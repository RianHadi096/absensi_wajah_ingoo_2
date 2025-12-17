<!DOCTYPE html>
<html lang="en">
        <!-- Latest compiled and minified CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<!-- Fav Icon-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<head>
    <!-- Add logo page-->
    <link rel="icon" type="image/png" href="{{ asset('logo/logo_ingoo_page.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INGOO || Profile ({{ session('user_name') }})</title>
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
    .if-table-displays-in-mobile {
            display: none;
    }
    .if-table-displays-in-desktop {
            display: inline;
    }
    /* Override Bootstrap 5 pagination text color to black */
    .page-link {
        color: #000 !important;  /* Black text for links */
    }
    .page-link:hover {
        color: #000 !important;  /* Black on hover */
        background-color: #f8f9fa;  /* Optional: Light gray background on hover */
    }
    /* Active page styling */
    .page-item.active .page-link {
        background-color: #000;  /* Black background for active page */
        border-color: #000;
        color: #fff !important;  /* White text on active for contrast */
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
        table {
            font-size: 10px !important;
        }
        .hide-on-small {
            display: none;
        }
        .if-table-displays-in-desktop {
            display: none;
        }
        .if-table-displays-in-mobile {
            overflow-x: auto;
            display: inline;
        }
        .logo-layout{
            padding-left: 80px;
        }
        .desktop-mode{
            display: none;
        }
        .mobile-mode{
            display: inline;
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
                    <div class="flex-fill d-flex flex-row-reverse gap-2 p-2">
                        <a class="btn btn-outline-dark" href="{{ route('karyawan/logout') }}" role="button"><i class="fas fa-sign-out-alt"></i><span class="hide-on-small"> Logout</span></a>
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
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <div class="flex-fill"></div>

                    <!--logo Perusahaan -->
                    <div class="logo-layout">
                        <img src="{{ asset('logo/logo_ingoo.png') }}" alt="INGOO" style="weight:auto; height:70px;" class="img-fluid mx-auto">
                    </div>

                    <!-- Menu button on the right -->
                    <div class="flex-fill d-flex flex-row-reverse gap-2 p-2">
                        
                        <a class="btn btn-outline-dark" href="{{ route('karyawan/logout') }}" role="button"><i class="fas fa-sign-out-alt"></i><span class="hide-on-small"> Logout</span></a>
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
    </nav>
    <main>
        <div class="container">
            <div class="text-center mb-5"><h2 class="mt-5">Pengaturan</h2></div>
                <div class="card w-75 mb-4 mx-auto">
                    <div class="card-body">
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <div class="form-check form-switch">
                                <label class="form-check-label" for="locationSwitch" style="font-weight: bold">Lokasi (Koordinat GPS)</label>
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="locationSwitch"
                                />
                            </div>
                            <div class="form-check form-switch">
                                <label class="form-check-label" for="cameraSwitch" style="font-weight: bold">Kamera</label>
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="cameraSwitch"
                                />
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
        <div class="justify-content-center text-center mt-5">
            <button type="button" class="btn btn-dark" data-bs-toggle="collapse" data-bs-target="#panduan-lokasi-kamera" aria-expanded="false" aria-controls="panduan-lokasi-kamera">
                <i class="fa fa-question-circle"></i> Panduan Lokasi dan Kamera
            </button>
        </div>

        <div class="container panduan-lokasi-kamera">
            <div class="text-center mb-5"><h2 class="mt-5">Cara Mengatur Lokasi dan Kamera</h2></div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Pengaturan Lokasi (Koordinat GPS)</h5>
                        </div>
                        <div class="card-body">
                            <p>Untuk mengaktifkan atau menonaktifkan akses lokasi (GPS) pada perangkat Anda, ikuti langkah-langkah berikut:</p>
                            <ol>
                                <li><strong>Aktifkan/Nonaktifkan fitur:</strong> Gunakan saklar "Lokasi (Koordinat GPS)" di atas untuk mengaktifkan atau menonaktifkan fitur ini.</li>
                                <li><strong>Pemberitahuan Browser:</strong> Saat pertama kali mengaktifkan, browser Anda mungkin akan meminta izin untuk mengakses lokasi Anda. Pilih "Izinkan" atau "Allow" untuk memberikan akses.</li>
                                <li><strong>Pengaturan Perangkat:</strong> Jika Anda tidak melihat permintaan izin atau mengalami masalah, periksa pengaturan lokasi pada perangkat Anda (ponsel atau komputer). Pastikan layanan lokasi diaktifkan untuk browser yang Anda gunakan.</li>
                                <ul>
                                    <li><strong>Android:</strong> Pengaturan > Lokasi > Izin Aplikasi > [Nama Browser Anda] > Izinkan.</li>
                                    <li><strong>iOS:</strong> Pengaturan > Privasi & Keamanan > Layanan Lokasi > [Nama Browser Anda] > Saat Menggunakan Aplikasi.</li>
                                    <li><strong>Windows/macOS:</strong> Periksa pengaturan privasi sistem untuk lokasi dan pastikan browser Anda memiliki izin.</li>
                                </ul>
                            </ol>
                            <p class="text-muted">Akses lokasi diperlukan untuk mencatat posisi Anda saat melakukan absensi.</p>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Pengaturan Kamera</h5>
                        </div>
                        <div class="card-body">
                            <p>Untuk mengaktifkan atau menonaktifkan akses kamera pada perangkat Anda, ikuti langkah-langkah berikut:</p>
                            <ol>
                                <li><strong>Aktifkan/Nonaktifkan fitur:
                                </strong> Gunakan saklar "Kamera" di atas untuk mengaktifkan atau menonaktifkan fitur ini.</li>
                                <li><strong>Pemberitahuan Browser:</strong> Saat pertama kali mengaktifkan, browser Anda mungkin akan meminta izin untuk mengakses kamera Anda. Pilih "Izinkan" atau "Allow" untuk memberikan akses.</li>
                                <li><strong>Pengaturan Perangkat:</strong> Jika Anda tidak melihat permintaan izin atau mengalami masalah, periksa pengaturan kamera pada perangkat Anda (ponsel atau komputer). Pastikan akses kamera diizinkan untuk browser yang Anda gunakan.</li>
                                <ul>
                                    <li><strong>Android:</strong> Pengaturan > Aplikasi > [Nama Browser Anda] > Izin > Kamera > Izinkan.</li>
                                    <li><strong>iOS:</strong> Pengaturan > Privasi & Keamanan > Kamera > [Nama Browser Anda] > Aktifkan.</li>
                                    <li><strong>Windows/macOS:</strong> Periksa pengaturan privasi sistem untuk kamera dan pastikan browser Anda memiliki izin.</li>
                                </ul>
                            </ol>
                            <p class="text-muted">Akses kamera diperlukan untuk mengambil foto saat melakukan absensi.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Hidden video element for camera stream -->
            <video id="videoElement" style="display: none;"></video>

        </div>
        
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            //tampilkan container panduan-lokasi-kamera
            const panduanLokasiKamera = document.querySelector('.panduan-lokasi-kamera');
            panduanLokasiKamera.style.display = 'none'; // Sembunyikan secara default

            document.querySelector('[data-bs-toggle="collapse"]').addEventListener('click', function() {
                if (panduanLokasiKamera.style.display === 'none') {
                    panduanLokasiKamera.style.display = 'block';
                } else {
                    panduanLokasiKamera.style.display = 'none';
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const locationSwitch = document.getElementById('locationSwitch');
            const cameraSwitch = document.getElementById('cameraSwitch');
            
            // Variable to hold the camera stream
            let cameraStream = null;

            locationSwitch.addEventListener('change', function() {
                if (this.checked) {
                    console.log('Lokasi (Koordinat GPS) telah diaktifkan.');
                    //izinkan lokasi
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            const latitude = position.coords.latitude;
                            const longitude = position.coords.longitude;
                            console.log('Latitude:', latitude);
                            console.log('Longitude:', longitude);
                        });
                    } else {
                        console.log('Geolocation is not supported by this browser.');
                    }
                    
                } else {
                    //matikan lokasi atau blokir lokasi
                    console.log('Lokasi (Koordinat GPS) telah dinonaktifkan.');
                    
                    console.log('Fitur Lokasi (Koordinat GPS) telah dinonaktifkan di aplikasi.');
                    alert('Untuk sepenuhnya memblokir akses, Anda harus mengubah pengaturan izin lokasi untuk situs ini di browser Anda.');
                }
            });

            cameraSwitch.addEventListener('change', function() {
                if (this.checked) {
                    console.log('Kamera telah diaktifkan.');
                    function startCamera() {
                        const video = document.getElementById('videoElement');
                        const constraints = {
                            video: true,
                            audio: false
                        };
                        navigator.mediaDevices.getUserMedia(constraints)
                            .then(function(stream) {
                                video.srcObject = stream;
                                video.play();
                            })
                            .catch(function(error) {
                                console.error('Error accessing camera:', error);
                            });
                    }
                    startCamera();
                    const video = document.getElementById('videoElement');
                    const constraints = {
                        video: true,
                        audio: false
                    };

                    // Request camera access
                    navigator.mediaDevices.getUserMedia(constraints)
                        .then(function(stream) {
                            cameraStream = stream; // Simpan stream
                            video.srcObject = stream;
                            video.play();
                            console.log('Akses kamera berhasil.');
                        })
                        .catch(function(error) {
                            console.error('Error mengakses kamera:', error);
                            alert('Gagal mengakses kamera. Pastikan Anda telah memberikan izin di browser.');
                            cameraSwitch.checked = false; // Kembalikan saklar ke posisi mati jika izin gagal
                        });
                } else {
                    console.log('Kamera telah dinonaktifkan.');
                    // Di sini Anda bisa menambahkan logika/fungsi saat kamera dinonaktifkan
                    if (cameraStream) {
                        // Hentikan setiap track (video) dalam stream
                        cameraStream.getTracks().forEach(track => track.stop());
                        cameraStream = null; // Hapus referensi stream
                        console.log('Stream kamera telah dihentikan.');
                    }
                }
            });
        });
    </script>
</body>
</html>