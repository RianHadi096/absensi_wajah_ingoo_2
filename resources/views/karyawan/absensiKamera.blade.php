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
    <title>Absensi Kamera</title>
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
    @media (max-width: 500px) {
        .hide-on-small {
            display: none;
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
                        <div class="text-center m-3">
                            <h3>Absensi Kamera</h3>
                            <p>Silakan ambil foto untuk absensi. Pastikan kamera telah diizinkan oleh browser.</p>

                            <!-- Camera preview and capture -->
                            <div class="mb-3">
                                <video id="video" width="360" height="270" autoplay playsinline style="border:1px solid #ddd;background:#000"></video>
                                <canvas id="canvas" width="360" height="270" style="display:none"></canvas>
                                <img id="previewImage" src="#" alt="Preview" style="display:none; max-width:360px; margin-top:10px; border:1px solid #ccc"> 
                            </div>

                            <!-- Fallback file input for devices that don't support getUserMedia -->
                            <div class="mb-2">
                                <input type="file" accept="image/*" capture="environment" id="cameraInput" style="display:none">
                            </div>

                            <form id="absensiForm" action="{{ route('karyawan/absensi_kamera/rekam') }}" method="POST">
                                @csrf
                                <input type="hidden" name="photo" id="photoInput">
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" id="startCameraBtn" class="btn btn-outline-primary">Start Camera</button>
                                    <button type="button" id="captureBtn" class="btn btn-primary" disabled>Capture</button>
                                    <button type="button" id="retakeBtn" class="btn btn-warning" style="display:none">Retake</button>
                                    <button type="submit" id="submitBtn" class="btn btn-success" disabled>Submit Absensi</button>
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
        const startCameraBtn = document.getElementById('startCameraBtn');
        const captureBtn = document.getElementById('captureBtn');
        const retakeBtn = document.getElementById('retakeBtn');
        const submitBtn = document.getElementById('submitBtn');
        const cameraInput = document.getElementById('cameraInput');

        async function startCamera() {
            try {
                stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' }, audio: false });
                video.srcObject = stream;
                captureBtn.disabled = false;
                startCameraBtn.disabled = true;
            } catch (err) {
                // fallback: trigger file input if camera access denied or not available
                cameraInput.click();
            }
        }

        function stopCamera() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
            }
            startCameraBtn.disabled = false;
        }

        captureBtn.addEventListener('click', function () {
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const dataUrl = canvas.toDataURL('image/jpeg', 0.9);
            previewImage.src = dataUrl;
            previewImage.style.display = 'block';
            photoInput.value = dataUrl;
            submitBtn.disabled = false;
            retakeBtn.style.display = 'inline-block';
            captureBtn.disabled = true;
            stopCamera();
        });

        retakeBtn.addEventListener('click', function () {
            previewImage.style.display = 'none';
            photoInput.value = '';
            submitBtn.disabled = true;
            retakeBtn.style.display = 'none';
            captureBtn.disabled = false;
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
                captureBtn.disabled = true;
            };
            reader.readAsDataURL(file);
        });

        startCameraBtn.addEventListener('click', startCamera);

        // stop camera when leaving page
        window.addEventListener('beforeunload', stopCamera);
    </script>

</body>
</html>