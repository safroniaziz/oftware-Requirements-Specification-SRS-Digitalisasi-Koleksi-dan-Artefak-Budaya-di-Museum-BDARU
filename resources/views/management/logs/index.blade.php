@extends('layouts.dashboard.dashboard')

@section('title', 'Logs - Admin Panel')

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
                                <i class="fas fa-file-alt me-2"></i>
                                Logs Sistem
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Page header-->

            <!--begin::Page body-->
            <div class="page-body">
                <div class="container-xl">
                    <!-- Recent Activities -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Aktivitas Terbaru (50 Terakhir)</h3>
                                </div>
                                <div class="card-body">
                                    @if(count($recentActivities) > 0)
                                        <div class="table-responsive">
                                            <table class="table table-vcenter">
                                                <thead>
                                                    <tr>
                                                        <th>Waktu</th>
                                                        <th>Tipe</th>
                                                        <th>Aktivitas</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($recentActivities as $activity)
                                                    <tr>
                                                        <td>
                                                            @if($activity['timestamp'])
                                                                <small class="text-muted">{{ $activity['timestamp'] }}</small>
                                                            @else
                                                                <small class="text-muted">-</small>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($activity['type'] == 'error')
                                                                <span class="badge badge-danger">Error</span>
                                                            @elseif($activity['type'] == 'warning')
                                                                <span class="badge badge-warning">Warning</span>
                                                            @elseif($activity['type'] == 'info')
                                                                <span class="badge badge-info">Info</span>
                                                            @else
                                                                <span class="badge badge-secondary">Debug</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <code class="text-wrap" style="font-size: 0.8rem;">{{ Str::limit($activity['log'], 200) }}</code>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center text-muted">
                                            <p>Belum ada aktivitas terbaru</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Log Files -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">File Log Sistem</h3>
                                </div>
                                <div class="card-body">
                                    @if(count($logFiles) > 0)
                                        <div class="table-responsive">
                                            <table class="table table-vcenter">
                                                <thead>
                                                    <tr>
                                                        <th>Nama File</th>
                                                        <th>Ukuran</th>
                                                        <th>Tanggal Modifikasi</th>
                                                        <th class="w-1">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($logFiles as $file)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-file-alt text-info me-2"></i>
                                                                {{ $file['name'] }}
                                                            </div>
                                                        </td>
                                                        <td>{{ number_format($file['size'] / 1024, 2) }} KB</td>
                                                        <td>{{ date('d/m/Y H:i', $file['date']) }}</td>
                                                        <td>
                                                            <div class="btn-list flex-nowrap">
                                                                <a href="{{ route('logs-management.show', $file['name']) }}"
                                                                   class="btn btn-sm btn-info">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                                <a href="{{ route('logs-management.download', $file['name']) }}"
                                                                   class="btn btn-sm btn-primary">
                                                                    <i class="fas fa-download"></i>
                                                                </a>
                                                                <button type="button"
                                                                        class="btn btn-sm btn-warning"
                                                                        onclick="confirmClear('{{ $file['name'] }}')">
                                                                    <i class="fas fa-eraser"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center py-10">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-file-alt fs-2x text-muted mb-3"></i>
                                                <span class="text-muted">Belum ada file log</span>
                                            </div>
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

<script>
function confirmClear(filename) {
    Swal.fire({
        title: 'Konfirmasi Bersihkan',
        text: `Apakah Anda yakin ingin membersihkan file log "${filename}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ffc107',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Bersihkan!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `/logs-management/${filename}/clear`;
        }
    });
}
</script>
@endsection
