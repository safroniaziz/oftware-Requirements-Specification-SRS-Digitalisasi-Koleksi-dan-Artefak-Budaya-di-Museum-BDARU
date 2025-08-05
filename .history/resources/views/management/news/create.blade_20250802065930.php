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
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Back-->
                        <a href="{{ route('news-management.index') }}" class="btn btn-secondary me-2">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali
                        </a>
                        <!--end::Back-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body py-4">
                <form action="{{ route('news-management.store') }}" method="POST" id="newsForm" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-6">
                                <label for="title" class="form-label fw-bold">Judul Berita <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       id="title" name="title" value="{{ old('title') }}"
                                       placeholder="Masukkan judul berita" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="summary" class="form-label fw-bold">Ringkasan</label>
                                <textarea class="form-control @error('summary') is-invalid @enderror"
                                          id="summary" name="summary" rows="3"
                                          placeholder="Masukkan ringkasan berita">{{ old('summary') }}</textarea>
                                @error('summary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Ringkasan singkat berita (opsional)</small>
                            </div>

                            <div class="mb-6">
                                <label for="content" class="form-label fw-bold">Konten Berita <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('content') is-invalid @enderror"
                                          id="content" name="content" rows="10"
                                          placeholder="Masukkan konten berita lengkap" required>{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Konten lengkap berita</small>
                            </div>

                            <div class="mb-6">
                                <label for="image" class="form-label fw-bold">Gambar Berita</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                       id="image" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>

                                <div id="image-preview" class="mt-3">
                                    <div class="bg-light-primary rounded-3 d-flex align-items-center justify-content-center"
                                         style="width: 300px; height: 200px;">
                                        <i class="fas fa-image text-primary fs-2x"></i>
                                    </div>
                                    <div class="mt-2">
                                        <small class="text-muted">Preview gambar akan muncul di sini</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-6">
                                <label class="form-label fw-bold">Status</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                           value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Berita Aktif
                                    </label>
                                </div>
                                <small class="text-muted">Berita aktif akan ditampilkan di frontend</small>
                            </div>

                            <div class="mb-6">
                                <label for="news_category_id" class="form-label fw-bold">Kategori Berita <span class="text-danger">*</span></label>
                                <select class="form-select @error('news_category_id') is-invalid @enderror" id="news_category_id" name="news_category_id" required>
                                    <option value="">Pilih kategori berita</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('news_category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('news_category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Pilih kategori yang sesuai dengan berita</small>
                            </div>

                            <div class="mb-6">
                                <label for="author" class="form-label fw-bold">Penulis</label>
                                <input type="text" class="form-control @error('author') is-invalid @enderror"
                                       id="author" name="author" value="{{ old('author') }}"
                                       placeholder="Masukkan nama penulis">
                                @error('author')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="published_at" class="form-label fw-bold">Tanggal Publikasi</label>
                                <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror"
                                       id="published_at" name="published_at" value="{{ old('published_at') }}">
                                @error('published_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Kosongkan untuk publikasi sekarang</small>
                            </div>

                            <div class="mb-6">
                                <label for="tags" class="form-label fw-bold">Tags</label>
                                <input type="text" class="form-control @error('tags') is-invalid @enderror"
                                       id="tags" name="tags" value="{{ old('tags') }}"
                                       placeholder="tag1, tag2, tag3">
                                @error('tags')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Pisahkan dengan koma</small>
                            </div>

                            <div class="mb-6">
                                <label for="meta_title" class="form-label fw-bold">Meta Title</label>
                                <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                       id="meta_title" name="meta_title" value="{{ old('meta_title') }}"
                                       placeholder="Meta title untuk SEO">
                                @error('meta_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Judul untuk SEO (opsional)</small>
                            </div>

                            <div class="mb-6">
                                <label for="meta_description" class="form-label fw-bold">Meta Description</label>
                                <textarea class="form-control @error('meta_description') is-invalid @enderror"
                                          id="meta_description" name="meta_description" rows="3"
                                          placeholder="Meta description untuk SEO">{{ old('meta_description') }}</textarea>
                                @error('meta_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Deskripsi untuk SEO (opsional)</small>
                            </div>

                            <div class="mb-6">
                                <div class="alert alert-info">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <div>
                                            <strong>Info:</strong> Berita akan dibuat dengan pengaturan default
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" onclick="resetForm()">
                            <i class="fas fa-undo me-2"></i>
                            Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            Simpan Berita
                        </button>
                    </div>
                </form>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->

    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->

<script>
// Image preview
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('image-preview');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <img id="preview-img" src="${e.target.result}" alt="Preview" class="img-thumbnail" style="max-width: 300px;">
                <div class="mt-2">
                    <small class="text-muted">Preview gambar</small>
                </div>
            `;
        }
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = `
            <div class="bg-light-primary rounded-3 d-flex align-items-center justify-content-center"
                 style="width: 300px; height: 200px;">
                <i class="fas fa-image text-primary fs-2x"></i>
            </div>
            <div class="mt-2">
                <small class="text-muted">Preview gambar akan muncul di sini</small>
            </div>
        `;
    }
});

// Form validation and submission
document.getElementById('newsForm').addEventListener('submit', function(e) {
    const title = document.getElementById('title').value.trim();
    const content = document.getElementById('content').value.trim();

    if (!title || !content) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Judul dan konten berita wajib diisi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    // Show confirmation
    e.preventDefault();
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
            // Show loading
            Swal.fire({
                title: 'Menyimpan...',
                text: 'Mohon tunggu, berita sedang disimpan',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Submit form
            document.getElementById('newsForm').submit();
        }
    });
});

function resetForm() {
    Swal.fire({
        title: 'Konfirmasi Reset',
        text: 'Apakah Anda yakin ingin mereset form?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#6c757d',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Reset!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Reset form
            document.getElementById('newsForm').reset();
            document.getElementById('is_active').checked = true;

            // Reset image preview
            const imagePreview = document.getElementById('image-preview');
            imagePreview.innerHTML = `
                <div class="bg-light-primary rounded-3 d-flex align-items-center justify-content-center"
                     style="width: 300px; height: 200px;">
                    <i class="fas fa-image text-primary fs-2x"></i>
                </div>
                <div class="mt-2">
                    <small class="text-muted">Preview gambar akan muncul di sini</small>
                </div>
            `;
        }
    });
}

// Show validation errors
document.addEventListener('DOMContentLoaded', function() {
    @if($errors->any())
        Swal.fire({
            title: 'Error!',
            html: `
                <div class="text-start">
                    <p>Terjadi kesalahan pada form:</p>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            `,
            icon: 'error',
            confirmButtonText: 'OK'
        });
    @endif
});
</script>
@endsection
