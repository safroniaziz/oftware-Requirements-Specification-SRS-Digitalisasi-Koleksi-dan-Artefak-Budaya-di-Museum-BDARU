@extends('layouts.dashboard.dashboard')

@section('title', 'Logs - BDARU Museum')

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
                    <h2 class="fw-bold">Activity Logs</h2>
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Filter-->
                        <div class="d-flex align-items-center me-3">
                            <select class="form-select form-select-sm" id="log_type_filter">
                                <option value="">Semua Tipe</option>
                                <option value="info">Info</option>
                                <option value="warning">Warning</option>
                                <option value="error">Error</option>
                                <option value="debug">Debug</option>
                            </select>
                        </div>
                        <!--end::Filter-->
                        <!--begin::Clear logs-->
                        <button type="button" class="btn btn-danger btn-sm" onclick="clearLogs()">
                            <i class="fas fa-trash me-2"></i>
                            Clear Logs
                        </button>
                        <!--end::Clear logs-->
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
                                <th class="ps-4 min-w-100px rounded-start">
                                    <span class="text-dark fw-bold">Level</span>
                                </th>
                                <th class="min-w-300px">
                                    <span class="text-dark fw-bold">Pesan</span>
                                </th>
                                <th class="min-w-200px">
                                    <span class="text-dark fw-bold">User</span>
                                </th>
                                <th class="min-w-150px">
                                    <span class="text-dark fw-bold">IP Address</span>
                                </th>
                                <th class="min-w-150px">
                                    <span class="text-dark fw-bold">User Agent</span>
                                </th>
                                <th class="min-w-150px text-center rounded-end">
                                    <span class="text-dark fw-bold">Waktu</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs ?? [] as $log)
                            <tr class="border-bottom">
                                <td class="ps-4">
                                    @if($log->level == 'error')
                                        <span class="badge badge-light-danger fw-bold px-3 py-2">
                                            <i class="fas fa-exclamation-circle me-1"></i>Error
                                        </span>
                                    @elseif($log->level == 'warning')
                                        <span class="badge badge-light-warning fw-bold px-3 py-2">
                                            <i class="fas fa-exclamation-triangle me-1"></i>Warning
                                        </span>
                                    @elseif($log->level == 'info')
                                        <span class="badge badge-light-info fw-bold px-3 py-2">
                                            <i class="fas fa-info-circle me-1"></i>Info
                                        </span>
                                    @else
                                        <span class="badge badge-light-secondary fw-bold px-3 py-2">
                                            <i class="fas fa-bug me-1"></i>Debug
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="text-dark fw-bold text-hover-primary fs-6">
                                            {{ $log->message }}
                                        </span>
                                        @if($log->context)
                                            <span class="text-muted fw-semibold d-block fs-7">
                                                {{ Str::limit($log->context, 100) }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px me-3">
                                            <div class="bg-light-primary rounded-3 d-flex align-items-center justify-content-center"
                                                 style="width: 40px; height: 40px;">
                                                <i class="fas fa-user text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <span class="text-dark fw-bold text-hover-primary fs-6">
                                                {{ $log->user->name ?? 'Guest' }}
                                            </span>
                                            <span class="text-muted fw-semibold d-block fs-7">
                                                {{ $log->user->email ?? 'N/A' }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark">{{ $log->ip_address ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark fs-7">
                                        {{ Str::limit($log->user_agent ?? 'N/A', 50) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex flex-column align-items-center">
                                        <span class="fw-bold text-dark fs-7">
                                            {{ $log->created_at->format('d M Y') }}
                                        </span>
                                        <span class="text-muted fs-8">
                                            {{ $log->created_at->format('H:i:s') }}
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-10">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="symbol symbol-100px symbol-lg-150px symbol-fixed position-relative mx-auto mb-6">
                                            <div class="symbol-label bg-light-primary rounded-3">
                                                <i class="fas fa-clipboard-list fs-2x text-primary"></i>
                                            </div>
                                        </div>
                                        <h3 class="text-muted mb-3">Belum ada logs</h3>
                                        <p class="text-muted mb-6">Activity logs akan muncul di sini</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!--end::Modern Table-->

                <!--begin::Pagination-->
                @if(isset($logs) && $logs->hasPages())
                <div class="d-flex flex-stack flex-wrap pt-10">
                    <div class="fs-6 fw-semibold text-gray-700">
                        Showing {{ $logs->firstItem() }} to {{ $logs->lastItem() }} of {{ $logs->total() }} entries
                    </div>
                    <ul class="pagination">
                        @if ($logs->onFirstPage())
                            <li class="page-item previous disabled">
                                <a href="#" class="page-link"><i class="previous"></i></a>
                            </li>
                        @else
                            <li class="page-item previous">
                                <a href="{{ $logs->previousPageUrl() }}" class="page-link"><i class="previous"></i></a>
                            </li>
                        @endif

                        @foreach ($logs->getUrlRange(1, $logs->lastPage()) as $page => $url)
                            @if ($page == $logs->currentPage())
                                <li class="page-item active">
                                    <a href="#" class="page-link">{{ $page }}</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        @if ($logs->hasMorePages())
                            <li class="page-item next">
                                <a href="{{ $logs->nextPageUrl() }}" class="page-link"><i class="next"></i></a>
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

        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mt-5">
            <!--begin::Col-->
            <div class="col-xl-6">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Error Logs</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Log error terbaru</span>
                        </h3>
                    </div>
                    <div class="card-body pt-2 pb-4">
                        <div class="table-responsive">
                            <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                <thead>
                                    <tr class="fw-bold text-muted bg-light-danger">
                                        <th class="ps-4 min-w-200px rounded-start">
                                            <span class="text-dark fw-bold">Error</span>
                                        </th>
                                        <th class="min-w-125px text-center">
                                            <span class="text-dark fw-bold">File</span>
                                        </th>
                                        <th class="min-w-125px text-center rounded-end">
                                            <span class="text-dark fw-bold">Line</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($errorLogs ?? [] as $error)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex flex-column">
                                                <span class="text-dark fw-bold text-hover-primary fs-6">
                                                    {{ Str::limit($error->message, 50) }}
                                                </span>
                                                <span class="text-muted fw-semibold d-block fs-7">
                                                    {{ $error->created_at->format('d M Y H:i:s') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bold text-dark fs-7">
                                                {{ Str::limit($error->file ?? 'N/A', 30) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bold text-dark">{{ $error->line ?? 'N/A' }}</span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-10">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-check-circle fs-2x text-success mb-3"></i>
                                                <span class="text-muted">Tidak ada error logs</span>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-6">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Login Activity</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Riwayat login user</span>
                        </h3>
                    </div>
                    <div class="card-body pt-2 pb-4">
                        <div class="table-responsive">
                            <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                <thead>
                                    <tr class="fw-bold text-muted bg-light-success">
                                        <th class="ps-4 min-w-200px rounded-start">
                                            <span class="text-dark fw-bold">User</span>
                                        </th>
                                        <th class="min-w-125px text-center">
                                            <span class="text-dark fw-bold">Status</span>
                                        </th>
                                        <th class="min-w-125px text-center rounded-end">
                                            <span class="text-dark fw-bold">Waktu</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($loginLogs ?? [] as $login)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-40px me-3">
                                                    <div class="bg-light-success rounded-3 d-flex align-items-center justify-content-center"
                                                         style="width: 40px; height: 40px;">
                                                        <i class="fas fa-user text-success"></i>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-start flex-column">
                                                    <span class="text-dark fw-bold text-hover-primary fs-6">
                                                        {{ $login->user->name ?? 'Unknown' }}
                                                    </span>
                                                    <span class="text-muted fw-semibold d-block fs-7">
                                                        {{ $login->ip_address ?? 'N/A' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if($login->status == 'success')
                                                <span class="badge badge-light-success fw-bold px-3 py-2">
                                                    <i class="fas fa-check-circle me-1"></i>Success
                                                </span>
                                            @else
                                                <span class="badge badge-light-danger fw-bold px-3 py-2">
                                                    <i class="fas fa-times-circle me-1"></i>Failed
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bold text-dark fs-7">
                                                {{ $login->created_at->format('d M Y H:i') }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-10">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-user-clock fs-2x text-muted mb-3"></i>
                                                <span class="text-muted">Belum ada login activity</span>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->

<script>
function clearLogs() {
    Swal.fire({
        title: 'Konfirmasi Clear Logs',
        text: 'Apakah Anda yakin ingin menghapus semua logs?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus Semua!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Create form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("logs-management.clear") }}';

            const tokenInput = document.createElement('input');
            tokenInput.type = 'hidden';
            tokenInput.name = '_token';
            tokenInput.value = '{{ csrf_token() }}';

            form.appendChild(tokenInput);
            document.body.appendChild(form);
            form.submit();
        }
    });
}

// Filter logs by type
document.getElementById('log_type_filter').addEventListener('change', function() {
    const filterValue = this.value;
    const rows = document.querySelectorAll('tbody tr');

    rows.forEach(row => {
        const levelCell = row.querySelector('td:first-child');
        if (levelCell) {
            const level = levelCell.textContent.toLowerCase();
            if (filterValue === '' || level.includes(filterValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
});

// Auto refresh logs every 30 seconds
setInterval(function() {
    // You can implement auto refresh here if needed
    // window.location.reload();
}, 30000);
</script>
@endsection
