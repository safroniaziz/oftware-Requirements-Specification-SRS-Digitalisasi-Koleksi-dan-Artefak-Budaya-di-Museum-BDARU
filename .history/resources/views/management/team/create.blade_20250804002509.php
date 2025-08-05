@extends('layouts.dashboard.dashboard')

@section('title', 'Tambah Anggota Tim - BDARU Museum')

@section('content')
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2 class="fw-bold">Tambah Anggota Tim Baru</h2>
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Back button-->
                        <a href="{{ route('team-members-management.index') }}" class="btn btn-secondary me-2">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali
                        </a>
                        <!--end::Back button-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body py-4">
                <form action="{{ route('team-members-management.store') }}" method="POST" enctype="multipart/form-data" id="teamForm">
                    @csrf

                    <div class="row">
                        <!--begin::Main Content-->
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Informasi Anggota Tim</h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-4">
                                        <label for="name" class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" value="{{ old('name') }}"
                                               placeholder="Masukkan nama lengkap" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Nama lengkap anggota tim</div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="position" class="form-label fw-bold">Jabatan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('position') is-invalid @enderror"
                                               id="position" name="position" value="{{ old('position') }}"
                                               placeholder="Masukkan jabatan" required>
                                        @error('position')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Jabatan atau posisi dalam tim</div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="description" class="form-label fw-bold">Deskripsi</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                                  id="description" name="description" rows="4"
                                                  placeholder="Masukkan deskripsi atau bio">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Deskripsi singkat tentang anggota tim</div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="email" class="form-label fw-bold">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               id="email" name="email" value="{{ old('email') }}"
                                               placeholder="Masukkan email">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Alamat email untuk kontak</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label for="linkedin" class="form-label fw-bold">LinkedIn</label>
                                                <input type="url" class="form-control @error('linkedin') is-invalid @enderror"
                                                       id="linkedin" name="linkedin" value="{{ old('linkedin') }}"
                                                       placeholder="https://linkedin.com/in/username">
                                                @error('linkedin')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="form-text">Profil LinkedIn (opsional)</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label for="twitter" class="form-label fw-bold">Twitter</label>
                                                <input type="url" class="form-control @error('twitter') is-invalid @enderror"
                                                       id="twitter" name="twitter" value="{{ old('twitter') }}"
                                                       placeholder="https://twitter.com/username">
                                                @error('twitter')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="form-text">Profil Twitter (opsional)</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="photo" class="form-label fw-bold">Foto</label>
                                        <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                               id="photo" name="photo" accept="image/*">
                                        @error('photo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Upload foto anggota tim (opsional)</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Main Content-->

                        <!--begin::Sidebar-->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Pengaturan</h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Status</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                                   value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                Anggota Tim Aktif
                                            </label>
                                        </div>
                                        <div class="form-text">Anggota tim aktif akan ditampilkan di frontend</div>
                                    </div>

                                    <div class="alert alert-info">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-info-circle me-2"></i>
                                            <div>
                                                <strong>Info:</strong> Anggota tim akan dibuat dengan pengaturan default
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Sidebar-->
                    </div>

                    <!--begin::Form Actions-->
                    <div class="d-flex justify-content-end mt-6">
                        <button type="button" class="btn btn-secondary me-2" onclick="resetForm()">
                            <i class="fas fa-undo me-2"></i>
                            Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            Simpan Anggota Tim
                        </button>
                    </div>
                    <!--end::Form Actions-->
                </form>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->

<script>
// Form validation and submission
document.getElementById('teamForm').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    const position = document.getElementById('position').value.trim();

    if (!name) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Nama anggota tim wajib diisi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    if (!position) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Jabatan anggota tim wajib diisi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    // Show confirmation
    e.preventDefault();
    Swal.fire({
        title: 'Konfirmasi Simpan',
        text: 'Apakah Anda yakin ingin menyimpan anggota tim ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Simpan!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Menyimpan...',
                text: 'Mohon tunggu, anggota tim sedang disimpan',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Submit form
            document.getElementById('teamForm').submit();
        }
    });
});

function resetForm() {
    Swal.fire({
        title: 'Konfirmasi Reset',
        text: 'Apakah Anda yakin ingin mereset form?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#6c757d',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Reset!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Reset form
            document.getElementById('teamForm').reset();
            document.getElementById('is_active').checked = true;
        }
    });
}

// Show validation errors
document.addEventListener('DOMContentLoaded', function() {
    @if($errors->any())
        Swal.fire({
            title: 'Error!',
            html: `
                <div class="text-start">
                    <p>Terjadi kesalahan pada form:</p>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            `,
            icon: 'error',
            confirmButtonText: 'OK'
        });
    @endif
});
</script>
@endsection
