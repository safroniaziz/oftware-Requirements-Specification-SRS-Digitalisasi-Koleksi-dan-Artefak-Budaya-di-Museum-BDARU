@extends('layouts.dashboard.dashboard')

@section('title', 'Edit Kategori - BDARU Museum')

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
                    <h2 class="fw-bold">Edit Kategori: {{ $category->name }}</h2>
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Back-->
                        <a href="{{ route('categories-management.index') }}" class="btn btn-secondary me-2">
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
                <form action="{{ route('categories-management.update', $category->id) }}" method="POST" id="categoryForm">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-6">
                                <label for="name" class="form-label fw-bold">Nama Kategori <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name', $category->name) }}"
                                       placeholder="Masukkan nama kategori" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="description" class="form-label fw-bold">Deskripsi</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description" name="description" rows="4"
                                          placeholder="Masukkan deskripsi kategori">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Deskripsi singkat tentang kategori ini</small>
                            </div>

                            <div class="mb-6">
                                <label for="slug" class="form-label fw-bold">Slug</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                       id="slug" name="slug" value="{{ old('slug', $category->slug) }}"
                                       placeholder="Slug akan dibuat otomatis dari nama">
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">URL-friendly version dari nama kategori (opsional, akan dibuat otomatis)</small>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="color" class="form-label fw-bold">Warna</label>
                                        <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror"
                                               id="color" name="color" value="{{ old('color', $category->color ?? '#0d6efd') }}"
                                               title="Pilih warna untuk kategori">
                                        @error('color')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Warna untuk menandai kategori</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="icon" class="form-label fw-bold">Icon</label>
                                        <input type="text" class="form-control @error('icon') is-invalid @enderror"
                                               id="icon" name="icon" value="{{ old('icon', $category->icon) }}"
                                               placeholder="fas fa-tag">
                                        @error('icon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Class icon FontAwesome (contoh: fas fa-tag)</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-6">
                                <label class="form-label fw-bold">Status</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                           value="1" {{ old('is_active', !$category->deleted_at) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Kategori Aktif
                                    </label>
                                </div>
                                <small class="text-muted">Kategori aktif akan ditampilkan di frontend</small>
                            </div>

                            <div class="mb-6">
                                <label for="parent_id" class="form-label fw-bold">Kategori Induk</label>
                                <select class="form-select @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                                    <option value="">Tidak ada induk</option>
                                    @foreach($categories as $cat)
                                        @if($cat->id != $category->id)
                                            <option value="{{ $cat->id }}" {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Pilih kategori induk jika ini adalah sub-kategori</small>
                            </div>

                            <div class="mb-6">
                                <label for="order" class="form-label fw-bold">Urutan Tampilan</label>
                                <input type="number" class="form-control @error('order') is-invalid @enderror"
                                       id="order" name="order" value="{{ old('order', $category->order ?? 0) }}"
                                       min="0" placeholder="Urutan dalam daftar kategori">
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Angka kecil akan ditampilkan lebih dulu</small>
                            </div>

                            <div class="mb-6">
                                <label for="meta_title" class="form-label fw-bold">Meta Title</label>
                                <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                       id="meta_title" name="meta_title" value="{{ old('meta_title', $category->meta_title) }}"
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
                                          placeholder="Meta description untuk SEO">{{ old('meta_description', $category->meta_description) }}</textarea>
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
                                            <strong>Info:</strong> Kategori dibuat pada
                                            <strong>{{ $category->created_at->format('d M Y H:i') }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <div>
                                            <strong>Perhatian:</strong> Mengubah kategori dapat mempengaruhi koleksi yang terkait
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
                            Update Kategori
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

// Form validation
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

    // Show loading
    Swal.fire({
        title: 'Mengupdate...',
        text: 'Mohon tunggu, kategori sedang diupdate',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
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
            document.getElementById('color').value = '{{ $category->color ?? "#0d6efd" }}';
            document.getElementById('icon').value = '{{ $category->icon }}';
            document.getElementById('parent_id').value = '{{ $category->parent_id }}';
            document.getElementById('order').value = '{{ $category->order ?? 0 }}';
            document.getElementById('meta_title').value = '{{ $category->meta_title }}';
            document.getElementById('meta_description').value = '{{ $category->meta_description }}';
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
