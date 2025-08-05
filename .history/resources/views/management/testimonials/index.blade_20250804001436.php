@extends('layouts.dashboard.dashboard')

@section('title', 'Manajemen Testimoni - BDARU Museum')

@section('content')
<style>
/* Modal no scroll styles */
.swal2-popup-no-scroll {
    max-height: none !important;
    overflow: visible !important;
}

.swal2-html-container-no-scroll {
    max-height: none !important;
    overflow: visible !important;
    margin: 0 !important;
}

.swal2-popup-no-scroll .swal2-html-container {
    max-height: none !important;
    overflow: visible !important;
}

/* Professional styling */
.symbol-label {
    border-radius: 8px !important;
    font-size: 14px !important;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.badge {
    font-size: 0.75rem !important;
    padding: 0.35em 0.65em !important;
}

.btn-sm {
    padding: 0.375rem 0.75rem !important;
    font-size: 0.875rem !important;
}

/* Card styling for modal */
.card {
    border-radius: 12px !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
}

.card-body {
    padding: 1.25rem !important;
}

/* Quote styling */
.border-start {
    border-left-width: 4px !important;
}

.fst-italic {
    font-style: italic !important;
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
                    <h2 class="fw-bold">Manajemen Testimoni</h2>
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Info-->
                        <div class="alert alert-info d-flex align-items-center p-3 mb-0">
                            <i class="fas fa-shield-alt me-2"></i>
                            <div>
                                <strong>Mode View-Only:</strong> Testimoni diisi langsung oleh pengunjung museum dan dipublikasikan untuk meningkatkan kepercayaan publik. Admin dapat melihat detail lengkap setiap testimoni.
                            </div>
                        </div>
                        <!--end::Info-->
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
                        <thead class="table-light">
                            <tr>
                                <th class="min-w-200px">
                                    <i class="fas fa-user-circle me-2 text-primary"></i>
                                    Pengunjung
                                </th>
                                <th class="min-w-150px text-center">
                                    <i class="fas fa-star me-2 text-warning"></i>
                                    Rating
                                </th>
                                <th class="min-w-300px">
                                    <i class="fas fa-comment me-2 text-info"></i>
                                    Pesan Testimoni
                                </th>
                                <th class="min-w-100px text-center">
                                    <i class="fas fa-cogs me-2 text-secondary"></i>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($testimonials as $testimonial)
                            <tr data-id="{{ $testimonial->id }}"
                            data-name="{{ $testimonial->name }}"
                            data-profession="{{ $testimonial->profession }}"
                            data-email="{{ $testimonial->email }}"
                            data-rating="{{ $testimonial->rating }}"
                            data-content="{{ $testimonial->content }}">
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-45px me-3">
                                        <div class="symbol-label bg-light-primary text-primary fw-bold">
                                            {{ strtoupper(substr($testimonial->name, 0, 2)) }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $testimonial->name }}</div>
                                        <div class="text-muted small">{{ $testimonial->profession }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="text-warning me-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $testimonial->rating)
                                                <i class="fas fa-star text-warning"></i>
                                            @else
                                                <i class="far fa-star text-muted"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="badge bg-success">{{ $testimonial->rating }}/5</span>
                                </div>
                            </td>
                            <td>
                                <div class="text-dark fw-bold line-clamp-2">
                                    {{ Str::limit($testimonial->content, 100) }}
                                </div>
                                <div class="text-muted small mt-1">
                                    <i class="fas fa-envelope me-1"></i>{{ $testimonial->email }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button type="button"
                                            class="btn btn-sm btn-light-primary"
                                            onclick="viewTestimonial({{ $testimonial->id }})"
                                            title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                        <span class="d-none d-md-inline ms-1">Detail</span>
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
                                                <i class="fas fa-comments fs-2x text-primary"></i>
                                            </div>
                                        </div>
                                        <h3 class="text-muted mb-3">Belum ada testimoni</h3>
                                        <p class="text-muted mb-6">Testimoni akan muncul setelah pengunjung memberikan feedback</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!--end::Modern Table-->

                <!--begin::Pagination-->
                @if($testimonials->hasPages())
                <div class="d-flex flex-stack flex-wrap pt-10">
                    <div class="fs-6 fw-semibold text-gray-700">
                        Showing {{ $testimonials->firstItem() }} to {{ $testimonials->lastItem() }} of {{ $testimonials->total() }} entries
                    </div>
                    <ul class="pagination">
                        @if ($testimonials->onFirstPage())
                            <li class="page-item previous disabled">
                                <a href="#" class="page-link"><i class="previous"></i></a>
                            </li>
                        @else
                            <li class="page-item previous">
                                <a href="{{ $testimonials->previousPageUrl() }}" class="page-link"><i class="previous"></i></a>
                            </li>
                        @endif

                        @foreach ($testimonials->getUrlRange(1, $testimonials->lastPage()) as $page => $url)
                            @if ($page == $testimonials->currentPage())
                                <li class="page-item active">
                                    <a href="#" class="page-link">{{ $page }}</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        @if ($testimonials->hasMorePages())
                            <li class="page-item next">
                                <a href="{{ $testimonials->nextPageUrl() }}" class="page-link"><i class="next"></i></a>
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


function viewTestimonial(id) {
    // Get testimonial data from the table row data attributes
    const row = document.querySelector(`tr[data-id="${id}"]`);
    const visitorName = row.dataset.name || 'Anonim';
    const profession = row.dataset.profession || '-';
    const email = row.dataset.email || '-';
    const rating = row.dataset.rating || '0';
    const content = row.dataset.content || 'Tidak ada pesan';

    // Create rating stars
    const stars = '★'.repeat(parseInt(rating)) + '☆'.repeat(5 - parseInt(rating));

    // Show testimonial detail in modal
    Swal.fire({
        title: '<div class="text-center"><i class="fas fa-comment-dots text-primary mb-2"></i><br><span class="text-primary fw-bold">Detail Testimoni Pengunjung</span></div>',
        html: `
            <div class="text-start">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card border-0 bg-light mb-3">
                            <div class="card-body">
                                <h6 class="card-title text-primary mb-2">
                                    <i class="fas fa-user-circle me-2"></i>Informasi Pengunjung
                                </h6>
                                <div class="mb-2">
                                    <strong>ID Testimoni:</strong><br>
                                    <span class="badge bg-secondary">#${id}</span>
                                </div>
                                <div class="mb-2">
                                    <strong>Nama Lengkap:</strong><br>
                                    <span class="fw-bold text-dark">${visitorName}</span>
                                </div>
                                <div class="mb-2">
                                    <strong>Profesi:</strong><br>
                                    <span class="text-muted">${profession}</span>
                                </div>
                                <div class="mb-2">
                                    <strong>Email:</strong><br>
                                    <span class="text-info">${email}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 bg-light mb-3">
                            <div class="card-body">
                                <h6 class="card-title text-primary mb-2">
                                    <i class="fas fa-star me-2"></i>Rating & Tanggapan
                                </h6>
                                <div class="mb-3">
                                    <strong>Rating:</strong><br>
                                    <div class="d-flex align-items-center mt-1">
                                        <span class="text-warning fs-5 me-2">${stars}</span>
                                        <span class="badge bg-success">${rating}/5</span>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <strong>Status:</strong><br>
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle me-1"></i>Dipublikasikan
                                    </span>
                                </div>
                                <div class="mb-2">
                                    <strong>Tanggal Input:</strong><br>
                                    <span class="text-muted">Hari ini</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 bg-light">
                    <div class="card-body">
                        <h6 class="card-title text-primary mb-3">
                            <i class="fas fa-quote-left me-2"></i>Pesan Testimoni
                        </h6>
                        <div class="p-3 bg-white rounded border-start border-4 border-primary">
                            <p class="mb-0 fst-italic text-dark" style="line-height: 1.6;">
                                "${content}"
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-3 text-center">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Testimoni ini diisi langsung oleh pengunjung museum dan dipublikasikan untuk meningkatkan kepercayaan publik
                    </small>
                </div>
            </div>
        `,
        icon: 'info',
        confirmButtonText: '<i class="fas fa-times me-1"></i>Tutup',
        confirmButtonColor: '#6c757d',
        width: '800px',
        heightAuto: true,
        showCloseButton: true,
        customClass: {
            popup: 'swal2-popup-no-scroll',
            htmlContainer: 'swal2-html-container-no-scroll',
            confirmButton: 'btn btn-secondary'
        }
    });
}

function confirmDelete(id) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: 'Apakah Anda yakin ingin menghapus testimoni ini?',
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
            form.action = `/testimonials-management/${id}`;

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
