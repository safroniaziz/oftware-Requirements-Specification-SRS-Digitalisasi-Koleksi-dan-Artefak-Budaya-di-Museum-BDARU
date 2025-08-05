@extends('layouts.dashboard.dashboard')

@section('title', 'Edit Agenda - BDARU Museum')

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
                    <h2 class="fw-bold">Edit Agenda: {{ $event->title }}</h2>
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Back-->
                        <a href="{{ route('events-management.index') }}" class="btn btn-secondary me-2">
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
                <form action="{{ route('events-management.update', $event->id) }}" method="POST" id="eventForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-6">
                                <label for="title" class="form-label fw-bold">Judul Agenda <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       id="title" name="title" value="{{ old('title', $event->title) }}"
                                       placeholder="Masukkan judul agenda" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="description" class="form-label fw-bold">Deskripsi</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description" name="description" rows="4"
                                          placeholder="Masukkan deskripsi agenda">{{ old('description', $event->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="event_date" class="form-label fw-bold">Tanggal Event <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('event_date') is-invalid @enderror"
                                               id="event_date" name="event_date" value="{{ old('event_date', $event->event_date) }}" required>
                                        @error('event_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="start_time" class="form-label fw-bold">Waktu Mulai <span class="text-danger">*</span></label>
                                        <input type="time" class="form-control @error('start_time') is-invalid @enderror"
                                               id="start_time" name="start_time" value="{{ old('start_time', $event->start_time) }}" required>
                                        @error('start_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="end_time" class="form-label fw-bold">Waktu Selesai</label>
                                        <input type="time" class="form-control @error('end_time') is-invalid @enderror"
                                               id="end_time" name="end_time" value="{{ old('end_time', $event->end_time) }}">
                                        @error('end_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="location" class="form-label fw-bold">Lokasi</label>
                                        <input type="text" class="form-control @error('location') is-invalid @enderror"
                                               id="location" name="location" value="{{ old('location', $event->location) }}"
                                               placeholder="Masukkan lokasi event">
                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="organizer" class="form-label fw-bold">Penyelenggara</label>
                                        <input type="text" class="form-control @error('organizer') is-invalid @enderror"
                                               id="organizer" name="organizer" value="{{ old('organizer', $event->organizer) }}"
                                               placeholder="Masukkan penyelenggara">
                                        @error('organizer')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="image" class="form-label fw-bold">Gambar Event</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                       id="image" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Format: JPG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar</small>

                                <div id="image-preview" class="mt-3">
                                    @if($event->image_path)
                                        <img id="preview-img" src="{{ asset('storage/' . $event->image_path) }}" alt="Current Image" class="img-thumbnail" style="max-width: 300px;">
                                        <div class="mt-2">
                                            <small class="text-muted">Gambar saat ini</small>
                                        </div>
                                    @else
                                        <div class="bg-light-primary rounded-3 d-flex align-items-center justify-content-center"
                                             style="width: 300px; height: 200px;">
                                            <i class="fas fa-image text-primary fs-2x"></i>
                                        </div>
                                        <div class="mt-2">
                                            <small class="text-muted">Tidak ada gambar</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-6">
                                <label class="form-label fw-bold">Status</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                           value="1" {{ old('is_active', !$event->deleted_at) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Agenda Aktif
                                    </label>
                                </div>
                                <small class="text-muted">Agenda aktif akan ditampilkan di frontend</small>
                            </div>

                            <div class="mb-6">
                                <label for="event_type" class="form-label fw-bold">Tipe Event</label>
                                <select class="form-select @error('event_type') is-invalid @enderror" id="event_type" name="event_type">
                                    <option value="">Pilih tipe event</option>
                                    <option value="exhibition" {{ old('event_type', $event->event_type) == 'exhibition' ? 'selected' : '' }}>Pameran</option>
                                    <option value="workshop" {{ old('event_type', $event->event_type) == 'workshop' ? 'selected' : '' }}>Workshop</option>
                                    <option value="seminar" {{ old('event_type', $event->event_type) == 'seminar' ? 'selected' : '' }}>Seminar</option>
                                    <option value="conference" {{ old('event_type', $event->event_type) == 'conference' ? 'selected' : '' }}>Konferensi</option>
                                    <option value="performance" {{ old('event_type', $event->event_type) == 'performance' ? 'selected' : '' }}>Pertunjukan</option>
                                    <option value="other" {{ old('event_type', $event->event_type) == 'other' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('event_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="capacity" class="form-label fw-bold">Kapasitas</label>
                                <input type="number" class="form-control @error('capacity') is-invalid @enderror"
                                       id="capacity" name="capacity" value="{{ old('capacity', $event->capacity) }}"
                                       min="1" placeholder="Jumlah peserta maksimal">
                                @error('capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Kosongkan jika tidak ada batasan</small>
                            </div>

                            <div class="mb-6">
                                <label for="registration_required" class="form-label fw-bold">Pendaftaran</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="registration_required" name="registration_required"
                                           value="1" {{ old('registration_required', $event->registration_required) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="registration_required">
                                        Perlu Pendaftaran
                                    </label>
                                </div>
                                <small class="text-muted">Centang jika event memerlukan pendaftaran</small>
                            </div>

                            <div class="mb-6">
                                <label for="contact_info" class="form-label fw-bold">Informasi Kontak</label>
                                <textarea class="form-control @error('contact_info') is-invalid @enderror"
                                          id="contact_info" name="contact_info" rows="3"
                                          placeholder="Email, telepon, atau informasi kontak lainnya">{{ old('contact_info', $event->contact_info) }}</textarea>
                                @error('contact_info')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <div class="alert alert-info">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <div>
                                            <strong>Info:</strong> Agenda dibuat pada
                                            <strong>{{ $event->created_at->format('d M Y H:i') }}</strong>
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
                            Update Agenda
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
                    <small class="text-muted">Preview gambar baru</small>
                </div>
            `;
        }
        reader.readAsDataURL(file);
    } else {
        // Reset to original image
        @if($event->image_path)
            preview.innerHTML = `
                <img id="preview-img" src="{{ asset('storage/' . $event->image_path) }}" alt="Current Image" class="img-thumbnail" style="max-width: 300px;">
                <div class="mt-2">
                    <small class="text-muted">Gambar saat ini</small>
                </div>
            `;
        @else
            preview.innerHTML = `
                <div class="bg-light-primary rounded-3 d-flex align-items-center justify-content-center"
                     style="width: 300px; height: 200px;">
                    <i class="fas fa-image text-primary fs-2x"></i>
                </div>
                <div class="mt-2">
                    <small class="text-muted">Tidak ada gambar</small>
                </div>
            `;
        @endif
    }
});

// Form validation and submission
document.getElementById('eventForm').addEventListener('submit', function(e) {
    const title = document.getElementById('title').value.trim();
    const eventDate = document.getElementById('event_date').value;

    if (!title || !eventDate) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Judul dan tanggal event wajib diisi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    // Show confirmation
    e.preventDefault();
    Swal.fire({
        title: 'Konfirmasi Update',
        text: 'Apakah Anda yakin ingin mengupdate agenda ini?',
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
                text: 'Mohon tunggu, agenda sedang diupdate',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Submit form
            document.getElementById('eventForm').submit();
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
            document.getElementById('title').value = '{{ $event->title }}';
            document.getElementById('description').value = '{{ $event->description }}';
            document.getElementById('event_date').value = '{{ $event->event_date }}';
            document.getElementById('event_time').value = '{{ $event->event_time }}';
            document.getElementById('location').value = '{{ $event->location }}';
            document.getElementById('organizer').value = '{{ $event->organizer }}';
            document.getElementById('event_type').value = '{{ $event->event_type }}';
            document.getElementById('capacity').value = '{{ $event->capacity }}';
            document.getElementById('contact_info').value = '{{ $event->contact_info }}';
            document.getElementById('is_active').checked = {{ !$event->deleted_at ? 'true' : 'false' }};
            document.getElementById('registration_required').checked = {{ $event->registration_required ? 'true' : 'false' }};

            // Reset image preview
            const imagePreview = document.getElementById('image-preview');
            @if($event->image_path)
                imagePreview.innerHTML = `
                    <img id="preview-img" src="{{ asset('storage/' . $event->image_path) }}" alt="Current Image" class="img-thumbnail" style="max-width: 300px;">
                    <div class="mt-2">
                        <small class="text-muted">Gambar saat ini</small>
                    </div>
                `;
            @else
                imagePreview.innerHTML = `
                    <div class="bg-light-primary rounded-3 d-flex align-items-center justify-content-center"
                         style="width: 300px; height: 200px;">
                        <i class="fas fa-image text-primary fs-2x"></i>
                    </div>
                    <div class="mt-2">
                        <small class="text-muted">Tidak ada gambar</small>
                    </div>
                `;
            @endif
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
