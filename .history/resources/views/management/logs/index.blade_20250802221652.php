@extends('layouts.dashboard')

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
