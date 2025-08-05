@extends('layouts.dashboard.dashboard')

@section('title', 'Edit Role - BDARU Museum')

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
                    <h2 class="fw-bold">Edit Role: {{ $role->name }}</h2>
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Back-->
                        <a href="{{ route('roles-management.index') }}" class="btn btn-secondary me-2">
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
                <form action="{{ route('roles-management.update', $role->id) }}" method="POST" id="roleForm">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-6">
                                <label for="name" class="form-label fw-bold">Nama Role <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name', $role->name) }}"
                                       placeholder="Masukkan nama role" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Nama role yang akan digunakan (contoh: admin, manager, user)</small>
                            </div>

                            <div class="mb-6">
                                <label for="display_name" class="form-label fw-bold">Nama Tampilan</label>
                                <input type="text" class="form-control @error('display_name') is-invalid @enderror"
                                       id="display_name" name="display_name" value="{{ old('display_name', $role->display_name) }}"
                                       placeholder="Masukkan nama tampilan">
                                @error('display_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Nama yang akan ditampilkan di interface (contoh: Administrator, Manager, User)</small>
                            </div>

                            <div class="mb-6">
                                <label for="description" class="form-label fw-bold">Deskripsi</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description" name="description" rows="4"
                                          placeholder="Masukkan deskripsi role">{{ old('description', $role->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Deskripsi singkat tentang role ini</small>
                            </div>

                            <div class="mb-6">
                                <label for="guard_name" class="form-label fw-bold">Guard <span class="text-danger">*</span></label>
                                <select class="form-select @error('guard_name') is-invalid @enderror" id="guard_name" name="guard_name" required>
                                    <option value="web" {{ old('guard_name', $role->guard_name) == 'web' ? 'selected' : '' }}>Web</option>
                                    <option value="api" {{ old('guard_name', $role->guard_name) == 'api' ? 'selected' : '' }}>API</option>
                                </select>
                                @error('guard_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Guard yang digunakan untuk role ini</small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-6">
                                <label class="form-label fw-bold">Permissions</label>
                                <div class="border rounded p-3" style="max-height: 400px; overflow-y: auto;">
                                    @foreach($permissions ?? [] as $permission)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox"
                                               id="permission_{{ $permission->id }}"
                                               name="permissions[]"
                                               value="{{ $permission->id }}"
                                               {{ in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray())) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="permission_{{ $permission->id }}">
                                            <strong>{{ $permission->name }}</strong>
                                            @if($permission->description)
                                                <br><small class="text-muted">{{ $permission->description }}</small>
                                            @endif
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <small class="text-muted">Pilih permissions yang akan diberikan ke role ini</small>
                            </div>

                            <div class="mb-6">
                                <div class="alert alert-info">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <div>
                                            <strong>Info:</strong> Role ini memiliki
                                            <strong>{{ $role->users_count ?? 0 }} users</strong> dan
                                            <strong>{{ $role->permissions_count ?? 0 }} permissions</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <div>
                                            <strong>Peringatan:</strong> Mengubah permissions role dapat mempengaruhi akses user yang menggunakan role ini.
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
                            Update Role
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
// Auto-generate display name from name
document.getElementById('name').addEventListener('input', function() {
    const name = this.value;
    const displayName = name.charAt(0).toUpperCase() + name.slice(1);
    document.getElementById('display_name').value = displayName;
});

// Form validation
document.getElementById('roleForm').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    const guardName = document.getElementById('guard_name').value;

    if (!name) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Nama role harus diisi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    if (!guardName) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Guard harus dipilih',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    // Show loading
    Swal.fire({
        title: 'Mengupdate...',
        text: 'Mohon tunggu, role sedang diupdate',
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
            document.getElementById('name').value = '{{ $role->name }}';
            document.getElementById('display_name').value = '{{ $role->display_name }}';
            document.getElementById('description').value = '{{ $role->description }}';
            document.getElementById('guard_name').value = '{{ $role->guard_name }}';

            // Reset permissions
            const permissionsSelect = document.querySelectorAll('input[name="permissions[]"]');
            const originalPermissions = {{ $role->permissions->pluck('id')->toArray() }};

            permissionsSelect.forEach(checkbox => {
                checkbox.checked = originalPermissions.includes(parseInt(checkbox.value));
            });
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
