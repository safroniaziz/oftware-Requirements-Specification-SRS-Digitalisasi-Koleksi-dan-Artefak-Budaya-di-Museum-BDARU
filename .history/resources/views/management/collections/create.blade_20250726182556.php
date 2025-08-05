@extends('layouts.dashboard.dashboard')

@section('title', 'Tambah Koleksi - BDARU Museum')

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
                    <h2 class="fw-bold">Tambah Koleksi Baru</h2>
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Back button-->
                        <a href="{{ route('collections-management.index') }}" class="btn btn-light me-3">
                            <i class="ki-duotone ki-arrow-left fs-2"></i>
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
                <!--begin::Wizard Steps-->
                <div class="wizard-steps mb-8">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="step-item active" data-step="1">
                            <div class="step-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="step-label">Informasi Dasar</div>
                        </div>
                        <div class="step-line"></div>
                        <div class="step-item" data-step="2">
                            <div class="step-icon">
                                <i class="fas fa-image"></i>
                            </div>
                            <div class="step-label">Gambar & Galeri</div>
                        </div>
                        <div class="step-line"></div>
                        <div class="step-item" data-step="3">
                            <div class="step-icon">
                                <i class="fas fa-history"></i>
                            </div>
                            <div class="step-label">Sejarah</div>
                        </div>
                        <div class="step-line"></div>
                        <div class="step-item" data-step="4">
                            <div class="step-icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <div class="step-label">Spesifikasi</div>
                        </div>
                        <div class="step-line"></div>
                        <div class="step-item" data-step="5">
                            <div class="step-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="step-label">Selesai</div>
                        </div>
                    </div>
                </div>
                <!--end::Wizard Steps-->

                <form action="{{ route('collections-management.store') }}" method="POST" enctype="multipart/form-data" id="collection-form">
                    @csrf

                    <!-- Step 1: Informasi Dasar -->
                    <div class="wizard-step active" data-step="1">
                        <div class="row">
                            <div class="col-md-8">
                                <!--begin::Form group-->
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Nama Koleksi</label>
                                    <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan nama koleksi" value="{{ old('name') }}" required />
                                    @error('name')
                                        <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!--end::Form group-->

                                <!--begin::Form group-->
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Kategori</label>
                                    <select name="category_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih kategori" required>
                                        <option value="">Pilih kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!--end::Form group-->

                                <!--begin::Form group-->
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Deskripsi</label>
                                    <textarea name="description" class="form-control form-control-solid" rows="5" placeholder="Masukkan deskripsi koleksi" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!--end::Form group-->

                                <div class="row">
                                    <!--begin::Form group-->
                                    <div class="col-md-6 fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Periode Tahun</label>
                                        <input type="text" name="year_period" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Contoh: 1920-1930" value="{{ old('year_period') }}" />
                                        @error('year_period')
                                            <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Form group-->

                                    <!--begin::Form group-->
                                    <div class="col-md-6 fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Lokasi Asal</label>
                                        <input type="text" name="origin_location" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Contoh: Jawa Tengah" value="{{ old('origin_location') }}" />
                                        @error('origin_location')
                                            <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Form group-->
                                </div>

                                <div class="row">
                                    <!--begin::Form group-->
                                    <div class="col-md-4 fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Material</label>
                                        <input type="text" name="material" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Contoh: Kayu, Logam, Kain" value="{{ old('material') }}" />
                                        @error('material')
                                            <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Form group-->

                                    <!--begin::Form group-->
                                    <div class="col-md-4 fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Dimensi</label>
                                        <input type="text" name="dimensions" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Contoh: 50cm x 30cm x 20cm" value="{{ old('dimensions') }}" />
                                        @error('dimensions')
                                            <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Form group-->

                                    <!--begin::Form group-->
                                    <div class="col-md-4 fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Rating</label>
                                        <input type="number" name="rating" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="0.00" step="0.01" min="0" max="5" value="{{ old('rating') }}" />
                                        @error('rating')
                                            <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Form group-->
                                </div>

                                <div class="row">
                                    <!--begin::Form group-->
                                    <div class="col-md-6 fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Status</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }} />
                                            <label class="form-check-label fw-semibold fs-6">Aktif</label>
                                        </div>
                                        @error('is_active')
                                            <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Form group-->

                                    <!--begin::Form group-->
                                    <div class="col-md-6 fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Koleksi Unggulan</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} />
                                            <label class="form-check-label fw-semibold fs-6">Tampilkan di halaman utama</label>
                                        </div>
                                        @error('is_featured')
                                            <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Form group-->
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!--begin::Form group-->
                                <div class="fv-row mb-7">
                                    <label class="fw-semibold fs-6 mb-2">Gambar Utama</label>
                                    <div class="image-input image-input-outline" data-kt-image-input="true">
                                        <div class="image-input-wrapper w-150px h-150px" style="background-image: url('{{ asset('assets/media/avatars/blank.png') }}')"></div>
                                        <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Ubah gambar">
                                            <i class="ki-duotone ki-pencil fs-7">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <input type="file" name="image" accept=".png, .jpg, .jpeg, .gif" />
                                            <input type="hidden" name="avatar_remove" />
                                        </label>
                                        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Batal">
                                            <i class="ki-duotone ki-cross fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus gambar">
                                            <i class="ki-duotone ki-cross fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                    </div>
                                    <div class="form-text">Format yang diizinkan: png, jpg, jpeg, gif. Maksimal 2MB.</div>
                                    @error('image')
                                        <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!--end::Form group-->
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Gambar & Galeri -->
                    <div class="wizard-step" data-step="2">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="mb-4">Galeri Gambar</h4>
                                <div class="fv-row mb-7">
                                    <label class="fw-semibold fs-6 mb-2">Upload Gambar Galeri</label>
                                    <input type="file" name="gallery_images[]" class="form-control form-control-solid mb-3 mb-lg-0" accept=".png, .jpg, .jpeg, .gif" multiple />
                                    <div class="form-text">Upload multiple gambar untuk galeri (opsional). Format: png, jpg, jpeg, gif. Maksimal 2MB per gambar.</div>
                                    @error('gallery_images.*')
                                        <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="fv-row mb-7">
                                    <label class="fw-semibold fs-6 mb-2">Signifikansi Budaya</label>
                                    <textarea name="cultural_significance" class="form-control form-control-solid" rows="4" placeholder="Masukkan signifikansi budaya koleksi">{{ old('cultural_significance') }}</textarea>
                                    <div class="form-text">Konten ini akan ditampilkan di bagian "Signifikansi Budaya"</div>
                                    @error('cultural_significance')
                                        <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Sejarah -->
                    <div class="wizard-step" data-step="3">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="mb-4">Timeline Sejarah</h4>
                                <div id="history-container">
                                    <div class="history-item mb-4 p-4 border rounded">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="fw-semibold fs-6 mb-2">Judul</label>
                                                <input type="text" name="history_titles[]" class="form-control form-control-solid" placeholder="Contoh: Periode Pembuatan" />
                                            </div>
                                            <div class="col-md-3">
                                                <label class="fw-semibold fs-6 mb-2">Tahun</label>
                                                <input type="text" name="history_years[]" class="form-control form-control-solid" placeholder="Contoh: 1920-1930" />
                                            </div>
                                            <div class="col-md-5">
                                                <label class="fw-semibold fs-6 mb-2">Deskripsi</label>
                                                <textarea name="history_descriptions[]" class="form-control form-control-solid" rows="2" placeholder="Deskripsi timeline"></textarea>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-icon btn-danger btn-sm mt-8" onclick="removeHistoryItem(this)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-light-primary" onclick="addHistoryItem()">
                                    <i class="fas fa-plus"></i> Tambah Timeline
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Spesifikasi -->
                    <div class="wizard-step" data-step="4">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="mb-4">Spesifikasi Teknis</h4>
                                <div class="fv-row mb-7">
                                    <label class="fw-semibold fs-6 mb-2">Overview Spesifikasi Teknis</label>
                                    <textarea name="technical_overview" class="form-control form-control-solid" rows="4" placeholder="Masukkan overview spesifikasi teknis koleksi">{{ old('technical_overview') }}</textarea>
                                    <div class="form-text">Konten ini akan ditampilkan di tab "Details" bagian spesifikasi teknis</div>
                                    @error('technical_overview')
                                        <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <h4 class="mb-4">Informasi Konservasi</h4>
                                <div class="fv-row mb-7">
                                    <label class="fw-semibold fs-6 mb-2">Status Konservasi</label>
                                    <input type="text" name="conservation_status" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Contoh: Baik, Perlu Perbaikan" value="{{ old('conservation_status') }}" />
                                    @error('conservation_status')
                                        <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="fv-row mb-7">
                                    <label class="fw-semibold fs-6 mb-2">Overview Konservasi</label>
                                    <textarea name="conservation_overview" class="form-control form-control-solid" rows="4" placeholder="Masukkan overview konservasi koleksi">{{ old('conservation_overview') }}</textarea>
                                    <div class="form-text">Konten ini akan ditampilkan di tab "Details" bagian informasi konservasi</div>
                                    @error('conservation_overview')
                                        <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 5: Selesai -->
                    <div class="wizard-step" data-step="5">
                        <div class="text-center">
                            <div class="mb-4">
                                <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                            </div>
                            <h4 class="mb-4">Siap Menyimpan Koleksi</h4>
                            <p class="text-muted">Semua informasi telah diisi. Klik tombol "Simpan Koleksi" untuk menyimpan data.</p>
                        </div>
                    </div>

                    <!--begin::Wizard Navigation-->
                    <div class="d-flex justify-content-between pt-15">
                        <button type="button" class="btn btn-light" id="prev-btn" onclick="prevStep()" style="display: none;">
                            <i class="fas fa-arrow-left"></i> Sebelumnya
                        </button>
                        <div class="ms-auto">
                            <button type="button" class="btn btn-primary" id="next-btn" onclick="nextStep()">
                                Selanjutnya <i class="fas fa-arrow-right"></i>
                            </button>
                            <button type="submit" class="btn btn-success" id="submit-btn" style="display: none;">
                                <i class="fas fa-save"></i> Simpan Koleksi
                            </button>
                        </div>
                    </div>
                    <!--end::Wizard Navigation-->
                </form>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->

<style>
.wizard-steps {
    position: relative;
}

.step-item {
    text-align: center;
    flex: 1;
}

.step-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    transition: all 0.3s ease;
}

.step-item.active .step-icon {
    background: #0d6efd;
    color: white;
}

.step-item.completed .step-icon {
    background: #198754;
    color: white;
}

.step-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #6c757d;
}

.step-item.active .step-label {
    color: #0d6efd;
    font-weight: 600;
}

.step-line {
    flex: 1;
    height: 2px;
    background: #e9ecef;
    margin: 25px 10px 0;
}

.wizard-step {
    display: none;
}

.wizard-step.active {
    display: block;
}

.history-item {
    background: #f8f9fa;
    border: 1px solid #dee2e6 !important;
}
</style>

<script>
let currentStep = 1;
const totalSteps = 5;

function updateWizardSteps() {
    // Update step indicators
    document.querySelectorAll('.step-item').forEach((item, index) => {
        const stepNumber = index + 1;
        item.classList.remove('active', 'completed');

        if (stepNumber < currentStep) {
            item.classList.add('completed');
        } else if (stepNumber === currentStep) {
            item.classList.add('active');
        }
    });

    // Update step content
    document.querySelectorAll('.wizard-step').forEach((step, index) => {
        const stepNumber = index + 1;
        step.classList.remove('active');

        if (stepNumber === currentStep) {
            step.classList.add('active');
        }
    });

    // Update navigation buttons
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const submitBtn = document.getElementById('submit-btn');

    if (currentStep === 1) {
        prevBtn.style.display = 'none';
    } else {
        prevBtn.style.display = 'inline-block';
    }

    if (currentStep === totalSteps) {
        nextBtn.style.display = 'none';
        submitBtn.style.display = 'inline-block';
    } else {
        nextBtn.style.display = 'inline-block';
        submitBtn.style.display = 'none';
    }
}

function nextStep() {
    if (currentStep < totalSteps) {
        currentStep++;
        updateWizardSteps();
    }
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        updateWizardSteps();
    }
}

function addHistoryItem() {
    const container = document.getElementById('history-container');
    const newItem = document.createElement('div');
    newItem.className = 'history-item mb-4 p-4 border rounded';
    newItem.innerHTML = `
        <div class="row">
            <div class="col-md-3">
                <label class="fw-semibold fs-6 mb-2">Judul</label>
                <input type="text" name="history_titles[]" class="form-control form-control-solid" placeholder="Contoh: Periode Pembuatan" />
            </div>
            <div class="col-md-3">
                <label class="fw-semibold fs-6 mb-2">Tahun</label>
                <input type="text" name="history_years[]" class="form-control form-control-solid" placeholder="Contoh: 1920-1930" />
            </div>
            <div class="col-md-5">
                <label class="fw-semibold fs-6 mb-2">Deskripsi</label>
                <textarea name="history_descriptions[]" class="form-control form-control-solid" rows="2" placeholder="Deskripsi timeline"></textarea>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-icon btn-danger btn-sm mt-8" onclick="removeHistoryItem(this)">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    `;
    container.appendChild(newItem);
}

function removeHistoryItem(button) {
    button.closest('.history-item').remove();
}

// Initialize wizard
document.addEventListener('DOMContentLoaded', function() {
    updateWizardSteps();
});
</script>
@endsection
