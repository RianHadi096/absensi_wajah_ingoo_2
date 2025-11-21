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
    <title>INGOO || Histori Absensi ({{ session('role') }})</title>
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
    .if-table-displays-in-desktop {
        display: inline;
    }
    .if-table-displays-in-mobile {
        display: none;
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
            display: inline;
        }
        .logo-layout{
            padding-left: 70px;
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
                    <div class="flex-fill">
                        <img src="{{ asset('logo/logo_ingoo.png') }}" alt="INGOO" style="height:70px;" class="img-fluid">
                    </div>

                    <!-- Center spacer to allow center alignment -->
                    <div class="flex-fill"></div>

                    <!-- Logout button on the right -->
                    <div class="d-flex flex-row-reverse">
                        <a class="btn btn-outline-dark ml-2" href="{{ route('admin/logout') }}" role="button"><i class="fas fa-sign-out-alt"></i><span class="hide-on-small"> Logout</span></a>
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
                                <a class="dropdown-item" href="{{ route('admin/export') }}"><i class="fa fa-pencil" aria-hidden="true"></i><i class="fas fa-file-excel"></i> Export Ke Excel</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('admin/dashboard') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali ke Main Menu</a>
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

                    <!-- Logout button on the right -->
                    <div class="flex-fill d-flex flex-row-reverse">
                        <a class="btn btn-outline-dark ml-2" href="{{ route('admin/logout') }}" role="button"><i class="fas fa-sign-out-alt"></i><span class="hide-on-small"> Logout</span></a>
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
                                <a class="dropdown-item" href="{{ route('admin/export') }}"><i class="fa fa-pencil" aria-hidden="true"></i><i class="fas fa-file-excel"></i> Export Ke Excel</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('admin/dashboard') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali ke Main Menu</a>
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
                        @if (Session::has('message'))
                        <div class="alert alert-success m-3" role="alert"><center>{{ Session::get('message') }}</center></div>
                        @endif
                        <div class="table-responsive">
                            <div class="if-table-displays-in-mobile">
                                <table id="absensiMobileTable" class="table table-bordered table-striped mt-3">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Karyawan</th>
                                            <th data-sortable="tanggal_absensi">Tanggal Absensi <span class="sort-indicator"></span></th>
                                            <th data-sortable="jam_masuk">Jam Masuk <span class="sort-indicator"></span></th>
                                            <th data-sortable="jam_keluar">Jam Keluar <span class="sort-indicator"></span></th>
                                            <th data-sortable="status_absensi">Status Absensi <span class="sort-indicator"></span></th>
                                            <th>Koordinat (Google Maps)</th>
                                            <th>Foto Masuk</th>
                                            <th>Foto Keluar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fetch_data_absensi_karyawan_mobile as $index => $absensi_mobile)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $absensi_mobile->nama_karyawan }}</td>
                                            <td>{{ $absensi_mobile->tanggal_absensi ?? 'N/A' }}</td>
                                            <td>{{ $absensi_mobile->jam_masuk ?? 'N/A' }}</td>
                                            <td>{{ $absensi_mobile->jam_keluar ?? 'N/A' }}</td>
                                            <td>{{ $absensi_mobile->status_absensi ?? 'N/A'}}</td>
                                            <td><a href="#" class="koordinat-link" data-koordinat="{{ $absensi_mobile->koordinat }}">{{ $absensi_mobile->koordinat }}</a></td>
                                            <td>
                                                @if ($absensi_mobile->foto_masuk)
                                                    <button id="toggleButton" class="btn btn-outline-dark mb-1"><i class="fa fa-file-image-o" aria-hidden="true"></i>Hide/Show</button>
                                                    <div class="d-flex justify-content-center">
                                                        <img id="foto-karyawan" src="{{ asset('storage/'.$absensi_mobile->foto_masuk) }}" alt="Foto Karyawan" style="max-width: 100px; max-height: 100px; display:none">
                                                    </div>
                                                @else
                                                    <span>Tidak ada bukti foto</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($absensi_mobile->foto_keluar)
                                                    <button id="toggleButton" class="btn btn-outline-dark mb-1"><i class="fa fa-file-image-o" aria-hidden="true"></i>Hide/Show</button>
                                                    <div class="d-flex justify-content-center">
                                                        <img id="foto-karyawan" src="{{ asset('storage/'.$absensi_mobile->foto_keluar) }}" alt="Foto Karyawan" style="max-width: 100px; max-height: 100px; display:none">
                                                    </div>
                                                @else
                                                    <span>Tidak ada bukti foto</span>
                                                @endif
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
                                            <th>Nama Karyawan</th>
                                            <th data-sortable="tanggal_absensi">Tanggal Absensi <span class="sort-indicator"></span></th>
                                            <th data-sortable="jam_masuk">Jam Masuk <span class="sort-indicator"></span></th>
                                            <th data-sortable="jam_keluar">Jam Keluar <span class="sort-indicator"></span></th>
                                            <th data-sortable="status_absensi">Status Absensi <span class="sort-indicator"></span></th>
                                            <th>Koordinat (Google Maps)</th>
                                            <th>Foto Masuk</th>
                                            <th>Foto Keluar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fetch_data_absensi_karyawan_desktop as $index => $absensi_desktop)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $absensi_desktop->nama_karyawan ?? 'N/A' }}</td>
                                            <td>{{ $absensi_desktop->tanggal_absensi ?? 'N/A' }}</td>
                                            <td>{{ $absensi_desktop->jam_masuk ?? 'N/A' }}</td>
                                            <td>{{ $absensi_desktop->jam_keluar ?? 'N/A' }}</td>
                                            <td>{{ $absensi_desktop->status_absensi ?? 'N/A'}}</td>
                                            <td><a href="#" class="koordinat-link" data-koordinat="{{ $absensi_desktop->koordinat }}">{{ $absensi_desktop->koordinat }}</a></td>
                                            <td>
                                                @if ($absensi_desktop->foto_masuk)
                                                    <button id="toggleButton" class="btn btn-outline-dark mb-1"><i class="fa fa-file-image-o" aria-hidden="true"></i>Hide/Show</button>
                                                    <div class="d-flex justify-content-center">
                                                        <img id="foto-karyawan" src="{{ asset('storage/'.$absensi_desktop->foto_masuk) }}" alt="Foto Karyawan" style="max-width: 100px; max-height: 100px; display:none">
                                                    </div>
                                                @else
                                                    <span>Tidak ada bukti foto saat masuk absensi</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($absensi_desktop->foto_keluar)
                                                    <button id="toggleButton" class="btn btn-outline-dark mb-1"><i class="fa fa-file-image-o" aria-hidden="true"></i>Hide/Show</button>
                                                    <div class="d-flex justify-content-center">
                                                        <img id="foto-karyawan" src="{{ asset('storage/'.$absensi_desktop->foto_keluar) }}" alt="Foto Karyawan" style="max-width: 100px; max-height: 100px; display:none">
                                                    </div>
                                                @else
                                                    <span>Tidak ada bukti foto saat keluar absensi</span>
                                                @endif
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
                    {{ $fetch_data_absensi_karyawan_mobile->links('pagination::bootstrap-5') }}
                </div>
                
                <div class="if-table-displays-in-desktop">
                    {{ $fetch_data_absensi_karyawan_desktop->links('pagination::bootstrap-5') }}
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

</body>

<script>
    document.querySelectorAll('#toggleButton').forEach(button => {
        button.addEventListener('click', function() {
            const fotoKaryawan = this.nextElementSibling.querySelector('#foto-karyawan');
                if (fotoKaryawan.style.display === 'none' || fotoKaryawan.style.display === '') {
                    fotoKaryawan.style.display = 'block';
                } else {
                    fotoKaryawan.style.display = 'none';
                }
            });
        }
    );

    // Modal for Koordinat Google Maps
    document.addEventListener('DOMContentLoaded', function () {
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

    // ====================================================================
    // Server-side AJAX sorting for admin (no page refresh)
    // - Click on headers to fetch sorted data from server via AJAX
    // - Updates table body with new sorted rows
    // ====================================================================

    async function fetchSortedAdminData(sortBy, sortOrder, tableType) {
        try {
            console.log('Fetching sorted data:', { sortBy, sortOrder, tableType });
            const url = new URL('{{ route("admin.histori_absensi_ajax") }}', window.location.origin);
            url.searchParams.append('sort_by', sortBy);
            url.searchParams.append('sort_order', sortOrder);
            url.searchParams.append('per_page', tableType === 'mobile' ? 2 : 5);

            console.log('Request URL:', url.toString());
            const response = await fetch(url.toString());
            if (!response.ok) throw new Error('Network response failed: ' + response.status);
            const result = await response.json();

            console.log('Response:', result);
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

    function updateAdminTableBody(tableId, data, isMobile) {
        const table = document.getElementById(tableId);
        if (!table) return;
        const tbody = table.tBodies[0];
        tbody.innerHTML = '';

        data.forEach(row => {
            const tr = document.createElement('tr');
            if (isMobile) {
                tr.innerHTML = `
                    <td>${row.index}</td>
                    <td>${row.nama_karyawan || 'N/A'}</td>
                    <td>${row.tanggal_absensi || 'N/A'}</td>
                    <td>${row.jam_masuk || 'N/A'}</td>
                    <td>${row.jam_keluar || 'N/A'}</td>
                    <td>${row.status_absensi || 'N/A'}</td>
                    <td>${row.koordinat || 'N/A'}</td>
                    <td>${row.foto_masuk || 'Tidak ada'}</td>
                    <td>${row.foto_keluar || 'Tidak ada'}</td>
                `;
            } else {
                tr.innerHTML = `
                    <td>${row.index}</td>
                    <td>${row.nama_karyawan || 'N/A'}</td>
                    <td>${row.tanggal_absensi || 'N/A'}</td>
                    <td>${row.jam_masuk || 'N/A'}</td>
                    <td>${row.jam_keluar || 'N/A'}</td>
                    <td>${row.status_absensi || 'N/A'}</td>
                    <td>${row.koordinat || 'N/A'}</td>
                    <td>${row.foto_masuk || 'Tidak ada'}</td>
                    <td>${row.foto_keluar || 'Tidak ada'}</td>
                `;
            }
            tbody.appendChild(tr);
        });
    }

    function attachAdminAjaxSorting(tableId, isMobile) {
        const table = document.getElementById(tableId);
        if (!table) return;
        const headers = table.querySelectorAll('th[data-sortable]');

        headers.forEach((th) => {
            th.style.cursor = 'pointer';
            let sortOrder = 'asc';

            th.addEventListener('click', async () => {
                // Get sortBy from data-sortable attribute, not from text content
                const sortBy = th.getAttribute('data-sortable');

                if (!sortBy) {
                    console.warn('Sort column not found for header:', th.textContent);
                    return;
                }

                console.log('Header clicked, sortBy:', sortBy, 'sortOrder:', sortOrder);

                // Update sort indicators
                headers.forEach(h => {
                    const s = h.querySelector('.sort-indicator');
                    if (s) s.textContent = '';
                });
                const indicator = th.querySelector('.sort-indicator');
                if (indicator) indicator.textContent = sortOrder === 'asc' ? ' ▲' : ' ▼';

                // Fetch sorted data
                const data = await fetchSortedAdminData(sortBy, sortOrder, isMobile ? 'mobile' : 'desktop');
                if (data) {
                    console.log('Updating table with', data.length, 'rows');
                    updateAdminTableBody(tableId, data, isMobile);
                }

                // Toggle sort order for next click
                sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
            });
        });
    }

    // Attach AJAX sorting for both tables when DOM is ready
    document.addEventListener('DOMContentLoaded', function () {
        console.log('DOMContentLoaded: Attaching AJAX sorting');
        attachAdminAjaxSorting('absensiMobileTable', true);
        attachAdminAjaxSorting('absensiDesktopTable', false);
    });
</script>
</html>