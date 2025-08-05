@extends('layouts.dashboard')

@section('title', 'Backup Database - Admin Panel')

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
                                <i class="fas fa-database me-2"></i>
                                Backup Database
                            </h2>
                        </div>
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="{{ route('backup-management.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>
                                    Buat Backup
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
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <div class="d-flex">
                                <div>
                                    <i class="fas fa-check-circle me-2"></i>
                                    {{ session('success') }}
                                </div>
                            </div>
                            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <div class="d-flex">
                                <div>
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    {{ session('error') }}
                                </div>
                            </div>
                            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">File Backup Database</h3>
                        </div>
                        <div class="card-body">
                            @if(count($backupFiles) > 0)
                                <div class="table-responsive">
                                    <table class="table table-vcenter">
                                        <thead>
                                            <tr>
                                                <th>Nama File</th>
                                                <th>Ukuran</th>
                                                <th>Tanggal Dibuat</th>
                                                <th class="w-1">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($backupFiles as $file)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-file-archive text-primary me-2"></i>
                                                        {{ $file['name'] }}
                                                    </div>
                                                </td>
                                                <td>{{ number_format($file['size'] / 1024 / 1024, 2) }} MB</td>
                                                <td>{{ date('d/m/Y H:i', $file['date']) }}</td>
                                                <td>
                                                    <div class="btn-list flex-nowrap">
                                                        <a href="{{ route('backup-management.download', $file['name']) }}"
                                                           class="btn btn-sm btn-primary">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                        <button type="button"
                                                                class="btn btn-sm btn-danger"
                                                                onclick="confirmDelete('{{ $file['name'] }}')">
                                                            <i class="fas fa-trash"></i>
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
                                        <i class="fas fa-database fs-2x text-muted mb-3"></i>
                                        <span class="text-muted">Belum ada file backup</span>
                                        <p class="text-muted mt-2">Klik tombol "Buat Backup" untuk membuat backup database pertama</p>
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
function confirmDelete(filename) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: `Apakah Anda yakin ingin menghapus file backup "${filename}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `/backup-management/${filename}/delete`;
        }
    });
}
</script>
@endsection
