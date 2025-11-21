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
    <script src="{{ asset('js/face-api.min.js') }}"></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INGOO || Histori Absensi ({{ session('user_name') }})</title>
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
            <div class="container-fluid">
                <div class="d-flex align-items-center">

                    <!--logo Perusahaan -->
                    <div class="logo-layout">
                        <img src="{{ asset('logo/logo_ingoo.png') }}" alt="INGOO" style="weight:auto; height:70px;" class="img-fluid mx-auto">
                    </div>

                    <div class="flex-fill"></div>

                    <!-- Menu button on the right -->
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
                                @if ($show_check_out)
                                    <a class="dropdown-item" href="{{ route('karyawan/absensi_kamera/check_out') }}"><i class="fa fa-user-circle-o" aria-hidden="true"></i><i class="fas fa-camera-alt" aria-hidden="true"></i> Absensi Keluar </a>
                                @else
                                    <a class="dropdown-item" href="{{ route('karyawan/absensi_kamera/check_in') }}"><i class="fa fa-user-circle-o" aria-hidden="true"></i><i class="fas fa-camera-alt" aria-hidden="true"></i> Absensi Masuk </a>
                                @endif
                                <div class="dropdown-divider"></div>
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
                    <div class="flex-fill d-flex flex-row-reverse p-2">
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
                                @if ($show_check_out)
                                    <a class="dropdown-item" href="{{ route('karyawan/absensi_kamera/check_out') }}"><i class="fa fa-user-circle-o" aria-hidden="true"></i><i class="fas fa-camera-alt" aria-hidden="true"></i> Absensi Keluar </a>
                                @else
                                    <a class="dropdown-item" href="{{ route('karyawan/absensi_kamera/check_in') }}"><i class="fa fa-user-circle-o" aria-hidden="true"></i><i class="fas fa-camera-alt" aria-hidden="true"></i> Absensi Masuk </a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('karyawan/dashboard') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali ke Main Menu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <main>
        <div class="container mt-5 mb-5">
            <div class="d-flex justify-content-center">
                <!-- Fetch all data karyawan -->
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center font-bold">Histori Absensi Karyawan</h1>
                        <h6 class="text-center font-bold"> ({{ $nama_karyawan }})</h4>
                        @if (Session::has('message'))
                            <div class="alert alert-success m-3" role="alert"><center>{{ Session::get('message') }}</center></div>
                        @endif

                        <div class="table-responsive">
                            <div class="if-table-displays-in-mobile">
                                <!-- Table Absensi Karyawan Mode Vertical -->
                                 <table id="absensiMobileTable" class="table table-bordered table-striped mt-3 mb-4">
                                    <thead>
                                        <tr>
                                            <th data-sortable="date">Tanggal Absensi <span class="sort-indicator"></span></th>
                                            <th data-sortable="time">Jam Masuk <span class="sort-indicator"></span></th>
                                            <th data-sortable="time">Jam Keluar <span class="sort-indicator"></span></th>
                                            <th data-sortable="string">Status Absensi <span class="sort-indicator"></span></th>
                                            <th>Koordinat (Google Maps)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fetch_data_mobile as $index => $absensi_mobile)
                                        <tr>
                                            <td>{{ $absensi_mobile->tanggal_absensi ?? 'N/A' }}</td>
                                            <td>{{ $absensi_mobile->jam_masuk ?? 'N/A' }}</td>
                                            <td>{{ $absensi_mobile->jam_keluar ?? 'N/A' }}</td>
                                            <td>{{ $absensi_mobile->status_absensi ?? 'N/A'}}</td>
                                            <td>
                                                <a href="#" class="koordinat-link" data-koordinat="{{ $absensi_mobile->koordinat }}">{{ $absensi_mobile->koordinat }}</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="if-table-displays-in-desktop">
                                <table id="absensiDesktopTable" class="table table-bordered table-striped mt-3">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th data-sortable="date">Tanggal Absensi <span class="sort-indicator"></span></th>
                                            <th data-sortable="time">Jam Masuk <span class="sort-indicator"></span></th>
                                            <th data-sortable="time">Jam Keluar <span class="sort-indicator"></span></th>
                                            <th data-sortable="string">Status Absensi <span class="sort-indicator"></span></th>
                                            <th>Koordinat (Google Maps)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fetch_data_desktop as $index => $absensi_desktop)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $absensi_desktop->tanggal_absensi ?? 'N/A' }}</td>
                                            <td>{{ $absensi_desktop->jam_masuk ?? 'N/A' }}</td>
                                            <td>{{ $absensi_desktop->jam_keluar ?? 'N/A' }}</td>
                                            <td>{{ $absensi_desktop->status_absensi ?? 'N/A'}}</td>
                                            <td>
                                                <a href="#" class="koordinat-link" data-koordinat="{{ $absensi_desktop->koordinat }}">{{ $absensi_desktop->koordinat }}</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center m-3">
                <div class="if-table-displays-in-mobile">
                    {{ $fetch_data_mobile->links('pagination::bootstrap-5') }}
                </div>
                
                <div class="if-table-displays-in-desktop">
                    {{ $fetch_data_desktop->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </main>
        <!-- Google Maps Modal -->
        <div class="modal fade" id="koordinatModal" tabindex="-1" aria-labelledby="koordinatModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="koordinatModalLabel">Lokasi Absensi (Google Maps)</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="koordinatMapContainer" style="width:100%;height:400px;">
                            <iframe id="koordinatMapIframe" src="" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
        // Clock out photo capture functionality
        let clockOutStream = null;
        let clockOutModelsLoaded = false;

        async function initializeClockOutCamera() {
            try {
                const constraints = {
                    video: {
                        facingMode: 'user',
                        width: { ideal: 640 },
                        height: { ideal: 480 }
                    },
                    audio: false
                };

                clockOutStream = await navigator.mediaDevices.getUserMedia(constraints);
                const videoElement = document.createElement('video');
                videoElement.srcObject = clockOutStream;
                videoElement.autoplay = true;
                videoElement.playsinline = true;
                videoElement.style.display = 'none';
                document.body.appendChild(videoElement);

                await new Promise(resolve => {
                    videoElement.onloadedmetadata = () => {
                        videoElement.play();
                        resolve();
                    };
                });

                return videoElement;
            } catch (error) {
                console.error('Clock out camera error:', error);
                alert('Camera access failed for clock out');
                return null;
            }
        }

        async function loadClockOutModels() {
            if (clockOutModelsLoaded) return;

            try {
                const MODEL_URL = '{{ asset("weights") }}';
                await Promise.all([
                    faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_URL),
                    faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL),
                    faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL)
                ]);
                clockOutModelsLoaded = true;
                console.log('Clock out models loaded');
            } catch (error) {
                console.error('Clock out model loading error:', error);
            }
        }

        async function captureClockOutPhoto() {
            const videoElement = await initializeClockOutCamera();
            if (!videoElement) return;

            await loadClockOutModels();

            const canvas = document.createElement('canvas');
            canvas.width = videoElement.videoWidth || 640;
            canvas.height = videoElement.videoHeight || 480;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

            // Detect face
            const detection = await faceapi
                .detectSingleFace(canvas, new faceapi.TinyFaceDetectorOptions({ inputSize: 512, scoreThreshold: 0.35 }))
                .withFaceLandmarks()
                .withFaceDescriptor();

            if (!detection) {
                alert('No face detected. Please try again.');
                return;
            }

            const imageData = canvas.toDataURL('image/jpeg', 0.9);
            document.getElementById('clockOutPhotoInput').value = imageData;
            document.getElementById('clockOutPreviewImg').src = imageData;
            document.getElementById('clockOutPreview').style.display = 'block';

            // Stop camera
            if (clockOutStream) {
                clockOutStream.getTracks().forEach(track => track.stop());
            }
            if (videoElement) {
                document.body.removeChild(videoElement);
            }
        }

        // Cleanup on page unload
        window.addEventListener('beforeunload', function () {
            if (clockOutStream) {
                clockOutStream.getTracks().forEach(track => track.stop());
            }
        });

        // ====================================================================
        // Server-side AJAX sorting (no page refresh)
        // - Click on headers to fetch sorted data from server via AJAX
        // - Updates table body with new sorted rows
        // ====================================================================

        let currentSortBy = 'tanggal_absensi';
        let currentSortOrder = 'desc';

        const sortByMap = {
            'Tanggal Absensi': 'tanggal_absensi',
            'Jam Masuk': 'jam_masuk',
            'Jam Keluar': 'jam_keluar',
            'Status Absensi': 'status_absensi'
        };

        async function fetchSortedData(sortBy, sortOrder, tableType) {
            try {
                const url = new URL('{{ route("karyawan/histori_absensi/ajax") }}', window.location.origin);
                url.searchParams.append('sort_by', sortBy);
                url.searchParams.append('sort_order', sortOrder);
                url.searchParams.append('per_page', tableType === 'mobile' ? 2 : 5);

                const response = await fetch(url.toString());
                if (!response.ok) throw new Error('Network response failed');
                const result = await response.json();

                if (result.success) {
                    return result.data;
                } else {
                    console.error('Server error:', result);
                    alert('Failed to fetch sorted data');
                    return null;
                }
            } catch (error) {
                console.error('Fetch error:', error);
                alert('Error fetching sorted data: ' + error.message);
                return null;
            }
        }

        function updateTableBody(tableId, data, isMobile) {
            const table = document.getElementById(tableId);
            if (!table) return;
            const tbody = table.tBodies[0];
            tbody.innerHTML = '';

            data.forEach(row => {
                const tr = document.createElement('tr');
                if (isMobile) {
                    tr.innerHTML = `
                        <td>${row.tanggal_absensi || 'N/A'}</td>
                        <td>${row.jam_masuk || 'N/A'}</td>
                        <td>${row.jam_keluar || 'N/A'}</td>
                        <td>${row.status_absensi || 'N/A'}</td>
                        <td>${row.koordinat || 'N/A'}</td>
                    `;
                } else {
                    tr.innerHTML = `
                        <td>${row.index}</td>
                        <td>${row.tanggal_absensi || 'N/A'}</td>
                        <td>${row.jam_masuk || 'N/A'}</td>
                        <td>${row.jam_keluar || 'N/A'}</td>
                        <td>${row.status_absensi || 'N/A'}</td>
                        <td>${row.koordinat || 'N/A'}</td>
                    `;
                }
                tbody.appendChild(tr);
            });
        }

        function attachAjaxSorting(tableId, isMobile) {
            const table = document.getElementById(tableId);
            if (!table) return;
            const headers = table.querySelectorAll('th[data-sortable]');

            headers.forEach((th) => {
                th.style.cursor = 'pointer';
                let sortOrder = 'asc';

                th.addEventListener('click', async () => {
                    const headerText = th.textContent.trim().replace(/[\s▲▼]/g, '').trim();
                    const sortBy = sortByMap[headerText];

                    if (!sortBy) {
                        console.warn('Sort column not found:', headerText);
                        return;
                    }

                    currentSortBy = sortBy;
                    currentSortOrder = sortOrder;

                    // Update sort indicators
                    headers.forEach(h => {
                        const s = h.querySelector('.sort-indicator');
                        if (s) s.textContent = '';
                    });
                    const indicator = th.querySelector('.sort-indicator');
                    if (indicator) indicator.textContent = sortOrder === 'asc' ? ' ▲' : ' ▼';

                    // Fetch sorted data
                    const data = await fetchSortedData(sortBy, sortOrder, isMobile ? 'mobile' : 'desktop');
                    if (data) {
                        updateTableBody(tableId, data, isMobile);
                    }

                    // Toggle sort order for next click
                    sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
                });
            });
        }

        // Attach AJAX sorting for both tables when DOM is ready
        document.addEventListener('DOMContentLoaded', function () {
            attachAjaxSorting('absensiMobileTable', true);
            attachAjaxSorting('absensiDesktopTable', false);

            // Modal for Koordinat Google Maps
            document.querySelectorAll('.koordinat-link').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    var koordinat = this.getAttribute('data-koordinat');
                    if (koordinat && koordinat !== 'N/A') {
                        var mapUrl = 'https://www.google.com/maps?q=' + encodeURIComponent(koordinat) + '&output=embed';
                        document.getElementById('koordinatMapIframe').src = mapUrl;
                        var modal = new bootstrap.Modal(document.getElementById('koordinatModal'));
                        modal.show();
                    }
                });
            });
        });
    </script>
</body>
</html>
