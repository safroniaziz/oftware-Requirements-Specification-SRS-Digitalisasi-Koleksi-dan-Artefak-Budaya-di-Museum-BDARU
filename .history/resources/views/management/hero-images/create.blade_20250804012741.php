@extends('layouts.dashboard.dashboard')

@section('title', 'Tambah Hero Image')

@section('content')
<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
        @include('layouts.dashboard._sidebar')

        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            @include('layouts.dashboard._header')

            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <div id="kt_content_container" class="container-xxl">
                        <!-- Page Header -->
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                Tambah Hero Image
                            </h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ route('hero-images-management.index') }}" class="text-muted text-hover-primary">Hero Images</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">Tambah</li>
                            </ul>
                        </div>

                        <!-- Form Card -->
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <h3 class="card-title fw-bold text-dark">Form Hero Image</h3>
                                <div class="card-toolbar">
                                    <a href="{{ route('hero-images-management.index') }}" class="btn btn-light-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>
                                        Kembali
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('hero-images-management.store') }}" method="POST" enctype="multipart/form-data" id="heroImageForm">
                                    @csrf

                                    <div class="row">
                                        <!-- Left Column -->
                                        <div class="col-lg-8">
                                            <!-- Title -->
                                            <div class="mb-5">
                                                <label for="title" class="form-label fw-semibold text-dark">
                                                    Judul <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                       class="form-control @error('title') is-invalid @enderror"
                                                       id="title"
                                                       name="title"
                                                       value="{{ old('title') }}"
                                                       placeholder="Masukkan judul hero image"
                                                       required>
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Subtitle -->
                                            <div class="mb-5">
                                                <label for="subtitle" class="form-label fw-semibold text-dark">
                                                    Subtitle <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                       class="form-control @error('subtitle') is-invalid @enderror"
                                                       id="subtitle"
                                                       name="subtitle"
                                                       value="{{ old('subtitle') }}"
                                                       placeholder="Masukkan subtitle"
                                                       required>
                                                @error('subtitle')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Description -->
                                            <div class="mb-5">
                                                <label for="description" class="form-label fw-semibold text-dark">
                                                    Deskripsi <span class="text-danger">*</span>
                                                </label>
                                                <textarea class="form-control @error('description') is-invalid @enderror"
                                                          id="description"
                                                          name="description"
                                                          rows="4"
                                                          placeholder="Masukkan deskripsi hero image"
                                                          required>{{ old('description') }}</textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Alt Text -->
                                            <div class="mb-5">
                                                <label for="alt_text" class="form-label fw-semibold text-dark">
                                                    Alt Text <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                       class="form-control @error('alt_text') is-invalid @enderror"
                                                       id="alt_text"
                                                       name="alt_text"
                                                       value="{{ old('alt_text') }}"
                                                       placeholder="Masukkan alt text untuk aksesibilitas"
                                                       required>
                                                @error('alt_text')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Right Column -->
                                        <div class="col-lg-4">
                                            <!-- Image Upload -->
                                            <div class="mb-5">
                                                <label for="image" class="form-label fw-semibold text-dark">
                                                    Gambar <span class="text-danger">*</span>
                                                </label>
                                                <div class="image-upload-container">
                                                    <input type="file"
                                                           class="form-control @error('image') is-invalid @enderror"
                                                           id="image"
                                                           name="image"
                                                           accept="image/*"
                                                           onchange="previewImage(this)"
                                                           required>
                                                    @error('image')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror

                                                    <!-- Image Preview -->
                                                    <div id="imagePreview" class="mt-3" style="display: none;">
                                                        <div class="position-relative">
                                                            <img id="previewImg"
                                                                 src=""
                                                                 alt="Preview"
                                                                 class="img-fluid rounded border"
                                                                 style="max-width: 100%; max-height: 300px; object-fit: cover;">
                                                            <button type="button"
                                                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2"
                                                                    onclick="removeImage()">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Upload Guidelines -->
                                                    <div class="mt-3 p-3 bg-light-primary rounded">
                                                        <h6 class="fw-semibold text-primary mb-2">
                                                            <i class="fas fa-info-circle me-2"></i>
                                                            Panduan Upload
                                                        </h6>
                                                        <ul class="text-muted small mb-0">
                                                            <li>Format: JPG, PNG, GIF</li>
                                                            <li>Ukuran maksimal: 2MB</li>
                                                            <li>Rasio aspek: 3:2 (1200x800)</li>
                                                            <li>Gambar akan otomatis di-resize</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Sort Order -->
                                            <div class="mb-5">
                                                <label for="sort_order" class="form-label fw-semibold text-dark">
                                                    Urutan
                                                </label>
                                                <input type="number"
                                                       class="form-control @error('sort_order') is-invalid @enderror"
                                                       id="sort_order"
                                                       name="sort_order"
                                                       value="{{ old('sort_order', 0) }}"
                                                       min="0"
                                                       placeholder="0">
                                                @error('sort_order')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="form-text">Urutan tampilan (0 = pertama)</div>
                                            </div>

                                            <!-- Status -->
                                            <div class="mb-5">
                                                <label class="form-label fw-semibold text-dark">Status</label>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input"
                                                           type="checkbox"
                                                           id="is_active"
                                                           name="is_active"
                                                           value="1"
                                                           {{ old('is_active') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_active">
                                                        Aktif
                                                    </label>
                                                </div>
                                                <div class="form-text">Hero image akan ditampilkan di slider jika aktif</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="d-flex justify-content-end pt-5">
                                        <button type="button"
                                                class="btn btn-light-secondary me-3"
                                                onclick="window.location.href='{{ route('hero-images-management.index') }}'">
                                            <i class="fas fa-times me-2"></i>
                                            Batal
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>
                                            Simpan Hero Image
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('layouts.dashboard._footer')
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input) {
    const file = input.files[0];
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
}

function removeImage() {
    document.getElementById('image').value = '';
    document.getElementById('imagePreview').style.display = 'none';
}

// Form validation
document.getElementById('heroImageForm').addEventListener('submit', function(e) {
    const image = document.getElementById('image').files[0];
    if (!image) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Silakan pilih gambar terlebih dahulu!'
        });
        return false;
    }
});
</script>
@endpush
