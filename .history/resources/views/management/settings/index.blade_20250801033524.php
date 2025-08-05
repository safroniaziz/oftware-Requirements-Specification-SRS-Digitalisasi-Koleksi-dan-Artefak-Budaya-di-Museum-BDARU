@extends('layouts.dashboard.dashboard')

@section('title', 'Pengaturan - BDARU Museum')

@section('content')
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">

        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
            <!--begin::Col-->
            <div class="col-xl-6">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Pengaturan Umum</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Konfigurasi dasar aplikasi</span>
                        </h3>
                    </div>
                    <div class="card-body pt-2 pb-4">
                        <form action="{{ route('settings-management.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-6">
                                <label for="app_name" class="form-label fw-bold">Nama Aplikasi</label>
                                <input type="text" class="form-control" id="app_name" name="app_name"
                                       value="{{ $settings['app_name'] ?? 'BDARU Museum' }}" required>
                                <small class="text-muted">Nama yang akan ditampilkan di header dan title</small>
                            </div>

                            <div class="mb-6">
                                <label for="app_description" class="form-label fw-bold">Deskripsi Aplikasi</label>
                                <textarea class="form-control" id="app_description" name="app_description" rows="3">{{ $settings['app_description'] ?? 'Sistem Informasi Museum BDARU' }}</textarea>
                                <small class="text-muted">Deskripsi singkat tentang aplikasi</small>
                            </div>

                            <div class="mb-6">
                                <label for="contact_email" class="form-label fw-bold">Email Kontak</label>
                                <input type="email" class="form-control" id="contact_email" name="contact_email"
                                       value="{{ $settings['contact_email'] ?? '' }}">
                                <small class="text-muted">Email untuk kontak pengunjung</small>
                            </div>

                            <div class="mb-6">
                                <label for="contact_phone" class="form-label fw-bold">Telepon Kontak</label>
                                <input type="text" class="form-control" id="contact_phone" name="contact_phone"
                                       value="{{ $settings['contact_phone'] ?? '' }}">
                                <small class="text-muted">Nomor telepon untuk kontak</small>
                            </div>

                            <div class="mb-6">
                                <label for="address" class="form-label fw-bold">Alamat</label>
                                <textarea class="form-control" id="address" name="address" rows="3">{{ $settings['address'] ?? '' }}</textarea>
                                <small class="text-muted">Alamat lengkap museum</small>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>
                                    Simpan Pengaturan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-6">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Logo & Favicon</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Upload logo dan favicon</span>
                        </h3>
                    </div>
                    <div class="card-body pt-2 pb-4">
                        <form action="{{ route('settings-management.update-logo') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-6">
                                <label for="logo" class="form-label fw-bold">Logo Aplikasi</label>
                                <div class="d-flex align-items-center mb-3">
                                    @if(isset($settings['logo_path']) && $settings['logo_path'])
                                        <img src="{{ asset('storage/' . $settings['logo_path']) }}"
                                             alt="Logo" class="me-3" style="width: 100px; height: auto;">
                                    @else
                                        <div class="bg-light-primary rounded-3 d-flex align-items-center justify-content-center me-3"
                                             style="width: 100px; height: 60px;">
                                            <i class="fas fa-image text-primary"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                                        <small class="text-muted">Format: PNG, JPG, SVG. Maksimal 2MB</small>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="favicon" class="form-label fw-bold">Favicon</label>
                                <div class="d-flex align-items-center mb-3">
                                    @if(isset($settings['favicon_path']) && $settings['favicon_path'])
                                        <img src="{{ asset('storage/' . $settings['favicon_path']) }}"
                                             alt="Favicon" class="me-3" style="width: 32px; height: 32px;">
                                    @else
                                        <div class="bg-light-primary rounded-3 d-flex align-items-center justify-content-center me-3"
                                             style="width: 32px; height: 32px;">
                                            <i class="fas fa-star text-primary"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <input type="file" class="form-control" id="favicon" name="favicon" accept="image/*">
                                        <small class="text-muted">Format: ICO, PNG. Maksimal 1MB</small>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-upload me-2"></i>
                                    Upload Logo & Favicon
                                </button>
                            </div>
                        </form>
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
                            <span class="card-label fw-bold text-gray-800">Pengaturan Email</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Konfigurasi SMTP</span>
                        </h3>
                    </div>
                    <div class="card-body pt-2 pb-4">
                        <form action="{{ route('settings-management.update-email') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-6">
                                <label for="mail_host" class="form-label fw-bold">SMTP Host</label>
                                <input type="text" class="form-control" id="mail_host" name="mail_host"
                                       value="{{ $settings['mail_host'] ?? '' }}">
                                <small class="text-muted">Contoh: smtp.gmail.com</small>
                            </div>

                            <div class="mb-6">
                                <label for="mail_port" class="form-label fw-bold">SMTP Port</label>
                                <input type="number" class="form-control" id="mail_port" name="mail_port"
                                       value="{{ $settings['mail_port'] ?? '587' }}">
                                <small class="text-muted">Port SMTP (biasanya 587 atau 465)</small>
                            </div>

                            <div class="mb-6">
                                <label for="mail_username" class="form-label fw-bold">SMTP Username</label>
                                <input type="email" class="form-control" id="mail_username" name="mail_username"
                                       value="{{ $settings['mail_username'] ?? '' }}">
                                <small class="text-muted">Email yang digunakan untuk SMTP</small>
                            </div>

                            <div class="mb-6">
                                <label for="mail_password" class="form-label fw-bold">SMTP Password</label>
                                <input type="password" class="form-control" id="mail_password" name="mail_password"
                                       value="{{ $settings['mail_password'] ?? '' }}">
                                <small class="text-muted">Password atau app password</small>
                            </div>

                            <div class="mb-6">
                                <label for="mail_encryption" class="form-label fw-bold">Enkripsi</label>
                                <select class="form-select" id="mail_encryption" name="mail_encryption">
                                    <option value="tls" {{ ($settings['mail_encryption'] ?? '') == 'tls' ? 'selected' : '' }}>TLS</option>
                                    <option value="ssl" {{ ($settings['mail_encryption'] ?? '') == 'ssl' ? 'selected' : '' }}>SSL</option>
                                    <option value="" {{ ($settings['mail_encryption'] ?? '') == '' ? 'selected' : '' }}>Tidak Ada</option>
                                </select>
                                <small class="text-muted">Jenis enkripsi yang digunakan</small>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-envelope me-2"></i>
                                    Simpan Pengaturan Email
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-6">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Pengaturan Sosial Media</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Link sosial media</span>
                        </h3>
                    </div>
                    <div class="card-body pt-2 pb-4">
                        <form action="{{ route('settings-management.update-social') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-6">
                                <label for="facebook_url" class="form-label fw-bold">Facebook</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-facebook text-primary"></i></span>
                                    <input type="url" class="form-control" id="facebook_url" name="facebook_url"
                                           value="{{ $settings['facebook_url'] ?? '' }}" placeholder="https://facebook.com/...">
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="instagram_url" class="form-label fw-bold">Instagram</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-instagram text-danger"></i></span>
                                    <input type="url" class="form-control" id="instagram_url" name="instagram_url"
                                           value="{{ $settings['instagram_url'] ?? '' }}" placeholder="https://instagram.com/...">
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="twitter_url" class="form-label fw-bold">Twitter</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-twitter text-info"></i></span>
                                    <input type="url" class="form-control" id="twitter_url" name="twitter_url"
                                           value="{{ $settings['twitter_url'] ?? '' }}" placeholder="https://twitter.com/...">
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="youtube_url" class="form-label fw-bold">YouTube</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-youtube text-danger"></i></span>
                                    <input type="url" class="form-control" id="youtube_url" name="youtube_url"
                                           value="{{ $settings['youtube_url'] ?? '' }}" placeholder="https://youtube.com/...">
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-share-alt me-2"></i>
                                    Simpan Social Media
                                </button>
                            </div>
                        </form>
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
                            <span class="card-label fw-bold text-gray-800">Pengaturan Sistem</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Konfigurasi sistem dan cache</span>
                        </h3>
                    </div>
                    <div class="card-body pt-2 pb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-6">
                                    <label class="form-label fw-bold">Maintenance Mode</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="maintenance_mode"
                                               {{ ($settings['maintenance_mode'] ?? false) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="maintenance_mode">
                                            Aktifkan mode maintenance
                                        </label>
                                    </div>
                                    <small class="text-muted">Situs akan offline untuk pengunjung</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-6">
                                    <label class="form-label fw-bold">Debug Mode</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="debug_mode"
                                               {{ ($settings['debug_mode'] ?? false) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="debug_mode">
                                            Aktifkan debug mode
                                        </label>
                                    </div>
                                    <small class="text-muted">Untuk development dan troubleshooting</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-6">
                                    <label for="pagination_per_page" class="form-label fw-bold">Item per Halaman</label>
                                    <input type="number" class="form-control" id="pagination_per_page"
                                           value="{{ $settings['pagination_per_page'] ?? 12 }}" min="5" max="100">
                                    <small class="text-muted">Jumlah item yang ditampilkan per halaman</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-6">
                                    <label for="session_lifetime" class="form-label fw-bold">Session Lifetime (Menit)</label>
                                    <input type="number" class="form-control" id="session_lifetime"
                                           value="{{ $settings['session_lifetime'] ?? 120 }}" min="30" max="1440">
                                    <small class="text-muted">Lama waktu session user aktif</small>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div>
                                <button type="button" class="btn btn-warning" onclick="clearCache()">
                                    <i class="fas fa-broom me-2"></i>
                                    Clear Cache
                                </button>
                                <button type="button" class="btn btn-info" onclick="clearLogs()">
                                    <i class="fas fa-trash me-2"></i>
                                    Clear Logs
                                </button>
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary" onclick="saveSystemSettings()">
                                    <i class="fas fa-save me-2"></i>
                                    Simpan Pengaturan Sistem
                                </button>
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
function clearCache() {
    Swal.fire({
        title: 'Konfirmasi Clear Cache',
        text: 'Apakah Anda yakin ingin menghapus semua cache?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ffc107',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Clear Cache!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Clearing Cache...',
                text: 'Mohon tunggu, cache sedang dihapus',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Make AJAX request
            fetch('{{ route("settings-management.clear-cache") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Cache berhasil dihapus',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat menghapus cache',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        }
    });
}

function clearLogs() {
    Swal.fire({
        title: 'Konfirmasi Clear Logs',
        text: 'Apakah Anda yakin ingin menghapus semua logs?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#17a2b8',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Clear Logs!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Clearing Logs...',
                text: 'Mohon tunggu, logs sedang dihapus',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Make AJAX request
            fetch('{{ route("settings-management.clear-logs") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Logs berhasil dihapus',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat menghapus logs',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        }
    });
}

function saveSystemSettings() {
    const maintenanceMode = document.getElementById('maintenance_mode').checked;
    const debugMode = document.getElementById('debug_mode').checked;
    const paginationPerPage = document.getElementById('pagination_per_page').value;
    const sessionLifetime = document.getElementById('session_lifetime').value;

    // Show loading
    Swal.fire({
        title: 'Menyimpan Pengaturan...',
        text: 'Mohon tunggu, pengaturan sedang disimpan',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Make AJAX request
    fetch('{{ route("settings-management.update-system") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            maintenance_mode: maintenanceMode,
            debug_mode: debugMode,
            pagination_per_page: paginationPerPage,
            session_lifetime: sessionLifetime
        })
    })
    .then(response => response.json())
    .then(data => {
        Swal.fire({
            title: 'Berhasil!',
            text: 'Pengaturan sistem berhasil disimpan',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    })
    .catch(error => {
        Swal.fire({
            title: 'Error!',
            text: 'Terjadi kesalahan saat menyimpan pengaturan',
            icon: 'error',
            confirmButtonText: 'OK'
        });
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
