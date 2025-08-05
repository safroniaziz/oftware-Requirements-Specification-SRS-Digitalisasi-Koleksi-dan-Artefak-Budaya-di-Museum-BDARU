@extends('layouts.dashboard.dashboard')

@section('title', 'Edit Tim Museum - BDARU Museum')

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
                    <h2 class="fw-bold">Edit Tim: {{ $teamMember->name }}</h2>
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Back-->
                        <a href="{{ route('team-management.index') }}" class="btn btn-secondary me-2">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali
                        </a>
                        <!--end::Back-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body py-4">
                <form action="{{ route('team-management.update', $teamMember->id) }}" method="POST" id="teamForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="name" class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" value="{{ old('name', $teamMember->name) }}"
                                               placeholder="Masukkan nama lengkap" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="position" class="form-label fw-bold">Jabatan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('position') is-invalid @enderror"
                                               id="position" name="position" value="{{ old('position', $teamMember->position) }}"
                                               placeholder="Masukkan jabatan" required>
                                        @error('position')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="email" class="form-label fw-bold">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               id="email" name="email" value="{{ old('email', $teamMember->email) }}"
                                               placeholder="Masukkan email">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="phone" class="form-label fw-bold">Telepon</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                               id="phone" name="phone" value="{{ old('phone', $teamMember->phone) }}"
                                               placeholder="Masukkan nomor telepon">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="bio" class="form-label fw-bold">Biografi</label>
                                <textarea class="form-control @error('bio') is-invalid @enderror"
                                          id="bio" name="bio" rows="4"
                                          placeholder="Masukkan biografi singkat">{{ old('bio', $teamMember->bio) }}</textarea>
                                @error('bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Deskripsi singkat tentang pengalaman dan keahlian</small>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="department" class="form-label fw-bold">Departemen</label>
                                        <input type="text" class="form-control @error('department') is-invalid @enderror"
                                               id="department" name="department" value="{{ old('department', $teamMember->department) }}"
                                               placeholder="Masukkan departemen">
                                        @error('department')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-6">
                                        <label for="join_date" class="form-label fw-bold">Tanggal Bergabung</label>
                                        <input type="date" class="form-control @error('join_date') is-invalid @enderror"
                                               id="join_date" name="join_date" value="{{ old('join_date', $teamMember->join_date) }}">
                                        @error('join_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="photo" class="form-label fw-bold">Foto</label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                       id="photo" name="photo" accept="image/*">
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Format: JPG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah foto</small>

                                <div id="photo-preview" class="mt-3">
                                    @if($teamMember->photo_path)
                                        <img id="preview-img" src="{{ asset('storage/' . $teamMember->photo_path) }}" alt="Current Photo" class="img-thumbnail" style="max-width: 200px;">
                                        <div class="mt-2">
                                            <small class="text-muted">Foto saat ini</small>
                                        </div>
                                    @else
                                        <div class="bg-light-primary rounded-3 d-flex align-items-center justify-content-center"
                                             style="width: 200px; height: 200px;">
                                            <i class="fas fa-user text-primary fs-2x"></i>
                                        </div>
                                        <div class="mt-2">
                                            <small class="text-muted">Tidak ada foto</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-6">
                                <label class="form-label fw-bold">Status</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                           value="1" {{ old('is_active', !$teamMember->deleted_at) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Tim Aktif
                                    </label>
                                </div>
                                <small class="text-muted">Tim aktif akan ditampilkan di frontend</small>
                            </div>

                            <div class="mb-6">
                                <label for="role" class="form-label fw-bold">Peran</label>
                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
                                    <option value="">Pilih peran</option>
                                    <option value="director" {{ old('role', $teamMember->role) == 'director' ? 'selected' : '' }}>Direktur</option>
                                    <option value="curator" {{ old('role', $teamMember->role) == 'curator' ? 'selected' : '' }}>Kurator</option>
                                    <option value="educator" {{ old('role', $teamMember->role) == 'educator' ? 'selected' : '' }}>Edukator</option>
                                    <option value="conservator" {{ old('role', $teamMember->role) == 'conservator' ? 'selected' : '' }}>Konservator</option>
                                    <option value="researcher" {{ old('role', $teamMember->role) == 'researcher' ? 'selected' : '' }}>Peneliti</option>
                                    <option value="administrator" {{ old('role', $teamMember->role) == 'administrator' ? 'selected' : '' }}>Administrator</option>
                                    <option value="staff" {{ old('role', $teamMember->role) == 'staff' ? 'selected' : '' }}>Staff</option>
                                    <option value="volunteer" {{ old('role', $teamMember->role) == 'volunteer' ? 'selected' : '' }}>Relawan</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="expertise" class="form-label fw-bold">Keahlian</label>
                                <textarea class="form-control @error('expertise') is-invalid @enderror"
                                          id="expertise" name="expertise" rows="3"
                                          placeholder="Keahlian khusus">{{ old('expertise', $teamMember->expertise) }}</textarea>
                                @error('expertise')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Keahlian atau spesialisasi</small>
                            </div>

                            <div class="mb-6">
                                <label for="education" class="form-label fw-bold">Pendidikan</label>
                                <textarea class="form-control @error('education') is-invalid @enderror"
                                          id="education" name="education" rows="3"
                                          placeholder="Riwayat pendidikan">{{ old('education', $teamMember->education) }}</textarea>
                                @error('education')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Gelar dan institusi pendidikan</small>
                            </div>

                            <div class="mb-6">
                                <label for="order" class="form-label fw-bold">Urutan Tampilan</label>
                                <input type="number" class="form-control @error('order') is-invalid @enderror"
                                       id="order" name="order" value="{{ old('order', $teamMember->order ?? 0) }}"
                                       min="0" placeholder="Urutan dalam daftar tim">
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Angka kecil akan ditampilkan lebih dulu</small>
                            </div>

                            <div class="mb-6">
                                <div class="alert alert-info">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <div>
                                            <strong>Info:</strong> Tim ditambahkan pada
                                            <strong>{{ $teamMember->created_at->format('d M Y H:i') }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" onclick="resetForm()">
                            <i class="fas fa-undo me-2"></i>
                            Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            Update Tim
                        </button>
                    </div>
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
// Photo preview
document.getElementById('photo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('photo-preview');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <img id="preview-img" src="${e.target.result}" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                <div class="mt-2">
                    <small class="text-muted">Preview foto baru</small>
                </div>
            `;
        }
        reader.readAsDataURL(file);
    } else {
        // Reset to original photo
        @if($teamMember->photo_path)
            preview.innerHTML = `
                <img id="preview-img" src="{{ asset('storage/' . $teamMember->photo_path) }}" alt="Current Photo" class="img-thumbnail" style="max-width: 200px;">
                <div class="mt-2">
                    <small class="text-muted">Foto saat ini</small>
                </div>
            `;
        @else
            preview.innerHTML = `
                <div class="bg-light-primary rounded-3 d-flex align-items-center justify-content-center"
                     style="width: 200px; height: 200px;">
                    <i class="fas fa-user text-primary fs-2x"></i>
                </div>
                <div class="mt-2">
                    <small class="text-muted">Tidak ada foto</small>
                </div>
            `;
        @endif
    }
});

// Form validation
document.getElementById('teamForm').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    const position = document.getElementById('position').value.trim();

    if (!name || !position) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Nama dan jabatan wajib diisi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }

    // Show loading
    Swal.fire({
        title: 'Mengupdate...',
        text: 'Mohon tunggu, tim sedang diupdate',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
});

function resetForm() {
    Swal.fire({
        title: 'Konfirmasi Reset',
        text: 'Apakah Anda yakin ingin mereset form ke data asli?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#6c757d',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Reset!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Reset to original values
            document.getElementById('name').value = '{{ $teamMember->name }}';
            document.getElementById('position').value = '{{ $teamMember->position }}';
            document.getElementById('email').value = '{{ $teamMember->email }}';
            document.getElementById('phone').value = '{{ $teamMember->phone }}';
            document.getElementById('bio').value = '{{ $teamMember->bio }}';
            document.getElementById('department').value = '{{ $teamMember->department }}';
            document.getElementById('join_date').value = '{{ $teamMember->join_date }}';
            document.getElementById('role').value = '{{ $teamMember->role }}';
            document.getElementById('expertise').value = '{{ $teamMember->expertise }}';
            document.getElementById('education').value = '{{ $teamMember->education }}';
            document.getElementById('order').value = '{{ $teamMember->order ?? 0 }}';
            document.getElementById('is_active').checked = {{ !$teamMember->deleted_at ? 'true' : 'false' }};

            // Reset photo preview
            const photoPreview = document.getElementById('photo-preview');
            @if($teamMember->photo_path)
                photoPreview.innerHTML = `
                    <img id="preview-img" src="{{ asset('storage/' . $teamMember->photo_path) }}" alt="Current Photo" class="img-thumbnail" style="max-width: 200px;">
                    <div class="mt-2">
                        <small class="text-muted">Foto saat ini</small>
                    </div>
                `;
            @else
                photoPreview.innerHTML = `
                    <div class="bg-light-primary rounded-3 d-flex align-items-center justify-content-center"
                         style="width: 200px; height: 200px;">
                        <i class="fas fa-user text-primary fs-2x"></i>
                    </div>
                    <div class="mt-2">
                        <small class="text-muted">Tidak ada foto</small>
                    </div>
                `;
            @endif
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
