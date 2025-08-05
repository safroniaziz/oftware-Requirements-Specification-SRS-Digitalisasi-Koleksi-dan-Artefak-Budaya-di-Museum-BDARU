@extends('layouts.dashboard.dashboard')

@section('title', 'Edit Hero Image - BDARU Museum')

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
                    <h2 class="fw-bold">Edit Hero Image: {{ $heroImage->title }}</h2>
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Back button-->
                        <a href="{{ route('hero-images-management.index') }}" class="btn btn-secondary me-2">
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
                <form action="{{ route('hero-images-management.update', $heroImage->id) }}" method="POST" enctype="multipart/form-data" id="heroImageForm">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!--begin::Main Content-->
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Informasi Hero Image</h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-4">
                                        <label for="title" class="form-label fw-bold">Judul <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                               id="title" name="title" value="{{ old('title', $heroImage->title) }}"
                                               placeholder="Masukkan judul hero image" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Judul yang akan ditampilkan di slider</div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="subtitle" class="form-label fw-bold">Subtitle <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                                               id="subtitle" name="subtitle" value="{{ old('subtitle', $heroImage->subtitle) }}"
                                               placeholder="Masukkan subtitle hero image" required>
                                        @error('subtitle')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Subtitle yang akan ditampilkan di bawah judul</div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="description" class="form-label fw-bold">Deskripsi <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                                  id="description" name="description" rows="4"
                                                  placeholder="Masukkan deskripsi hero image" required>{{ old('description', $heroImage->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Deskripsi lengkap hero image</div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="image" class="form-label fw-bold">Gambar Hero Image</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                                               id="image" name="image" accept="image/*">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Upload gambar untuk hero image (opsional, akan resize otomatis ke 1920x1080)</div>

                                        @if($heroImage->image_path)
                                            <div class="mt-3">
                                                <label class="form-label fw-bold">Gambar Saat Ini</label>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('storage/' . $heroImage->image_path) }}"
                                                         alt="Current Image" class="img-thumbnail me-3"
                                                         style="max-width: 200px; max-height: 120px;">
                                                    <div>
                                                        <small class="text-muted d-block">Gambar saat ini akan tetap digunakan jika tidak ada upload baru</small>
                                                        <small class="text-muted d-block">Ukuran yang direkomendasikan: 1920x1080px</small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="mb-4">
                                        <label for="alt_text" class="form-label fw-bold">Alt Text <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('alt_text') is-invalid @enderror"
                                               id="alt_text" name="alt_text" value="{{ old('alt_text', $heroImage->alt_text) }}"
                                               placeholder="Masukkan alt text untuk gambar" required>
                                        @error('alt_text')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Deskripsi gambar untuk accessibility</div>
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
                                        <label for="sort_order" class="form-label fw-bold">Urutan</label>
                                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                               id="sort_order" name="sort_order" value="{{ old('sort_order', $heroImage->sort_order ?? 0) }}"
                                               placeholder="0" min="0">
                                        @error('sort_order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Urutan tampilan di slider (angka kecil = tampil duluan)</div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Status</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                                   value="1" {{ old('is_active', $heroImage->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                Hero Image Aktif
                                            </label>
                                        </div>
                                        <div class="form-text">Hero image aktif akan ditampilkan di slider</div>
                                    </div>

                                    <div class="alert alert-info">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-info-circle me-2"></i>
                                            <div>
                                                <strong>Info:</strong> Hero image dibuat pada
                                                <strong>{{ $heroImage->created_at->format('d M Y H:i') }}</strong>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert alert-warning">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            <div>
                                                <strong>Perhatian:</strong> Mengubah hero image dapat mempengaruhi tampilan slider di beranda
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
                            Update Hero Image
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
document.getElementById('heroImageForm').addEventListener('submit', function(e) {
    const title = document.getElementById('title').value.trim();
    const subtitle = document.getElementById('subtitle').value.trim();
    const description = document.getElementById('description').value.trim();
    const altText = document.getElementById('alt_text').value.trim();

    if (!title) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Judul wajib diisi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    if (!subtitle) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Subtitle wajib diisi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    if (!description) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Deskripsi wajib diisi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    if (!altText) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Alt text wajib diisi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    // Show confirmation
    e.preventDefault();
    Swal.fire({
        title: 'Konfirmasi Update',
        text: 'Apakah Anda yakin ingin mengupdate hero image ini?',
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
                text: 'Mohon tunggu, hero image sedang diupdate',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Submit form
            document.getElementById('heroImageForm').submit();
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
            document.getElementById('title').value = '{{ $heroImage->title }}';
            document.getElementById('subtitle').value = '{{ $heroImage->subtitle }}';
            document.getElementById('description').value = '{{ $heroImage->description }}';
            document.getElementById('alt_text').value = '{{ $heroImage->alt_text }}';
            document.getElementById('sort_order').value = '{{ $heroImage->sort_order ?? 0 }}';
            document.getElementById('is_active').checked = {{ $heroImage->is_active ? 'true' : 'false' }};
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
