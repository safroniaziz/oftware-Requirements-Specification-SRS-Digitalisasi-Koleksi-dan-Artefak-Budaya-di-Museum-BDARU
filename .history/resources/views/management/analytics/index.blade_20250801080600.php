@extends('layouts.dashboard.dashboard')

@section('title', 'Analitik - BDARU Museum')

@section('content')
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">

        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
            <!--begin::Col-->
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                    <div class="card-header pt-5">
                        <div class="card-title d-flex flex-column">
                            <div class="d-flex align-items-center">
                                <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">Total</span>
                            </div>
                            <span class="text-gray-900 pt-1 fw-bold fs-2">Koleksi</span>
                        </div>
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
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                    <div class="card-header pt-5">
                        <div class="card-title d-flex flex-column">
                            <div class="d-flex align-items-center">
                                <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">Total</span>
                            </div>
                            <span class="text-gray-900 pt-1 fw-bold fs-2">Berita</span>
                        </div>
                    </div>
                    <div class="card-body pt-2 pb-4 d-flex align-items-center">
                        <div class="d-flex flex-column content-justify-center flex-row-fluid">
                            <div class="d-flex fw-semibold align-items-center">
                                <div class="bullet bullet-dot bg-success me-2"></div>
                                <div class="text-gray-900 fs-6 fw-bold">{{ $totalNews ?? 0 }} Berita</div>
                            </div>
                        </div>
                        <div class="symbol symbol-50px ms-auto">
                            <div class="symbol-label bg-light-success">
                                <i class="fas fa-newspaper fs-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                    <div class="card-header pt-5">
                        <div class="card-title d-flex flex-column">
                            <div class="d-flex align-items-center">
                                <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">Total</span>
                            </div>
                            <span class="text-gray-900 pt-1 fw-bold fs-2">Agenda</span>
                        </div>
                    </div>
                    <div class="card-body pt-2 pb-4 d-flex align-items-center">
                        <div class="d-flex flex-column content-justify-center flex-row-fluid">
                            <div class="d-flex fw-semibold align-items-center">
                                <div class="bullet bullet-dot bg-warning me-2"></div>
                                <div class="text-gray-900 fs-6 fw-bold">{{ $totalEvents ?? 0 }} Agenda</div>
                            </div>
                        </div>
                        <div class="symbol symbol-50px ms-auto">
                            <div class="symbol-label bg-light-warning">
                                <i class="fas fa-calendar-alt fs-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                    <div class="card-header pt-5">
                        <div class="card-title d-flex flex-column">
                            <div class="d-flex align-items-center">
                                <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">Total</span>
                            </div>
                            <span class="text-gray-900 pt-1 fw-bold fs-2">Pengguna</span>
                        </div>
                    </div>
                    <div class="card-body pt-2 pb-4 d-flex align-items-center">
                        <div class="d-flex flex-column content-justify-center flex-row-fluid">
                            <div class="d-flex fw-semibold align-items-center">
                                <div class="bullet bullet-dot bg-info me-2"></div>
                                <div class="text-gray-900 fs-6 fw-bold">{{ $totalUsers ?? 0 }} Pengguna</div>
                            </div>
                        </div>
                        <div class="symbol symbol-50px ms-auto">
                            <div class="symbol-label bg-light-info">
                                <i class="fas fa-users fs-2x text-info"></i>
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
            <div class="col-xl-6">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Koleksi Terpopuler</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Berdasarkan Rating</span>
                        </h3>
                    </div>
                    <div class="card-body pt-2 pb-4 d-flex align-items-center">
                        <div class="table-responsive">
                            <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                <thead>
                                    <tr class="fw-bold text-muted bg-light-primary">
                                        <th class="ps-4 min-w-300px rounded-start">
                                            <span class="text-dark fw-bold">Koleksi</span>
                                        </th>
                                        <th class="min-w-125px text-center">
                                            <span class="text-dark fw-bold">Rating</span>
                                        </th>
                                        <th class="min-w-125px text-center rounded-end">
                                            <span class="text-dark fw-bold">Views</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($popularCollections ?? [] as $collection)
                                    <tr>
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
                                                    <span class="text-dark fw-bold text-hover-primary fs-6">
                                                        {{ $collection->name }}
                                                    </span>
                                                    <span class="text-muted fw-semibold d-block fs-7">
                                                        {{ $collection->category->name ?? 'Tanpa Kategori' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= ($collection->average_rating ?? 0))
                                                        <i class="fas fa-star text-warning me-1"></i>
                                                    @else
                                                        <i class="far fa-star text-muted me-1"></i>
                                                    @endif
                                                @endfor
                                                <span class="ms-2 fw-bold">{{ number_format($collection->average_rating ?? 0, 1) }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bold text-dark">{{ number_format($collection->view_count ?? 0) }}</span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-10">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-chart-bar fs-2x text-muted mb-3"></i>
                                                <span class="text-muted">Belum ada data koleksi</span>
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
                            <span class="card-label fw-bold text-gray-800">Aktivitas Terbaru</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Koleksi yang baru ditambahkan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-2 pb-4 d-flex align-items-center">
                        <div class="table-responsive">
                            <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                <thead>
                                    <tr class="fw-bold text-muted bg-light-primary">
                                        <th class="ps-4 min-w-300px rounded-start">
                                            <span class="text-dark fw-bold">Koleksi</span>
                                        </th>
                                        <th class="min-w-125px text-center">
                                            <span class="text-dark fw-bold">Kategori</span>
                                        </th>
                                        <th class="min-w-125px text-center rounded-end">
                                            <span class="text-dark fw-bold">Tanggal</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentCollections ?? [] as $collection)
                                    <tr>
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
                                                    <span class="text-dark fw-bold text-hover-primary fs-6">
                                                        {{ $collection->name }}
                                                    </span>
                                                    <span class="text-muted fw-semibold d-block fs-7">
                                                        {{ Str::limit($collection->description, 50) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-light-primary fw-bold px-3 py-2">
                                                {{ $collection->category->name ?? 'Tanpa Kategori' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bold text-dark">{{ $collection->created_at->format('d M Y') }}</span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-10">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-clock fs-2x text-muted mb-3"></i>
                                                <span class="text-muted">Belum ada aktivitas terbaru</span>
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
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Statistik Bulanan</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Data 6 bulan terakhir</span>
                        </h3>
                    </div>
                    <div class="card-body pt-2 pb-4">
                        <div class="d-flex flex-column">
                            <div class="row g-3">
                                @foreach($monthlyStats ?? [] as $month => $stats)
                                <div class="col-md-4 col-lg-2">
                                    <div class="card card-flush bg-light-primary">
                                        <div class="card-body text-center">
                                            <div class="fw-bold text-primary fs-6">{{ $month }}</div>
                                            <div class="d-flex justify-content-between mt-2">
                                                <div class="text-start">
                                                    <div class="text-muted fs-8">Koleksi</div>
                                                    <div class="fw-bold">{{ $stats['collections'] ?? 0 }}</div>
                                                </div>
                                                <div class="text-end">
                                                    <div class="text-muted fs-8">Berita</div>
                                                    <div class="fw-bold">{{ $stats['news'] ?? 0 }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
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
// Chart.js untuk visualisasi data (opsional)
document.addEventListener('DOMContentLoaded', function() {
    // Bisa ditambahkan chart untuk visualisasi data
    console.log('Analytics page loaded');
});
</script>
@endsection
