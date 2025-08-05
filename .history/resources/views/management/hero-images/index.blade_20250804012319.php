@extends('layouts.dashboard.dashboard')

@section('title', 'Manajemen Hero Images')

@section('content')
<style>
    .hero-img-thumb {
        width: 90px;
        height: 60px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        border: 2px solid #f3f6f9;
    }
    .table-hero th, .table-hero td {
        vertical-align: middle !important;
    }
    .badge-status {
        font-size: 0.85rem;
        padding: 0.4em 0.8em;
        border-radius: 0.5rem;
    }
    .badge-order {
        background: #f3f6f9;
        color: #3f4254;
        font-weight: 600;
        border-radius: 0.5rem;
        padding: 0.4em 0.8em;
    }
    .btn-action {
        padding: 0.35rem 0.7rem;
        font-size: 0.95rem;
        border-radius: 0.45rem;
    }
    .table-hero tbody tr:hover {
        background: #f3f6f9;
    }
    @media (max-width: 768px) {
        .table-hero th, .table-hero td {
            font-size: 0.95rem;
            padding: 0.5rem 0.5rem;
        }
    }
</style>
<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow-sm rounded-4 border-0 mb-8">
                <div class="card-header bg-white border-0 rounded-top-4 d-flex flex-wrap flex-md-nowrap align-items-center justify-content-between py-4 px-4 px-md-6">
                    <div>
                        <h2 class="fw-bold mb-1 text-dark">Manajemen Hero Images</h2>
                        <div class="text-muted">Kelola gambar slider di halaman beranda museum</div>
                    </div>
                    <a href="{{ route('hero-images-management.create') }}" class="btn btn-primary btn-lg rounded-3 shadow-sm">
                        <i class="fas fa-plus me-2"></i> Tambah Hero Image
                    </a>
                </div>
                <div class="card-body p-0">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show m-4" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-hover table-hero align-middle mb-0">
                            <thead class="bg-light-primary">
                                <tr class="fw-semibold fs-6 text-muted">
                                    <th class="ps-4">Gambar</th>
                                    <th>Judul</th>
                                    <th>Subtitle</th>
                                    <th>Urutan</th>
                                    <th>Status</th>
                                    <th>Tanggal Dibuat</th>
                                    <th class="text-end pe-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($heroImages as $heroImage)
                                    <tr>
                                        <td class="ps-4">
                                            @if($heroImage->image_path)
                                                <img src="{{ asset('storage/' . $heroImage->image_path) }}" alt="{{ $heroImage->alt_text }}" class="hero-img-thumb" />
                                            @else
                                                <div class="bg-light-secondary rounded d-flex align-items-center justify-content-center" style="width:90px;height:60px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="fw-bold text-dark mb-1">{{ $heroImage->title }}</div>
                                            <div class="text-muted small">{{ Str::limit($heroImage->description, 50) }}</div>
                                        </td>
                                        <td>
                                            <span class="text-dark">{{ $heroImage->subtitle }}</span>
                                        </td>
                                        <td>
                                            <span class="badge-order">{{ $heroImage->sort_order }}</span>
                                        </td>
                                        <td>
                                            @if($heroImage->is_active)
                                                <span class="badge-status bg-success bg-opacity-10 text-success">
                                                    <i class="fas fa-check-circle me-1"></i>Aktif
                                                </span>
                                            @else
                                                <span class="badge-status bg-danger bg-opacity-10 text-danger">
                                                    <i class="fas fa-times-circle me-1"></i>Nonaktif
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-muted small">{{ $heroImage->created_at->format('d M Y H:i') }}</span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('hero-images-management.edit', $heroImage->id) }}" class="btn btn-action btn-light-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-action btn-light-danger" onclick="confirmDelete({{ $heroImage->id }}, '{{ $heroImage->title }}')">
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
                                                    <i class="fas fa-plus me-2"></i> Tambah Hero Image
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
</script>
@endpush
