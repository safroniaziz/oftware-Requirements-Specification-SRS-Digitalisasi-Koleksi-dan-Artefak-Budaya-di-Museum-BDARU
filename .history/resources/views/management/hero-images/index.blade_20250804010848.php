@extends('layouts.dashboard.dashboard')

@section('title', 'Manajemen Hero Images')

@section('content')
<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
        @include('layouts.dashboard._sidebar')

        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            @include('layouts.dashboard._header')

            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <div id="kt_content_container" class="container-xxl">
                        <!-- Page Header -->
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                Manajemen Hero Images
                            </h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">Hero Images</li>
                            </ul>
                        </div>

                        <!-- Success/Error Messages -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <div>
                                <h3 class="fw-bold text-dark mb-0">Daftar Hero Images</h3>
                                <p class="text-muted">Kelola gambar slider di halaman beranda</p>
                            </div>
                            <a href="{{ route('hero-images-management.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>
                                Tambah Hero Image
                            </a>
                        </div>

                        <!-- Hero Images Table -->
                        <div class="card shadow-sm">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover table-row-bordered gy-5">
                                        <thead class="bg-light-primary">
                                            <tr class="fw-semibold fs-6 text-muted">
                                                <th class="ps-6">Gambar</th>
                                                <th>Judul</th>
                                                <th>Subtitle</th>
                                                <th>Urutan</th>
                                                <th>Status</th>
                                                <th>Tanggal Dibuat</th>
                                                <th class="text-end pe-6">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($heroImages as $heroImage)
                                                <tr>
                                                    <td class="ps-6">
                                                        <div class="d-flex align-items-center">
                                                            @if($heroImage->image_path)
                                                                <div class="symbol symbol-50px me-5">
                                                                    <img src="{{ asset('storage/' . $heroImage->image_path) }}"
                                                                         alt="{{ $heroImage->alt_text }}"
                                                                         class="rounded"
                                                                         style="width: 80px; height: 60px; object-fit: cover;">
                                                                </div>
                                                            @else
                                                                <div class="symbol symbol-50px me-5 bg-light-secondary rounded d-flex align-items-center justify-content-center">
                                                                    <i class="fas fa-image text-muted"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-column">
                                                            <span class="fw-bold text-dark">{{ $heroImage->title }}</span>
                                                            <span class="text-muted fs-7">{{ Str::limit($heroImage->description, 50) }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="text-dark">{{ $heroImage->subtitle }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light-primary">{{ $heroImage->sort_order }}</span>
                                                    </td>
                                                    <td>
                                                        @if($heroImage->is_active)
                                                            <span class="badge badge-light-success">
                                                                <i class="fas fa-check-circle me-1"></i>
                                                                Aktif
                                                            </span>
                                                        @else
                                                            <span class="badge badge-light-danger">
                                                                <i class="fas fa-times-circle me-1"></i>
                                                                Nonaktif
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="text-muted">{{ $heroImage->created_at->format('d M Y H:i') }}</span>
                                                    </td>
                                                    <td class="text-end pe-6">
                                                        <div class="d-flex justify-content-end">
                                                            <a href="{{ route('hero-images-management.edit', $heroImage->id) }}"
                                                               class="btn btn-sm btn-light-primary me-2">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button type="button"
                                                                    class="btn btn-sm btn-light-danger"
                                                                    onclick="confirmDelete({{ $heroImage->id }}, '{{ $heroImage->title }}')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center py-10">
                                                        <div class="d-flex flex-column align-items-center">
                                                            <i class="fas fa-images text-muted fs-2x mb-3"></i>
                                                            <h4 class="text-muted mb-2">Belum ada hero images</h4>
                                                            <p class="text-muted mb-5">Tambahkan hero image pertama untuk slider beranda</p>
                                                            <a href="{{ route('hero-images-management.create') }}" class="btn btn-primary">
                                                                <i class="fas fa-plus me-2"></i>
                                                                Tambah Hero Image
                                                            </a>
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
                </div>
            </div>

            @include('layouts.dashboard._footer')
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus hero image "<span id="heroImageTitle"></span>"?</p>
                <p class="text-muted small">Gambar akan tetap tersimpan di storage untuk keamanan data.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function confirmDelete(id, title) {
    document.getElementById('heroImageTitle').textContent = title;
    document.getElementById('deleteForm').action = `/admin/hero-images/${id}`;

    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

// SweetAlert2 for success/error messages
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false
    });
@endif

@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: '{{ session('error') }}',
        timer: 3000,
        showConfirmButton: false
    });
@endif
</script>
@endpush
