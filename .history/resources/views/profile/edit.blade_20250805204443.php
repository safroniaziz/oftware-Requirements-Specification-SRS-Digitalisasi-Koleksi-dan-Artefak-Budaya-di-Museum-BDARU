@extends('layouts.dashboard.dashboard')

@section('title', 'Edit Profile - BDARU Museum')

@section('content')
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.fs-8 {
    font-size: 0.75rem !important;
}

.gap-2 {
    gap: 0.5rem !important;
}

/* Modern Card Styling */
.card-hover:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.bg-light-primary {
    background-color: rgba(13, 110, 253, 0.1) !important;
}

.btn-icon {
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 0.5rem;
    transition: all 0.2s ease;
}

.btn-icon:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
</style>

<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Card-->
        <div class="card card-hover">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2 class="fw-bold">Edit Profile</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body py-4">
                <!--begin::Form-->
                <form id="profileForm" method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="row">
                        <!--begin::Main Content-->
                        <div class="col-lg-8">
                            <!--begin::Profile Information-->
                            <div class="card mb-6">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-user me-2 text-primary"></i>
                                        Informasi Profile
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                   id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                   id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <label for="profession" class="form-label fw-bold">Profesi</label>
                                            <input type="text" class="form-control @error('profession') is-invalid @enderror"
                                                   id="profession" name="profession" value="{{ old('profession', $user->profession ?? '') }}">
                                            @error('profession')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone" class="form-label fw-bold">Nomor Telepon</label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                   id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="alert alert-info">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-info-circle me-2"></i>
                                            <div>
                                                <strong>Info:</strong> Jika Anda mengubah email, Anda perlu memverifikasi email baru
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Profile Information-->

                            <!--begin::Password Update-->
                            <div class="card mb-6">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-lock me-2 text-primary"></i>
                                        Update Password
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <label for="current_password" class="form-label fw-bold">Password Saat Ini</label>
                                            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                                   id="current_password" name="current_password">
                                            @error('current_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="password" class="form-label fw-bold">Password Baru</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                   id="password" name="password">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <label for="password_confirmation" class="form-label fw-bold">Konfirmasi Password Baru</label>
                                            <input type="password" class="form-control"
                                                   id="password_confirmation" name="password_confirmation">
                                        </div>
                                    </div>

                                    <div class="alert alert-warning">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            <div>
                                                <strong>Peringatan:</strong> Kosongkan field password jika tidak ingin mengubah password
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Password Update-->
                        </div>
                        <!--end::Main Content-->

                        <!--begin::Sidebar-->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Informasi Akun</h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Role</label>
                                        <div class="d-flex align-items-center">
                                            @if($user->hasRole('admin'))
                                                <span class="badge badge-light-danger fw-bold px-3 py-2">
                                                    <i class="fas fa-crown me-1"></i>Admin
                                                </span>
                                            @elseif($user->hasRole('pengelola'))
                                                <span class="badge badge-light-warning fw-bold px-3 py-2">
                                                    <i class="fas fa-user-tie me-1"></i>Pengelola
                                                </span>
                                            @elseif($user->hasRole('user'))
                                                <span class="badge badge-light-primary fw-bold px-3 py-2">
                                                    <i class="fas fa-user me-1"></i>User
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Status Email</label>
                                        <div class="d-flex align-items-center">
                                            @if($user->email_verified_at)
                                                <span class="badge badge-success fw-bold px-3 py-2">
                                                    <i class="fas fa-check-circle me-1"></i>Terverifikasi
                                                </span>
                                            @else
                                                <span class="badge badge-warning fw-bold px-3 py-2">
                                                    <i class="fas fa-clock me-1"></i>Belum Terverifikasi
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Bergabung Sejak</label>
                                        <div class="text-muted">
                                            {{ $user->created_at->format('d M Y H:i') }}
                                        </div>
                                    </div>

                                    <div class="alert alert-info">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-info-circle me-2"></i>
                                            <div>
                                                <strong>Info:</strong> Role dan status email tidak dapat diubah dari halaman ini
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
                            Update Profile
                        </button>
                    </div>
                    <!--end::Form Actions-->
                </form>
                <!--end::Form-->
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
document.getElementById('profileForm').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const currentPassword = document.getElementById('current_password').value;
    const newPassword = document.getElementById('password').value;
    const passwordConfirmation = document.getElementById('password_confirmation').value;

    if (!name) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Nama wajib diisi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    if (!email) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Email wajib diisi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    // Check if password is being changed
    if (newPassword || currentPassword || passwordConfirmation) {
        if (!currentPassword) {
            e.preventDefault();
            Swal.fire({
                title: 'Error!',
                text: 'Password saat ini wajib diisi jika ingin mengubah password',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!newPassword) {
            e.preventDefault();
            Swal.fire({
                title: 'Error!',
                text: 'Password baru wajib diisi',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (newPassword !== passwordConfirmation) {
            e.preventDefault();
            Swal.fire({
                title: 'Error!',
                text: 'Password baru dan konfirmasi password tidak sama',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }
    }

    // Show confirmation
    e.preventDefault();
    Swal.fire({
        title: 'Konfirmasi Update',
        text: 'Apakah Anda yakin ingin mengupdate profile ini?',
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
                text: 'Mohon tunggu, profile sedang diupdate',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Submit form
            document.getElementById('profileForm').submit();
        }
    });
});

function resetForm() {
    Swal.fire({
        title: 'Konfirmasi Reset',
        text: 'Apakah Anda yakin ingin mereset form?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Reset!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Reset form fields
            document.getElementById('name').value = '{{ $user->name }}';
            document.getElementById('email').value = '{{ $user->email }}';
            document.getElementById('profession').value = '{{ $user->profession ?? '' }}';
            document.getElementById('phone').value = '{{ $user->phone ?? '' }}';
            document.getElementById('current_password').value = '';
            document.getElementById('password').value = '';
            document.getElementById('password_confirmation').value = '';

            Swal.fire({
                title: 'Berhasil!',
                text: 'Form telah direset',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        }
    });
}

// Show success message if exists
@if(session('success'))
    Swal.fire({
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        icon: 'success',
        confirmButtonText: 'OK'
    });
@endif
</script>
@endsection
