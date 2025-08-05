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
                                <small class="text-muted">Nama permission yang akan digunakan (contoh: create-users, edit-roles)</small>
                            </div>

                            <div class="mb-6">
                                <label for="display_name" class="form-label fw-bold">Nama Tampilan</label>
                                <input type="text" class="form-control @error('display_name') is-invalid @enderror"
                                       id="display_name" name="display_name" value="{{ old('display_name', $permission->display_name) }}"
                                       placeholder="Masukkan nama tampilan">
                                @error('display_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Nama yang akan ditampilkan di interface (contoh: Create Users, Edit Roles)</small>
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
                                <label for="guard_name" class="form-label fw-bold">Guard <span class="text-danger">*</span></label>
                                <select class="form-select @error('guard_name') is-invalid @enderror" id="guard_name" name="guard_name" required>
                                    <option value="web" {{ old('guard_name', $permission->guard_name) == 'web' ? 'selected' : '' }}>Web</option>
                                    <option value="api" {{ old('guard_name', $permission->guard_name) == 'api' ? 'selected' : '' }}>API</option>
                                </select>
                                @error('guard_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Guard yang digunakan untuk permission ini</small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-6">
                                <div class="alert alert-info">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <div>
                                            <strong>Info:</strong> Permission ini digunakan oleh
                                            <strong>{{ $permission->roles_count ?? 0 }} roles</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <div>
                                            <strong>Peringatan:</strong> Mengubah nama permission dapat mempengaruhi kode yang menggunakan permission ini.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <div class="alert alert-success">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-check-circle me-2"></i>
                                        <div>
                                            <strong>Tips:</strong> Permission biasanya mengikuti pola <code>action-resource</code> untuk konsistensi.
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
// Auto-generate display name from name
document.getElementById('name').addEventListener('input', function() {
    const name = this.value;
    const displayName = name.split('-')
        .map(word => word.charAt(0).toUpperCase() + word.slice(1))
        .join(' ');
    document.getElementById('display_name').value = displayName;
});

// Form validation
document.getElementById('permissionForm').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    const guardName = document.getElementById('guard_name').value;

    if (!name) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Nama permission harus diisi',
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
