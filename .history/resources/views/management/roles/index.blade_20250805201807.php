@extends('layouts.dashboard.dashboard')

@section('title', 'Manajemen Roles - BDARU Museum')

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

/* Modern Table Styling */
.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.05) !important;
    transform: scale(1.01);
    transition: all 0.2s ease;
}

.table-row-bordered {
    border-left: 3px solid transparent;
}

.table-row-bordered:hover {
    border-left-color: #0d6efd;
}

.bg-light-primary {
    background-color: rgba(13, 110, 253, 0.1) !important;
}

.badge-sm {
    font-size: 0.75rem !important;
    padding: 0.25rem 0.5rem !important;
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

/* Responsive table */
@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.875rem;
    }

    .min-w-125px {
        min-width: 100px !important;
    }

    .min-w-300px {
        min-width: 200px !important;
    }
}
</style>
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
                    <h2 class="fw-bold">Manajemen Roles</h2>
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Add role-->
                        <a href="{{ route('roles-management.create') }}" class="btn btn-primary">
                            <i class="ki-duotone ki-plus fs-2"></i>
                            Tambah Role
                        </a>
                        <!--end::Add role-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body py-4">
                <!--begin::Modern Table-->
                <div class="table-responsive">
                    <table class="table table-hover table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                        <thead>
                            <tr class="fw-bold text-muted bg-light-primary">
                                <th class="ps-4 min-w-300px rounded-start">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-shield-alt me-2 text-primary"></i>
                                        <span class="text-dark fw-bold">Role</span>
                                    </div>
                                </th>
                                <th class="min-w-125px text-center">
                                    <i class="fas fa-users me-2 text-primary"></i>
                                    <span class="text-dark fw-bold">Jumlah User</span>
                                </th>
                                <th class="min-w-125px text-center">
                                    <i class="fas fa-key me-2 text-primary"></i>
                                    <span class="text-dark fw-bold">Permissions</span>
                                </th>
                                <th class="min-w-125px text-center">
                                    <i class="fas fa-clock me-2 text-primary"></i>
                                    <span class="text-dark fw-bold">Dibuat</span>
                                </th>

                                <th class="min-w-100px text-center rounded-end">
                                    <i class="fas fa-cogs me-2 text-primary"></i>
                                    <span class="text-dark fw-bold">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                            <tr class="border-bottom">
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            <div class="bg-light-primary rounded-3 d-flex align-items-center justify-content-center"
                                                 style="width: 50px; height: 50px;">
                                                <i class="fas fa-shield-alt text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <div class="d-flex align-items-center mb-1">
                                                <span class="text-dark fw-bold text-hover-primary fs-6 me-2">
                                                    {{ $role->name }}
                                                </span>
                                                @if($role->guard_name == 'web')
                                                    <span class="badge badge-success badge-sm">
                                                        <i class="fas fa-globe me-1"></i>Web
                                                    </span>
                                                @else
                                                    <span class="badge badge-info badge-sm">
                                                        <i class="fas fa-mobile me-1"></i>API
                                                    </span>
                                                @endif
                                            </div>
                                            <span class="text-muted fw-semibold d-block fs-7 line-clamp-2">
                                                Guard: {{ $role->guard_name }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="d-flex align-items-center mb-1">
                                            <i class="fas fa-users text-info me-1"></i>
                                            <span class="fw-bold text-dark">
                                                {{ $role->users_count ?? 0 }}
                                            </span>
                                        </div>
                                        <span class="text-muted fs-8">users</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="d-flex align-items-center mb-1">
                                            <i class="fas fa-key text-warning me-1"></i>
                                            <span class="fw-bold text-dark">
                                                {{ $role->permissions_count ?? 0 }}
                                            </span>
                                        </div>
                                        <span class="text-muted fs-8">permissions</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex flex-column align-items-center">
                                        <span class="fw-bold text-dark fs-7">
                                            {{ $role->created_at->format('d M Y') }}
                                        </span>
                                        <span class="text-muted fs-8">
                                            {{ $role->created_at->format('H:i') }}
                                        </span>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('roles-management.edit', $role->id) }}"
                                           class="btn btn-icon btn-sm btn-light-primary"
                                           data-bs-toggle="tooltip"
                                           title="Edit Role">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('roles-management.permissions', $role->id) }}"
                                           class="btn btn-icon btn-sm btn-light-info"
                                           data-bs-toggle="tooltip"
                                           title="Manage Permissions">
                                            <i class="fas fa-key"></i>
                                        </a>

                                        <button type="button"
                                                class="btn btn-icon btn-sm btn-light-danger"
                                                onclick="confirmDelete({{ $role->id }}, '{{ $role->name }}')"
                                                data-bs-toggle="tooltip"
                                                title="Delete Role">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-10">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="symbol symbol-100px symbol-lg-150px symbol-fixed position-relative mx-auto mb-6">
                                            <div class="symbol-label bg-light-primary rounded-3">
                                                <i class="fas fa-shield-alt fs-2x text-primary"></i>
                                            </div>
                                        </div>
                                        <h3 class="text-muted mb-3">Belum ada roles</h3>
                                        <p class="text-muted mb-6">Mulai dengan menambahkan role pertama</p>
                                        <a href="{{ route('roles-management.create') }}" class="btn btn-primary btn-lg">
                                            <i class="fas fa-plus me-2"></i>
                                            Tambah Role Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!--end::Modern Table-->

                <!--begin::Pagination-->
                @if($roles->hasPages())
                <div class="d-flex flex-stack flex-wrap pt-10">
                    <div class="fs-6 fw-semibold text-gray-700">
                        Showing {{ $roles->firstItem() }} to {{ $roles->lastItem() }} of {{ $roles->total() }} entries
                    </div>
                    <ul class="pagination">
                        @if ($roles->onFirstPage())
                            <li class="page-item previous disabled">
                                <a href="#" class="page-link"><i class="previous"></i></a>
                            </li>
                        @else
                            <li class="page-item previous">
                                <a href="{{ $roles->previousPageUrl() }}" class="page-link"><i class="previous"></i></a>
                            </li>
                        @endif

                        @foreach ($roles->getUrlRange(1, $roles->lastPage()) as $page => $url)
                            @if ($page == $roles->currentPage())
                                <li class="page-item active">
                                    <a href="#" class="page-link">{{ $page }}</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        @if ($roles->hasMorePages())
                            <li class="page-item next">
                                <a href="{{ $roles->nextPageUrl() }}" class="page-link"><i class="next"></i></a>
                            </li>
                        @else
                            <li class="page-item next disabled">
                                <a href="#" class="page-link"><i class="next"></i></a>
                            </li>
                        @endif
                    </ul>
                </div>
                @endif
                <!--end::Pagination-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->

<script>
function confirmDelete(id, name) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: `Apakah Anda yakin ingin menghapus role "${name}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Create form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/roles-management/${id}`;

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';

            const tokenInput = document.createElement('input');
            tokenInput.type = 'hidden';
            tokenInput.name = '_token';
            tokenInput.value = '{{ csrf_token() }}';

            form.appendChild(methodInput);
            form.appendChild(tokenInput);
            document.body.appendChild(form);
            form.submit();
        }
    });
}



// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Show success message if exists
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    // Show error message if exists
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
});
</script>
@endsection
