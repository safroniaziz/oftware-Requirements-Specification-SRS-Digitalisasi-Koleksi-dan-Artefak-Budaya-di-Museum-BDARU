@extends('layouts.dashboard.dashboard')

@section('title', 'Edit User - BDARU Museum')

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
                    <h2 class="fw-bold">Edit User: {{ $user->name }}</h2>
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Back-->
                        <a href="{{ route('users-management.index') }}" class="btn btn-secondary me-2">
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
                <form action="{{ route('users-management.update', $user->id) }}" method="POST" id="userForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="name" class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" value="{{ old('name', $user->name) }}"
                                               placeholder="Masukkan nama lengkap" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="username" class="form-label fw-bold">Username <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                               id="username" name="username" value="{{ old('username', $user->username) }}"
                                               placeholder="Masukkan username" required>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="email" class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               id="email" name="email" value="{{ old('email', $user->email) }}"
                                               placeholder="Masukkan email" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="phone" class="form-label fw-bold">Telepon</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                               id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                                               placeholder="Masukkan nomor telepon">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="password" class="form-label fw-bold">Password Baru</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                   id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">
                                                <i class="fas fa-eye" id="password-icon"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="password_confirmation" class="form-label fw-bold">Konfirmasi Password Baru</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                                   id="password_confirmation" name="password_confirmation"
                                                   placeholder="Konfirmasi password baru">
                                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation')">
                                                <i class="fas fa-eye" id="password_confirmation-icon"></i>
                                            </button>
                                        </div>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="bio" class="form-label fw-bold">Bio</label>
                                <textarea class="form-control @error('bio') is-invalid @enderror"
                                          id="bio" name="bio" rows="3"
                                          placeholder="Masukkan bio singkat">{{ old('bio', $user->bio) }}</textarea>
                                @error('bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-6">
                                <label for="roles" class="form-label fw-bold">Role <span class="text-danger">*</span></label>
                                <select class="form-select @error('roles') is-invalid @enderror" id="roles" name="roles[]" multiple required>
                                    @foreach($roles ?? [] as $role)
                                        <option value="{{ $role->id }}"
                                                {{ in_array($role->id, old('roles', $user->roles->pluck('id')->toArray())) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('roles')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Pilih satu atau lebih role</small>
                            </div>

                            <div class="mb-6">
                                <label class="form-label fw-bold">Status</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                           value="1" {{ old('is_active', !$user->deleted_at) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        User Aktif
                                    </label>
                                </div>
                                <small class="text-muted">User aktif dapat login ke sistem</small>
                            </div>

                            <div class="mb-6">
                                <label class="form-label fw-bold">Verifikasi Email</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="email_verified" name="email_verified"
                                           value="1" {{ old('email_verified', $user->email_verified_at) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="email_verified">
                                        Email Terverifikasi
                                    </label>
                                </div>
                                <small class="text-muted">Centang jika email sudah terverifikasi</small>
                            </div>

                            <div class="mb-6">
                                <label for="photo" class="form-label fw-bold">Foto Profil</label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                       id="photo" name="photo" accept="image/*">
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>

                                <div id="photo-preview" class="mt-3">
                                    @if($user->profile_photo_url)
                                        <img id="preview-img" src="{{ $user->profile_photo_url }}" alt="Current Photo" class="img-thumbnail" style="max-width: 150px;">
                                        <div class="mt-2">
                                            <small class="text-muted">Foto saat ini</small>
                                        </div>
                                    @else
                                        <div class="bg-light-primary rounded-3 d-flex align-items-center justify-content-center"
                                             style="width: 150px; height: 150px;">
                                            <i class="fas fa-user text-primary fs-2x"></i>
                                        </div>
                                        <div class="mt-2">
                                            <small class="text-muted">Tidak ada foto</small>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-6">
                                <div class="alert alert-info">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <div>
                                            <strong>Info:</strong> Bergabung sejak
                                            <strong>{{ $user->created_at->format('d M Y') }}</strong>
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
                            Update User
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
// Toggle password visibility
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '-icon');

    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Photo preview
document.getElementById('photo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('photo-preview');
    const previewImg = document.getElementById('preview-img');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.innerHTML = `
                <img id="preview-img" src="${e.target.result}" alt="Preview" class="img-thumbnail" style="max-width: 150px;">
                <div class="mt-2">
                    <small class="text-muted">Preview foto baru</small>
                </div>
            `;
        }
        reader.readAsDataURL(file);
    }
});

// Form validation
document.getElementById('userForm').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    const username = document.getElementById('username').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const passwordConfirmation = document.getElementById('password_confirmation').value;
    const roles = document.getElementById('roles').selectedOptions;

    if (!name || !username || !email) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Nama, username, dan email wajib diisi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    if (password && password !== passwordConfirmation) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Password dan konfirmasi password tidak cocok',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    if (password && password.length < 8) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Password minimal 8 karakter',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    if (roles.length === 0) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Pilih minimal satu role',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    // Show loading
    Swal.fire({
        title: 'Mengupdate...',
        text: 'Mohon tunggu, user sedang diupdate',
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
            document.getElementById('name').value = '{{ $user->name }}';
            document.getElementById('username').value = '{{ $user->username }}';
            document.getElementById('email').value = '{{ $user->email }}';
            document.getElementById('phone').value = '{{ $user->phone }}';
            document.getElementById('bio').value = '{{ $user->bio }}';
            document.getElementById('password').value = '';
            document.getElementById('password_confirmation').value = '';
            document.getElementById('is_active').checked = {{ !$user->deleted_at ? 'true' : 'false' }};
            document.getElementById('email_verified').checked = {{ $user->email_verified_at ? 'true' : 'false' }};

            // Reset roles
            const rolesSelect = document.getElementById('roles');
            for (let option of rolesSelect.options) {
                option.selected = {{ $user->roles->pluck('id')->toArray() }}.includes(parseInt(option.value));
            }

            // Reset photo preview
            const photoPreview = document.getElementById('photo-preview');
            @if($user->profile_photo_url)
                photoPreview.innerHTML = `
                    <img id="preview-img" src="{{ $user->profile_photo_url }}" alt="Current Photo" class="img-thumbnail" style="max-width: 150px;">
                    <div class="mt-2">
                        <small class="text-muted">Foto saat ini</small>
                    </div>
                `;
            @else
                photoPreview.innerHTML = `
                    <div class="bg-light-primary rounded-3 d-flex align-items-center justify-content-center"
                         style="width: 150px; height: 150px;">
                        <i class="fas fa-user text-primary fs-2x"></i>
                    </div>
                    <div class="mt-2">
                        <small class="text-muted">Tidak ada foto</small>
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
