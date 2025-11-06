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
    <title>Data Karyawan</title>
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
    @media (max-width: 500px) {
        .hide-on-small {
            display: none;
        }
        .if-table-displays-in-desktop {
            display: none;
        }
    }

</style>

<body>
    <nav>
        <div class="container-fluid bg-light">
            <div class="d-flex flex-row-reverse p-2">
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
                        <a class="dropdown-item" href="tambahkaryawan" data-bs-toggle="modal" data-bs-target="#my-modal-tambah-karyawan"><i class="fa fa-user-circle-o" aria-hidden="true"></i><i class="fa fa-plus" aria-hidden="true"></i> Tambah Karyawan </a>
                        <a class="dropdown-item" href="editkaryawan" data-bs-toggle="modal" data-bs-target="#my-modal-edit-karyawan"><i class="fa fa-user-circle-o" aria-hidden="true"></i><i class="fa fa-pencil" aria-hidden="true"></i> Edit Karyawan </a>
                        <a class="dropdown-item" href="hapuskaryawan" data-bs-toggle="modal" data-bs-target="#my-modal-hapus-karyawan"><i class="fa fa-user-circle-o" aria-hidden="true"></i><i class="fa fa-trash" aria-hidden="true"></i> Hapus Karyawan </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('admin/dashboard') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali ke Main Menu</a>
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
                        <h1 class="text-center font-bold">Data Karyawan</h1>
                        @if (Session::has('message'))
                        <div class="alert alert-success m-3" role="alert"><center>{{ Session::get('message') }}</center></div>
                        @endif
                        <!-- Vertical Table Style -->
                        <div class="table-responsive">
                            <div class="if-table-displays-in-desktop">
                                <table class="table table-bordered table-striped mt-3">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama Karyawan</th>
                                            <th>Tanggal Lahir</th>
                                            <th>NIK</th>
                                            <th>Bagian</th>
                                            <th>Jabatan</th>
                                            <th>Tgl. Masuk Kerja</th>
                                            <th>No. Handphone</th>
                                            <th>Foto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    @foreach ($karyawans as $karyawan)
                                        <tr class="text-center">
                                            <td>{{ $karyawan->id }}</td>
                                            <td>{{ $karyawan->nama_lengkap }}</td>
                                            <td>{{ $karyawan->tanggal_lahir ? $karyawan->tanggal_lahir->format('d/m/Y') : '' }}</td>
                                            <td>{{ $karyawan->NIK }}</td>
                                            <td>{{ $karyawan->bagian }}</td>
                                            <td>{{ $karyawan->jabatan }}</td>
                                            <td>{{ $karyawan->tanggal_masuk_kerja ? $karyawan->tanggal_masuk_kerja->format('d/m/Y') : '' }}</td>
                                            <td>{{ $karyawan->nomor_handphone }}</td>
                                            <td>
                                                @if ($karyawan->imageFileLocation)
                                                    <button id="toggleButton" class="btn btn-outline-dark mb-1"><i class="fa fa-file-image-o" aria-hidden="true"></i>Hide/Show</button>
                                                    <div class="d-flex justify-content-center">
                                                        <img id="foto-karyawan" src="{{ asset('storage/'.$karyawan->imageFileLocation) }}" alt="Foto Karyawan" style="max-width: 100px; max-height: 100px;">
                                                    </div>
                                                @else
                                                    <span>Tidak ada foto</span>
                                                @endif
                                            </td>
                                        </tr>
                                        
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="if-table-displays-in-mobile">
                                <table class="table table-bordered mt-4">
                                    @foreach ($karyawans as $karyawan)
                                        <tr>
                                            <th>Nama Lengkap</th>
                                            <td >{{ $karyawan->nama_lengkap }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Lahir</th>
                                            <td>{{ $karyawan->tanggal_lahir ? $karyawan->tanggal_lahir->format('d/m/Y') : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>NIK</th>
                                            <td>{{ $karyawan->NIK }}</td>
                                        </tr>
                                        <tr>
                                            <th>Bagian</th>
                                            <td">{{ $karyawan->bagian }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jabatan</th>
                                            <td>{{ $karyawan->jabatan }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Masuk Kerja</th>
                                            <td>{{ $karyawan->tanggal_masuk_kerja ? $karyawan->tanggal_masuk_kerja->format('d/m/Y') : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Handphone</th>
                                            <td>{{ $karyawan->nomor_handphone }}</td>
                                        </tr>
                                        <tr>
                                            <th>Foto Karyawan</th>
                                            <td>
                                                @if ($karyawan->imageFileLocation)
                                                    <button id="toggleButton" class="btn btn-outline-dark mb-1"><i class="fa fa-file-image-o" aria-hidden="true"></i>Hide/Show</button>
                                                    <div class="d-flex justify-content-center">
                                                        <img id="foto-karyawan" src="{{ asset('storage/'.$karyawan->imageFileLocation) }}" alt="Foto Karyawan" style="max-width: 100px; max-height: 100px; display:none">
                                                    </div>
                                                @else
                                                    <span>Tidak ada foto</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            
                            </div>
                         </div>
                </div>
            </div>
            <div class="d-flex justify-content-center m-3">
                {{ $karyawans->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </main>
    <!--Modal Tambah Karyawan -->
    <div id="my-modal-tambah-karyawan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h1 class="modal-title mb-3 font-semibold text-center">Form Tambah Karyawan<h1>
                        <form action="{{ route('prosesTambahKaryawan') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                            </div>
                            <div class="mb-3">
                                <label for="NIK" class="form-label">NIK</label>
                                <input type="text" class="form-control" id="NIK" name="NIK" required>
                            </div>
                            <div class="mb-3">
                                <label for="bagian" class="form-label">Bagian</label>
                                <input type="text" class="form-control" id="bagian" name="bagian" required>
                            </div>
                            <div class="mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_masuk_kerja" class="form-label">Tanggal Masuk Kerja</label>
                                <input type="date" class="form-control" id="tanggal_masuk_kerja" name="tanggal_masuk_kerja" required>
                            </div>
                            <div class="mb-3">
                                <label for="nomor_handphone" class="form-label">Nomor Handphone</label>
                                <input type="text" class="form-control" id="nomor_handphone" name="nomor_handphone" required>
                            </div>
                            <!--Upload Foto Karyawan-->
                            <div class="mb-3">
                                <label for="imageFileLocation" class="form-label">Foto Karyawan</label>
                                <input type="file" class="form-control" id="imageFileLocation" name="imageFileLocation" accept="image/*">
                            </div>
                            <div class="preview-gambar mb-3">
                                <img id="preview-image" src="#" alt="Preview Gambar" style="display: none; max-width: 100%;">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <!--Modal Edit Karyawan -->
    <div id="my-modal-edit-karyawan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h1 class="modal-title mb-3 font-semibold text-center">Form Edit Karyawan</h1>
                    <form action="{{ route('prosesEditKaryawan') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="edit_id" name="id">
                        <div class="mb-3">
                            <label for="select_karyawan" class="form-label">Pilih Karyawan</label>
                            <select class="form-select" id="select_karyawan" name="select_karyawan" required>
                                <option value="">Pilih Karyawan</option>
                                @foreach ($karyawans as $karyawan)
                                    <option value="{{ $karyawan->id }}">{{ $karyawan->nama_lengkap }} - {{ $karyawan->NIK }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="edit_nama_lengkap" name="nama_lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="edit_tanggal_lahir" name="tanggal_lahir" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_NIK" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="edit_NIK" name="NIK" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_bagian" class="form-label">Bagian</label>
                            <input type="text" class="form-control" id="edit_bagian" name="bagian" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="edit_jabatan" name="jabatan" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_tanggal_masuk_kerja" class="form-label">Tanggal Masuk Kerja</label>
                            <input type="date" class="form-control" id="edit_tanggal_masuk_kerja" name="tanggal_masuk_kerja" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_nomor_handphone" class="form-label">Nomor Handphone</label>
                            <input type="text" class="form-control" id="edit_nomor_handphone" name="nomor_handphone" required>
                        </div>
                        <!--Upload Foto Karyawan-->
                        <div class="mb-3">
                            <label for="edit_imageFileLocation" class="form-label">Foto Karyawan</label>
                            <input type="file" class="form-control" id="edit_imageFileLocation" name="imageFileLocation" accept="image/*">
                        </div>
                        <div class="preview-gambar mb-3">
                            <img id="edit-preview-image" src="#" alt="Preview Gambar" style="display: none; max-width: 100%;">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Modal Hapus Karyawan -->
    <div id="my-modal-hapus-karyawan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h1 class="modal-title mb-3 font-semibold text-center">Form Hapus Karyawan</h1>
                    <form action="{{ route('hapusKaryawan') }}" method="get">
                        @csrf
                        <div class="mb-3">
                            <label for="select_karyawan_hapus" class="form-label">Pilih Karyawan</label>
                            <select class="form-select" id="select_karyawan_hapus" name="select_karyawan_hapus" required>
                                <option value="">Pilih Karyawan</option>
                                @foreach ($karyawans as $karyawan)
                                    <option value="{{ $karyawan->id }}">{{ $karyawan->nama_lengkap }} - {{ $karyawan->NIK }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        //menampilkan dan menyemmbunyikan foto karyawan dari tabel karyawan
        document.querySelectorAll('#toggleButton').forEach(button => {
            button.addEventListener('click', function() {
                const fotoKaryawan = this.nextElementSibling.querySelector('#foto-karyawan');
                if (fotoKaryawan.style.display === 'none' || fotoKaryawan.style.display === '') {
                    fotoKaryawan.style.display = 'block';
                } else {
                    fotoKaryawan.style.display = 'none';
                }
            });
        });


        //call id my-modal
        var myModalTambahKaryawan = new bootstrap.Modal(document.getElementById('my-modal-tambah-karyawan'), {
            keyboard: false
        });
        var myModalEditKaryawan = new bootstrap.Modal(document.getElementById('my-modal-edit-karyawan'), {
            keyboard: false
        });
        var myModalHapusKaryawan = new bootstrap.Modal(document.getElementById('my-modal-hapus-karyawan'), {
            keyboard: false
        });
        //fetch data karyawans dengan response json
        const karyawans = @json($karyawans);

        //edit karyawan dengan ambil id modal my-modal-edit-karyawan
        document.getElementById('select_karyawan').addEventListener('change', function() {
            const selectedId = this.value;
            if (selectedId) {
                const selectedKaryawan = karyawans.find(karyawan => karyawan.id == selectedId);
                if (selectedKaryawan) {
                    document.getElementById('edit_id').value = selectedKaryawan.id;
                    document.getElementById('edit_nama_lengkap').value = selectedKaryawan.nama_lengkap;
                    document.getElementById('edit_tanggal_lahir').value = selectedKaryawan.tanggal_lahir ? new Date(selectedKaryawan.tanggal_lahir).toISOString().split('T')[0] : '';
                    document.getElementById('edit_NIK').value = selectedKaryawan.NIK;
                    document.getElementById('edit_bagian').value = selectedKaryawan.bagian;
                    document.getElementById('edit_jabatan').value = selectedKaryawan.jabatan;
                    document.getElementById('edit_tanggal_masuk_kerja').value = selectedKaryawan.tanggal_masuk_kerja ? new Date(selectedKaryawan.tanggal_masuk_kerja).toISOString().split('T')[0] : '';
                    document.getElementById('edit_nomor_handphone').value = selectedKaryawan.nomor_handphone;
                    // For image, if exists, show preview
                    if (selectedKaryawan.imageFileLocation) {
                        document.getElementById('edit-preview-image').src = '{{ asset("storage/".$karyawan->imageFileLocation) }}';
                        document.getElementById('edit-preview-image').style.display = 'block';
                    } else {
                        document.getElementById('edit-preview-image').style.display = 'none';
                    }
                }
            } else {
                // Clear form if no selection
                document.getElementById('edit_id').value = '';
                document.getElementById('edit_nama_lengkap').value = '';
                document.getElementById('edit_tanggal_lahir').value = '';
                document.getElementById('edit_NIK').value = '';
                document.getElementById('edit_bagian').value = '';
                document.getElementById('edit_jabatan').value = '';
                document.getElementById('edit_tanggal_masuk_kerja').value = '';
                document.getElementById('edit_nomor_handphone').value = '';
                document.getElementById('edit-preview-image').style.display = 'none';
            }
        });


        // Preview image for edit
        document.getElementById('edit_imageFileLocation').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('edit-preview-image').src = e.target.result;
                    document.getElementById('edit-preview-image').style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                document.getElementById('edit-preview-image').style.display = 'none';
            }
        });

        // Preview image for tambah karyawan
        document.getElementById('imageFileLocation').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                    document.getElementById('preview-image').style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                document.getElementById('preview-image').style.display = 'none';
            }
        });

    </script>
</body>
</html>