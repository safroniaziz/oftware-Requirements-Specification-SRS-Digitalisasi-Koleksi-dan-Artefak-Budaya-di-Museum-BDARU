@extends('layouts.dashboard.dashboard')

@section('title', 'Tambah Agenda - BDARU Museum')

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
                    <h2 class="fw-bold">Tambah Agenda Baru</h2>
                </div>
                <!--end::Card title-->

                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <a href="{{ route('events-management.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali ke Daftar
                    </a>
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body py-4">
                <form action="{{ route('events-management.store') }}" method="POST" enctype="multipart/form-data" id="eventForm">
                    @csrf

                    <div class="row">
                        <!--begin::Left Column-->
                        <div class="col-lg-8">
                            <!--begin::Title-->
                            <div class="mb-6">
                                <label for="title" class="form-label fw-bold">Judul Agenda <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control form-control-lg @error('title') is-invalid @enderror"
                                       id="title"
                                       name="title"
                                       value="{{ old('title') }}"
                                       placeholder="Masukkan judul agenda"
                                       required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Title-->

                            <!--begin::Description-->
                            <div class="mb-6">
                                <label for="description" class="form-label fw-bold">Deskripsi Agenda <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description"
                                          name="description"
                                          rows="8"
                                          placeholder="Tulis deskripsi agenda lengkap"
                                          required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Description-->

                            <!--begin::Date and Time-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="event_date" class="form-label fw-bold">Tanggal Event <span class="text-danger">*</span></label>
                                        <input type="date"
                                               class="form-control @error('event_date') is-invalid @enderror"
                                               id="event_date"
                                               name="event_date"
                                               value="{{ old('event_date') }}"
                                               required>
                                        @error('event_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="event_time" class="form-label fw-bold">Waktu Event</label>
                                        <input type="time"
                                               class="form-control @error('event_time') is-invalid @enderror"
                                               id="event_time"
                                               name="event_time"
                                               value="{{ old('event_time') }}">
                                        @error('event_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!--end::Date and Time-->

                            <!--begin::Location-->
                            <div class="mb-6">
                                <label for="location" class="form-label fw-bold">Lokasi Event</label>
                                <input type="text"
                                       class="form-control @error('location') is-invalid @enderror"
                                       id="location"
                                       name="location"
                                       value="{{ old('location') }}"
                                       placeholder="Masukkan lokasi event">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Location-->
                        </div>
                        <!--end::Left Column-->

                        <!--begin::Right Column-->
                        <div class="col-lg-4">
                            <!--begin::Image Upload-->
                            <div class="mb-6">
                                <label class="form-label fw-bold">Gambar Agenda</label>
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

                            <!--begin::Status-->
                            <div class="mb-6">
                                <label for="status" class="form-label fw-bold">Status Event <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror"
                                        id="status"
                                        name="status"
                                        required>
                                    <option value="">Pilih status</option>
                                    <option value="upcoming" {{ old('status') == 'upcoming' ? 'selected' : '' }}>Akan Datang</option>
                                    <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Sedang Berlangsung</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Status-->

                            <!--begin::Submit Buttons-->
                            <div class="d-grid gap-3">
                                <button type="button" class="btn btn-primary btn-lg" onclick="confirmSubmit()">
                                    <i class="fas fa-save me-2"></i>
                                    Simpan Agenda
                                </button>
                                <a href="{{ route('events-management.index') }}" class="btn btn-outline-secondary">
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
    <!--end::Content container-->
</div>
<!--end::Content-->

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
    const description = document.getElementById('description').value.trim();
    const eventDate = document.getElementById('event_date').value;
    const status = document.getElementById('status').value;

    if (!title) {
        Swal.fire('Error', 'Judul agenda harus diisi', 'error');
        return;
    }

    if (!description) {
        Swal.fire('Error', 'Deskripsi agenda harus diisi', 'error');
        return;
    }

    if (!eventDate) {
        Swal.fire('Error', 'Tanggal event harus diisi', 'error');
        return;
    }

    if (!status) {
        Swal.fire('Error', 'Status event harus dipilih', 'error');
        return;
    }

    Swal.fire({
        title: 'Konfirmasi Simpan',
        text: 'Apakah Anda yakin ingin menyimpan agenda ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Simpan!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('eventForm').submit();
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
