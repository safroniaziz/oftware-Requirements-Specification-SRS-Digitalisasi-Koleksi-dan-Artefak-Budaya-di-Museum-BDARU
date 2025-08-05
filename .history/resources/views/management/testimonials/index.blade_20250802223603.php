@extends('layouts.dashboard.dashboard')

@section('title', 'Manajemen Testimoni - BDARU Museum')

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
                    <h2 class="fw-bold">Manajemen Testimoni</h2>
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Info-->
                        <div class="alert alert-info d-flex align-items-center p-3 mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            <span class="fs-7">Testimoni diisi oleh pengunjung, admin hanya dapat melihat</span>
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
                        <thead>
                            <tr class="fw-bold text-muted bg-light-primary">
                                <th class="ps-4 min-w-300px rounded-start">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-comments me-2 text-primary"></i>
                                        <span class="text-dark fw-bold">Testimoni</span>
                                    </div>
                                </th>
                                <th class="min-w-125px text-center">
                                    <i class="fas fa-user me-2 text-primary"></i>
                                    <span class="text-dark fw-bold">Pengunjung</span>
                                </th>
                                <th class="min-w-125px text-center">
                                    <i class="fas fa-star me-2 text-primary"></i>
                                    <span class="text-dark fw-bold">Rating</span>
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
                            @forelse($testimonials as $testimonial)
                            <tr class="border-bottom">
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            <div class="bg-light-primary rounded-3 d-flex align-items-center justify-content-center"
                                                 style="width: 50px; height: 50px;">
                                                <i class="fas fa-comment text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <div class="d-flex align-items-center mb-1">
                                                <span class="text-dark fw-bold text-hover-primary fs-6 me-2">
                                                    Testimoni #{{ $testimonial->id }}
                                                </span>
                                            </div>
                                            <span class="text-muted fw-semibold d-block fs-7 line-clamp-2">
                                                {{ Str::limit($testimonial->message, 80) }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex flex-column align-items-center">
                                        <span class="fw-bold text-dark fs-7">
                                            {{ $testimonial->visitor_name ?? 'Anonim' }}
                                        </span>
                                        @if($testimonial->email)
                                        <span class="text-muted fs-8">
                                            {{ $testimonial->email }}
                                        </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="d-flex align-items-center mb-1">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= ($testimonial->rating ?? 0))
                                                    <i class="fas fa-star text-warning me-1"></i>
                                                @else
                                                    <i class="far fa-star text-muted me-1"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="text-muted fs-8">
                                            {{ $testimonial->rating ?? 0 }}/5
                                        </span>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <div class="d-flex flex-column align-items-center">
                                        <span class="fw-bold text-dark fs-7">
                                            {{ $testimonial->created_at->format('d M Y') }}
                                        </span>
                                        <span class="text-muted fs-8">
                                            {{ $testimonial->created_at->format('H:i') }}
                                        </span>
                                    </div>
                                </td>
                                                                                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button type="button"
                                                class="btn btn-icon btn-sm btn-light-info"
                                                onclick="viewTestimonial({{ $testimonial->id }})"
                                                data-bs-toggle="tooltip"
                                                title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
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
    // Show testimonial detail in modal
    Swal.fire({
        title: 'Detail Testimoni',
        html: `
            <div class="text-start">
                <p><strong>ID:</strong> ${id}</p>
                <p><strong>Pengunjung:</strong> ${document.querySelector(`tr[data-id="${id}"] .visitor-name`)?.textContent || 'Anonim'}</p>
                <p><strong>Rating:</strong> ${document.querySelector(`tr[data-id="${id}"] .rating`)?.textContent || '0/5'}</p>
                <p><strong>Pesan:</strong> ${document.querySelector(`tr[data-id="${id}"] .message`)?.textContent || 'Tidak ada pesan'}</p>
            </div>
        `,
        icon: 'info',
        confirmButtonText: 'Tutup'
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
