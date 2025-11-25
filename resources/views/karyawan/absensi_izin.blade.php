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
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    
    /* Drag and Drop Upload Styles */
    .upload-container {
        margin: 30px 0;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
    }
    
    .drop-zone {
        border: 3px dashed #007bff;
        border-radius: 8px;
        padding: 40px 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background-color: #fff;
    }
    
    .drop-zone:hover {
        border-color: #0056b3;
        background-color: #f0f7ff;
    }
    
    .drop-zone.dragover {
        border-color: #0056b3;
        background-color: #e7f3ff;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.3);
    }
    
    .drop-zone-icon {
        font-size: 48px;
        color: #007bff;
        margin-bottom: 10px;
    }
    
    .drop-zone-text {
        color: #333;
        font-weight: 500;
        margin: 10px 0;
    }
    
    .drop-zone-hint {
        color: #666;
        font-size: 14px;
    }
    
    .file-input-hidden {
        display: none;
    }
    
    .preview-container {
        margin-top: 20px;
        display: none;
    }
    
    .preview-container.show {
        display: block;
    }
    
    .preview-image {
        max-width: 100%;
        max-height: 400px;
        border-radius: 8px;
        margin: 15px 0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .file-info {
        background-color: #e8f5e9;
        border-left: 4px solid #4caf50;
        padding: 12px;
        margin: 10px 0;
        border-radius: 4px;
    }
    
    .file-info.error {
        background-color: #ffebee;
        border-left-color: #f44336;
        color: #c62828;
    }
    
    .file-info.success {
        background-color: #e8f5e9;
        border-left-color: #4caf50;
        color: #2e7d32;
    }
    
    .action-buttons {
        margin-top: 20px;
    }
    
    .action-buttons .btn {
        margin-right: 10px;
    }
    
    @media (max-width: 500px) {
        /* Mobile Upload Styles */
        .drop-zone {
            padding: 20px 10px;
        }
        
        .drop-zone-icon {
            font-size: 32px;
        }
        
        .preview-image {
            max-height: 300px;
        }
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
                                <a class="dropdown-item" href="{{ route('karyawan/absensi') }}"><i class="fa fa-pencil" aria-hidden="true"></i> Absensi</a>
                                <a class="dropdown-item" href="{{ route('karyawan/histori_absensi') }}"><i class="fa fa-table" aria-hidden="true"></i> Histori Absensi</a>
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
                                <a class="dropdown-item" href="{{ route('karyawan/absensi') }}"><i class="fa fa-pencil" aria-hidden="true"></i> Absensi</a>
                                <a class="dropdown-item" href="{{ route('karyawan/histori_absensi') }}"><i class="fa fa-table" aria-hidden="true"></i> Histori Absensi</a>
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
        <div class="container">
            <h2 class="mt-4 mb-4 text-center">Upload Bukti Izin</h2>
            
            <div class="upload-container">
                <h5 class="mb-4 text-center">Upload Foto/Dokumen Izin</h5>
                
                <!-- Drag and Drop Area -->
                <div class="drop-zone" id="dropZone">
                    <div class="drop-zone-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <p class="drop-zone-text">Seret file foto/dokumen ke sini</p>
                    <p class="drop-zone-hint">atau klik untuk memilih file</p>
                </div>
                
                <!-- Hidden File Input -->
                <input type="file" id="fileInput" class="file-input-hidden" accept="image/*" multiple>
                
                <!-- Preview Container -->
                <div class="preview-container" id="previewContainer">
                    <div id="fileList"></div>
                    <img id="previewImage" class="preview-image" style="display:none;" alt="Preview">
                </div>
                
                <!-- File Info -->
                <div id="fileInfo"></div>
                
                <!-- Tombol Upload dan simpan ke database -->
                <form method="POST" action="{{ route('upload-izin') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="action-buttons" id="actionButtons" style="display:none;">
                        <button type="button" class="btn btn-outline-primary" id="uploadBtn">
                            <i class="fas fa-upload"></i> Upload File
                        </button>
                        <button type="button" class="btn btn-dark" id="clearBtn">
                             <i class="fas fa-times"></i> Batal
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </main>
    
    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">
                        <i class="fas fa-check-circle"></i> Sukses!
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="successMessage" class="mb-0">Absensi izin Anda telah berhasil terekam.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="successOkBtn">
                        <i class="fas fa-check"></i> OK
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Get CSRF token from meta tag
        function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]')?.content || '';
        }
        
        // Configuration
        const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5MB
        const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/gif'];
        const ALLOWED_EXTENSIONS = ['.jpg', '.jpeg', '.png', '.gif'];
        
        let selectedFiles = [];
        
        // Get Elements
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');
        const previewContainer = document.getElementById('previewContainer');
        const previewImage = document.getElementById('previewImage');
        const fileList = document.getElementById('fileList');
        const fileInfo = document.getElementById('fileInfo');
        const actionButtons = document.getElementById('actionButtons');
        const uploadBtn = document.getElementById('uploadBtn');
        const clearBtn = document.getElementById('clearBtn');
        
        // Drag and Drop Events
        dropZone.addEventListener('click', () => fileInput.click());
        
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropZone.classList.add('dragover');
        });
        
        dropZone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropZone.classList.remove('dragover');
        });
        
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropZone.classList.remove('dragover');
            
            const files = e.dataTransfer.files;
            handleFiles(files);
        });
        
        // File Input Change Event
        fileInput.addEventListener('change', (e) => {
            handleFiles(e.target.files);
        });
        
        // Handle Files
        function handleFiles(files) {
            selectedFiles = [];
            fileList.innerHTML = '';
            fileInfo.innerHTML = '';
            previewImage.style.display = 'none';
            
            if (files.length === 0) {
                actionButtons.style.display = 'none';
                previewContainer.classList.remove('show');
                return;
            }
            
            for (let file of files) {
                const validation = validateFile(file);
                
                if (validation.valid) {
                    selectedFiles.push(file);
                    displayFilePreview(file);
                } else {
                    displayError(validation.message);
                }
            }
            
            if (selectedFiles.length > 0) {
                actionButtons.style.display = 'block';
                previewContainer.classList.add('show');
            }
        }
        
        // Validate File
        function validateFile(file) {
            // Check file size
            if (file.size > MAX_FILE_SIZE) {
                return {
                    valid: false,
                    message: `File "${file.name}" terlalu besar. Maksimal 5MB.`
                };
            }
            
            // Check file type
            const extension = '.' + file.name.split('.').pop().toLowerCase();
            if (!ALLOWED_EXTENSIONS.includes(extension)) {
                return {
                    valid: false,
                    message: `Tipe file "${file.name}" tidak didukung. Hanya JPG, PNG, GIF, atau PDF.`
                };
            }
            
            return { valid: true };
        }
        
        // Display File Preview
        function displayFilePreview(file) {
            const fileItem = document.createElement('div');
            fileItem.className = 'file-info success';
            fileItem.innerHTML = `
                <div class="d-flex align-items-center">
                    <div>
                        <i class="fas fa-check-circle" style="color: #4caf50; margin-right: 10px;"></i>
                        <strong>${file.name}</strong><br>
                        <small>Ukuran: ${formatFileSize(file.size)}</small>
                    </div>
                </div>
            `;
            fileList.appendChild(fileItem);
            
            // Show image preview if it's an image
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    if (!previewImage.src) {
                        previewImage.src = e.target.result;
                        previewImage.style.display = 'block';
                    }
                };
                reader.readAsDataURL(file);
            }
        }
        
        // Display Error
        function displayError(message) {
            const errorItem = document.createElement('div');
            errorItem.className = 'file-info error';
            errorItem.innerHTML = `
                <i class="fas fa-exclamation-circle" style="margin-right: 10px;"></i>
                ${message}
            `;
            fileInfo.appendChild(errorItem);
        }
        
        // Format File Size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            
            return Math.round((bytes / Math.pow(k, i)) * 100) / 100 + ' ' + sizes[i];
        }
        
        // Upload Button
        uploadBtn.addEventListener('click', () => {
            if (selectedFiles.length === 0) {
                alert('Silakan pilih file terlebih dahulu!');
                return;
            }
            
            // Create FormData
            const formData = new FormData();
            selectedFiles.forEach((file, index) => {
                formData.append('files[]', file);
            });
            
            // Add CSRF token
            const csrfToken = getCsrfToken();
            if (csrfToken) {
                formData.append('_token', csrfToken);
            }
            
            // Upload Files
            uploadBtn.disabled = true;
            uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Uploading...';
            
            fetch('{{ route("upload-izin") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success modal
                    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                    document.getElementById('successMessage').textContent = data.message || 'Absensi izin Anda telah berhasil terekam.';
                    successModal.show();
                    
                    // Redirect after modal shown
                    document.getElementById('successOkBtn').addEventListener('click', function() {
                        window.location.href = '{{ route("karyawan/absensi") }}';
                    });
                    
                    clearSelection();
                } else {
                    displayError(data.message || 'Gagal mengupload file!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                displayError('Terjadi kesalahan saat mengupload file!');
            })
            .finally(() => {
                uploadBtn.disabled = false;
                uploadBtn.innerHTML = '<i class="fas fa-upload"></i> Upload File';
            });
        });
        
        // Clear Button
        clearBtn.addEventListener('click', clearSelection);
        
        // Clear Selection
        function clearSelection() {
            selectedFiles = [];
            fileInput.value = '';
            fileList.innerHTML = '';
            fileInfo.innerHTML = '';
            previewImage.src = '';
            previewImage.style.display = 'none';
            actionButtons.style.display = 'none';
            previewContainer.classList.remove('show');
        }
        
        // Display Success
        function displaySuccess(message) {
            const successItem = document.createElement('div');
            successItem.className = 'alert alert-success alert-dismissible fade show';
            successItem.innerHTML = `
                <strong><i class="fas fa-check-circle"></i> Berhasil!</strong> ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            fileInfo.appendChild(successItem);
            
            // Auto dismiss after 5 seconds
            setTimeout(() => {
                successItem.remove();
            }, 5000);
        }
    </script>
</body>
</html>