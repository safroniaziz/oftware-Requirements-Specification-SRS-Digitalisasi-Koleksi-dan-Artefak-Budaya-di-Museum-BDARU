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

                <!--begin::Collections Grid-->
                <div class="row g-6">
                    @forelse($collections as $collection)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="card card-custom h-100 shadow-sm border-0 hover-shadow-lg transition-all duration-300">
                            <!--begin::Card header-->
                            <div class="card-header border-0 pt-6 pb-0">
                                <div class="card-title w-100">
                                    <div class="d-flex align-items-center justify-content-between w-100">
                                        <div class="d-flex align-items-center">
                                            @if($collection->is_featured)
                                                <span class="badge badge-warning me-2">
                                                    <i class="fas fa-star me-1"></i>Featured
                                                </span>
                                            @endif
                                            @if($collection->is_active)
                                                <span class="badge badge-success me-2">
                                                    <i class="fas fa-check-circle me-1"></i>Active
                                                </span>
                                            @else
                                                <span class="badge badge-danger me-2">
                                                    <i class="fas fa-times-circle me-1"></i>Inactive
                                                </span>
                                            @endif
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-icon btn-sm btn-light-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('collections-management.edit', $collection->id) }}">
                                                        <i class="fas fa-edit me-2 text-primary"></i>Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="/collections/{{ $collection->id }}" target="_blank">
                                                        <i class="fas fa-eye me-2 text-info"></i>Preview
                                                    </a>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <button class="dropdown-item text-danger" onclick="confirmDelete({{ $collection->id }}, '{{ $collection->name }}')">
                                                        <i class="fas fa-trash me-2"></i>Hapus
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body d-flex flex-column p-6">
                                <!--begin::Image-->
                                <div class="position-relative mb-4">
                                    @if($collection->image_path)
                                        <div class="symbol symbol-100px symbol-lg-100px symbol-fixed position-relative">
                                            <img src="{{ asset('storage/' . $collection->image_path) }}"
                                                 alt="{{ $collection->name }}"
                                                 class="w-100 h-100 object-cover rounded-3 shadow-sm" />
                                        </div>
                                    @else
                                        <div class="symbol symbol-100px symbol-lg-100px symbol-fixed position-relative bg-light-primary rounded-3 d-flex align-items-center justify-content-center">
                                            <i class="fas fa-image fs-2x text-primary"></i>
                                        </div>
                                    @endif

                                    <!--begin::Category badge-->
                                    @if($collection->category)
                                        <div class="position-absolute top-0 start-0 m-3">
                                            <span class="badge badge-primary fs-7 fw-bold px-3 py-2">
                                                {{ $collection->category->name }}
                                            </span>
                                        </div>
                                    @endif

                                    <!--begin::View count badge-->
                                    <div class="position-absolute bottom-0 end-0 m-3">
                                        <span class="badge badge-light-dark fs-8 px-2 py-1">
                                            <i class="fas fa-eye me-1"></i>{{ number_format($collection->view_count ?? 0) }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Image-->

                                <!--begin::Content-->
                                <div class="flex-grow-1">
                                    <h3 class="card-title text-dark fw-bold fs-5 mb-2 line-clamp-2">
                                        {{ $collection->name }}
                                    </h3>

                                    <p class="text-muted fs-7 mb-3 line-clamp-3">
                                        {{ Str::limit($collection->description, 120) }}
                                    </p>

                                    <!--begin::Details-->
                                    <div class="d-flex flex-column gap-2 mb-4">
                                        @if($collection->year_period)
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar-alt text-primary me-2 fs-8"></i>
                                            <span class="text-muted fs-8">{{ $collection->year_period }}</span>
                                        </div>
                                        @endif

                                        @if($collection->origin_location)
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-map-marker-alt text-success me-2 fs-8"></i>
                                            <span class="text-muted fs-8">{{ $collection->origin_location }}</span>
                                        </div>
                                        @endif

                                        @if($collection->material)
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-cube text-warning me-2 fs-8"></i>
                                            <span class="text-muted fs-8">{{ Str::limit($collection->material, 30) }}</span>
                                        </div>
                                        @endif
                                    </div>
                                    <!--end::Details-->

                                    <!--begin::Stats-->
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-star text-warning me-1"></i>
                                            <span class="text-muted fs-8">{{ number_format($collection->average_rating ?? 0, 1) }}/5.0</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-comments text-info me-1"></i>
                                            <span class="text-muted fs-8">{{ $collection->rating_count ?? 0 }} ulasan</span>
                                        </div>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Content-->

                                <!--begin::Card footer-->
                                <div class="card-footer border-0 pt-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted fs-8">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $collection->created_at->diffForHumans() }}
                                        </small>

                                        <div class="d-flex gap-2">
                                            <a href="{{ route('collections-management.edit', $collection->id) }}"
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            <a href="/collections/{{ $collection->id }}"
                                               target="_blank"
                                               class="btn btn-sm btn-outline-info">
                                                <i class="fas fa-eye me-1"></i>View
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Card footer-->
                            </div>
                            <!--end::Card body-->
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="card card-custom border-0">
                            <div class="card-body text-center py-10">
                                <div class="symbol symbol-100px symbol-lg-150px symbol-fixed position-relative mx-auto mb-6">
                                    <div class="symbol-label bg-light-primary rounded-3">
                                        <i class="fas fa-boxes fs-2x text-primary"></i>
                                    </div>
                                </div>
                                <h3 class="text-muted mb-3">Belum ada koleksi</h3>
                                <p class="text-muted mb-6">Mulai dengan menambahkan koleksi pertama Anda untuk mengelola museum digital</p>
                                <a href="{{ route('collections-management.create') }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-plus me-2"></i>
                                    Tambah Koleksi Pertama
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
                <!--end::Collections Grid-->

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
// Function to confirm delete with SweetAlert2
function confirmDelete(collectionId, collectionName) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        html: `
            <div class="text-center">
                <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                <p class="mb-3">Apakah Anda yakin ingin menghapus koleksi ini?</p>
                <div class="bg-light p-3 rounded">
                    <strong>${collectionName}</strong>
                </div>
                <p class="text-sm text-muted mt-3">
                    <i class="fas fa-info-circle"></i>
                    Tindakan ini akan menghapus:
                </p>
                <ul class="text-sm text-muted text-start" style="display: inline-block;">
                    <li>Gambar utama koleksi</li>
                    <li>Semua gambar galeri</li>
                    <li>Timeline sejarah</li>
                    <li>Rating dan ulasan</li>
                    <li>Data spesifikasi teknis</li>
                    <li>Data konservasi</li>
                </ul>
                <p class="text-danger mt-3">
                    <strong>Tindakan ini tidak dapat dibatalkan!</strong>
                </p>
            </div>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus Koleksi',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        width: '500px'
    }).then((result) => {
        if (result.isConfirmed) {
            // Create and submit form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/collections-management/${collectionId}`;

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';

            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';

            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            form.submit();
        }
    });
}

// Check for success message on page load
document.addEventListener('DOMContentLoaded', function() {
    // Flag to prevent multiple alerts
    if (window.alertsShown) {
        return;
    }
    window.alertsShown = true;

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

// Reset alert flag when user performs actions that might generate new session messages
document.addEventListener('click', function(e) {
    // Reset flag when clicking on action buttons or links that might redirect
    if (e.target.closest('a[href*="edit"]') ||
        e.target.closest('a[href*="delete"]') ||
        e.target.closest('button[type="submit"]') ||
        e.target.closest('.btn-danger')) {
        window.alertsShown = false;
    }
});
</script>
@endsection
