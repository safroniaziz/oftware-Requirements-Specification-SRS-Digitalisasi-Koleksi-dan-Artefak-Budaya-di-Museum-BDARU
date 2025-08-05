@extends('layouts.dashboard.dashboard')

@section('title', 'Reports - BDARU Museum')

@section('content')
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">

        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
            <!--begin::Col-->
            <div class="col-xl-3">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Total Koleksi</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Semua waktu</span>
                        </h3>
                    </div>
                    <div class="card-body pt-2 pb-4 d-flex align-items-center">
                        <div class="d-flex flex-column content-justify-center flex-row-fluid">
                            <div class="d-flex fw-semibold align-items-center">
                                <div class="bullet bullet-dot bg-primary me-2"></div>
                                <div class="text-gray-900 fs-6 fw-bold">{{ $totalCollections ?? 0 }} Koleksi</div>
                            </div>
                        </div>
                        <div class="symbol symbol-50px ms-auto">
                            <div class="symbol-label bg-light-primary">
                                <i class="fas fa-boxes fs-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-3">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Total Views</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Semua koleksi</span>
                        </h3>
                    </div>
                    <div class="card-body pt-2 pb-4 d-flex align-items-center">
                        <div class="d-flex flex-column content-justify-center flex-row-fluid">
                            <div class="d-flex fw-semibold align-items-center">
                                <div class="bullet bullet-dot bg-success me-2"></div>
                                <div class="text-gray-900 fs-6 fw-bold">{{ number_format($totalViews ?? 0) }} Views</div>
                            </div>
                        </div>
                        <div class="symbol symbol-50px ms-auto">
                            <div class="symbol-label bg-light-success">
                                <i class="fas fa-eye fs-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-3">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Total Berita</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Artikel berita</span>
                        </h3>
                    </div>
                    <div class="card-body pt-2 pb-4 d-flex align-items-center">
                        <div class="d-flex flex-column content-justify-center flex-row-fluid">
                            <div class="d-flex fw-semibold align-items-center">
                                <div class="bullet bullet-dot bg-warning me-2"></div>
                                <div class="text-gray-900 fs-6 fw-bold">{{ $totalNews ?? 0 }} Berita</div>
                            </div>
                        </div>
                        <div class="symbol symbol-50px ms-auto">
                            <div class="symbol-label bg-light-warning">
                                <i class="fas fa-newspaper fs-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-3">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Total Agenda</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Event & kegiatan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-2 pb-4 d-flex align-items-center">
                        <div class="d-flex flex-column content-justify-center flex-row-fluid">
                            <div class="d-flex fw-semibold align-items-center">
                                <div class="bullet bullet-dot bg-info me-2"></div>
                                <div class="text-gray-900 fs-6 fw-bold">{{ $totalEvents ?? 0 }} Agenda</div>
                            </div>
                        </div>
                        <div class="symbol symbol-50px ms-auto">
                            <div class="symbol-label bg-light-info">
                                <i class="fas fa-calendar-alt fs-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
            <!--begin::Col-->
            <div class="col-xl-8">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Laporan Koleksi per Kategori</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Distribusi koleksi berdasarkan kategori</span>
                        </h3>
                    </div>
                    <div class="card-body pt-2 pb-4">
                        <div class="table-responsive">
                            <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                <thead>
                                    <tr class="fw-bold text-muted bg-light-primary">
                                        <th class="ps-4 min-w-300px rounded-start">
                                            <span class="text-dark fw-bold">Kategori</span>
                                        </th>
                                        <th class="min-w-125px text-center">
                                            <span class="text-dark fw-bold">Jumlah Koleksi</span>
                                        </th>
                                        <th class="min-w-125px text-center">
                                            <span class="text-dark fw-bold">Total Views</span>
                                        </th>
                                        <th class="min-w-125px text-center">
                                            <span class="text-dark fw-bold">Rating Rata-rata</span>
                                        </th>
                                        <th class="min-w-100px text-center rounded-end">
                                            <span class="text-dark fw-bold">Persentase</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($categoryReports ?? [] as $report)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-50px me-3">
                                                    <div class="bg-light-primary rounded-3 d-flex align-items-center justify-content-center"
                                                         style="width: 50px; height: 50px;">
                                                        <i class="fas fa-tag text-primary"></i>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-start flex-column">
                                                    <span class="text-dark fw-bold text-hover-primary fs-6">
                                                        {{ $report->category_name }}
                                                    </span>
                                                    <span class="text-muted fw-semibold d-block fs-7">
                                                        {{ $report->category_description ?? 'Tidak ada deskripsi' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bold text-dark">{{ $report->collections_count }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bold text-dark">{{ number_format($report->total_views) }}</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= ($report->average_rating ?? 0))
                                                        <i class="fas fa-star text-warning me-1"></i>
                                                    @else
                                                        <i class="far fa-star text-muted me-1"></i>
                                                    @endif
                                                @endfor
                                                <span class="ms-2 fw-bold">{{ number_format($report->average_rating ?? 0, 1) }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-light-primary fw-bold px-3 py-2">
                                                {{ number_format(($report->collections_count / ($totalCollections ?? 1)) * 100, 1) }}%
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-10">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-chart-pie fs-2x text-muted mb-3"></i>
                                                <span class="text-muted">Belum ada data kategori</span>
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
            <div class="col-xl-4">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Koleksi Terpopuler</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Top 5 berdasarkan views</span>
                        </h3>
                    </div>
                    <div class="card-body pt-2 pb-4">
                        <div class="d-flex flex-column">
                            @forelse($popularCollections ?? [] as $index => $collection)
                            <div class="d-flex align-items-center mb-6">
                                <div class="symbol symbol-50px me-3">
                                    <div class="bg-light-primary rounded-3 d-flex align-items-center justify-content-center"
                                         style="width: 50px; height: 50px;">
                                        <span class="fw-bold text-primary">{{ $index + 1 }}</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start flex-column flex-grow-1">
                                    <span class="text-dark fw-bold text-hover-primary fs-6">
                                        {{ $collection->name }}
                                    </span>
                                    <span class="text-muted fw-semibold d-block fs-7">
                                        {{ $collection->category->name ?? 'Tanpa Kategori' }}
                                    </span>
                                </div>
                                <div class="d-flex flex-column align-items-end">
                                    <span class="fw-bold text-dark">{{ number_format($collection->view_count) }}</span>
                                    <span class="text-muted fs-8">views</span>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-10">
                                <i class="fas fa-chart-line fs-2x text-muted mb-3"></i>
                                <span class="text-muted">Belum ada data koleksi</span>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
            <!--begin::Col-->
            <div class="col-xl-6">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Laporan Bulanan</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Statistik 6 bulan terakhir</span>
                        </h3>
                    </div>
                    <div class="card-body pt-2 pb-4">
                        <div class="table-responsive">
                            <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                <thead>
                                    <tr class="fw-bold text-muted bg-light-primary">
                                        <th class="ps-4 min-w-150px rounded-start">
                                            <span class="text-dark fw-bold">Bulan</span>
                                        </th>
                                        <th class="min-w-100px text-center">
                                            <span class="text-dark fw-bold">Koleksi</span>
                                        </th>
                                        <th class="min-w-100px text-center">
                                            <span class="text-dark fw-bold">Berita</span>
                                        </th>
                                        <th class="min-w-100px text-center">
                                            <span class="text-dark fw-bold">Agenda</span>
                                        </th>
                                        <th class="min-w-100px text-center rounded-end">
                                            <span class="text-dark fw-bold">Views</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($monthlyReports ?? [] as $report)
                                    <tr>
                                        <td class="ps-4">
                                            <span class="fw-bold text-dark">{{ $report->month }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bold text-dark">{{ $report->collections_count }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bold text-dark">{{ $report->news_count }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bold text-dark">{{ $report->events_count }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bold text-dark">{{ number_format($report->total_views) }}</span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-10">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-calendar-alt fs-2x text-muted mb-3"></i>
                                                <span class="text-muted">Belum ada data bulanan</span>
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
                            <span class="card-label fw-bold text-gray-800">Laporan User Activity</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Aktivitas pengguna terbaru</span>
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
                                        <th class="min-w-150px text-center">
                                            <span class="text-dark fw-bold">Aktivitas</span>
                                        </th>
                                        <th class="min-w-125px text-center rounded-end">
                                            <span class="text-dark fw-bold">Waktu</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($userActivityReports ?? [] as $activity)
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
                                                        {{ $activity->user->name ?? 'Unknown' }}
                                                    </span>
                                                    <span class="text-muted fw-semibold d-block fs-7">
                                                        {{ $activity->user->email ?? 'N/A' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-light-primary fw-bold px-3 py-2">
                                                {{ $activity->action }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bold text-dark fs-7">
                                                {{ $activity->created_at->format('d M H:i') }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-10">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-user-clock fs-2x text-muted mb-3"></i>
                                                <span class="text-muted">Belum ada aktivitas user</span>
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

        <!--begin::Row-->
        <div class="row g-5 g-xl-10">
            <!--begin::Col-->
            <div class="col-xl-12">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-5">
                        <div class="card-title">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Export Laporan</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6">Download laporan dalam berbagai format</span>
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary" onclick="exportReport('pdf')">
                                    <i class="fas fa-file-pdf me-2"></i>
                                    Export PDF
                                </button>
                                <button type="button" class="btn btn-success" onclick="exportReport('excel')">
                                    <i class="fas fa-file-excel me-2"></i>
                                    Export Excel
                                </button>
                                <button type="button" class="btn btn-info" onclick="exportReport('csv')">
                                    <i class="fas fa-file-csv me-2"></i>
                                    Export CSV
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-2 pb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-6">
                                    <label class="form-label fw-bold">Jenis Laporan</label>
                                    <select class="form-select" id="report_type">
                                        <option value="collections">Laporan Koleksi</option>
                                        <option value="news">Laporan Berita</option>
                                        <option value="events">Laporan Agenda</option>
                                        <option value="users">Laporan User</option>
                                        <option value="comprehensive">Laporan Komprehensif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-6">
                                    <label class="form-label fw-bold">Periode</label>
                                    <select class="form-select" id="report_period">
                                        <option value="all">Semua Waktu</option>
                                        <option value="this_month">Bulan Ini</option>
                                        <option value="last_month">Bulan Lalu</option>
                                        <option value="this_year">Tahun Ini</option>
                                        <option value="last_year">Tahun Lalu</option>
                                    </select>
                                </div>
                            </div>
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
function exportReport(format) {
    const reportType = document.getElementById('report_type').value;
    const reportPeriod = document.getElementById('report_period').value;

    Swal.fire({
        title: 'Menyiapkan Laporan...',
        text: 'Mohon tunggu, laporan sedang disiapkan',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Simulate export process
    setTimeout(() => {
        Swal.fire({
            title: 'Laporan Siap!',
            text: `Laporan ${reportType} dalam format ${format.toUpperCase()} berhasil dibuat`,
            icon: 'success',
            confirmButtonText: 'Download'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create download link
                const link = document.createElement('a');
                link.href = `/reports-management/export?type=${reportType}&period=${reportPeriod}&format=${format}`;
                link.download = `laporan_${reportType}_${reportPeriod}.${format}`;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        });
    }, 2000);
}

// Auto refresh reports every 5 minutes
setInterval(function() {
    // You can implement auto refresh here if needed
    // window.location.reload();
}, 300000);
</script>
@endsection
