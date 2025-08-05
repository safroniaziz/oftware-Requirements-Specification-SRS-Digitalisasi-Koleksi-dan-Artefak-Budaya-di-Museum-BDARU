@extends('layouts.dashboard.dashboard')

@section('title', 'Backup Database - BDARU Museum')

@section('content')
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">

        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
            <!--begin::Col-->
            <div class="col-xl-4">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Buat Backup</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Backup database saat ini</span>
                        </h3>
                    </div>
                    <div class="card-body pt-2 pb-4">
                        <div class="d-flex flex-column">
                            <div class="alert alert-info d-flex align-items-center p-3 mb-6">
                                <i class="fas fa-info-circle me-2"></i>
                                <span class="fs-7">Backup akan menyimpan seluruh data database termasuk koleksi, berita, agenda, dan pengaturan.</span>
                            </div>

                            <div class="d-grid">
                                <button type="button" class="btn btn-primary btn-lg" onclick="createBackup()">
                                    <i class="fas fa-download me-2"></i>
                                    Buat Backup Sekarang
                                </button>
                            </div>

                            <div class="mt-6">
                                <h6 class="fw-bold mb-3">Informasi Backup:</h6>
                                <ul class="list-unstyled">
                                    <li class="d-flex align-items-center mb-2">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <span class="fs-7">Mencakup seluruh tabel database</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-2">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <span class="fs-7">Format file: .sql</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-2">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <span class="fs-7">Dapat di-restore kapan saja</span>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <span class="fs-7">Backup otomatis setiap hari</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-8">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Riwayat Backup</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Daftar backup yang tersedia</span>
                        </h3>
                    </div>
                    <div class="card-body pt-2 pb-4">
                        <div class="table-responsive">
                            <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                <thead>
                                    <tr class="fw-bold text-muted bg-light-primary">
                                        <th class="ps-4 min-w-300px rounded-start">
                                            <span class="text-dark fw-bold">Nama File</span>
                                        </th>
                                        <th class="min-w-125px text-center">
                                            <span class="text-dark fw-bold">Ukuran</span>
                                        </th>
                                        <th class="min-w-125px text-center">
                                            <span class="text-dark fw-bold">Tanggal</span>
                                        </th>
                                        <th class="min-w-125px text-center">
                                            <span class="text-dark fw-bold">Status</span>
                                        </th>
                                        <th class="min-w-100px text-center rounded-end">
                                            <span class="text-dark fw-bold">Aksi</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($backups ?? [] as $backup)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-50px me-3">
                                                    <div class="bg-light-primary rounded-3 d-flex align-items-center justify-content-center"
                                                         style="width: 50px; height: 50px;">
                                                        <i class="fas fa-database text-primary"></i>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-start flex-column">
                                                    <span class="text-dark fw-bold text-hover-primary fs-6">
                                                        {{ $backup->filename }}
                                                    </span>
                                                    <span class="text-muted fw-semibold d-block fs-7">
                                                        Backup Database
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bold text-dark">{{ $backup->size ?? '0 KB' }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bold text-dark">{{ $backup->created_at ?? 'N/A' }}</span>
                                        </td>
                                        <td class="text-center">
                                            @if($backup->status == 'completed')
                                                <span class="badge badge-light-success fw-bold px-3 py-2">
                                                    <i class="fas fa-check-circle me-1"></i>Selesai
                                                </span>
                                            @elseif($backup->status == 'failed')
                                                <span class="badge badge-light-danger fw-bold px-3 py-2">
                                                    <i class="fas fa-times-circle me-1"></i>Gagal
                                                </span>
                                            @else
                                                <span class="badge badge-light-warning fw-bold px-3 py-2">
                                                    <i class="fas fa-clock me-1"></i>Proses
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                @if($backup->status == 'completed')
                                                <a href="{{ route('backup-management.download', $backup->id) }}"
                                                   class="btn btn-icon btn-sm btn-light-success"
                                                   data-bs-toggle="tooltip"
                                                   title="Download Backup">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                                <button type="button"
                                                        class="btn btn-icon btn-sm btn-light-warning"
                                                        onclick="confirmRestore({{ $backup->id }}, '{{ $backup->filename }}')"
                                                        data-bs-toggle="tooltip"
                                                        title="Restore Database">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                                @endif
                                                <button type="button"
                                                        class="btn btn-icon btn-sm btn-light-danger"
                                                        onclick="confirmDelete({{ $backup->id }}, '{{ $backup->filename }}')"
                                                        data-bs-toggle="tooltip"
                                                        title="Hapus Backup">
                                                    <i class="fas fa-trash"></i>
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
                                                        <i class="fas fa-database fs-2x text-primary"></i>
                                                    </div>
                                                </div>
                                                <h3 class="text-muted mb-3">Belum ada backup</h3>
                                                <p class="text-muted mb-6">Buat backup pertama untuk melindungi data Anda</p>
                                                <button type="button" class="btn btn-primary btn-lg" onclick="createBackup()">
                                                    <i class="fas fa-download me-2"></i>
                                                    Buat Backup Pertama
                                                </button>
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
                            <span class="card-label fw-bold text-gray-800">Pengaturan Backup</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Konfigurasi backup otomatis</span>
                        </h3>
                    </div>
                    <div class="card-body pt-2 pb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-6">
                                    <label class="form-label fw-bold">Backup Otomatis</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="auto_backup" checked>
                                        <label class="form-check-label" for="auto_backup">
                                            Aktifkan backup otomatis
                                        </label>
                                    </div>
                                    <small class="text-muted">Backup akan dibuat secara otomatis setiap hari</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-6">
                                    <label for="backup_frequency" class="form-label fw-bold">Frekuensi Backup</label>
                                    <select class="form-select" id="backup_frequency">
                                        <option value="daily">Setiap Hari</option>
                                        <option value="weekly">Setiap Minggu</option>
                                        <option value="monthly">Setiap Bulan</option>
                                    </select>
                                    <small class="text-muted">Pilih frekuensi backup otomatis</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-6">
                                    <label for="retention_days" class="form-label fw-bold">Retensi Backup (Hari)</label>
                                    <input type="number" class="form-control" id="retention_days" value="30" min="1" max="365">
                                    <small class="text-muted">Backup lama akan dihapus otomatis setelah periode ini</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-6">
                                    <label class="form-label fw-bold">Kompresi</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="compression" checked>
                                        <label class="form-check-label" for="compression">
                                            Kompresi file backup
                                        </label>
                                    </div>
                                    <small class="text-muted">Mengurangi ukuran file backup</small>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" onclick="saveSettings()">
                                <i class="fas fa-save me-2"></i>
                                Simpan Pengaturan
                            </button>
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
function createBackup() {
    Swal.fire({
        title: 'Konfirmasi Backup',
        text: 'Apakah Anda yakin ingin membuat backup database sekarang?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Buat Backup!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Membuat Backup...',
                text: 'Mohon tunggu, backup sedang dibuat',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Create form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("backup-management.create") }}';

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

function confirmRestore(id, filename) {
    Swal.fire({
        title: 'Konfirmasi Restore',
        text: `Apakah Anda yakin ingin restore database dari backup "${filename}"?`,
        html: '<div class="alert alert-warning"><i class="fas fa-exclamation-triangle me-2"></i><strong>Peringatan:</strong> Semua data saat ini akan diganti dengan data dari backup!</div>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ffc107',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Restore!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Restoring Database...',
                text: 'Mohon tunggu, database sedang di-restore',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Create form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/backup-management/${id}/restore`;

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

function confirmDelete(id, filename) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: `Apakah Anda yakin ingin menghapus backup "${filename}"?`,
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
            form.action = `/backup-management/${id}`;

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

function saveSettings() {
    Swal.fire({
        title: 'Berhasil!',
        text: 'Pengaturan backup berhasil disimpan',
        icon: 'success',
        confirmButtonText: 'OK'
    });
}

// Show success/error messages
document.addEventListener('DOMContentLoaded', function() {
    @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif

    @if(session('error'))
        Swal.fire({
            title: 'Error!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    @endif
});
</script>
@endsection
