<!DOCTYPE html>
<html lang="en">
        <!-- Latest compiled and minified CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<!-- Fav Icon-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Camera Link-->

<script src="https://cdn.tailwindcss.com"></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INGOO || Absensi Kamera ({{ session('name') }})</title>
</head>

<style>
    .endpage{
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 60px; /* Height of the footer */
        background-color: #f5f5f5;
    }
    .hide-on-small {
        display: inline;
    }
    .camera-container {
        width: 100%;
        max-width: 360px;
        margin: 0 auto;
    }
    .camera-preview {
        width: 100%;
        aspect-ratio: 4/3;
        object-fit: cover;
        border: 1px solid #ddd;
        background: #000;
        display: block;
    }
    .preview-image {
        width: 100%;
        max-width: 360px;
        margin: 10px auto 0;
        border: 1px solid #ccc;
        display: none;
    }
    @media (max-width: 500px) {
        .hide-on-small {
            display: none;
        }
        .camera-container {
            width: 90%;
        }
    }
</style>

<body>
    <nav>
        <div class="container-fluid bg-light">
            <div class="d-flex flex-row-reverse p-2">
               <a class="btn btn-outline-dark ml-2" href="{{ route('karyawan/logout') }}" role="button"><i class="fas fa-sign-out-alt"></i><span class="hide-on-small"> Logout</span></a>
                <div class="dropdown">
                    <button
                        class="btn btn-outline-dark dropdown-toggle"
                        type="button"
                        id="triggerId"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                       <i class="fa fa-bars" aria-hidden="true"></i><span class="hide-on-small"> Main Menu </span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="triggerId">
                        <a class="dropdown-item" href="{{ route('karyawan/dashboard') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali ke Main Menu</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <main>
        <div class="container mt-5 mb-5">
            <div class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center m-2">
                            <h1 class="text-center font-bold mb-2">Absensi Kamera</h1>
                            <p class="mb-2">Silakan ambil foto untuk absensi ( Pastikan kamera telah diizinkan oleh browser ).</p>
                            <div id="cameraStatus" class="alert alert-info" role="alert" style="display:none"></div>

                            <!-- Camera preview and capture -->
                            <div class="mb-3 camera-container">
                                <video id="video" class="camera-preview" autoplay playsinline></video>
                                <canvas id="canvas" width="360" height="270" style="display:none"></canvas>
                                <img id="previewImage" src="#" alt="Preview" class="preview-image" />
                            </div>

                            <!-- Fallback file input for devices that don't support getUserMedia -->
                            <div class="mb-2">
                                <input type="file" accept="image/*" capture="environment" id="cameraInput" style="display:none">
                            </div>

                            <form id="absensiForm" action="{{ route('karyawan/absensi_kamera/rekam') }}" method="POST">
                                @csrf
                                <input type="hidden" name="photo" id="photoInput">
                                <div class="d-flex justify-content-center gap-2">
                                    <div class="dropdown">
                                        <button class="btn btn-outline-dark dropdown-toggle" type="button" id="cameraDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-camera" aria-hidden="true"></i> </i><span class="hide-on-small"> Menu Camera </span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="cameraDropdown">
                                            <li><a class="dropdown-item" href="#" id="startCameraDropdown"><i class="fa fa-camera-retro" aria-hidden="true"></i> Mulai Camera</a></li>
                                            <li><a class="dropdown-item" href="#" id="captureDropdown"><i class="fa fa-image" aria-hidden="true"></i> Ambil Gambar</a></li>
                                        </ul>
                                    </div>
                                    <button type="button" id="retakeBtn" class="btn btn-dark" style="display:none"><i class="fa fa-repeat" aria-hidden="true"></i><span class="hide-on-small"> Retake </span></button>
                                    <button type="submit" id="submitBtn" class="btn btn-dark" disabled><i class="fa fa-paper-plane" aria-hidden="true"></i><span class="hide-on-small"> Submit </span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
    let stream;
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const previewImage = document.getElementById('previewImage');
    const photoInput = document.getElementById('photoInput');
    const retakeBtn = document.getElementById('retakeBtn');
    const submitBtn = document.getElementById('submitBtn');
    const cameraInput = document.getElementById('cameraInput');
    // Dropdown menu actions
    const startCameraDropdown = document.getElementById('startCameraDropdown');
    const captureDropdown = document.getElementById('captureDropdown');
    let cameraActive = false;

        async function checkCameraPermission() {
            // Show current permission state if Permissions API is available
            const statusEl = document.getElementById('cameraStatus');
            if (navigator.permissions && navigator.permissions.query) {
                try {
                    const perm = await navigator.permissions.query({ name: 'camera' });
                    if (perm.state === 'granted') {
                        statusEl.className = 'alert alert-success';
                        statusEl.textContent = 'Akses kamera sudah diberikan. Tekan "Mulai Camera" untuk memulai.';
                        statusEl.style.display = 'block';
                        return 'granted';
                    } else if (perm.state === 'prompt') {
                        statusEl.className = 'alert alert-info';
                        statusEl.textContent = 'Browser akan meminta izin kamera saat Anda menekan "Mulai Camera".';
                        statusEl.style.display = 'block';
                        return 'prompt';
                    } else {
                        statusEl.className = 'alert alert-danger';
                        statusEl.innerHTML = 'Akses kamera diblokir. Silakan buka pengaturan browser dan izinkan akses kamera untuk situs ini.';
                        statusEl.style.display = 'block';
                        return 'denied';
                    }
                } catch (e) {
                    // some browsers may throw for 'camera' permission query
                }
            }
            // Fallback: check for mediaDevices support
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                statusEl.className = 'alert alert-warning';
                statusEl.innerHTML = 'Perangkat Anda tidak mendukung akses kamera lewat browser. Silakan gunakan tombol "Mulai Camera" atau pilih file dari perangkat.';
                statusEl.style.display = 'block';
                return 'unsupported';
            }
            // default
            statusEl.style.display = 'none';
            return 'unknown';
        }

        async function startCamera() {
            const statusEl = document.getElementById('cameraStatus');
            const perm = await checkCameraPermission();
            if (perm === 'denied') {
                return;
            }
            try {
                // Ubah facingMode ke 'user' agar menggunakan kamera depan
                stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' }, audio: false });
                video.srcObject = stream;
                cameraActive = true;
                statusEl.className = 'alert alert-success';
                statusEl.textContent = 'Kamera aktif (depan). Tekan "Ambil Gambar" untuk mengambil foto.';
                statusEl.style.display = 'block';
            } catch (err) {
                statusEl.className = 'alert alert-danger';
                statusEl.innerHTML = 'Tidak dapat mengakses kamera: ' + (err && err.message ? err.message : err) + '<br/>1.Silakan periksa pengaturan izin browser <br/>2.Cek perangkat anda yang lainnya. <br/>3.Silahkan upload dari gallery HP anda/ PC anda.';
                statusEl.style.display = 'block';
                cameraInput.click();
            }
        }

        function stopCamera() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
            }
            cameraActive = false;
        }

        function capturePhoto() {
            if (!cameraActive) return;
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const dataUrl = canvas.toDataURL('image/jpeg', 0.9);
            previewImage.src = dataUrl;
            previewImage.style.display = 'block';
            photoInput.value = dataUrl;
            submitBtn.disabled = false;
            retakeBtn.style.display = 'inline-block';
            stopCamera();
        }

        retakeBtn.addEventListener('click', function () {
            previewImage.style.display = 'none';
            photoInput.value = '';
            submitBtn.disabled = true;
            retakeBtn.style.display = 'none';
            startCamera();
        });

        cameraInput.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
                photoInput.value = e.target.result;
                submitBtn.disabled = false;
                retakeBtn.style.display = 'inline-block';
            };
            reader.readAsDataURL(file);
        });

        startCameraDropdown.addEventListener('click', function(e) {
            e.preventDefault();
            startCamera();
        });
        captureDropdown.addEventListener('click', function(e) {
            e.preventDefault();
            capturePhoto();
        });

    // stop camera when leaving page
    window.addEventListener('beforeunload', stopCamera);
    </script>

</body>
</html>