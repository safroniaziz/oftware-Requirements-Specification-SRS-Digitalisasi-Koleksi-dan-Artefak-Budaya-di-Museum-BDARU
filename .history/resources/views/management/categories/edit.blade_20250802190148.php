@extends('layouts.dashboard.dashboard')

@section('title', 'Edit Kategori - BDARU Museum')

@section('content')
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Card-->
        <div class="card shadow-sm border-0">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6 bg-light-warning">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2 class="fw-bold text-dark">
                        <i class="fas fa-edit me-3 text-warning"></i>
                        Edit Kategori
                    </h2>
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Back button-->
                        <a href="{{ route('categories-management.index') }}" class="btn btn-light-warning me-3">
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
            <div class="card-body py-6">
                <form action="{{ route('categories-management.update', $category->id) }}" method="POST" id="categoryForm">
                    @csrf
                    @method('PUT')

                    <div class="row g-6">
                        <!--begin::Main Content-->
                        <div class="col-lg-8">
                            <div class="card shadow-sm border-0 bg-light-primary">
                                <div class="card-header bg-transparent border-0">
                                    <h3 class="card-title fw-bold text-dark">
                        <i class="fas fa-info-circle me-2 text-primary"></i>
                        Informasi Kategori
                    </h3>
                </div>
                <div class="card-body">
                    <div class="mb-6">
                        <label for="name" class="form-label fw-bold">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name', $category->name) }}"
                               placeholder="Masukkan nama kategori" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Nama kategori yang akan ditampilkan di frontend</div>
                    </div>

                    <div class="mb-6">
                        <label for="description" class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="4"
                                  placeholder="Masukkan deskripsi kategori">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Deskripsi singkat tentang kategori ini</div>
                    </div>

                    <div class="mb-6">
                        <label for="slug" class="form-label fw-bold">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror"
                               id="slug" name="slug" value="{{ old('slug', $category->slug) }}"
                               placeholder="Slug akan dibuat otomatis dari nama">
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">URL-friendly version dari nama kategori (opsional, akan dibuat otomatis)</div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Main Content-->

        <!--begin::Sidebar-->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 bg-light-success">
                <div class="card-header bg-transparent border-0">
                    <h3 class="card-title fw-bold text-dark">
                        <i class="fas fa-cog me-2 text-success"></i>
                        Pengaturan
                    </h3>
                </div>
                <div class="card-body">
                    <div class="mb-6">
                        <label class="form-label fw-bold">Status</label>
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                   value="1" {{ old('is_active', !$category->deleted_at) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Kategori Aktif
                            </label>
                        </div>
                        <div class="form-text">Kategori aktif akan ditampilkan di frontend</div>
                    </div>

                    <div class="alert alert-info d-flex align-items-center p-4">
                        <i class="fas fa-info-circle me-3 fs-2x text-info"></i>
                        <div>
                            <h6 class="alert-heading fw-bold mb-1">Info</h6>
                            <p class="mb-0">Kategori dibuat pada {{ $category->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Sidebar-->
    </div>

    <!--begin::Form Actions-->
    <div class="d-flex justify-content-end gap-3 mt-8">
        <button type="button" class="btn btn-light-secondary btn-lg" onclick="resetForm()">
            <i class="fas fa-undo me-2"></i>
            Reset
        </button>
        <button type="submit" class="btn btn-warning btn-lg">
            <i class="fas fa-save me-2"></i>
            Update Kategori
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
// Auto-generate slug from name
document.getElementById('name').addEventListener('input', function() {
    const name = this.value;
    const slug = name.toLowerCase()
        .replace(/[^a-z0-9 -]/g, '') // Remove special characters
        .replace(/\s+/g, '-') // Replace spaces with hyphens
        .replace(/-+/g, '-') // Replace multiple hyphens with single hyphen
        .trim('-'); // Remove leading/trailing hyphens

    document.getElementById('slug').value = slug;
});

// Form validation and submission
document.getElementById('categoryForm').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();

    if (!name) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Nama kategori wajib diisi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    // Show confirmation
    e.preventDefault();
    Swal.fire({
        title: 'Konfirmasi Update',
        text: 'Apakah Anda yakin ingin mengupdate kategori ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Update!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Mengupdate...',
                text: 'Mohon tunggu, kategori sedang diupdate',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Submit form
            document.getElementById('categoryForm').submit();
        }
    });
});

function resetForm() {
    Swal.fire({
        title: 'Konfirmasi Reset',
        text: 'Apakah Anda yakin ingin mereset form ke data asli?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#6c757d',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Reset!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Reset to original values
            document.getElementById('name').value = '{{ $category->name }}';
            document.getElementById('description').value = '{{ $category->description }}';
            document.getElementById('slug').value = '{{ $category->slug }}';
            document.getElementById('is_active').checked = {{ !$category->deleted_at ? 'true' : 'false' }};
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
