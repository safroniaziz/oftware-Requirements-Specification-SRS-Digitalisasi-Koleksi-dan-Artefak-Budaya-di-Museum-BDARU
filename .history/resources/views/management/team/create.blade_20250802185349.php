@extends('layouts.dashboard.dashboard')

@section('title', 'Tambah Tim Museum - BDARU Museum')

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
                    <h2 class="fw-bold">Tambah Tim Baru</h2>
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Back-->
                        <a href="{{ route('team-management.index') }}" class="btn btn-secondary me-2">
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
                <form action="{{ route('team-management.store') }}" method="POST" id="teamForm" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="name" class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" value="{{ old('name') }}"
                                               placeholder="Masukkan nama lengkap" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="position" class="form-label fw-bold">Jabatan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('position') is-invalid @enderror"
                                               id="position" name="position" value="{{ old('position') }}"
                                               placeholder="Masukkan jabatan" required>
                                        @error('position')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="email" class="form-label fw-bold">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               id="email" name="email" value="{{ old('email') }}"
                                               placeholder="Masukkan email">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="linkedin" class="form-label fw-bold">LinkedIn</label>
                                        <input type="url" class="form-control @error('linkedin') is-invalid @enderror"
                                               id="linkedin" name="linkedin" value="{{ old('linkedin') }}"
                                               placeholder="https://linkedin.com/in/username">
                                        @error('linkedin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="twitter" class="form-label fw-bold">Twitter</label>
                                <input type="url" class="form-control @error('twitter') is-invalid @enderror"
                                       id="twitter" name="twitter" value="{{ old('twitter') }}"
                                       placeholder="https://twitter.com/username">
                                @error('twitter')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="bio" class="form-label fw-bold">Biografi</label>
                                <textarea class="form-control @error('bio') is-invalid @enderror"
                                          id="bio" name="bio" rows="4"
                                          placeholder="Masukkan biografi singkat">{{ old('bio') }}</textarea>
                                @error('bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Deskripsi singkat tentang pengalaman dan keahlian</small>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="department" class="form-label fw-bold">Departemen</label>
                                        <input type="text" class="form-control @error('department') is-invalid @enderror"
                                               id="department" name="department" value="{{ old('department') }}"
                                               placeholder="Masukkan departemen">
                                        @error('department')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="join_date" class="form-label fw-bold">Tanggal Bergabung</label>
                                        <input type="date" class="form-control @error('join_date') is-invalid @enderror"
                                               id="join_date" name="join_date" value="{{ old('join_date') }}">
                                        @error('join_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="photo" class="form-label fw-bold">Foto</label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                       id="photo" name="photo" accept="image/*">
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>

                                <div id="photo-preview" class="mt-3">
                                    <div class="bg-light-primary rounded-3 d-flex align-items-center justify-content-center"
                                         style="width: 200px; height: 200px;">
                                        <i class="fas fa-user text-primary fs-2x"></i>
                                    </div>
                                    <div class="mt-2">
                                        <small class="text-muted">Preview foto akan muncul di sini</small>
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
                                        Tim Aktif
                                    </label>
                                </div>
                                <small class="text-muted">Tim aktif akan ditampilkan di frontend</small>
                            </div>

                            <div class="mb-6">
                                <label for="role" class="form-label fw-bold">Peran</label>
                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
                                    <option value="">Pilih peran</option>
                                    <option value="director" {{ old('role') == 'director' ? 'selected' : '' }}>Direktur</option>
                                    <option value="curator" {{ old('role') == 'curator' ? 'selected' : '' }}>Kurator</option>
                                    <option value="educator" {{ old('role') == 'educator' ? 'selected' : '' }}>Edukator</option>
                                    <option value="conservator" {{ old('role') == 'conservator' ? 'selected' : '' }}>Konservator</option>
                                    <option value="researcher" {{ old('role') == 'researcher' ? 'selected' : '' }}>Peneliti</option>
                                    <option value="administrator" {{ old('role') == 'administrator' ? 'selected' : '' }}>Administrator</option>
                                    <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                                    <option value="volunteer" {{ old('role') == 'volunteer' ? 'selected' : '' }}>Relawan</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="expertise" class="form-label fw-bold">Keahlian</label>
                                <textarea class="form-control @error('expertise') is-invalid @enderror"
                                          id="expertise" name="expertise" rows="3"
                                          placeholder="Keahlian khusus">{{ old('expertise') }}</textarea>
                                @error('expertise')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Keahlian atau spesialisasi</small>
                            </div>

                            <div class="mb-6">
                                <label for="education" class="form-label fw-bold">Pendidikan</label>
                                <textarea class="form-control @error('education') is-invalid @enderror"
                                          id="education" name="education" rows="3"
                                          placeholder="Riwayat pendidikan">{{ old('education') }}</textarea>
                                @error('education')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Gelar dan institusi pendidikan</small>
                            </div>

                            <div class="mb-6">
                                <label for="order" class="form-label fw-bold">Urutan Tampilan</label>
                                <input type="number" class="form-control @error('order') is-invalid @enderror"
                                       id="order" name="order" value="{{ old('order', 0) }}"
                                       min="0" placeholder="Urutan dalam daftar tim">
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Angka kecil akan ditampilkan lebih dulu</small>
                            </div>

                            <div class="mb-6">
                                <div class="alert alert-info">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <div>
                                            <strong>Info:</strong> Tim akan dibuat dengan pengaturan default
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
                            Simpan Tim
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
// Photo preview
document.getElementById('photo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('photo-preview');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <img id="preview-img" src="${e.target.result}" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                <div class="mt-2">
                    <small class="text-muted">Preview foto</small>
                </div>
            `;
        }
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = `
            <div class="bg-light-primary rounded-3 d-flex align-items-center justify-content-center"
                 style="width: 200px; height: 200px;">
                <i class="fas fa-user text-primary fs-2x"></i>
            </div>
            <div class="mt-2">
                <small class="text-muted">Preview foto akan muncul di sini</small>
            </div>
        `;
    }
});

// Form validation and submission
document.getElementById('teamForm').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    const position = document.getElementById('position').value.trim();

    if (!name || !position) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Nama dan jabatan wajib diisi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    // Show confirmation
    e.preventDefault();
    Swal.fire({
        title: 'Konfirmasi Simpan',
        text: 'Apakah Anda yakin ingin menyimpan anggota tim ini?',
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
                text: 'Mohon tunggu, tim sedang disimpan',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Submit form
            document.getElementById('teamForm').submit();
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
            document.getElementById('teamForm').reset();
            document.getElementById('is_active').checked = true;
            document.getElementById('order').value = '0';

            // Reset photo preview
            const photoPreview = document.getElementById('photo-preview');
            photoPreview.innerHTML = `
                <div class="bg-light-primary rounded-3 d-flex align-items-center justify-content-center"
                     style="width: 200px; height: 200px;">
                    <i class="fas fa-user text-primary fs-2x"></i>
                </div>
                <div class="mt-2">
                    <small class="text-muted">Preview foto akan muncul di sini</small>
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
