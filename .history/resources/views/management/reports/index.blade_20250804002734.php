@extends('layouts.dashboard.dashboard')

@section('title', 'Reports - Admin Panel')

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
                                <i class="fas fa-chart-line me-2"></i>
                                Reports & Analytics
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
                                    <div class="h1 mb-3">{{ number_format($collectionStats['total']) }}</div>
                                    <div class="d-flex mb-2">
                                        <div>Koleksi yang tersedia</div>
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
                                    <div class="h1 mb-3">{{ number_format($qrStats['total_codes']) }}</div>
                                    <div class="d-flex mb-2">
                                        <div>QR code yang dibuat</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Total Scan</div>
                                    </div>
                                    <div class="h1 mb-3">{{ number_format($qrStats['total_scans']) }}</div>
                                    <div class="d-flex mb-2">
                                        <div>Total scan QR code</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Total Users</div>
                                    </div>
                                    <div class="h1 mb-3">{{ number_format($userStats['total_users']) }}</div>
                                    <div class="d-flex mb-2">
                                        <div>Pengguna terdaftar</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detailed Reports -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">QR Code Terbanyak Di-scan</h3>
                                </div>
                                <div class="card-body">
                                    @if($qrStats['most_scanned']->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-vcenter">
                                                <thead>
                                                    <tr>
                                                        <th>Koleksi</th>
                                                        <th>Scan Count</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($qrStats['most_scanned'] as $qrStat)
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
                                    <h3 class="card-title">Koleksi per Kategori</h3>
                                </div>
                                <div class="card-body">
                                    @if(count($collectionStats['by_category']) > 0)
                                        <div class="table-responsive">
                                            <table class="table table-vcenter">
                                                <thead>
                                                    <tr>
                                                        <th>Kategori</th>
                                                        <th>Jumlah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($collectionStats['by_category'] as $category => $count)
                                                    <tr>
                                                        <td>{{ $category }}</td>
                                                        <td>{{ number_format($count) }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center text-muted">
                                            <p>Belum ada data kategori</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User Registration -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Registrasi User Terbaru</h3>
                                </div>
                                <div class="card-body">
                                    @if($userStats['recent_registrations']->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-vcenter">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Email</th>
                                                        <th>Tanggal Registrasi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($userStats['recent_registrations'] as $user)
                                                    <tr>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center text-muted">
                                            <p>Belum ada user terdaftar</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Export Reports</h3>
                                </div>
                                <div class="card-body">
                                    <div class="btn-list">
                                        <a href="{{ route('reports-management.collections') }}" class="btn btn-primary">
                                            <i class="fas fa-download me-2"></i>
                                            Export Data Koleksi
                                        </a>
                                        <a href="{{ route('reports-management.qrCodes') }}" class="btn btn-success">
                                            <i class="fas fa-qrcode me-2"></i>
                                            Export Data QR Code
                                        </a>
                                    </div>
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
