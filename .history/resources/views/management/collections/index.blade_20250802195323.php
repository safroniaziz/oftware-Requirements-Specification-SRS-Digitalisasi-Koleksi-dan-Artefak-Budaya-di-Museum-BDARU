@extends('layouts.dashboard.dashboard')

@section('title', 'Manajemen Koleksi - BDARU Museum')

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

                <!--begin::Modern Table-->
                <div class="table-responsive">
                    <table class="table table-hover table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                        <thead>
                            <tr class="fw-bold text-muted bg-light-primary">
                                <th class="ps-4 min-w-300px rounded-start">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-boxes me-2 text-primary"></i>
                                        <span class="text-dark fw-bold">Koleksi</span>
                                    </div>
                                </th>
                                <th class="min-w-125px text-center">
                                    <i class="fas fa-tag me-2 text-primary"></i>
                                    <span class="text-dark fw-bold">Kategori</span>
                                </th>
                                <th class="min-w-125px text-center">
                                    <i class="fas fa-calendar me-2 text-primary"></i>
                                    <span class="text-dark fw-bold">Periode</span>
                                </th>
                                <th class="min-w-125px text-center">
                                    <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                    <span class="text-dark fw-bold">Lokasi</span>
                                </th>
                                <th class="min-w-125px text-center">
                                    <i class="fas fa-star me-2 text-primary"></i>
                                    <span class="text-dark fw-bold">Rating</span>
                                </th>
                                <th class="min-w-125px text-center">
                                    <i class="fas fa-eye me-2 text-primary"></i>
                                    <span class="text-dark fw-bold">Views</span>
                                </th>
                                <th class="min-w-125px text-center">
                                    <i class="fas fa-clock me-2 text-primary"></i>
                                    <span class="text-dark fw-bold">Dibuat</span>
                                </th>
                                <th class="min-w-100px text-center rounded-end">
                                    <i class="fas fa-cogs me-2 text-primary"></i>
                                    <span class="text-dark fw-bold">Aksi</span>
                                </th>
                                <th class="min-w-125px">QR Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($collections as $collection)
                            <tr class="border-bottom">
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            @if($collection->image_path)
                                                <img src="{{ asset('storage/' . $collection->image_path) }}"
                                                     alt="{{ $collection->name }}"
                                                     class="rounded-3 object-cover"
                                                     style="width: 50px; height: 50px;" />
                                            @else
                                                <div class="bg-light-primary rounded-3 d-flex align-items-center justify-content-center"
                                                     style="width: 50px; height: 50px;">
                                                    <i class="fas fa-image text-primary"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <div class="d-flex align-items-center mb-1">
                                                <a href="/collections/{{ $collection->id }}"
                                                   target="_blank"
                                                   class="text-dark fw-bold text-hover-primary fs-6 me-2">
                                                    {{ $collection->name }}
                                                </a>
                                                <div class="d-flex align-items-center">
                                                    @if($collection->is_featured)
                                                        <span class="badge badge-warning badge-sm me-1">
                                                            <i class="fas fa-star me-1"></i>Featured
                                                        </span>
                                                    @endif
                                                    @if($collection->is_active)
                                                        <span class="badge badge-success badge-sm">
                                                            <i class="fas fa-check-circle me-1"></i>Active
                                                        </span>
                                                    @else
                                                        <span class="badge badge-danger badge-sm">
                                                            <i class="fas fa-times-circle me-1"></i>Inactive
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <span class="text-muted fw-semibold d-block fs-7 line-clamp-2">
                                                {{ Str::limit($collection->description, 80) }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if($collection->category)
                                        <span class="badge badge-light-primary fw-bold px-3 py-2">
                                            {{ $collection->category->name }}
                                        </span>
                                    @else
                                        <span class="badge badge-light-warning fw-bold px-3 py-2">
                                            <i class="fas fa-exclamation-triangle me-1"></i>No Category
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($collection->year_period)
                                        <span class="badge badge-light-info fw-bold px-3 py-2">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ $collection->year_period }}
                                        </span>
                                    @else
                                        <span class="text-muted fw-semibold">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($collection->origin_location)
                                        <span class="badge badge-light-success fw-bold px-3 py-2">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            {{ Str::limit($collection->origin_location, 20) }}
                                        </span>
                                    @else
                                        <span class="text-muted fw-semibold">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="d-flex align-items-center mb-1">
                                            <i class="fas fa-star text-warning me-1"></i>
                                            <span class="fw-bold text-dark">
                                                {{ number_format($collection->average_rating ?? 0, 1) }}
                                            </span>
                                        </div>
                                        <span class="text-muted fs-8">
                                            {{ $collection->rating_count ?? 0 }} ulasan
                                        </span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="d-flex align-items-center mb-1">
                                            <i class="fas fa-eye text-info me-1"></i>
                                            <span class="fw-bold text-dark">
                                                {{ number_format($collection->view_count ?? 0) }}
                                            </span>
                                        </div>
                                        <span class="text-muted fs-8">views</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex flex-column align-items-center">
                                        <span class="fw-bold text-dark fs-7">
                                            {{ $collection->created_at->format('d M Y') }}
                                        </span>
                                        <span class="text-muted fs-8">
                                            {{ $collection->created_at->format('H:i') }}
                                        </span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('collections-management.edit', $collection->id) }}"
                                           class="btn btn-icon btn-sm btn-light-primary"
                                           data-bs-toggle="tooltip"
                                           title="Edit Koleksi">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="/collections/{{ $collection->id }}"
                                           target="_blank"
                                           class="btn btn-icon btn-sm btn-light-info"
                                           data-bs-toggle="tooltip"
                                           title="Preview Koleksi">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-icon btn-sm btn-light-danger"
                                                onclick="confirmDelete({{ $collection->id }}, '{{ $collection->name }}')"
                                                data-bs-toggle="tooltip"
                                                title="Hapus Koleksi">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if($collection->qrCodes->count() > 0)
                                        <button type="button" class="btn btn-icon btn-sm btn-light-success" onclick="viewQrCodes({{ $collection->id }})" data-bs-toggle="tooltip" title="Lihat QR Codes">
                                            <i class="fas fa-qrcode"></i>
                                        </button>
                                    @endif
                                    <button type="button" class="btn btn-icon btn-sm btn-light-primary" onclick="generateQrCode({{ $collection->id }})" data-bs-toggle="tooltip" title="Generate QR Code">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-10">
                                    <div class="d-flex flex-column align-items-center">
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
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!--end::Modern Table-->

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

// QR Code Management Functions
function generateQrCode(collectionId) {
    Swal.fire({
        title: 'Generate QR Code?',
        text: 'Apakah Anda yakin ingin membuat QR Code baru untuk koleksi ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Generate!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/admin/collections/${collectionId}/generate-qr`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Berhasil!', data.message, 'success');
                    // Reload page to update QR code count
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    Swal.fire('Error!', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'Terjadi kesalahan saat generate QR Code', 'error');
            });
        }
    });
}

function viewQrCodes(collectionId) {
    fetch(`/admin/collections/${collectionId}/qr-codes`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showQrCodesModal(data.qr_codes);
            } else {
                Swal.fire('Error!', 'Gagal memuat QR Codes', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error!', 'Terjadi kesalahan saat memuat QR Codes', 'error');
        });
}

function showQrCodesModal(qrCodes) {
    let qrCodesHTML = '';

    qrCodes.forEach((qr, index) => {
        qrCodesHTML += `
            <div class="text-center mb-4">
                <h6 class="fw-bold mb-2">QR Code ${index + 1}</h6>
                <img src="${qr.qr_image_url}" alt="QR Code" class="img-fluid border rounded mb-2" style="max-width: 200px;">
                <div class="mb-2">
                    <strong>Kode:</strong> <code>${qr.qr_code}</code>
                </div>
                <div class="mb-2">
                    <strong>Scan Count:</strong> ${qr.scan_count}
                </div>
                <div class="mb-2">
                    <strong>Last Scanned:</strong> ${qr.last_scanned_at || 'Belum pernah di-scan'}
                </div>
                <div class="mb-2">
                    <strong>Created:</strong> ${qr.created_at}
                </div>
                <hr>
            </div>
        `;
    });

    Swal.fire({
        title: 'QR Codes Collection',
        html: `
            <div class="text-left">
                <p class="mb-3">Total QR Codes: <strong>${qrCodes.length}</strong></p>
                ${qrCodesHTML}
            </div>
        `,
        width: '600px',
        confirmButtonText: 'Tutup',
        confirmButtonColor: '#3085d6'
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
