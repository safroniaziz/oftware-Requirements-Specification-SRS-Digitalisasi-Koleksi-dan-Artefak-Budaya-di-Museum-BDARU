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
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Back button-->
                        <a href="{{ route('news-management.index') }}" class="btn btn-secondary me-2">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali
                        </a>
                        <!--end::Back button-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body py-4">
                <form action="{{ route('news-management.store') }}" method="POST" enctype="multipart/form-data" id="newsForm">
                    @csrf

                    <div class="row">
                        <!--begin::Main Content-->
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Informasi Berita</h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-4">
                                        <label for="title" class="form-label fw-bold">Judul Berita <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                               id="title" name="title" value="{{ old('title') }}"
                                               placeholder="Masukkan judul berita" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Judul berita yang akan ditampilkan di frontend</div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="excerpt" class="form-label fw-bold">Ringkasan</label>
                                        <textarea class="form-control @error('excerpt') is-invalid @enderror"
                                                  id="excerpt" name="excerpt" rows="3"
                                                  placeholder="Masukkan ringkasan berita">{{ old('excerpt') }}</textarea>
                                        @error('excerpt')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Ringkasan singkat berita untuk preview</div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="content" class="form-label fw-bold">Konten Berita <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('content') is-invalid @enderror"
                                                  id="content" name="content" rows="10"
                                                  placeholder="Masukkan konten berita" required>{{ old('content') }}</textarea>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Konten lengkap berita</div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="image_path" class="form-label fw-bold">Gambar Berita</label>
                                        <input type="file" class="form-control @error('image_path') is-invalid @enderror"
                                               id="image_path" name="image_path" accept="image/*">
                                        @error('image_path')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Upload gambar untuk berita (opsional)</div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <!--end::Main Content-->

                        <!--begin::Sidebar-->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Pengaturan</h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-4">
                                        <label for="category_id" class="form-label fw-bold">Kategori Berita</label>
                                        <select class="form-select @error('category_id') is-invalid @enderror"
                                                id="category_id" name="category_id">
                                            <option value="">Pilih Kategori</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Pilih kategori untuk berita ini</div>
                                    </div>



                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Status</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="is_published" name="is_published"
                                                   value="1" {{ old('is_published', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_published">
                                                Berita Dipublikasikan
                                            </label>
                                        </div>
                                        <div class="form-text">Berita aktif akan ditampilkan di frontend</div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Fitur</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured"
                                                   value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_featured">
                                                Berita Unggulan
                                            </label>
                                        </div>
                                        <div class="form-text">Berita unggulan akan ditampilkan di halaman utama</div>
                                    </div>

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
                        <!--end::Sidebar-->
                    </div>

                    <!--begin::Form Actions-->
                    <div class="d-flex justify-content-end mt-6">
                        <button type="button" class="btn btn-secondary me-2" onclick="resetForm()">
                            <i class="fas fa-undo me-2"></i>
                            Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            Simpan Berita
                        </button>
                    </div>
                    <!--end::Form Actions-->
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
// Form validation and submission
document.getElementById('newsForm').addEventListener('submit', function(e) {
    const title = document.getElementById('title').value.trim();
    const content = document.getElementById('content').value.trim();

    if (!title) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Judul berita wajib diisi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    if (!content) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Konten berita wajib diisi',
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
            document.getElementById('is_published').checked = true;

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
