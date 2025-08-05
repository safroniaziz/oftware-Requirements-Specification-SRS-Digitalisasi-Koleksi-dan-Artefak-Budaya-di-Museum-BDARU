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
                <form action="{{ route('users-management.update', $user->id) }}" method="POST" id="userForm">
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
                                        <label for="email" class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               id="email" name="email" value="{{ old('email', $user->email) }}"
                                               placeholder="Masukkan email" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="username" class="form-label fw-bold">Username</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                               id="username" name="username" value="{{ old('username', $user->username) }}"
                                               placeholder="Masukkan username">
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Username untuk login (opsional)</small>
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

                            <div class="mb-6">
                                <label for="address" class="form-label fw-bold">Alamat</label>
                                <textarea class="form-control @error('address') is-invalid @enderror"
                                          id="address" name="address" rows="3"
                                          placeholder="Masukkan alamat lengkap">{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="city" class="form-label fw-bold">Kota</label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror"
                                               id="city" name="city" value="{{ old('city', $user->city) }}"
                                               placeholder="Masukkan kota">
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="postal_code" class="form-label fw-bold">Kode Pos</label>
                                        <input type="text" class="form-control @error('postal_code') is-invalid @enderror"
                                               id="postal_code" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}"
                                               placeholder="Masukkan kode pos">
                                        @error('postal_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="password" class="form-label fw-bold">Password Baru</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                               id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Minimal 8 karakter</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="password_confirmation" class="form-label fw-bold">Konfirmasi Password</label>
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                               id="password_confirmation" name="password_confirmation"
                                               placeholder="Konfirmasi password baru">
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
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
                                <label for="role" class="form-label fw-bold">Role</label>
                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
                                    <option value="">Pilih role</option>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                                    <option value="manager" {{ old('role', $user->role) == 'manager' ? 'selected' : '' }}>Manager</option>
                                    <option value="staff" {{ old('role', $user->role) == 'staff' ? 'selected' : '' }}>Staff</option>
                                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="department" class="form-label fw-bold">Departemen</label>
                                <input type="text" class="form-control @error('department') is-invalid @enderror"
                                       id="department" name="department" value="{{ old('department', $user->department) }}"
                                       placeholder="Masukkan departemen">
                                @error('department')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="position" class="form-label fw-bold">Jabatan</label>
                                <input type="text" class="form-control @error('position') is-invalid @enderror"
                                       id="position" name="position" value="{{ old('position', $user->position) }}"
                                       placeholder="Masukkan jabatan">
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="birth_date" class="form-label fw-bold">Tanggal Lahir</label>
                                <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
                                       id="birth_date" name="birth_date" value="{{ old('birth_date', $user->birth_date) }}">
                                @error('birth_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="gender" class="form-label fw-bold">Jenis Kelamin</label>
                                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender">
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <div class="alert alert-info">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <div>
                                            <strong>Info:</strong> User terdaftar pada
                                            <strong>{{ $user->created_at->format('d M Y H:i') }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <div>
                                            <strong>Perhatian:</strong> Mengubah role dapat mempengaruhi akses user
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
// Password confirmation validation
document.getElementById('password_confirmation').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirmation = this.value;

    if (password && confirmation && password !== confirmation) {
        this.setCustomValidity('Password tidak cocok');
    } else {
        this.setCustomValidity('');
    }
});

document.getElementById('password').addEventListener('input', function() {
    const confirmation = document.getElementById('password_confirmation');
    if (confirmation.value) {
        confirmation.dispatchEvent(new Event('input'));
    }
});

// Form validation
document.getElementById('userForm').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const confirmation = document.getElementById('password_confirmation').value;

    if (!name || !email) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Nama dan email wajib diisi',
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

    if (password && password !== confirmation) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Konfirmasi password tidak cocok',
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
            document.getElementById('email').value = '{{ $user->email }}';
            document.getElementById('username').value = '{{ $user->username }}';
            document.getElementById('phone').value = '{{ $user->phone }}';
            document.getElementById('address').value = '{{ $user->address }}';
            document.getElementById('city').value = '{{ $user->city }}';
            document.getElementById('postal_code').value = '{{ $user->postal_code }}';
            document.getElementById('role').value = '{{ $user->role }}';
            document.getElementById('department').value = '{{ $user->department }}';
            document.getElementById('position').value = '{{ $user->position }}';
            document.getElementById('birth_date').value = '{{ $user->birth_date }}';
            document.getElementById('gender').value = '{{ $user->gender }}';
            document.getElementById('is_active').checked = {{ !$user->deleted_at ? 'true' : 'false' }};

            // Clear password fields
            document.getElementById('password').value = '';
            document.getElementById('password_confirmation').value = '';
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
