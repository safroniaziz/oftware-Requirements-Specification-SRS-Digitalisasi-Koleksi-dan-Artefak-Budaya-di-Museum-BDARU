@extends('layouts.dashboard')

@section('title', 'Analitik - Admin Panel')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Page header-->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title">
                                <i class="fas fa-chart-bar me-2"></i>
                                Analitik Dashboard
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Page header-->

            <!--begin::Page body-->
            <div class="page-body">
                <div class="container-xl">
                    <!-- Statistics Cards -->
                    <div class="row row-deck row-cards mb-4">
                        <div class="col-sm-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Total Koleksi</div>
                                    </div>
                                    <div class="h1 mb-3">{{ number_format($stats['total_collections']) }}</div>
                                    <div class="d-flex mb-2">
                                        <div>Total koleksi yang tersedia</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Total Berita</div>
                                    </div>
                                    <div class="h1 mb-3">{{ number_format($stats['total_news']) }}</div>
                                    <div class="d-flex mb-2">
                                        <div>Total berita yang dipublikasi</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Total QR Codes</div>
                                    </div>
                                    <div class="h1 mb-3">{{ number_format($stats['total_qr_codes']) }}</div>
                                    <div class="d-flex mb-2">
                                        <div>Total QR code yang dibuat</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Total Scan QR</div>
                                    </div>
                                    <div class="h1 mb-3">{{ number_format($stats['total_qr_scans']) }}</div>
                                    <div class="d-flex mb-2">
                                        <div>Total scan QR code</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- QR Code Scan Statistics -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">QR Code Terbanyak Di-scan</h3>
                                </div>
                                <div class="card-body">
                                    @if($qrScanStats->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-vcenter">
                                                <thead>
                                                    <tr>
                                                        <th>Koleksi</th>
                                                        <th>Scan Count</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($qrScanStats as $qrStat)
                                                    <tr>
                                                        <td>{{ $qrStat->collection->name ?? 'Koleksi tidak ditemukan' }}</td>
                                                        <td>{{ number_format($qrStat->scan_count) }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center text-muted">
                                            <p>Belum ada data scan QR code</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Koleksi Terbaru</h3>
                                </div>
                                <div class="card-body">
                                    @if($recentCollections->count() > 0)
                                        <div class="list-group list-group-flush">
                                            @foreach($recentCollections as $collection)
                                            <div class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <span class="status-dot status-dot-animated bg-green"></span>
                                                    </div>
                                                    <div class="col text-truncate">
                                                        <a href="#" class="text-reset d-block">{{ $collection->name }}</a>
                                                        <div class="d-block text-muted text-truncate mt-n1">
                                                            {{ $collection->created_at->format('d/m/Y H:i') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center text-muted">
                                            <p>Belum ada koleksi</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Page body-->
        </div>
    </div>
</div>
@endsection
