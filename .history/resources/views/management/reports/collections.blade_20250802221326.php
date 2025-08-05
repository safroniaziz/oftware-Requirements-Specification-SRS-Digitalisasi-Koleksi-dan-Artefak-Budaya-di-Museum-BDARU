@extends('layouts.dashboard')

@section('title', 'Export Data Koleksi - Admin Panel')

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
                                <i class="fas fa-download me-2"></i>
                                Export Data Koleksi
                            </h2>
                        </div>
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="{{ route('reports-management.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Page header-->

            <!--begin::Page body-->
            <div class="page-body">
                <div class="container-xl">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Koleksi</h3>
                        </div>
                        <div class="card-body">
                            @if(count($collections) > 0)
                                <div class="table-responsive">
                                    <table class="table table-vcenter">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama Koleksi</th>
                                                <th>Kategori</th>
                                                <th>QR Codes</th>
                                                <th>Total Scan</th>
                                                <th>Tanggal Dibuat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($collections as $collection)
                                            <tr>
                                                <td>{{ $collection['id'] }}</td>
                                                <td>{{ $collection['name'] }}</td>
                                                <td>{{ $collection['category'] }}</td>
                                                <td>{{ $collection['qr_codes'] }}</td>
                                                <td>{{ number_format($collection['total_scans']) }}</td>
                                                <td>{{ $collection['created_at'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-10">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-boxes fs-2x text-muted mb-3"></i>
                                        <span class="text-muted">Belum ada data koleksi</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Page body-->
        </div>
    </div>
</div>
@endsection
