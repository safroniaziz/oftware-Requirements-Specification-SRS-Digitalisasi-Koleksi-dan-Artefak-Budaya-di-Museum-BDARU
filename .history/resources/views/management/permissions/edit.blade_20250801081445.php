@extends('layouts.dashboard.dashboard')

@section('title', 'Edit Permission - BDARU Museum')

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
                    <h2 class="fw-bold">Edit Permission: {{ $permission->name }}</h2>
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Back-->
                        <a href="{{ route('permissions-management.index') }}" class="btn btn-secondary me-2">
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
                <form action="{{ route('permissions-management.update', $permission->id) }}" method="POST" id="permissionForm">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-6">
                                <label for="name" class="form-label fw-bold">Nama Permission <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name', $permission->name) }}"
                                       placeholder="Masukkan nama permission" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Format: resource.action (contoh: users.create, collections.edit)</small>
                            </div>

                            <div class="mb-6">
                                <label for="display_name" class="form-label fw-bold">Nama Tampilan</label>
                                <input type="text" class="form-control @error('display_name') is-invalid @enderror"
                                       id="display_name" name="display_name" value="{{ old('display_name', $permission->display_name) }}"
                                       placeholder="Masukkan nama tampilan permission">
                                @error('display_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Nama yang ditampilkan di interface (opsional)</small>
                            </div>

                            <div class="mb-6">
                                <label for="description" class="form-label fw-bold">Deskripsi</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description" name="description" rows="4"
                                          placeholder="Masukkan deskripsi permission">{{ old('description', $permission->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Deskripsi singkat tentang permission ini</small>
                            </div>

                            <div class="mb-6">
                                <label for="guard_name" class="form-label fw-bold">Guard Name</label>
                                <select class="form-select @error('guard_name') is-invalid @enderror" id="guard_name" name="guard_name">
                                    <option value="web" {{ old('guard_name', $permission->guard_name) == 'web' ? 'selected' : '' }}>Web</option>
                                    <option value="api" {{ old('guard_name', $permission->guard_name) == 'api' ? 'selected' : '' }}>API</option>
                                </select>
                                @error('guard_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Guard yang digunakan untuk permission ini</small>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="module" class="form-label fw-bold">Module</label>
                                        <input type="text" class="form-control @error('module') is-invalid @enderror"
                                               id="module" name="module" value="{{ old('module', $permission->module) }}"
                                               placeholder="Masukkan nama module">
                                        @error('module')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Module yang terkait dengan permission ini</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="action" class="form-label fw-bold">Action</label>
                                        <select class="form-select @error('action') is-invalid @enderror" id="action" name="action">
                                            <option value="">Pilih action</option>
                                            <option value="view" {{ old('action', $permission->action) == 'view' ? 'selected' : '' }}>View</option>
                                            <option value="create" {{ old('action', $permission->action) == 'create' ? 'selected' : '' }}>Create</option>
                                            <option value="edit" {{ old('action', $permission->action) == 'edit' ? 'selected' : '' }}>Edit</option>
                                            <option value="delete" {{ old('action', $permission->action) == 'delete' ? 'selected' : '' }}>Delete</option>
                                            <option value="export" {{ old('action', $permission->action) == 'export' ? 'selected' : '' }}>Export</option>
                                            <option value="import" {{ old('action', $permission->action) == 'import' ? 'selected' : '' }}>Import</option>
                                            <option value="approve" {{ old('action', $permission->action) == 'approve' ? 'selected' : '' }}>Approve</option>
                                            <option value="reject" {{ old('action', $permission->action) == 'reject' ? 'selected' : '' }}>Reject</option>
                                            <option value="manage" {{ old('action', $permission->action) == 'manage' ? 'selected' : '' }}>Manage</option>
                                        </select>
                                        @error('action')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Action yang diizinkan</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-6">
                                <label class="form-label fw-bold">Status</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                           value="1" {{ old('is_active', !$permission->deleted_at) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Permission Aktif
                                    </label>
                                </div>
                                <small class="text-muted">Permission aktif dapat digunakan</small>
                            </div>

                            <div class="mb-6">
                                <label for="priority" class="form-label fw-bold">Prioritas</label>
                                <input type="number" class="form-control @error('priority') is-invalid @enderror"
                                       id="priority" name="priority" value="{{ old('priority', $permission->priority ?? 1) }}"
                                       min="1" max="10" placeholder="Prioritas permission">
                                @error('priority')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Prioritas permission (1-10)</small>
                            </div>

                            <div class="mb-6">
                                <label for="category" class="form-label fw-bold">Kategori</label>
                                <select class="form-select @error('category') is-invalid @enderror" id="category" name="category">
                                    <option value="">Pilih kategori</option>
                                    <option value="user_management" {{ old('category', $permission->category) == 'user_management' ? 'selected' : '' }}>User Management</option>
                                    <option value="role_management" {{ old('category', $permission->category) == 'role_management' ? 'selected' : '' }}>Role Management</option>
                                    <option value="permission_management" {{ old('category', $permission->category) == 'permission_management' ? 'selected' : '' }}>Permission Management</option>
                                    <option value="content_management" {{ old('category', $permission->category) == 'content_management' ? 'selected' : '' }}>Content Management</option>
                                    <option value="system_management" {{ old('category', $permission->category) == 'system_management' ? 'selected' : '' }}>System Management</option>
                                    <option value="reporting" {{ old('category', $permission->category) == 'reporting' ? 'selected' : '' }}>Reporting</option>
                                    <option value="settings" {{ old('category', $permission->category) == 'settings' ? 'selected' : '' }}>Settings</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Kategori permission untuk pengelompokan</small>
                            </div>

                            <div class="mb-6">
                                <div class="alert alert-info">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <div>
                                            <strong>Info:</strong> Permission dibuat pada
                                            <strong>{{ $permission->created_at->format('d M Y H:i') }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <div>
                                            <strong>Perhatian:</strong> Mengubah permission dapat mempengaruhi akses role
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
                            Update Permission
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
// Auto-generate name from module and action
document.getElementById('module').addEventListener('input', updatePermissionName);
document.getElementById('action').addEventListener('change', updatePermissionName);

function updatePermissionName() {
    const module = document.getElementById('module').value.trim();
    const action = document.getElementById('action').value;

    if (module && action) {
        const name = module.toLowerCase() + '.' + action.toLowerCase();
        document.getElementById('name').value = name;
    }
}

// Form validation
document.getElementById('permissionForm').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();

    if (!name) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Nama permission wajib diisi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    // Show loading
    Swal.fire({
        title: 'Mengupdate...',
        text: 'Mohon tunggu, permission sedang diupdate',
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
            document.getElementById('name').value = '{{ $permission->name }}';
            document.getElementById('display_name').value = '{{ $permission->display_name }}';
            document.getElementById('description').value = '{{ $permission->description }}';
            document.getElementById('guard_name').value = '{{ $permission->guard_name }}';
            document.getElementById('module').value = '{{ $permission->module }}';
            document.getElementById('action').value = '{{ $permission->action }}';
            document.getElementById('priority').value = '{{ $permission->priority ?? 1 }}';
            document.getElementById('category').value = '{{ $permission->category }}';
            document.getElementById('is_active').checked = {{ !$permission->deleted_at ? 'true' : 'false' }};
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
