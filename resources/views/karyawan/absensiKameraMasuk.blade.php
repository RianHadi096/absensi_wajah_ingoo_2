<!DOCTYPE html>
<html lang="en">
        <!-- Latest compiled and minified CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<!-- Fav Icon-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Camera Link-->
<script src="{{ asset('js/face-api.min.js') }}"></script>

<script src="https://cdn.tailwindcss.com"></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INGOO || Absensi Kamera ({{ session('user_name') }})</title>
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
    .desktop-mode{
        display: inline;
    }
    .mobile-mode{
        display: none;
    }
    @media (max-width: 500px) {
        /* Reduce font sizes for mobile devices */
        body, nav, main, footer, h1, h2, h3, h4, h5, h6, p, a, div, td, th, span, button {
            font-size: 11px !important;
        }
        h1 {
            font-size: 16px !important;
        }
        h2 {
            font-size: 14px !important;
        }
        h6 {
            font-size: 12px !important;
        }
        .btn {
            padding: 0.3rem 0.5rem !important;
            font-size: 10px !important;
        }
        .hide-on-small {
            display: none;
        }
        .camera-container {
            width: 90%;
        }
        .desktop-mode{
            display: none;
        }
        .mobile-mode{
            display: inline;
        }
        .logo-layout{
            padding-left: 80px;
        }
    }
</style>

<body>
    <nav>
        <div class="desktop-mode">
            <!-- Desktop Mode -->
            <div class="container-fluid">
                <div class="d-flex align-items-center">

                    <!--logo Perusahaan -->
                    <div class="">
                        <img src="{{ asset('logo/logo_ingoo.png') }}" alt="INGOO" style="weight:auto; height:70px;" class="img-fluid mx-auto">
                    </div>

                    <div class="flex-fill"></div>

                    <!-- Menu button on the right -->
                    <div class="flex-fill d-flex flex-row-reverse"">
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
            </div>
        </div>
        <div class="mobile-mode">
            <!-- Mobile Mode -->
            <div class="d-flex align-items-center">
                <div class="flex-fill"></div>
                    <!--logo Perusahaan -->
                    <div class="logo-layout">
                        <img src="{{ asset('logo/logo_ingoo.png') }}" alt="INGOO" style="weight:auto; height:70px;" class="img-fluid mx-auto">
                    </div>

                    <!-- Menu button on the right -->
                    <div class="flex-fill d-flex flex-row-reverse pr-4">
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
        </div>
    </nav>
    <main>
        <div class="container mt-5 mb-5">
            <div class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center m-2">
                            <h1 class="text-center font-bold mb-2">Absensi Masuk</h1>
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

                            <form id="absensiForm" action="{{ route('karyawan/absensi_kamera/rekam_check_in') }}" method="POST">
                                @csrf
                                <input type="hidden" name="photo" id="photoInput">
                                <input type="hidden" name="koordinat" id="koordinatInput">
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
        // ============================================================================
        // FACE RECOGNITION ATTENDANCE SYSTEM
        // Initialize camera, load face detection models, and verify employee identity
        // ============================================================================

        <?php
            use App\Models\Karyawan;
            $karyawan = null;
            try {
                $karyawan = Karyawan::find(session('user_id'));
            } catch (Exception $e) {
                $karyawan = null;
            }
            $referenceImageUrl = '';
            if ($karyawan && !empty($karyawan->imageFileLocation)) {
                $referenceImageUrl = asset('storage/' . $karyawan->imageFileLocation);
            }
        ?>

        const VIDEO_ID = 'video';
        const CANVAS_ID = 'canvas';
        const PREVIEW_IMAGE_ID = 'previewImage';
        const CAMERA_STATUS_ID = 'cameraStatus';
        const PHOTO_INPUT_ID = 'photoInput';
        const SUBMIT_BTN_ID = 'submitBtn';
        const RETAKE_BTN_ID = 'retakeBtn';
        const ABSENSI_FORM_ID = 'absensiForm';
        const START_CAMERA_DROPDOWN_ID = 'startCameraDropdown';
        const CAPTURE_DROPDOWN_ID = 'captureDropdown';

        let stream = null;
        let modelsLoaded = false;
        let currentFaceDescriptor = null;
        let referenceDescriptor = null;
        let userLocation = null;
        const REFERENCE_IMAGE_URL = {!! json_encode($referenceImageUrl) !!};

        /**
         * Recommended TinyFaceDetector options helper
         * - inputSize: 320/416/512 (bigger -> more accurate, slower)
         * - scoreThreshold: lower -> more detections (may increase false positives)
         */
        function getTinyOptions() {
            return new faceapi.TinyFaceDetectorOptions({ inputSize: 512, scoreThreshold: 0.35 });
        }

        // ============================================================================
        // 1. INITIALIZE CAMERA
        // ============================================================================

        /**
         * Start camera using getUserMedia API
         * Supports both desktop webcam and mobile front camera
         */
        async function initializeCamera() {
            try {
                const statusElement = document.getElementById(CAMERA_STATUS_ID);
                statusElement.style.display = 'block';
                statusElement.className = 'alert alert-info';
                statusElement.textContent = 'Mengakses kamera...';

                const constraints = {
                    video: {
                        facingMode: 'user', // Front camera
                        width: { ideal: 1280 },
                        height: { ideal: 960 }
                    },
                    audio: false
                };

                stream = await navigator.mediaDevices.getUserMedia(constraints);
                const videoElement = document.getElementById(VIDEO_ID);
                videoElement.srcObject = stream;

                // Wait for video to load
                await new Promise(resolve => {
                    videoElement.onloadedmetadata = () => {
                        videoElement.play();
                        // Make canvas match actual video size for accurate detection
                        const canvasElement = document.getElementById(CANVAS_ID);
                        canvasElement.width = videoElement.videoWidth || canvasElement.width;
                        canvasElement.height = videoElement.videoHeight || canvasElement.height;
                        resolve();
                    };
                });

                statusElement.className = 'alert alert-success';
                statusElement.textContent = 'Kamera berhasil diaktifkan ✓';
                setTimeout(() => {
                    statusElement.style.display = 'none';
                }, 3000);

                console.log('Camera initialized successfully');
            } catch (error) {
                console.error('Camera error:', error);
                const statusElement = document.getElementById(CAMERA_STATUS_ID);
                statusElement.className = 'alert alert-danger';
                statusElement.textContent = 'Error: ' + (error.name === 'NotAllowedError' 
                    ? 'Izin kamera ditolak. Silakan izinkan akses kamera di pengaturan browser.' 
                    : 'Kamera tidak tersedia.');
                statusElement.style.display = 'block';
            }
        }

        // ============================================================================
        // 2. LOAD FACE-API MODELS
        // ============================================================================

        /**
         * Load face detection and recognition models
         * Models: TinyFaceDetector, FaceLandmark68Net, FaceRecognitionNet
         */
        async function loadFaceApiModels() {
            try {
                const statusElement = document.getElementById(CAMERA_STATUS_ID);
                statusElement.style.display = 'block';
                statusElement.className = 'alert alert-info';
                statusElement.textContent = 'Memuat model face detection...';

                // Model paths from assets
                const MODEL_URL = '{{ asset("weights") }}';

                await Promise.all([
                    faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_URL),
                    faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL),
                    faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL)
                ]);

                modelsLoaded = true;
                statusElement.className = 'alert alert-success';
                statusElement.textContent = 'Model face detection berhasil dimuat ✓';
                setTimeout(() => {
                    statusElement.style.display = 'none';
                }, 3000);

                console.log('Face-api models loaded successfully');
            } catch (error) {
                console.error('Model loading error:', error);
                const statusElement = document.getElementById(CAMERA_STATUS_ID);
                statusElement.className = 'alert alert-danger';
                statusElement.textContent = 'Error: Gagal memuat model face detection. ' + error.message;
                statusElement.style.display = 'block';
            }
        }

        // ============================================================================
        // 3. CAPTURE IMAGE FROM CAMERA
        // ============================================================================

        /**
         * Capture image from video stream
         */
        function captureImage() {
            const videoElement = document.getElementById(VIDEO_ID);
            const canvasElement = document.getElementById(CANVAS_ID);
            const previewImageElement = document.getElementById(PREVIEW_IMAGE_ID);

            // Ensure canvas size matches current video frame (critical on some devices)
            canvasElement.width = videoElement.videoWidth || canvasElement.width;
            canvasElement.height = videoElement.videoHeight || canvasElement.height;

            const ctx = canvasElement.getContext('2d');
            // draw the current video frame into the canvas
            ctx.drawImage(videoElement, 0, 0, canvasElement.width, canvasElement.height);

            // Convert canvas to data URL
            const imageData = canvasElement.toDataURL('image/jpeg', 0.9);
            previewImageElement.src = imageData;
            previewImageElement.style.display = 'block';

            // Store for later submission
            document.getElementById(PHOTO_INPUT_ID).value = imageData;

            // Hide video, show preview
            videoElement.style.display = 'none';
            
            // Show retake button, disable submit button initially
            document.getElementById(RETAKE_BTN_ID).style.display = 'inline-block';
            document.getElementById(SUBMIT_BTN_ID).disabled = true;

            console.log('Image captured');
            return imageData;
        }

        // ============================================================================
        // 4. DETECT AND EXTRACT FACE DESCRIPTOR
        // ============================================================================

        /**
         * Detect face in captured image and extract descriptor
         * Returns face descriptor for comparison
         */
        async function detectAndExtractFaceDescriptor() {
            try {
                if (!modelsLoaded) {
                    throw new Error('Face-api models not loaded');
                }

                const canvasElement = document.getElementById(CANVAS_ID);
                const statusElement = document.getElementById(CAMERA_STATUS_ID);

                statusElement.style.display = 'block';
                statusElement.className = 'alert alert-info';
                statusElement.textContent = 'Mendeteksi wajah...';

                // Detect single face with tuned options. Using detectSingleFace avoids multiple-face ambiguity.
                const detection = await faceapi
                    .detectSingleFace(canvasElement, getTinyOptions())
                    .withFaceLandmarks()
                    .withFaceDescriptor();

                if (!detection) {
                    statusElement.className = 'alert alert-warning';
                    statusElement.textContent = 'Wajah tidak terdeteksi. Silakan ambil foto kembali dengan pencahayaan yang baik dan wajah menghadap kamera.';
                    document.getElementById(SUBMIT_BTN_ID).disabled = true;
                    return null;
                }

                currentFaceDescriptor = detection.descriptor;

                statusElement.className = 'alert alert-success';
                statusElement.textContent = 'Wajah terdeteksi dengan baik ✓ Siap untuk verifikasi...';

                console.log('Face detected and descriptor extracted');
                return detection;
            } catch (error) {
                console.error('Face detection error:', error);
                const statusElement = document.getElementById(CAMERA_STATUS_ID);
                statusElement.className = 'alert alert-danger';
                statusElement.textContent = 'Error: Gagal mendeteksi wajah. ' + error.message;
                document.getElementById(SUBMIT_BTN_ID).disabled = true;
                return null;
            }
        }

        // ============================================================================
        // 5. VERIFY FACE WITH DATABASE
        // ============================================================================

        /**
         * Fetch reference face descriptor from server
         * Compares with captured face using Euclidean distance
         */
        async function verifyFaceWithDatabase(photoData) {
            try {
                const statusElement = document.getElementById(CAMERA_STATUS_ID);
                statusElement.style.display = 'block';
                statusElement.className = 'alert alert-info';
                statusElement.textContent = 'Memverifikasi wajah dengan database...';

                // If we don't have a reference descriptor computed client-side, try to load the reference image
                if (!referenceDescriptor && REFERENCE_IMAGE_URL) {
                    try {
                        const img = new Image();
                        img.crossOrigin = 'anonymous';
                        img.src = REFERENCE_IMAGE_URL;
                        await new Promise((resolve, reject) => {
                            img.onload = resolve;
                            img.onerror = () => {
                                console.warn('Gagal memuat gambar referensi dari', REFERENCE_IMAGE_URL);
                                resolve();
                            };
                        });
                        const refDetection = await faceapi
                            .detectSingleFace(img, getTinyOptions())
                            .withFaceLandmarks()
                            .withFaceDescriptor();
                        if (refDetection && refDetection.descriptor) {
                            referenceDescriptor = refDetection.descriptor;
                            console.log('Reference descriptor computed from stored image');
                        } else {
                            console.warn('Tidak dapat mengekstrak descriptor dari foto referensi');
                        }
                    } catch (e) {
                        console.error('Error loading reference image:', e);
                    }
                }

                if (!referenceDescriptor) {
                    statusElement.className = 'alert alert-warning';
                    statusElement.textContent = 'Foto referensi tidak tersedia atau tidak dapat diproses. Verifikasi tidak dapat dilakukan.';
                    document.getElementById(SUBMIT_BTN_ID).disabled = true;
                    return false;
                }

                if (!currentFaceDescriptor) {
                    statusElement.className = 'alert alert-warning';
                    statusElement.textContent = 'Tidak ada descriptor wajah yang tertangkap. Silakan ambil foto terlebih dahulu.';
                    document.getElementById(SUBMIT_BTN_ID).disabled = true;
                    return false;
                }

                const distance = faceapi.euclideanDistance(currentFaceDescriptor, referenceDescriptor);
                console.log('Descriptor distance:', distance);

                const THRESHOLD = 0.5; // tweak between ~0.4 (strict) and 0.6 (lenient)

                if (distance <= THRESHOLD) {
                    statusElement.className = 'alert alert-success';
                    statusElement.textContent = 'Verifikasi berhasil! Wajah sesuai dengan data karyawan ✓ ';
                    document.getElementById(SUBMIT_BTN_ID).disabled = false;
                    return true;
                } else {
                    statusElement.className = 'alert alert-danger';
                    statusElement.textContent = 'Verifikasi gagal! Wajah tidak sesuai dengan data karyawan. Silakan coba lagi.';
                    document.getElementById(SUBMIT_BTN_ID).disabled = true;
                    return false;
                }
            } catch (error) {
                console.error('Verification error:', error);
                const statusElement = document.getElementById(CAMERA_STATUS_ID);
                statusElement.className = 'alert alert-danger';
                statusElement.textContent = 'Error: Gagal melakukan verifikasi. ' + error.message;
                document.getElementById(SUBMIT_BTN_ID).disabled = true;
                return false;
            }
        }

        // ============================================================================
        // 6. RETAKE PHOTO
        // ============================================================================

        /**
         * Clear captured image and go back to camera
         */
        function retakePhoto() {
            const videoElement = document.getElementById(VIDEO_ID);
            const previewImageElement = document.getElementById(PREVIEW_IMAGE_ID);
            const statusElement = document.getElementById(CAMERA_STATUS_ID);

            videoElement.style.display = 'block';
            previewImageElement.style.display = 'none';
            document.getElementById(RETAKE_BTN_ID).style.display = 'none';
            document.getElementById(SUBMIT_BTN_ID).disabled = true;
            document.getElementById(PHOTO_INPUT_ID).value = '';
            currentFaceDescriptor = null;

            statusElement.style.display = 'none';

            console.log('Photo retaken');
        }

        // ============================================================================
        // 6. GET USER LOCATION
        // ============================================================================

        /**
         * Get user location using Geolocation API
         */
        function getUserLocation() {
            return new Promise((resolve, reject) => {
                if (!navigator.geolocation) {
                    reject(new Error('Geolocation tidak didukung oleh browser ini.'));
                    return;
                }

                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;
                        userLocation = `${latitude},${longitude}`;
                        console.log('Location obtained:', userLocation);
                        resolve(userLocation);
                    },
                    (error) => {
                        console.error('Geolocation error:', error);
                        let errorMessage = 'Gagal mendapatkan lokasi: ';
                        switch(error.code) {
                            case error.PERMISSION_DENIED:
                                errorMessage += 'Izin lokasi ditolak. Silakan izinkan akses lokasi di pengaturan browser.';
                                break;
                            case error.POSITION_UNAVAILABLE:
                                errorMessage += 'Lokasi tidak tersedia.';
                                break;
                            case error.TIMEOUT:
                                errorMessage += 'Waktu habis untuk mendapatkan lokasi.';
                                break;
                            default:
                                errorMessage += 'Error tidak diketahui.';
                                break;
                        }
                        reject(new Error(errorMessage));
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 300000 // 5 minutes
                    }
                );
            });
        }

        // ============================================================================
        // 7. EVENT LISTENERS
        // ============================================================================

        document.addEventListener('DOMContentLoaded', async function () {
            // Initialize camera and load models on page load
            await initializeCamera();
            await loadFaceApiModels();

            // Try to get location on page load
            try {
                await getUserLocation();
                console.log('Location pre-obtained');
            } catch (error) {
                console.warn('Could not get location on load:', error.message);
            }

            // Pre-compute reference descriptor from stored image (if available) to speed up verification
            if (REFERENCE_IMAGE_URL) {
                try {
                    const img = new Image();
                    img.crossOrigin = 'anonymous';
                    img.src = REFERENCE_IMAGE_URL;
                    await new Promise((resolve) => {
                        img.onload = resolve;
                        img.onerror = resolve; // resolve even on error to avoid blocking
                    });
                    const refDetection = await faceapi
                        .detectSingleFace(img, getTinyOptions())
                        .withFaceLandmarks()
                        .withFaceDescriptor();
                    if (refDetection && refDetection.descriptor) {
                        referenceDescriptor = refDetection.descriptor;
                        console.log('Preloaded reference descriptor from stored image');
                    } else {
                        console.warn('Could not extract descriptor from reference image');
                    }
                } catch (e) {
                    console.error('Error preloading reference image:', e);
                }
            }

            // Start Camera button
            document.getElementById(START_CAMERA_DROPDOWN_ID).addEventListener('click', function (e) {
                e.preventDefault();
                initializeCamera();
            });

            // Capture Image button
            document.getElementById(CAPTURE_DROPDOWN_ID).addEventListener('click', async function (e) {
                e.preventDefault();
                const imageData = captureImage();
                if (imageData) {
                    await detectAndExtractFaceDescriptor();
                    if (currentFaceDescriptor) {
                        await verifyFaceWithDatabase(imageData);
                    }
                }
            });

            // Retake button
            document.getElementById(RETAKE_BTN_ID).addEventListener('click', function (e) {
                e.preventDefault();
                retakePhoto();
            });

            // Form submission
            document.getElementById(ABSENSI_FORM_ID).addEventListener('submit', async function (e) {
                // Prevent default submission so we can await async geolocation
                e.preventDefault();

                if (document.getElementById(SUBMIT_BTN_ID).disabled) {
                    alert('Silakan verifikasi wajah terlebih dahulu!');
                    return;
                }

                // Get location before submitting (await so koordinatInput is populated)
                try {
                    const location = await getUserLocation();
                    document.getElementById('koordinatInput').value = location;
                    console.log('Location set for submission:', location);
                } catch (error) {
                    // If location fails, still proceed but leave koordinat empty
                    alert('Gagal mendapatkan lokasi: ' + error.message + '. Absensi tetap akan dilanjutkan tanpa lokasi.');
                    document.getElementById('koordinatInput').value = '';
                }

                // Now submit the form programmatically
                e.target.submit();
            });

            // Stop camera when user leaves the page
            window.addEventListener('beforeunload', function () {
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                }
            });
        });
    </script>
</body>
</html>