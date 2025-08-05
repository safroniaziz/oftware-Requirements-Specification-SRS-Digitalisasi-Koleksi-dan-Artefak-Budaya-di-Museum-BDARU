@extends('layouts.dashboard.dashboard')

@section('title', 'Edit Kategori Berita')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Edit Kategori Berita: {{ $newsCategory->name }}</h3>
            <a href="{{ route('news-categories-management.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <form id="newsCategoryForm" action="{{ route('news-categories-management.update', $newsCategory->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name', $newsCategory->name) }}"
                               placeholder="Masukkan nama kategori" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror"
                               id="slug" name="slug" value="{{ old('slug', $newsCategory->slug) }}"
                               placeholder="slug-otomatis-akan-dibuat" required>
                        <div class="form-text">Slug akan dibuat otomatis dari nama kategori</div>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="3"
                                  placeholder="Masukkan deskripsi kategori">{{ old('description', $newsCategory->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="color" class="form-label">Warna <span class="text-danger">*</span></label>
                        <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror"
                               id="color" name="color" value="{{ old('color', $newsCategory->color) }}"
                               title="Pilih warna untuk kategori" required>
                        @error('color')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon</label>
                        <input type="text" class="form-control @error('icon') is-invalid @enderror"
                               id="icon" name="icon" value="{{ old('icon', $newsCategory->icon) }}"
                               placeholder="🏛️ atau nama icon">
                        <div class="form-text">Masukkan emoji atau nama icon</div>
                        @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Urutan</label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                               id="sort_order" name="sort_order" value="{{ old('sort_order', $newsCategory->sort_order) }}"
                               min="0" placeholder="0">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                   value="1" {{ old('is_active', $newsCategory->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Aktif
                            </label>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Info:</strong> Kategori ini dibuat pada {{ $newsCategory->created_at->format('d M Y H:i') }}
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-secondary" onclick="resetForm()">
                    <i class="fas fa-undo"></i> Reset
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

// Form submission with SweetAlert2
document.getElementById('newsCategoryForm').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    const slug = document.getElementById('slug').value.trim();

    if (!name || !slug) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Nama dan slug kategori wajib diisi',
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

// Reset form to original values
function resetForm() {
    Swal.fire({
        title: 'Reset Form?',
        text: 'Form akan dikembalikan ke nilai asli',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Reset!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Reset to original values
            document.getElementById('name').value = '{{ $newsCategory->name }}';
            document.getElementById('slug').value = '{{ $newsCategory->slug }}';
            document.getElementById('description').value = '{{ $newsCategory->description }}';
            document.getElementById('color').value = '{{ $newsCategory->color }}';
            document.getElementById('icon').value = '{{ $newsCategory->icon }}';
            document.getElementById('sort_order').value = '{{ $newsCategory->sort_order }}';
            document.getElementById('is_active').checked = {{ $newsCategory->is_active ? 'true' : 'false' }};

            Swal.fire('Berhasil!', 'Form telah direset ke nilai asli', 'success');
        }
    });
}

// Show validation errors if any
document.addEventListener('DOMContentLoaded', function() {
    @if($errors->any())
        Swal.fire({
            title: 'Error Validasi!',
            text: 'Mohon periksa kembali data yang diinput',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    @endif
});
</script>
@endpush
