@extends('layouts.dashboard.dashboard')

@section('title', 'Tambah Koleksi - BDARU Museum')

@section('content')
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Card-->
        <div class="card shadow-sm border-0">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6 bg-gradient-primary">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2 class="fw-bold text-white">
                        <i class="fas fa-plus-circle me-2"></i>
                        Tambah Koleksi Baru
                    </h2>
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Back button-->
                        <a href="{{ route('collections-management.index') }}" class="btn btn-light-primary me-3">
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
                <div class="wizard-container mb-8">
                    <div class="wizard-steps">
                        <div class="step-item active" data-step="1">
                            <div class="step-circle">
                                <div class="step-number">1</div>
                                <div class="step-icon">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                            </div>
                            <div class="step-label">Informasi Dasar</div>
                            <div class="step-line"></div>
                        </div>
                        <div class="step-item" data-step="2">
                            <div class="step-circle">
                                <div class="step-number">2</div>
                                <div class="step-icon">
                                    <i class="fas fa-images"></i>
                                </div>
                            </div>
                            <div class="step-label">Galeri & Media</div>
                            <div class="step-line"></div>
                        </div>
                        <div class="step-item" data-step="3">
                            <div class="step-circle">
                                <div class="step-number">3</div>
                                <div class="step-icon">
                                    <i class="fas fa-history"></i>
                                </div>
                            </div>
                            <div class="step-label">Timeline Sejarah</div>
                            <div class="step-line"></div>
                        </div>
                        <div class="step-item" data-step="4">
                            <div class="step-circle">
                                <div class="step-number">4</div>
                                <div class="step-icon">
                                    <i class="fas fa-cogs"></i>
                                </div>
                            </div>
                            <div class="step-label">Spesifikasi</div>
                            <div class="step-line"></div>
                        </div>
                        <div class="step-item" data-step="5">
                            <div class="step-circle">
                                <div class="step-number">5</div>
                                <div class="step-icon">
                                    <i class="fas fa-check"></i>
                                </div>
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
                        <div class="step-content">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-section">
                                        <h4 class="section-title">
                                            <i class="fas fa-info-circle text-primary me-2"></i>
                                            Informasi Koleksi
                                        </h4>

                                        <!--begin::Form group-->
                                        <div class="fv-row mb-6">
                                            <label class="required fw-semibold fs-6 mb-3">Nama Koleksi</label>
                                            <input type="text" name="name" class="form-control form-control-lg form-control-solid" placeholder="Masukkan nama koleksi" value="{{ old('name') }}" required />
                                            @error('name')
                                                <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!--end::Form group-->

                                        <!--begin::Form group-->
                                        <div class="fv-row mb-6">
                                            <label class="required fw-semibold fs-6 mb-3">Kategori</label>
                                            <select name="category_id" class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Pilih kategori" required>
                                                <option value="">Pilih kategori</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!--end::Form group-->

                                        <!--begin::Form group-->
                                        <div class="fv-row mb-6">
                                            <label class="required fw-semibold fs-6 mb-3">Deskripsi</label>
                                            <textarea name="description" class="form-control form-control-solid" rows="4" placeholder="Masukkan deskripsi koleksi" required>{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!--end::Form group-->

                                        <div class="row">
                                            <!--begin::Form group-->
                                            <div class="col-md-6 fv-row mb-6">
                                                <label class="fw-semibold fs-6 mb-3">Periode Tahun</label>
                                                <input type="text" name="year_period" class="form-control form-control-solid" placeholder="Contoh: 1920-1930" value="{{ old('year_period') }}" />
                                                @error('year_period')
                                                    <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!--end::Form group-->

                                            <!--begin::Form group-->
                                            <div class="col-md-6 fv-row mb-6">
                                                <label class="fw-semibold fs-6 mb-3">Lokasi Asal</label>
                                                <input type="text" name="origin_location" class="form-control form-control-solid" placeholder="Contoh: Jawa Tengah" value="{{ old('origin_location') }}" />
                                                @error('origin_location')
                                                    <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!--end::Form group-->
                                        </div>
                                    </div>

                                    <div class="form-section mt-8">
                                        <h4 class="section-title">
                                            <i class="fas fa-cube text-success me-2"></i>
                                            Detail Teknis
                                        </h4>

                                        <div class="row">
                                            <!--begin::Form group-->
                                            <div class="col-md-4 fv-row mb-6">
                                                <label class="fw-semibold fs-6 mb-3">Material</label>
                                                <input type="text" name="material" class="form-control form-control-solid" placeholder="Contoh: Kayu, Logam, Kain" value="{{ old('material') }}" />
                                                @error('material')
                                                    <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!--end::Form group-->

                                            <!--begin::Form group-->
                                            <div class="col-md-4 fv-row mb-6">
                                                <label class="fw-semibold fs-6 mb-3">Dimensi</label>
                                                <input type="text" name="dimensions" class="form-control form-control-solid" placeholder="Contoh: 50cm x 30cm x 20cm" value="{{ old('dimensions') }}" />
                                                @error('dimensions')
                                                    <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!--end::Form group-->

                                            <!--begin::Form group-->
                                            <div class="col-md-4 fv-row mb-6">
                                                <label class="fw-semibold fs-6 mb-3">Rating</label>
                                                <input type="number" name="rating" class="form-control form-control-solid" placeholder="0.00" step="0.01" min="0" max="5" value="{{ old('rating') }}" />
                                                @error('rating')
                                                    <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!--end::Form group-->
                                        </div>

                                        <div class="row">
                                            <!--begin::Form group-->
                                            <div class="col-md-6 fv-row mb-6">
                                                <label class="fw-semibold fs-6 mb-3">Status</label>
                                                <div class="form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }} />
                                                    <label class="form-check-label fw-semibold fs-6">Aktif</label>
                                                </div>
                                                @error('is_active')
                                                    <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!--end::Form group-->

                                            <!--begin::Form group-->
                                            <div class="col-md-6 fv-row mb-6">
                                                <label class="fw-semibold fs-6 mb-3">Koleksi Unggulan</label>
                                                <div class="form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} />
                                                    <label class="form-check-label fw-semibold fs-6">Tampilkan di halaman utama</label>
                                                </div>
                                                @error('is_featured')
                                                    <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!--end::Form group-->
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-section">
                                        <h4 class="section-title">
                                            <i class="fas fa-image text-warning me-2"></i>
                                            Gambar Utama
                                        </h4>

                                        <!--begin::Form group-->
                                        <div class="fv-row mb-6">
                                            <div class="image-upload-container">
                                                <div class="image-preview" id="image-preview">
                                                    <div class="preview-placeholder">
                                                        <i class="fas fa-cloud-upload-alt"></i>
                                                        <p>Upload Gambar</p>
                                                        <span>Drag & drop atau klik untuk memilih</span>
                                                    </div>
                                                </div>
                                                <input type="file" name="image" id="image-input" accept=".png, .jpg, .jpeg, .gif" class="d-none" />
                                                <div class="upload-info">
                                                    <small class="text-muted">Format: PNG, JPG, JPEG, GIF. Maksimal 2MB.</small>
                                                </div>
                                            </div>
                                            @error('image')
                                                <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!--end::Form group-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Gambar & Galeri -->
                    <div class="wizard-step" data-step="2">
                        <div class="step-content">
                            <div class="form-section">
                                <h4 class="section-title">
                                    <i class="fas fa-images text-info me-2"></i>
                                    Galeri Gambar
                                </h4>

                                <div class="fv-row mb-6">
                                    <label class="fw-semibold fs-6 mb-3">Upload Gambar Galeri</label>
                                    <div class="gallery-upload-container">
                                        <div class="gallery-dropzone" id="gallery-dropzone">
                                            <div class="dropzone-content">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                                <h5>Upload Multiple Gambar</h5>
                                                <p>Drag & drop atau klik untuk memilih beberapa gambar</p>
                                                <button type="button" class="btn btn-light-primary" onclick="document.getElementById('gallery-input').click()">
                                                    <i class="fas fa-plus me-2"></i>Pilih Gambar
                                                </button>
                                            </div>
                                        </div>
                                        <input type="file" name="gallery_images[]" id="gallery-input" accept=".png, .jpg, .jpeg, .gif" multiple class="d-none" />
                                        <div class="gallery-preview" id="gallery-preview"></div>
                                    </div>
                                    <div class="form-text">Upload multiple gambar untuk galeri (opsional). Format: PNG, JPG, JPEG, GIF. Maksimal 2MB per gambar.</div>
                                    @error('gallery_images.*')
                                        <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="fv-row mb-6">
                                    <label class="fw-semibold fs-6 mb-3">Signifikansi Budaya</label>
                                    <textarea name="cultural_significance" class="form-control form-control-solid" rows="4" placeholder="Masukkan signifikansi budaya koleksi">{{ old('cultural_significance') }}</textarea>
                                    <div class="form-text">Konten ini akan ditampilkan di bagian "Signifikansi Budaya"</div>
                                    @error('cultural_significance')
                                        <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Sejarah -->
                    <div class="wizard-step" data-step="3">
                        <div class="step-content">
                            <div class="form-section">
                                <h4 class="section-title">
                                    <i class="fas fa-history text-secondary me-2"></i>
                                    Timeline Sejarah
                                </h4>

                                <div id="history-container">
                                    <div class="history-item">
                                        <div class="history-header">
                                            <h6>Timeline #1</h6>
                                            <button type="button" class="btn btn-icon btn-sm btn-light-danger" onclick="removeHistoryItem(this)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="fw-semibold fs-6 mb-2">Judul</label>
                                                <input type="text" name="history_titles[]" class="form-control form-control-solid" placeholder="Contoh: Periode Pembuatan" />
                                            </div>
                                            <div class="col-md-3">
                                                <label class="fw-semibold fs-6 mb-2">Tahun</label>
                                                <input type="text" name="history_years[]" class="form-control form-control-solid" placeholder="Contoh: 1920-1930" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="fw-semibold fs-6 mb-2">Deskripsi</label>
                                                <textarea name="history_descriptions[]" class="form-control form-control-solid" rows="2" placeholder="Deskripsi timeline"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-light-primary btn-lg" onclick="addHistoryItem()">
                                    <i class="fas fa-plus me-2"></i>Tambah Timeline
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Spesifikasi -->
                    <div class="wizard-step" data-step="4">
                        <div class="step-content">
                            <div class="form-section">
                                <h4 class="section-title">
                                    <i class="fas fa-cogs text-primary me-2"></i>
                                    Spesifikasi Teknis
                                </h4>

                                <div class="fv-row mb-6">
                                    <label class="fw-semibold fs-6 mb-3">Overview Spesifikasi Teknis</label>
                                    <textarea name="technical_overview" class="form-control form-control-solid" rows="4" placeholder="Masukkan overview spesifikasi teknis koleksi">{{ old('technical_overview') }}</textarea>
                                    <div class="form-text">Konten ini akan ditampilkan di tab "Details" bagian spesifikasi teknis</div>
                                    @error('technical_overview')
                                        <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <h4 class="section-title mt-8">
                                    <i class="fas fa-shield-alt text-success me-2"></i>
                                    Informasi Konservasi
                                </h4>

                                <div class="fv-row mb-6">
                                    <label class="fw-semibold fs-6 mb-3">Status Konservasi</label>
                                    <input type="text" name="conservation_status" class="form-control form-control-solid" placeholder="Contoh: Baik, Perlu Perbaikan" value="{{ old('conservation_status') }}" />
                                    @error('conservation_status')
                                        <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="fv-row mb-6">
                                    <label class="fw-semibold fs-6 mb-3">Overview Konservasi</label>
                                    <textarea name="conservation_overview" class="form-control form-control-solid" rows="4" placeholder="Masukkan overview konservasi koleksi">{{ old('conservation_overview') }}</textarea>
                                    <div class="form-text">Konten ini akan ditampilkan di tab "Details" bagian informasi konservasi</div>
                                    @error('conservation_overview')
                                        <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 5: Selesai -->
                    <div class="wizard-step" data-step="5">
                        <div class="step-content">
                            <div class="completion-step text-center">
                                <div class="completion-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <h3 class="completion-title">Siap Menyimpan Koleksi</h3>
                                <p class="completion-description">Semua informasi telah diisi dengan lengkap. Klik tombol "Simpan Koleksi" untuk menyimpan data ke database.</p>

                                <div class="completion-summary">
                                    <div class="summary-item">
                                        <i class="fas fa-info-circle text-primary"></i>
                                        <span>Informasi dasar telah diisi</span>
                                    </div>
                                    <div class="summary-item">
                                        <i class="fas fa-images text-info"></i>
                                        <span>Galeri gambar siap diupload</span>
                                    </div>
                                    <div class="summary-item">
                                        <i class="fas fa-history text-secondary"></i>
                                        <span>Timeline sejarah telah dibuat</span>
                                    </div>
                                    <div class="summary-item">
                                        <i class="fas fa-cogs text-success"></i>
                                        <span>Spesifikasi teknis lengkap</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--begin::Wizard Navigation-->
                    <div class="wizard-navigation">
                        <button type="button" class="btn btn-light btn-lg" id="prev-btn" onclick="prevStep()" style="display: none;">
                            <i class="fas fa-arrow-left me-2"></i>Sebelumnya
                        </button>
                        <div class="ms-auto">
                            <button type="button" class="btn btn-primary btn-lg" id="next-btn" onclick="nextStep()">
                                Selanjutnya<i class="fas fa-arrow-right ms-2"></i>
                            </button>
                            <button type="submit" class="btn btn-success btn-lg" id="submit-btn" style="display: none;">
                                <i class="fas fa-save me-2"></i>Simpan Koleksi
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
/* Wizard Container */
.wizard-container {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.wizard-steps {
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
}

.step-item {
    text-align: center;
    flex: 1;
    position: relative;
    z-index: 2;
}

.step-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    position: relative;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.step-item.active .step-circle {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    transform: scale(1.1);
    box-shadow: 0 8px 25px rgba(108, 117, 125, 0.3);
}

.step-item.completed .step-circle {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    transform: scale(1.05);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
}

.step-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: #6c757d;
    transition: all 0.3s ease;
}

.step-item.active .step-number {
    color: white;
}

.step-item.completed .step-number {
    color: white;
}

.step-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 1.2rem;
    color: #adb5bd;
    opacity: 0;
    transition: all 0.3s ease;
}

.step-item.active .step-icon,
.step-item.completed .step-icon {
    opacity: 1;
    color: white;
}

.step-label {
    font-size: 0.9rem;
    font-weight: 600;
    color: #6c757d;
    transition: all 0.3s ease;
    margin-bottom: 0.5rem;
}

.step-item.active .step-label {
    color: #495057;
    font-weight: 700;
}

.step-item.completed .step-label {
    color: #28a745;
    font-weight: 600;
}

.step-line {
    position: absolute;
    top: 40px;
    left: 50%;
    width: 100%;
    height: 3px;
    background: linear-gradient(90deg, #e9ecef 0%, #dee2e6 100%);
    transform: translateX(-50%);
    z-index: 1;
}

.step-item.completed .step-line {
    background: linear-gradient(90deg, #28a745 0%, #20c997 100%);
}

/* Step Content */
.wizard-step {
    display: none;
    animation: fadeInUp 0.5s ease;
}

.wizard-step.active {
    display: block;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.step-content {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
}

/* Form Sections */
.form-section {
    margin-bottom: 2rem;
}

.section-title {
    color: #495057;
    font-weight: 700;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e9ecef;
}

/* Image Upload */
.image-upload-container {
    text-align: center;
}

.image-preview {
    width: 200px;
    height: 200px;
    border: 3px dashed #dee2e6;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.image-preview:hover {
    border-color: #6c757d;
    background: #e9ecef;
}

.preview-placeholder {
    text-align: center;
    color: #6c757d;
}

.preview-placeholder i {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: #adb5bd;
}

.preview-placeholder p {
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.preview-placeholder span {
    font-size: 0.8rem;
}

/* Gallery Upload */
.gallery-upload-container {
    border: 2px dashed #dee2e6;
    border-radius: 15px;
    padding: 2rem;
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.gallery-upload-container:hover {
    border-color: #6c757d;
    background: #e9ecef;
}

.dropzone-content {
    text-align: center;
    color: #6c757d;
}

.dropzone-content i {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: #adb5bd;
}

.gallery-preview {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

/* History Items */
.history-item {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 15px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    border: 1px solid #dee2e6;
    transition: all 0.3s ease;
}

.history-item:hover {
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transform: translateY(-2px);
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
}

/* Completion Step */
.completion-step {
    padding: 3rem 1rem;
}

.completion-icon {
    margin-bottom: 2rem;
}

.completion-icon i {
    font-size: 5rem;
    color: #28a745;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.completion-title {
    color: #495057;
    font-weight: 700;
    margin-bottom: 1rem;
}

.completion-description {
    color: #6c757d;
    font-size: 1.1rem;
    margin-bottom: 2rem;
}

.completion-summary {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    margin-top: 2rem;
}

.summary-item {
    display: flex;
    align-items: center;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 10px;
    border-left: 4px solid #6c757d;
}

.summary-item i {
    font-size: 1.5rem;
    margin-right: 1rem;
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

/* Responsive */
@media (max-width: 768px) {
    .wizard-steps {
        flex-direction: column;
        gap: 1rem;
    }

    .step-line {
        display: none;
    }

    .completion-summary {
        grid-template-columns: 1fr;
    }
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
    const itemCount = container.children.length + 1;

    const newItem = document.createElement('div');
    newItem.className = 'history-item';
    newItem.innerHTML = `
        <div class="history-header">
            <h6>Timeline #${itemCount}</h6>
            <button type="button" class="btn btn-icon btn-sm btn-light-danger" onclick="removeHistoryItem(this)">
                <i class="fas fa-trash"></i>
            </button>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label class="fw-semibold fs-6 mb-2">Judul</label>
                <input type="text" name="history_titles[]" class="form-control form-control-solid" placeholder="Contoh: Periode Pembuatan" />
            </div>
            <div class="col-md-3">
                <label class="fw-semibold fs-6 mb-2">Tahun</label>
                <input type="text" name="history_years[]" class="form-control form-control-solid" placeholder="Contoh: 1920-1930" />
            </div>
            <div class="col-md-6">
                <label class="fw-semibold fs-6 mb-2">Deskripsi</label>
                <textarea name="history_descriptions[]" class="form-control form-control-solid" rows="2" placeholder="Deskripsi timeline"></textarea>
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

    // Main image upload
    const imagePreview = document.getElementById('image-preview');
    const imageInput = document.getElementById('image-input');

    imagePreview.addEventListener('click', () => imageInput.click());

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.innerHTML = `<img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;">`;
            };
            reader.readAsDataURL(file);
        }
    });

    // Gallery upload
    const galleryDropzone = document.getElementById('gallery-dropzone');
    const galleryInput = document.getElementById('gallery-input');
    const galleryPreview = document.getElementById('gallery-preview');

    galleryDropzone.addEventListener('click', () => galleryInput.click());

    galleryInput.addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        galleryPreview.innerHTML = '';

        files.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewItem = document.createElement('div');
                previewItem.className = 'gallery-preview-item';
                previewItem.innerHTML = `
                    <img src="${e.target.result}" style="width: 100%; height: 100px; object-fit: cover; border-radius: 8px;">
                    <div class="preview-overlay">
                        <span>${file.name}</span>
                    </div>
                `;
                galleryPreview.appendChild(previewItem);
            };
            reader.readAsDataURL(file);
        });
    });
});
</script>
@endsection
