@extends('layouts.dashboard.dashboard')

@section('title', 'Tambah Berita - BDARU Museum')

@section('content')
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2 class="fw-bold">Tambah Berita Baru</h2>
                </div>
                <!--end::Card title-->

                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <a href="{{ route('news-management.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali ke Daftar
                    </a>
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body py-4">
                                <form action="{{ route('news-management.store') }}" method="POST" enctype="multipart/form-data" id="newsForm">
                                    @csrf

                                    <div class="row">
                                        <!--begin::Left Column-->
                                        <div class="col-lg-8">
                                            <!--begin::Title-->
                                            <div class="mb-6">
                                                <label for="title" class="form-label fw-bold">Judul Berita <span class="text-danger">*</span></label>
                                                <input type="text"
                                                       class="form-control form-control-lg @error('title') is-invalid @enderror"
                                                       id="title"
                                                       name="title"
                                                       value="{{ old('title') }}"
                                                       placeholder="Masukkan judul berita"
                                                       required>
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!--end::Title-->

                                            <!--begin::Summary-->
                                            <div class="mb-6">
                                                <label for="summary" class="form-label fw-bold">Ringkasan</label>
                                                <textarea class="form-control @error('summary') is-invalid @enderror"
                                                          id="summary"
                                                          name="summary"
                                                          rows="3"
                                                          placeholder="Ringkasan singkat berita (opsional)">{{ old('summary') }}</textarea>
                                                @error('summary')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="form-text">Ringkasan akan ditampilkan di halaman daftar berita</div>
                                            </div>
                                            <!--end::Summary-->

                                            <!--begin::Content-->
                                            <div class="mb-6">
                                                <label for="content" class="form-label fw-bold">Konten Berita <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('content') is-invalid @enderror"
                                                          id="content"
                                                          name="content"
                                                          rows="12"
                                                          placeholder="Tulis konten berita lengkap"
                                                          required>{{ old('content') }}</textarea>
                                                @error('content')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Left Column-->

                                        <!--begin::Right Column-->
                                        <div class="col-lg-4">
                                            <!--begin::Image Upload-->
                                            <div class="mb-6">
                                                <label class="form-label fw-bold">Gambar Berita</label>
                                                <div class="upload-zone border-2 border-dashed border-gray-300 rounded-lg p-6 text-center"
                                                     id="uploadZone"
                                                     onclick="document.getElementById('image').click()">
                                                    <i class="fas fa-cloud-upload-alt fs-2x text-muted mb-3"></i>
                                                    <h6 class="text-muted mb-2">Klik untuk upload gambar</h6>
                                                    <p class="text-muted fs-7 mb-3">atau drag & drop file di sini</p>
                                                    <p class="text-muted fs-8">Format: JPG, PNG, GIF (Max: 2MB)</p>
                                                    <p class="text-muted fs-8">Ukuran optimal: 800×600px</p>
                                                </div>
                                                <input type="file"
                                                       id="image"
                                                       name="image"
                                                       accept="image/*"
                                                       class="d-none"
                                                       onchange="previewImage(this)">
                                                @error('image')
                                                    <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!--end::Image Upload-->

                                            <!--begin::Image Preview-->
                                            <div id="imagePreview" class="mb-6" style="display: none;">
                                                <div class="position-relative">
                                                    <img id="previewImg" class="w-100 rounded-lg" alt="Preview">
                                                    <button type="button"
                                                            class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2"
                                                            onclick="removeImage()">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <!--end::Image Preview-->

                                            <!--begin::Category-->
                                            <div class="mb-6">
                                                <label for="news_category_id" class="form-label fw-bold">Kategori <span class="text-danger">*</span></label>
                                                <select class="form-select @error('news_category_id') is-invalid @enderror"
                                                        id="news_category_id"
                                                        name="news_category_id"
                                                        required>
                                                    <option value="">Pilih kategori</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" {{ old('news_category_id') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('news_category_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!--end::Category-->

                                            <!--begin::Status-->
                                            <div class="mb-6">
                                                <label class="form-label fw-bold">Status Publikasi</label>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input"
                                                           type="checkbox"
                                                           id="is_published"
                                                           name="is_published"
                                                           value="1"
                                                           {{ old('is_published') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_published">
                                                        Publikasikan sekarang
                                                    </label>
                                                </div>
                                                <div class="form-text">Jika tidak dicentang, berita akan disimpan sebagai draft</div>
                                            </div>
                                            <!--end::Status-->

                                            <!--begin::Submit Buttons-->
                                            <div class="d-grid gap-3">
                                                <button type="button" class="btn btn-primary btn-lg" onclick="confirmSubmit()">
                                                    <i class="fas fa-save me-2"></i>
                                                    Simpan Berita
                                                </button>
                                                <a href="{{ route('news-management.index') }}" class="btn btn-outline-secondary">
                                                    <i class="fas fa-times me-2"></i>
                                                    Batal
                                                </a>
                                            </div>
                                            <!--end::Submit Buttons-->
                                        </div>
                                        <!--end::Right Column-->
                                    </div>
                                </form>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Content wrapper-->
            </div>
            <!--end::Content-->

            <!--begin::Footer-->
            @include('layouts.dashboard._footer')
            <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>

<style>
.upload-zone {
    cursor: pointer;
    transition: all 0.3s ease;
}

.upload-zone:hover {
    border-color: #0d6efd !important;
    background-color: rgba(13, 110, 253, 0.05);
}

.upload-zone.dragover {
    border-color: #0d6efd !important;
    background-color: rgba(13, 110, 253, 0.1);
}
</style>

<script>
// Image preview functionality
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
            document.getElementById('uploadZone').style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function removeImage() {
    document.getElementById('image').value = '';
    document.getElementById('imagePreview').style.display = 'none';
    document.getElementById('uploadZone').style.display = 'block';
}

// Drag and drop functionality
document.addEventListener('DOMContentLoaded', function() {
    const uploadZone = document.getElementById('uploadZone');
    const imageInput = document.getElementById('image');

    uploadZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadZone.classList.add('dragover');
    });

    uploadZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        uploadZone.classList.remove('dragover');
    });

    uploadZone.addEventListener('drop', function(e) {
        e.preventDefault();
        uploadZone.classList.remove('dragover');

        const files = e.dataTransfer.files;
        if (files.length > 0) {
            imageInput.files = files;
            previewImage(imageInput);
        }
    });
});

// Form submission confirmation
function confirmSubmit() {
    const title = document.getElementById('title').value.trim();
    const content = document.getElementById('content').value.trim();
    const category = document.getElementById('news_category_id').value;

    if (!title) {
        Swal.fire('Error', 'Judul berita harus diisi', 'error');
        return;
    }

    if (!content) {
        Swal.fire('Error', 'Konten berita harus diisi', 'error');
        return;
    }

    if (!category) {
        Swal.fire('Error', 'Kategori harus dipilih', 'error');
        return;
    }

    Swal.fire({
        title: 'Konfirmasi Simpan',
        text: 'Apakah Anda yakin ingin menyimpan berita ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Simpan!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('newsForm').submit();
        }
    });
}

// Show success/error messages
document.addEventListener('DOMContentLoaded', function() {
    @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif

    @if(session('error'))
        Swal.fire({
            title: 'Error!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    @endif

    @if($errors->any())
        Swal.fire({
            title: 'Error!',
            text: 'Terjadi kesalahan pada form. Silakan periksa kembali.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    @endif
});
</script>
@endsection
