@extends('layouts.dashboard.dashboard')

@section('title', 'Edit Anggota Tim - BDARU Museum')

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
                    <h2 class="fw-bold">Edit Anggota Tim</h2>
                </div>
                <!--end::Card title-->

                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <a href="{{ route('team-members-management.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali ke Daftar
                    </a>
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body py-4">
                <form action="{{ route('team-members-management.update', $teamMember->id) }}" method="POST" enctype="multipart/form-data" id="teamForm">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!--begin::Left Column-->
                        <div class="col-lg-8">
                            <!--begin::Name-->
                            <div class="mb-6">
                                <label for="name" class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control form-control-lg @error('name') is-invalid @enderror"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', $teamMember->name) }}"
                                       placeholder="Masukkan nama lengkap"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Name-->

                            <!--begin::Position-->
                            <div class="mb-6">
                                <label for="position" class="form-label fw-bold">Posisi/Jabatan <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('position') is-invalid @enderror"
                                       id="position"
                                       name="position"
                                       value="{{ old('position', $teamMember->position) }}"
                                       placeholder="Contoh: Kurator, Direktur, Staff, dll"
                                       required>
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Position-->

                            <!--begin::Bio-->
                            <div class="mb-6">
                                <label for="bio" class="form-label fw-bold">Biografi</label>
                                <textarea class="form-control @error('bio') is-invalid @enderror"
                                          id="bio"
                                          name="bio"
                                          rows="6"
                                          placeholder="Tulis biografi singkat tentang anggota tim"
                                          >{{ old('bio', $teamMember->bio) }}</textarea>
                                @error('bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Bio-->

                            <!--begin::Contact Info-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="email" class="form-label fw-bold">Email</label>
                                        <input type="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               id="email"
                                               name="email"
                                               value="{{ old('email', $teamMember->email) }}"
                                               placeholder="email@example.com">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="phone" class="form-label fw-bold">Nomor Telepon</label>
                                        <input type="text"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               id="phone"
                                               name="phone"
                                               value="{{ old('phone', $teamMember->phone) }}"
                                               placeholder="+62 812-3456-7890">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!--end::Contact Info-->

                            <!--begin::Social Media-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="linkedin" class="form-label fw-bold">LinkedIn</label>
                                        <input type="url"
                                               class="form-control @error('linkedin') is-invalid @enderror"
                                               id="linkedin"
                                               name="linkedin"
                                               value="{{ old('linkedin', $teamMember->linkedin) }}"
                                               placeholder="https://linkedin.com/in/username">
                                        @error('linkedin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="twitter" class="form-label fw-bold">Twitter</label>
                                        <input type="url"
                                               class="form-control @error('twitter') is-invalid @enderror"
                                               id="twitter"
                                               name="twitter"
                                               value="{{ old('twitter', $teamMember->twitter) }}"
                                               placeholder="https://twitter.com/username">
                                        @error('twitter')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!--end::Social Media-->
                        </div>
                        <!--end::Left Column-->

                        <!--begin::Right Column-->
                        <div class="col-lg-4">
                            <!--begin::Photo Upload-->
                            <div class="mb-6">
                                <label class="form-label fw-bold">Foto Profil</label>
                                <div class="upload-zone border-2 border-dashed border-gray-300 rounded-lg p-6 text-center"
                                     id="uploadZone"
                                     onclick="document.getElementById('photo').click()"
                                     style="{{ $teamMember->photo_path ? 'display: none;' : '' }}">
                                    <i class="fas fa-cloud-upload-alt fs-2x text-muted mb-3"></i>
                                    <h6 class="text-muted mb-2">Klik untuk upload foto</h6>
                                    <p class="text-muted fs-7 mb-3">atau drag & drop file di sini</p>
                                    <p class="text-muted fs-8">Format: JPG, PNG, GIF (Max: 2MB)</p>
                                    <p class="text-muted fs-8">Ukuran optimal: 400×400px</p>
                                </div>
                                <input type="file"
                                       id="photo"
                                       name="photo"
                                       accept="image/*"
                                       class="d-none"
                                       onchange="previewImage(this)">
                                @error('photo')
                                    <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Photo Upload-->

                            <!--begin::Photo Preview-->
                            <div id="imagePreview" class="mb-6" style="{{ $teamMember->photo_path ? 'display: block;' : 'display: none;' }}">
                                <div class="position-relative">
                                    <img id="previewImg"
                                         class="w-100 rounded-lg"
                                         alt="Preview"
                                         src="{{ $teamMember->photo_path ? asset('storage/' . $teamMember->photo_path) : '' }}">
                                    <button type="button"
                                            class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2"
                                            onclick="removeImage()">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                @if($teamMember->photo_path)
                                <div class="text-center mt-2">
                                    <small class="text-muted">Foto saat ini</small>
                                </div>
                                @endif
                            </div>
                            <!--end::Photo Preview-->

                            <!--begin::Status-->
                            <div class="mb-6">
                                <label class="form-label fw-bold">Status</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           id="is_active"
                                           name="is_active"
                                           value="1"
                                           {{ old('is_active', $teamMember->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Aktif
                                    </label>
                                </div>
                                <small class="text-muted">Anggota tim aktif akan ditampilkan di halaman publik</small>
                            </div>
                            <!--end::Status-->

                            <!--begin::Sort Order-->
                            <div class="mb-6">
                                <label for="sort_order" class="form-label fw-bold">Urutan Tampilan</label>
                                <input type="number"
                                       class="form-control @error('sort_order') is-invalid @enderror"
                                       id="sort_order"
                                       name="sort_order"
                                       value="{{ old('sort_order', $teamMember->sort_order ?? 0) }}"
                                       min="0"
                                       placeholder="0">
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Angka lebih kecil akan ditampilkan lebih dulu</small>
                            </div>
                            <!--end::Sort Order-->

                            <!--begin::Submit Buttons-->
                            <div class="d-grid gap-3">
                                <button type="button" class="btn btn-primary btn-lg" onclick="confirmSubmit()">
                                    <i class="fas fa-save me-2"></i>
                                    Update Anggota Tim
                                </button>
                                <a href="{{ route('team-members-management.index') }}" class="btn btn-outline-secondary">
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
    document.getElementById('photo').value = '';
    document.getElementById('imagePreview').style.display = 'none';
    document.getElementById('uploadZone').style.display = 'block';
}

// Drag and drop functionality
document.addEventListener('DOMContentLoaded', function() {
    const uploadZone = document.getElementById('uploadZone');
    const photoInput = document.getElementById('photo');

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
            photoInput.files = files;
            previewImage(photoInput);
        }
    });
});

// Form submission confirmation
function confirmSubmit() {
    const name = document.getElementById('name').value.trim();
    const position = document.getElementById('position').value.trim();

    if (!name) {
        Swal.fire('Error', 'Nama lengkap harus diisi', 'error');
        return;
    }

    if (!position) {
        Swal.fire('Error', 'Posisi/jabatan harus diisi', 'error');
        return;
    }

    Swal.fire({
        title: 'Konfirmasi Update',
        text: 'Apakah Anda yakin ingin mengupdate anggota tim ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Update!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('teamForm').submit();
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
