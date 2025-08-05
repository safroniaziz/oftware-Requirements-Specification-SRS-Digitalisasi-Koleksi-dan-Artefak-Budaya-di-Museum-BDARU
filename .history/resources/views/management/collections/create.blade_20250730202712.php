@extends('layouts.dashboard.dashboard')

@section('title', 'Tambah Koleksi - BDARU Museum')

@section('content')
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Card-->
        <div class="card border-0 bg-transparent">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6 bg-transparent">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2 class="fw-bold text-dark">
                        <i class="fas fa-plus-circle me-3 text-primary"></i>
                        Tambah Koleksi Baru
                    </h2>
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Back button-->
                        <a href="{{ route('collections-management.index') }}" class="btn btn-light me-3">
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
            <div class="card-body py-6">
                <!--begin::Wizard Steps-->
                <div class="wizard-container mb-4">
                    <div class="wizard-steps">
                        <div class="step active" data-step="1">
                            <div class="step-dot">
                                <span class="step-number">1</span>
                            </div>
                            <span class="step-label">Dasar</span>
                        </div>
                        <div class="step" data-step="2">
                            <div class="step-dot">
                                <span class="step-number">2</span>
                            </div>
                            <span class="step-label">Media</span>
                        </div>
                        <div class="step" data-step="3">
                            <div class="step-dot">
                                <span class="step-number">3</span>
                            </div>
                            <span class="step-label">Sejarah</span>
                        </div>
                        <div class="step" data-step="4">
                            <div class="step-dot">
                                <span class="step-number">4</span>
                            </div>
                            <span class="step-label">Detail</span>
                        </div>
                        <div class="step" data-step="5">
                            <div class="step-dot">
                                <span class="step-number">5</span>
                            </div>
                            <span class="step-label">Selesai</span>
                        </div>
                    </div>
                </div>
                <!--end::Wizard Steps-->

                <form action="{{ route('collections-management.store') }}" method="POST" enctype="multipart/form-data" id="collection-form">
                    @csrf

                    <!-- Step 1: Informasi Dasar -->
                    <div class="wizard-step active" data-step="1">
                        <div class="step-content">
                            <div class="row g-4">
                                <div class="col-lg-8">
                                    <div class="form-section">
                                        <h5 class="section-title">Informasi Koleksi</h5>

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label required">Nama Koleksi</label>
                                                <input type="text" name="name" class="form-input" placeholder="Masukkan nama koleksi" value="{{ old('name') }}" required />
                                                @error('name')
                                                    <div class="error-text">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label required">Kategori</label>
                                                <select name="category_id" class="form-input" required>
                                                    <option value="">Pilih kategori</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <div class="error-text">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <label class="form-label required">Deskripsi</label>
                                            <textarea name="description" class="form-input" rows="4" placeholder="Masukkan deskripsi koleksi" required>{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="error-text">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row g-3 mt-4">
                                            <div class="col-md-6">
                                                <label class="form-label">Periode Tahun</label>
                                                <input type="text" name="year_period" class="form-input" placeholder="Contoh: 1920-1930" value="{{ old('year_period') }}" />
                                                @error('year_period')
                                                    <div class="error-text">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Lokasi Asal</label>
                                                <input type="text" name="origin_location" class="form-input" placeholder="Contoh: Jawa Tengah" value="{{ old('origin_location') }}" />
                                                @error('origin_location')
                                                    <div class="error-text">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row g-3 mt-4">
                                            <div class="col-md-6">
                                                <label class="form-label">Bahan Material</label>
                                                <input type="text" name="material" class="form-input" placeholder="Contoh: Kayu, Logam, Kain" value="{{ old('material') }}" />
                                                @error('material')
                                                    <div class="error-text">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Ukuran Dimensi</label>
                                                <input type="text" name="dimensions" class="form-input" placeholder="Contoh: 50cm x 30cm x 20cm" value="{{ old('dimensions') }}" />
                                                @error('dimensions')
                                                    <div class="error-text">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-section mt-6">
                                        <h5 class="section-title">Pengaturan Koleksi</h5>

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Status Koleksi</label>
                                                <div class="toggle-container">
                                                    <label class="toggle">
                                                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }} />
                                                        <span class="toggle-slider"></span>
                                                    </label>
                                                    <span class="toggle-label">Aktif</span>
                                                </div>
                                                @error('is_active')
                                                    <div class="error-text">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Koleksi Unggulan</label>
                                                <div class="toggle-container">
                                                    <label class="toggle">
                                                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} />
                                                        <span class="toggle-slider"></span>
                                                    </label>
                                                    <span class="toggle-label">Tampilkan di halaman utama</span>
                                                </div>
                                                @error('is_featured')
                                                    <div class="error-text">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-section">
                                        <h5 class="section-title">Gambar Utama</h5>

                                        <div class="upload-zone" id="upload-zone">
                                            <div class="upload-content">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                                <h6>Upload Gambar</h6>
                                                <p>Drag & drop atau klik untuk memilih</p>
                                                <button type="button" class="upload-btn" id="upload-btn">
                                                    Pilih File
                                                </button>
                                            </div>
                                        </div>
                                        <input type="file" name="image" id="image-input" accept=".png, .jpg, .jpeg, .gif" style="display: none;" />

                                        <div class="upload-info">
                                            <small>Format: PNG, JPG, JPEG, GIF. Maksimal 2MB. Preview menampilkan gambar asli, hasil akhir akan di-crop dan di-resize ke ukuran optimal (800x600px).</small>
                                        </div>
                                        @error('image')
                                            <div class="error-text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Gambar & Galeri -->
                    <div class="wizard-step" data-step="2">
                        <div class="step-content">
                            <div class="form-section">
                                <h5 class="section-title">Galeri Gambar</h5>

                                <div class="upload-zone-large" id="gallery-upload-zone">
                                    <div class="upload-content">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        <h6>Upload Multiple Gambar</h6>
                                        <p>Drag & drop atau klik untuk memilih beberapa gambar</p>
                                        <button type="button" class="upload-btn" id="gallery-upload-btn">
                                            Pilih Gambar
                                        </button>
                                    </div>
                                </div>
                                <input type="file" name="gallery_images[]" id="gallery-input" accept=".png, .jpg, .jpeg, .gif" multiple style="display: none;" />

                                <div class="gallery-preview" id="gallery-preview"></div>

                                <div class="upload-info">
                                    <small>Upload multiple gambar untuk galeri (opsional). Format: PNG, JPG, JPEG, GIF. Maksimal 2MB per gambar. Preview menampilkan gambar asli, hasil akhir akan di-crop dan di-resize ke ukuran optimal (300x200px).</small>
                                </div>
                                @error('gallery_images.*')
                                    <div class="error-text">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-section mt-6">
                                <h5 class="section-title">Nilai Koleksi</h5>

                                <div class="mb-4">
                                    <label class="form-label">Nilai Budaya</label>
                                    <textarea name="nilai_budaya" class="form-input" rows="4" placeholder="Masukkan nilai budaya koleksi">{{ old('nilai_budaya') }}</textarea>
                                    <div class="form-hint">Konten ini akan ditampilkan di bagian "Nilai Budaya" pada detail koleksi</div>
                                    @error('nilai_budaya')
                                        <div class="error-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Nilai Historis</label>
                                    <textarea name="nilai_historis" class="form-input" rows="4" placeholder="Masukkan nilai historis koleksi">{{ old('nilai_historis') }}</textarea>
                                    <div class="form-hint">Konten ini akan ditampilkan di bagian "Nilai Historis" pada detail koleksi</div>
                                    @error('nilai_historis')
                                        <div class="error-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Nilai Edukatif</label>
                                    <textarea name="nilai_edukatif" class="form-input" rows="4" placeholder="Masukkan nilai edukatif koleksi">{{ old('nilai_edukatif') }}</textarea>
                                    <div class="form-hint">Konten ini akan ditampilkan di bagian "Nilai Edukatif" pada detail koleksi</div>
                                    @error('nilai_edukatif')
                                        <div class="error-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Sejarah -->
                    <div class="wizard-step" data-step="3">
                        <div class="step-content">
                            <div class="form-section">
                                <h5 class="section-title">Timeline Sejarah</h5>

                                <div id="history-container">
                                    <div class="history-item">
                                        <div class="history-header">
                                            <h6>Timeline #1</h6>
                                            <button type="button" class="remove-btn" onclick="removeHistoryItem(this)">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <label class="form-label">Judul</label>
                                                <input type="text" name="history_titles[]" class="form-input" placeholder="Contoh: Periode Pembuatan" />
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Tahun</label>
                                                <input type="text" name="history_years[]" class="form-input" placeholder="Contoh: 1920-1930" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Deskripsi</label>
                                                <textarea name="history_descriptions[]" class="form-input" rows="2" placeholder="Deskripsi timeline"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="add-btn" onclick="addHistoryItem()">
                                    <i class="fas fa-plus me-2"></i>Tambah Timeline
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Spesifikasi -->
                    <div class="wizard-step" data-step="4">
                        <div class="step-content">
                            <div class="form-section">
                                <h5 class="section-title">Spesifikasi Teknis</h5>

                                <div class="mb-4">
                                    <label class="form-label">Ringkasan Spesifikasi Teknis</label>
                                    <textarea name="technical_overview" class="form-input" rows="4" placeholder="Masukkan ringkasan spesifikasi teknis koleksi">{{ old('technical_overview') }}</textarea>
                                    <div class="form-hint">Konten ini akan ditampilkan di tab "Details" bagian spesifikasi teknis</div>
                                    @error('technical_overview')
                                        <div class="error-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Status Konservasi</label>
                                    <input type="text" name="conservation_status" class="form-input" placeholder="Contoh: Baik, Perlu Perbaikan, Sedang Diproses" value="{{ old('conservation_status') }}" />
                                    <div class="form-hint">Status kondisi fisik koleksi saat ini</div>
                                    @error('conservation_status')
                                        <div class="error-text">{{ $message }}</div>
                                    @enderror
                                </div>


                            </div>
                        </div>
                    </div>

                    <!-- Step 5: Selesai -->
                    <div class="wizard-step" data-step="5">
                        <div class="step-content">
                            <div class="completion-section">
                                <div class="completion-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                <h3>Siap Menyimpan Koleksi</h3>
                                <p>Semua informasi telah diisi dengan lengkap. Klik tombol "Simpan Koleksi" untuk menyimpan data ke database.</p>

                                <div class="completion-summary">
                                    <div class="summary-item">
                                        <i class="fas fa-info-circle"></i>
                                        <span>Informasi dasar telah diisi</span>
                                    </div>
                                    <div class="summary-item">
                                        <i class="fas fa-images"></i>
                                        <span>Galeri gambar siap diupload</span>
                                    </div>
                                    <div class="summary-item">
                                        <i class="fas fa-history"></i>
                                        <span>Timeline sejarah telah dibuat</span>
                                    </div>
                                    <div class="summary-item">
                                        <i class="fas fa-cogs"></i>
                                        <span>Spesifikasi teknis lengkap</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--begin::Wizard Navigation-->
                    <div class="wizard-navigation mt-6">
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button" class="nav-btn nav-prev btn btn-outline-secondary" id="prev-btn" onclick="prevStep()" style="display: none;">
                                <i class="fas fa-arrow-left me-2"></i>
                                <span class="d-none d-sm-inline">Sebelumnya</span>
                            </button>
                            <div class="ms-auto">
                                <button type="button" class="nav-btn nav-next btn btn-primary" id="next-btn" onclick="nextStep()">
                                    <span class="d-none d-sm-inline">Selanjutnya</span>
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                                <button type="submit" class="nav-btn nav-submit btn btn-success" id="submit-btn" style="display: none;">
                                    <i class="fas fa-save me-2"></i>
                                    <span class="d-none d-sm-inline">Simpan Koleksi</span>
                                </button>
                            </div>
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
/* Wizard Container */
.wizard-container {
    margin-bottom: 2rem;
}

.wizard-steps {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 100%;
    margin: 0 auto;
    position: relative;
    gap: 0.5rem;
}

.wizard-steps::before {
    content: '';
    position: absolute;
    top: 20px;
    left: 15px;
    right: 15px;
    height: 2px;
    background: #e9ecef;
    z-index: 1;
}

.step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    z-index: 2;
    flex: 1;
    min-width: 0;
}

.step-dot {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: white;
    border: 2px solid #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 0.5rem;
    transition: all 0.3s ease;
    position: relative;
}

.step-number {
    font-size: 0.875rem;
    font-weight: 600;
    color: #6c757d;
    transition: color 0.3s ease;
}

.step.active .step-dot {
    background: #0d6efd;
    border-color: #0d6efd;
    transform: scale(1.1);
}

.step.active .step-number {
    color: white;
}

.step.completed .step-dot {
    background: #198754;
    border-color: #198754;
}

.step.completed .step-number {
    color: white;
}

.step-label {
    font-size: 0.75rem;
    font-weight: 500;
    color: #6c757d;
    text-align: center;
    line-height: 1.2;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .wizard-steps {
        gap: 0.25rem;
    }

    .step-dot {
        width: 32px;
        height: 32px;
    }

    .step-number {
        font-size: 0.75rem;
    }

    .step-label {
        font-size: 0.625rem;
        max-width: 60px;
        word-wrap: break-word;
    }

    .wizard-steps::before {
        top: 16px;
        left: 16px;
        right: 16px;
    }
}

@media (max-width: 480px) {
    .wizard-steps {
        gap: 0.125rem;
    }

    .step-dot {
        width: 28px;
        height: 28px;
    }

    .step-number {
        font-size: 0.625rem;
    }

    .step-label {
        font-size: 0.5rem;
        max-width: 50px;
    }

    .wizard-steps::before {
        top: 14px;
        left: 14px;
        right: 14px;
    }
}
    transition: all 0.3s ease;
}

.step.active .step-label {
    color: #0d6efd;
    font-weight: 600;
}

.step.completed .step-label {
    color: #198754;
}

/* Step Content */
.wizard-step {
    display: none;
    animation: fadeIn 0.5s ease;
}

.wizard-step.active {
    display: block;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.step-content {
    width: 100%;
}

/* Form Sections */
.form-section {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    border: 1px solid #f8f9fa;
    margin-bottom: 1.5rem;
}

.section-title {
    color: #212529;
    font-weight: 600;
    margin-bottom: 1.5rem;
    font-size: 1.1rem;
    position: relative;
    padding-bottom: 0.5rem;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 30px;
    height: 2px;
    background: #0d6efd;
}

/* Form Controls */
.form-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: #495057;
    font-size: 0.9rem;
}

.form-label.required::after {
    content: " *";
    color: #dc3545;
}

.form-input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.form-input:focus {
    outline: none;
    border-color: #0d6efd;
    background: white;
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
}

.form-input::placeholder {
    color: #adb5bd;
}

/* Toggle Switch */
.toggle-container {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.toggle {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 26px;
}

.toggle input {
    opacity: 0;
    width: 0;
    height: 0;
}

.toggle-slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .3s;
    border-radius: 26px;
}

.toggle-slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: .3s;
    border-radius: 50%;
}

input:checked + .toggle-slider {
    background-color: #0d6efd;
}

input:checked + .toggle-slider:before {
    transform: translateX(24px);
}

.toggle-label {
    font-weight: 500;
    color: #495057;
    font-size: 0.9rem;
}

/* Upload Zones */
.upload-zone {
    border: 2px dashed #dee2e6;
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
    background: #f8f9fa;
    cursor: pointer;
}

.upload-zone:hover {
    border-color: #0d6efd;
    background: #f0f7ff;
}

.upload-zone-large {
    border: 2px dashed #dee2e6;
    border-radius: 12px;
    padding: 3rem 2rem;
    text-align: center;
    transition: all 0.3s ease;
    background: #f8f9fa;
    cursor: pointer;
    margin-bottom: 1rem;
}

.upload-zone-large:hover {
    border-color: #0d6efd;
    background: #f0f7ff;
}

.upload-content i {
    font-size: 2.5rem;
    color: #adb5bd;
    margin-bottom: 1rem;
}

.upload-content h6 {
    color: #495057;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.upload-content p {
    color: #6c757d;
    margin-bottom: 1.5rem;
    font-size: 0.9rem;
}

.upload-btn {
    background: #0d6efd;
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.upload-btn:hover {
    background: #0b5ed7;
    transform: translateY(-1px);
}

.upload-info {
    margin-top: 1rem;
    text-align: center;
    color: #6c757d;
    font-size: 0.875rem;
}

/* Gallery Preview */
.gallery-preview {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

.gallery-preview-item {
    background: white;
    border-radius: 8px;
    padding: 0.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.gallery-preview-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.gallery-item-container {
    position: relative;
    overflow: hidden;
}

.gallery-item-info {
    text-align: center;
    padding: 0.25rem 0;
}

/* History Items */
.history-item {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.history-item:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.history-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #dee2e6;
}

.history-header h6 {
    margin: 0;
    color: #495057;
    font-weight: 600;
    font-size: 0.9rem;
}

.remove-btn {
    background: #dc3545;
    color: white;
    border: none;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.8rem;
}

.remove-btn:hover {
    background: #c82333;
    transform: scale(1.1);
}

.add-btn {
    background: #198754;
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.add-btn:hover {
    background: #157347;
    transform: translateY(-1px);
}

/* Completion Section */
.completion-section {
    text-align: center;
    padding: 3rem 2rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    border: 1px solid #f8f9fa;
}

.completion-icon {
    margin-bottom: 2rem;
}

.completion-icon i {
    font-size: 4rem;
    color: #198754;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.completion-section h3 {
    color: #212529;
    font-weight: 700;
    margin-bottom: 1rem;
}

.completion-section p {
    color: #6c757d;
    font-size: 1rem;
    margin-bottom: 2rem;
}

.completion-summary {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-top: 2rem;
}

.summary-item {
    display: flex;
    align-items: center;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 3px solid #0d6efd;
}

.summary-item i {
    font-size: 1.2rem;
    margin-right: 0.75rem;
    color: #0d6efd;
}

.summary-item span {
    font-weight: 500;
    color: #495057;
    font-size: 0.9rem;
}

/* Navigation */
.wizard-navigation {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid #e9ecef;
}

.nav-btn {
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    font-weight: 500;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.nav-prev {
    background: #6c757d;
    color: white;
}

.nav-prev:hover {
    background: #5a6268;
}

.nav-next {
    background: #0d6efd;
    color: white;
}

.nav-next:hover {
    background: #0b5ed7;
}

.nav-submit {
    background: #198754;
    color: white;
}

.nav-submit:hover {
    background: #157347;
}

/* Image Preview Styles */
.image-preview-container {
    background: #f8f9fa;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.image-preview-container:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transform: translateY(-2px);
}

.gallery-preview-item {
    display: inline-block;
    margin: 0.5rem;
    padding: 0.5rem;
    background: white;
    border-radius: 0.5rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.gallery-preview-item:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    transform: translateY(-1px);
}

.gallery-preview {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: 1rem;
}

/* Error Messages */
.error-text {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.form-hint {
    color: #6c757d;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

/* Responsive */
@media (max-width: 768px) {
    .wizard-navigation {
        margin-top: 1.5rem;
        padding-top: 0.75rem;
    }

    .nav-btn {
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
    }
}

@media (max-width: 480px) {
    .wizard-navigation {
        margin-top: 1rem;
        padding-top: 0.5rem;
    }

    .nav-btn {
        padding: 0.4rem 0.8rem;
        font-size: 0.75rem;
    }
}
</style>

<script>
let currentStep = 1;
const totalSteps = 5;

function updateWizardSteps() {
    // Update step indicators
    document.querySelectorAll('.step').forEach((item, index) => {
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
        prevBtn.style.display = 'inline-flex';
    }

    if (currentStep === totalSteps) {
        nextBtn.style.display = 'none';
        submitBtn.style.display = 'inline-flex';
    } else {
        nextBtn.style.display = 'inline-flex';
        submitBtn.style.display = 'none';
    }
}

function nextStep() {
    // Validate current step before proceeding
    if (!validateCurrentStep()) {
        return;
    }

    if (currentStep < totalSteps) {
        currentStep++;
        updateWizardSteps();
    }
}

function validateCurrentStep() {
    const currentStepElement = document.querySelector(`.wizard-step[data-step="${currentStep}"]`);
    const requiredFields = currentStepElement.querySelectorAll('input[required], select[required], textarea[required]');
    let isValid = true;

    // Clear previous error messages
    currentStepElement.querySelectorAll('.validation-error').forEach(el => el.remove());

    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            showFieldError(field, 'Field ini wajib diisi');
        }
    });

    // Step-specific validations
    if (currentStep === 1) {
        // Validate name, category_id, description
        const name = currentStepElement.querySelector('input[name="name"]');
        const category = currentStepElement.querySelector('select[name="category_id"]');
        const description = currentStepElement.querySelector('textarea[name="description"]');

        if (!name.value.trim()) {
            isValid = false;
            showFieldError(name, 'Nama koleksi wajib diisi');
        }

        if (!category.value) {
            isValid = false;
            showFieldError(category, 'Kategori wajib dipilih');
        }

        if (!description.value.trim()) {
            isValid = false;
            showFieldError(description, 'Deskripsi wajib diisi');
        }
    }

    if (currentStep === 2) {
        // Step 2 validation (if any specific validation needed)
        // Currently no required fields in step 2
    }

    if (currentStep === 3) {
        // Validate at least one history item
        const historyTitles = currentStepElement.querySelectorAll('input[name="history_titles[]"]');
        let hasHistory = false;

        historyTitles.forEach(title => {
            if (title.value.trim()) {
                hasHistory = true;
            }
        });

        if (!hasHistory) {
            isValid = false;
            showStepError('Minimal satu timeline sejarah harus diisi');
        }
    }

    if (currentStep === 4) {
        // Validate technical_overview and conservation_overview (optional but recommended)
        const technicalOverview = currentStepElement.querySelector('textarea[name="technical_overview"]');
        const conservationOverview = currentStepElement.querySelector('textarea[name="conservation_overview"]');

        if (!technicalOverview.value.trim() && !conservationOverview.value.trim()) {
            // Show warning but allow to continue
            showStepWarning('Overview spesifikasi teknis dan konservasi belum diisi. Disarankan untuk mengisi minimal salah satu field ini.');
            return true; // Allow to continue with warning
        }
    }

    if (!isValid) {
        // Show error message
        showStepError('Mohon lengkapi semua field yang wajib diisi sebelum melanjutkan');
    }

    return isValid;
}

function showFieldError(field, message) {
    // Remove existing error
    const existingError = field.parentNode.querySelector('.validation-error');
    if (existingError) {
        existingError.remove();
    }

    // Add error message
    const errorDiv = document.createElement('div');
    errorDiv.className = 'validation-error';
    errorDiv.style.color = '#dc3545';
    errorDiv.style.fontSize = '0.875rem';
    errorDiv.style.marginTop = '0.25rem';
    errorDiv.textContent = message;

    field.parentNode.appendChild(errorDiv);
    field.style.borderColor = '#dc3545';

    // Add focus event to remove error on input
    field.addEventListener('input', function() {
        if (this.value.trim()) {
            this.style.borderColor = '#dee2e6';
            const error = this.parentNode.querySelector('.validation-error');
            if (error) {
                error.remove();
            }
        }
    }, { once: true });
}

function showStepError(message) {
    toastr.error(message, 'Error');
}

function showStepWarning(message) {
    toastr.warning(message, 'Warning');
}

// Using showToast function from dashboard.js

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        updateWizardSteps();

        // Clear any validation errors when going back
        document.querySelectorAll('.validation-error, .step-error').forEach(el => el.remove());
        document.querySelectorAll('.form-input').forEach(input => {
            input.style.borderColor = '#dee2e6';
        });
    }
}

function addHistoryItem() {
    const container = document.getElementById('history-container');
    const itemCount = container.children.length + 1;

    const newItem = document.createElement('div');
    newItem.className = 'history-item';
    newItem.innerHTML = `
        <div class="history-header">
            <h6>Timeline #${itemCount}</h6>
            <button type="button" class="remove-btn" onclick="removeHistoryItem(this)">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Judul</label>
                <input type="text" name="history_titles[]" class="form-input" placeholder="Contoh: Periode Pembuatan" />
            </div>
            <div class="col-md-3">
                <label class="form-label">Tahun</label>
                <input type="text" name="history_years[]" class="form-input" placeholder="Contoh: 1920-1930" />
            </div>
            <div class="col-md-6">
                <label class="form-label">Deskripsi</label>
                <textarea name="history_descriptions[]" class="form-input" rows="2" placeholder="Deskripsi timeline"></textarea>
            </div>
        </div>
    `;
    container.appendChild(newItem);
}

function removeHistoryItem(button) {
    button.closest('.history-item').remove();
    // Update numbering
    document.querySelectorAll('.history-item').forEach((item, index) => {
        const header = item.querySelector('.history-header h6');
        header.textContent = `Timeline #${index + 1}`;
    });
}

// Image upload functionality
document.addEventListener('DOMContentLoaded', function() {
    updateWizardSteps();

    // Form submit validation
    document.getElementById('collection-form').addEventListener('submit', function(e) {
        if (!validateAllSteps()) {
            e.preventDefault();
            showStepError('Mohon lengkapi semua field yang wajib diisi sebelum menyimpan koleksi');

            // Go to first step with error
            currentStep = 1;
            updateWizardSteps();
            validateCurrentStep();
        }
    });

    // Main image upload
    const uploadZone = document.getElementById('upload-zone');
    const imageInput = document.getElementById('image-input');
    const uploadBtn = document.getElementById('upload-btn');

    console.log('Upload zone element:', uploadZone);
    console.log('Image input element:', imageInput);
    console.log('Upload button element:', uploadBtn);

    // Function to trigger file input
    function triggerFileInput() {
        console.log('Triggering file input...');
        if (imageInput) {
            imageInput.click();
        } else {
            console.error('Image input not found!');
        }
    }

    uploadZone.addEventListener('click', (e) => {
        console.log('Upload zone clicked!');
        e.preventDefault();
        e.stopPropagation();
        triggerFileInput();
    });

    // Fallback: also handle button click
    uploadBtn.addEventListener('click', (e) => {
        console.log('Upload button clicked!');
        e.preventDefault();
        e.stopPropagation();
        triggerFileInput();
    });

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                uploadZone.innerHTML = `
                    <div class="upload-content">
                        <div class="image-preview-container w-48 h-20 mx-auto rounded-lg overflow-hidden mb-4 border-2 border-gray-200">
                            <img src="${e.target.result}" class="w-full h-full object-cover" alt="Preview">
                        </div>
                        <h6 class="text-lg font-semibold text-gray-800 mb-2">Gambar Terpilih</h6>
                        <p class="text-sm text-gray-600 mb-3">${file.name}</p>
                        <div class="text-xs text-gray-500 mb-3">
                            <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded">Ukuran: ${(file.size / 1024 / 1024).toFixed(2)} MB</span>
                            <span class="inline-block bg-yellow-100 text-yellow-800 px-2 py-1 rounded ml-2">Akan di-crop otomatis</span>
                        </div>
                        <button type="button" class="upload-btn" onclick="changeImage()">
                            Ganti Gambar
                        </button>
                    </div>
                `;
            };
            reader.readAsDataURL(file);
        }
    });

    // Gallery upload
    const galleryUploadZone = document.getElementById('gallery-upload-zone');
    const galleryInput = document.getElementById('gallery-input');
    const galleryPreview = document.getElementById('gallery-preview');
    const galleryUploadBtn = document.getElementById('gallery-upload-btn');

    console.log('Gallery upload zone element:', galleryUploadZone);
    console.log('Gallery input element:', galleryInput);
    console.log('Gallery upload button element:', galleryUploadBtn);

    // Function to trigger gallery file input
    function triggerGalleryFileInput() {
        console.log('Triggering gallery file input...');
        if (galleryInput) {
            galleryInput.click();
        } else {
            console.error('Gallery input not found!');
        }
    }

    galleryUploadZone.addEventListener('click', (e) => {
        console.log('Gallery upload zone clicked!');
        e.preventDefault();
        e.stopPropagation();
        triggerGalleryFileInput();
    });

    galleryUploadBtn.addEventListener('click', (e) => {
        console.log('Gallery upload button clicked!');
        e.preventDefault();
        e.stopPropagation();
        triggerGalleryFileInput();
    });

    galleryInput.addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        galleryPreview.innerHTML = '';

        files.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewItem = document.createElement('div');
                previewItem.className = 'gallery-preview-item';
                previewItem.innerHTML = `
                    <div class="gallery-item-container w-20 h-12 mx-auto rounded-lg overflow-hidden border border-gray-200">
                        <img src="${e.target.result}" class="w-full h-full object-cover" alt="Gallery Preview">
                    </div>
                    <div class="gallery-item-info mt-2 text-center">
                        <p class="text-xs text-gray-600 truncate">${file.name}</p>
                        <p class="text-xs text-gray-500">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                        <p class="text-xs text-yellow-600">Akan di-crop otomatis</p>
                    </div>
                `;
                galleryPreview.appendChild(previewItem);
            };
            reader.readAsDataURL(file);
        });
    });
});

// Function to change image
function changeImage() {
    console.log('Change image function called');
    const imageInput = document.getElementById('image-input');
    if (imageInput) {
        imageInput.click();
    } else {
        console.error('Image input not found in changeImage function!');
    }
}

function validateAllSteps() {
    let isValid = true;

    // Validate Step 1 - Required fields
    const name = document.querySelector('input[name="name"]');
    const category = document.querySelector('select[name="category_id"]');
    const description = document.querySelector('textarea[name="description"]');

    if (!name.value.trim()) {
        isValid = false;
    }

    if (!category.value) {
        isValid = false;
    }

    if (!description.value.trim()) {
        isValid = false;
    }

    // Validate Step 3 - At least one history item
    const historyTitles = document.querySelectorAll('input[name="history_titles[]"]');
    let hasHistory = false;

    historyTitles.forEach(title => {
        if (title.value.trim()) {
            hasHistory = true;
        }
    });

    if (!hasHistory) {
        isValid = false;
    }

    return isValid;
}
</script>
@endsection
