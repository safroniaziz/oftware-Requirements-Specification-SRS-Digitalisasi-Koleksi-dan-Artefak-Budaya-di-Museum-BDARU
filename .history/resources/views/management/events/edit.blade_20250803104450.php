@extends('layouts.dashboard.dashboard')

@section('title', 'Edit Event - BDARU Museum')

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
                    <h2 class="fw-bold">Edit Event: {{ $event->title }}</h2>
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Back button-->
                        <a href="{{ route('events-management.index') }}" class="btn btn-secondary me-2">
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
                <form action="{{ route('events-management.update', $event->id) }}" method="POST" enctype="multipart/form-data" id="eventForm">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!--begin::Main Content-->
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Informasi Event</h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-4">
                                        <label for="title" class="form-label fw-bold">Judul Event <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                               id="title" name="title" value="{{ old('title', $event->title) }}"
                                               placeholder="Masukkan judul event" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Judul event yang akan ditampilkan di frontend</div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="description" class="form-label fw-bold">Deskripsi Event <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                                  id="description" name="description" rows="6"
                                                  placeholder="Masukkan deskripsi event" required>{{ old('description', $event->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Deskripsi lengkap tentang event</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label for="event_date" class="form-label fw-bold">Tanggal Event <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control @error('event_date') is-invalid @enderror"
                                                       id="event_date" name="event_date" value="{{ old('event_date', $event->event_date) }}" required>
                                                @error('event_date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="form-text">Tanggal pelaksanaan event</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label for="location" class="form-label fw-bold">Lokasi <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('location') is-invalid @enderror"
                                                       id="location" name="location" value="{{ old('location', $event->location) }}"
                                                       placeholder="Masukkan lokasi event" required>
                                                @error('location')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="form-text">Lokasi pelaksanaan event</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label for="start_time" class="form-label fw-bold">Waktu Mulai</label>
                                                <input type="time" class="form-control @error('start_time') is-invalid @enderror"
                                                       id="start_time" name="start_time" value="{{ old('start_time', $event->start_time) }}">
                                                @error('start_time')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="form-text">Waktu mulai event</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label for="end_time" class="form-label fw-bold">Waktu Selesai</label>
                                                <input type="time" class="form-control @error('end_time') is-invalid @enderror"
                                                       id="end_time" name="end_time" value="{{ old('end_time', $event->end_time) }}">
                                                @error('end_time')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="form-text">Waktu selesai event</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="image" class="form-label fw-bold">Gambar Event</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                                               id="image" name="image" accept="image/*" onchange="previewImage(this)">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Upload gambar untuk event (opsional). Ukuran yang direkomendasikan: 16:9 aspect ratio</div>

                                        <!-- Current Image Display -->
                                        @if($event->image)
                                            <div class="mt-3">
                                                <label class="form-label fw-bold">Gambar Saat Ini</label>
                                                <div class="relative h-64 overflow-hidden rounded-lg border border-gray-200">
                                                    <img src="{{ asset('storage/' . $event->image) }}"
                                                         alt="Current Image" class="w-full h-full object-cover">
                                                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-600/20 to-teal-600/20"></div>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <small class="text-muted">Gambar saat ini akan tetap digunakan jika tidak ada upload baru</small>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- New Image Preview -->
                                        <div id="imagePreview" class="mt-3" style="display: none;">
                                            <label class="form-label fw-bold">Preview Gambar Baru</label>
                                            <div class="relative h-64 overflow-hidden rounded-lg border border-gray-200">
                                                <img id="previewImg" src="" alt="Preview" class="w-full h-full object-cover">
                                                <div class="absolute inset-0 bg-gradient-to-br from-emerald-600/20 to-teal-600/20"></div>
                                            </div>
                                            <div class="mt-2 text-center">
                                                <small class="text-muted">Preview gambar baru akan ditampilkan dengan ukuran yang sama seperti di halaman events</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="additional_info" class="form-label fw-bold">Informasi Tambahan</label>
                                        <textarea class="form-control @error('additional_info') is-invalid @enderror"
                                                  id="additional_info" name="additional_info" rows="3"
                                                  placeholder="Masukkan informasi tambahan">{{ old('additional_info', $event->additional_info) }}</textarea>
                                        @error('additional_info')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Informasi tambahan seperti syarat, ketentuan, dll</div>
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
                                        <label for="type" class="form-label fw-bold">Tipe Event</label>
                                        <select class="form-select @error('type') is-invalid @enderror"
                                                id="type" name="type">
                                            <option value="seminar" {{ old('type', $event->type) == 'seminar' ? 'selected' : '' }}>Seminar</option>
                                            <option value="workshop" {{ old('type', $event->type) == 'workshop' ? 'selected' : '' }}>Workshop</option>
                                            <option value="exhibition" {{ old('type', $event->type) == 'exhibition' ? 'selected' : '' }}>Pameran</option>
                                            <option value="conference" {{ old('type', $event->type) == 'conference' ? 'selected' : '' }}>Konferensi</option>
                                            <option value="other" {{ old('type', $event->type) == 'other' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Tipe event yang akan diselenggarakan</div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="status" class="form-label fw-bold">Status Event</label>
                                        <select class="form-select @error('status') is-invalid @enderror"
                                                id="status" name="status">
                                            <option value="upcoming" {{ old('status', $event->status) == 'upcoming' ? 'selected' : '' }}>Akan Datang</option>
                                            <option value="ongoing" {{ old('status', $event->status) == 'ongoing' ? 'selected' : '' }}>Sedang Berlangsung</option>
                                            <option value="completed" {{ old('status', $event->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                                            <option value="cancelled" {{ old('status', $event->status) == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Status event saat ini</div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="organizer" class="form-label fw-bold">Penyelenggara</label>
                                        <input type="text" class="form-control @error('organizer') is-invalid @enderror"
                                               id="organizer" name="organizer" value="{{ old('organizer', $event->organizer) }}"
                                               placeholder="Masukkan nama penyelenggara">
                                        @error('organizer')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Nama penyelenggara event</div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="capacity" class="form-label fw-bold">Kapasitas</label>
                                        <input type="number" class="form-control @error('capacity') is-invalid @enderror"
                                               id="capacity" name="capacity" value="{{ old('capacity', $event->capacity) }}"
                                               placeholder="Masukkan kapasitas peserta" min="1">
                                        @error('capacity')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Jumlah maksimal peserta</div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="price" class="form-label fw-bold">Harga Tiket</label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror"
                                               id="price" name="price" value="{{ old('price', $event->price) }}"
                                               placeholder="Masukkan harga tiket" min="0">
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Harga tiket event (0 untuk gratis)</div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Fitur</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured"
                                                   value="1" {{ old('is_featured', $event->is_featured) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_featured">
                                                Event Unggulan
                                            </label>
                                        </div>
                                        <div class="form-text">Event unggulan akan ditampilkan di halaman utama</div>
                                    </div>

                                    <div class="alert alert-info">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-info-circle me-2"></i>
                                            <div>
                                                <strong>Info:</strong> Event dibuat pada
                                                <strong>{{ $event->created_at->format('d M Y H:i') }}</strong>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert alert-warning">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            <div>
                                                <strong>Perhatian:</strong> Mengubah event dapat mempengaruhi tampilan di frontend
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
                            Update Event
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
document.getElementById('eventForm').addEventListener('submit', function(e) {
    const title = document.getElementById('title').value.trim();
    const description = document.getElementById('description').value.trim();
    const eventDate = document.getElementById('event_date').value;
    const location = document.getElementById('location').value.trim();

    if (!title) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Judul event wajib diisi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    if (!description) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Deskripsi event wajib diisi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    if (!eventDate) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Tanggal event wajib diisi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    if (!location) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Lokasi event wajib diisi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    // Show confirmation
    e.preventDefault();
    Swal.fire({
        title: 'Konfirmasi Update',
        text: 'Apakah Anda yakin ingin mengupdate event ini?',
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
                text: 'Mohon tunggu, event sedang diupdate',
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
            document.getElementById('location').value = '{{ $event->location }}';
            document.getElementById('start_time').value = '{{ $event->start_time }}';
            document.getElementById('end_time').value = '{{ $event->end_time }}';
            document.getElementById('type').value = '{{ $event->type }}';
            document.getElementById('status').value = '{{ $event->status }}';
            document.getElementById('organizer').value = '{{ $event->organizer }}';
            document.getElementById('capacity').value = '{{ $event->capacity }}';
            document.getElementById('price').value = '{{ $event->price }}';
            document.getElementById('additional_info').value = '{{ $event->additional_info }}';
            document.getElementById('is_featured').checked = {{ $event->is_featured ? 'true' : 'false' }};
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
