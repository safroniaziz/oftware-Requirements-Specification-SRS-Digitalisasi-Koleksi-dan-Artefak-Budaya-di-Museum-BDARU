@extends('layouts.dashboard.dashboard')

@section('title', 'Manajemen Koleksi - BDARU Museum')

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
                    <h2 class="fw-bold">Manajemen Koleksi</h2>
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Add user-->
                        <a href="{{ route('collections-management.create') }}" class="btn btn-primary">
                            <i class="ki-duotone ki-plus fs-2"></i>
                            Tambah Koleksi
                        </a>
                        <!--end::Add user-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body py-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                                </div>
                            </th>
                            <th class="min-w-125px">Nama Koleksi</th>
                            <th class="min-w-125px">Kategori</th>
                            <th class="min-w-125px">Periode</th>
                            <th class="min-w-125px">Lokasi Asal</th>
                            <th class="min-w-125px">Tanggal Dibuat</th>
                            <th class="text-end min-w-100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                        @forelse($collections as $collection)
                        <tr>
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="{{ $collection->id }}" />
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($collection->image_path)
                                        <div class="symbol symbol-50px me-3">
                                            <img src="{{ asset('storage/' . $collection->image_path) }}" alt="{{ $collection->name }}" class="object-cover rounded" style="height: 80px; width: auto;" />
                                        </div>
                                    @else
                                        <div class="symbol symbol-50px me-3 bg-light-primary rounded">
                                            <i class="ki-duotone ki-boxes fs-2 text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                    @endif
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $collection->name }}</a>
                                        <span class="text-muted fw-semibold text-muted d-block fs-7">{{ Str::limit($collection->description, 50) }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($collection->category)
                                    <span class="badge badge-light-primary">{{ $collection->category->name }}</span>
                                @else
                                    <span class="badge badge-light-warning">Tidak ada kategori</span>
                                @endif
                            </td>
                            <td>{{ $collection->year_period ?? '-' }}</td>
                            <td>{{ $collection->origin_location ?? '-' }}</td>
                            <td>{{ $collection->created_at->format('d M Y H:i') }}</td>
                            <td class="text-end">
                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    Aksi
                                    <i class="ki-duotone ki-down fs-5 m-0"></i>
                                </a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="{{ route('collections-management.edit', $collection->id) }}" class="menu-link px-3">
                                            Edit
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <form action="{{ route('collections-management.destroy', $collection->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="menu-link px-3 text-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus koleksi ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-10">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="ki-duotone ki-boxes fs-3x text-muted mb-5">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <h3 class="text-muted mb-2">Belum ada koleksi</h3>
                                    <p class="text-muted">Mulai dengan menambahkan koleksi pertama Anda</p>
                                    <a href="{{ route('collections-management.create') }}" class="btn btn-primary">
                                        <i class="ki-duotone ki-plus fs-2"></i>
                                        Tambah Koleksi Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <!--end::Table-->

                <!--begin::Pagination-->
                @if($collections->hasPages())
                <div class="d-flex flex-stack flex-wrap pt-10">
                    <div class="fs-6 fw-semibold text-gray-700">
                        Menampilkan {{ $collections->firstItem() ?? 0 }} sampai {{ $collections->lastItem() ?? 0 }} dari {{ $collections->total() }} koleksi
                    </div>
                    <ul class="pagination">
                        @if($collections->onFirstPage())
                            <li class="page-item previous disabled">
                                <a href="#" class="page-link"><i class="previous"></i></a>
                            </li>
                        @else
                            <li class="page-item previous">
                                <a href="{{ $collections->previousPageUrl() }}" class="page-link"><i class="previous"></i></a>
                            </li>
                        @endif

                        @foreach($collections->getUrlRange(1, $collections->lastPage()) as $page => $url)
                            @if($page == $collections->currentPage())
                                <li class="page-item active">
                                    <a href="#" class="page-link">{{ $page }}</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        @if($collections->hasMorePages())
                            <li class="page-item next">
                                <a href="{{ $collections->nextPageUrl() }}" class="page-link"><i class="next"></i></a>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Check for success message on page load
document.addEventListener('DOMContentLoaded', function() {
    // Check if there's a success message in session
    @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonColor: '#198754',
            confirmButtonText: 'OK'
        });
    @endif

    // Check if there's an error message
    @if(session('error'))
        Swal.fire({
            title: 'Error!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'OK'
        });
    @endif
});
</script>
@endsection
