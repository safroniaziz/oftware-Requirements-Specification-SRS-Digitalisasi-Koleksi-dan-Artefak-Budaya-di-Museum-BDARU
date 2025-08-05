@extends('layouts.dashboard.dashboard')

@section('title', 'Tambah Koleksi - BDARU Museum')

@section('content')
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Card-->
        <div class="card shadow-lg border-0">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2 class="fw-bold text-white">
                        <i class="fas fa-plus-circle me-3"></i>
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
                <div class="wizard-progress mb-8">
                    <div class="progress-container">
                        <div class="progress-bar" id="progress-bar"></div>
                        <div class="steps-container">
                            <div class="step active" data-step="1">
                                <div class="step-icon">
                                    <i class="fas fa-info"></i>
                                </div>
                                <span class="step-text">Dasar</span>
                            </div>
                            <div class="step" data-step="2">
                                <div class="step-icon">
                                    <i class="fas fa-images"></i>
                                </div>
                                <span class="step-text">Media</span>
                            </div>
                            <div class="step" data-step="3">
                                <div class="step-icon">
                                    <i class="fas fa-history"></i>
                                </div>
                                <span class="step-text">Sejarah</span>
                            </div>
                            <div class="step" data-step="4">
                                <div class="step-icon">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                <span class="step-text">Detail</span>
                            </div>
                            <div class="step" data-step="5">
                                <div class="step-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                <span class="step-text">Selesai</span>
                            </div>
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
                                <div class="col-lg-8">
                                    <div class="form-card">
                                        <div class="card-header-custom">
                                            <h4><i class="fas fa-info-circle text-primary me-2"></i>Informasi Koleksi</h4>
                                        </div>
                                        <div class="card-body-custom">
                                            <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <label class="form-label required">Nama Koleksi</label>
                                                    <input type="text" name="name" class="form-control-custom" placeholder="Masukkan nama koleksi" value="{{ old('name') }}" required />
                                                    @error('name')
                                                        <div class="error-message">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <label class="form-label required">Kategori</label>
                                                    <select name="category_id" class="form-control-custom" required>
                                                        <option value="">Pilih kategori</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <div class="error-message">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label required">Deskripsi</label>
                                                <textarea name="description" class="form-control-custom" rows="4" placeholder="Masukkan deskripsi koleksi" required>{{ old('description') }}</textarea>
                                                @error('description')
                                                    <div class="error-message">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <label class="form-label">Periode Tahun</label>
                                                    <input type="text" name="year_period" class="form-control-custom" placeholder="Contoh: 1920-1930" value="{{ old('year_period') }}" />
                                                    @error('year_period')
                                                        <div class="error-message">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <label class="form-label">Lokasi Asal</label>
                                                    <input type="text" name="origin_location" class="form-control-custom" placeholder="Contoh: Jawa Tengah" value="{{ old('origin_location') }}" />
                                                    @error('origin_location')
                                                        <div class="error-message">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-card mt-4">
                                        <div class="card-header-custom">
                                            <h4><i class="fas fa-cube text-success me-2"></i>Detail Teknis</h4>
                                        </div>
                                        <div class="card-body-custom">
                                            <div class="row">
                                                <div class="col-md-4 mb-4">
                                                    <label class="form-label">Material</label>
                                                    <input type="text" name="material" class="form-control-custom" placeholder="Contoh: Kayu, Logam, Kain" value="{{ old('material') }}" />
                                                    @error('material')
                                                        <div class="error-message">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mb-4">
                                                    <label class="form-label">Dimensi</label>
                                                    <input type="text" name="dimensions" class="form-control-custom" placeholder="Contoh: 50cm x 30cm x 20cm" value="{{ old('dimensions') }}" />
                                                    @error('dimensions')
                                                        <div class="error-message">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mb-4">
                                                    <label class="form-label">Rating</label>
                                                    <input type="number" name="rating" class="form-control-custom" placeholder="0.00" step="0.01" min="0" max="5" value="{{ old('rating') }}" />
                                                    @error('rating')
                                                        <div class="error-message">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <label class="form-label">Status</label>
                                                    <div class="switch-container">
                                                        <label class="switch">
                                                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }} />
                                                            <span class="slider"></span>
                                                        </label>
                                                        <span class="switch-label">Aktif</span>
                                                    </div>
                                                    @error('is_active')
                                                        <div class="error-message">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <label class="form-label">Koleksi Unggulan</label>
                                                    <div class="switch-container">
                                                        <label class="switch">
                                                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} />
                                                            <span class="slider"></span>
                                                        </label>
                                                        <span class="switch-label">Tampilkan di halaman utama</span>
                                                    </div>
                                                    @error('is_featured')
                                                        <div class="error-message">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-card">
                                        <div class="card-header-custom">
                                            <h4><i class="fas fa-image text-warning me-2"></i>Gambar Utama</h4>
                                        </div>
                                        <div class="card-body-custom">
                                            <div class="image-upload-area" id="image-upload-area">
                                                <div class="upload-content">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                    <h5>Upload Gambar</h5>
                                                    <p>Drag & drop atau klik untuk memilih</p>
                                                    <button type="button" class="btn-upload" onclick="document.getElementById('image-input').click()">
                                                        Pilih File
                                                    </button>
                                                </div>
                                                <input type="file" name="image" id="image-input" accept=".png, .jpg, .jpeg, .gif" class="d-none" />
                                            </div>
                                            <div class="upload-info">
                                                <small>Format: PNG, JPG, JPEG, GIF. Maksimal 2MB.</small>
                                            </div>
                                            @error('image')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Gambar & Galeri -->
                    <div class="wizard-step" data-step="2">
                        <div class="step-content">
                            <div class="form-card">
                                <div class="card-header-custom">
                                    <h4><i class="fas fa-images text-info me-2"></i>Galeri Gambar</h4>
                                </div>
                                <div class="card-body-custom">
                                    <div class="gallery-upload-area" id="gallery-upload-area">
                                        <div class="upload-content">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <h5>Upload Multiple Gambar</h5>
                                            <p>Drag & drop atau klik untuk memilih beberapa gambar</p>
                                            <button type="button" class="btn-upload" onclick="document.getElementById('gallery-input').click()">
                                                Pilih Gambar
                                            </button>
                                        </div>
                                        <input type="file" name="gallery_images[]" id="gallery-input" accept=".png, .jpg, .jpeg, .gif" multiple class="d-none" />
                                    </div>
                                    <div class="gallery-preview" id="gallery-preview"></div>
                                    <div class="upload-info">
                                        <small>Upload multiple gambar untuk galeri (opsional). Format: PNG, JPG, JPEG, GIF. Maksimal 2MB per gambar.</small>
                                    </div>
                                    @error('gallery_images.*')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror

                                    <div class="mt-5">
                                        <label class="form-label">Signifikansi Budaya</label>
                                        <textarea name="cultural_significance" class="form-control-custom" rows="4" placeholder="Masukkan signifikansi budaya koleksi">{{ old('cultural_significance') }}</textarea>
                                        <div class="form-text">Konten ini akan ditampilkan di bagian "Signifikansi Budaya"</div>
                                        @error('cultural_significance')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Sejarah -->
                    <div class="wizard-step" data-step="3">
                        <div class="step-content">
                            <div class="form-card">
                                <div class="card-header-custom">
                                    <h4><i class="fas fa-history text-secondary me-2"></i>Timeline Sejarah</h4>
                                </div>
                                <div class="card-body-custom">
                                    <div id="history-container">
                                        <div class="history-item">
                                            <div class="history-header">
                                                <h6>Timeline #1</h6>
                                                <button type="button" class="btn-remove" onclick="removeHistoryItem(this)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Judul</label>
                                                    <input type="text" name="history_titles[]" class="form-control-custom" placeholder="Contoh: Periode Pembuatan" />
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Tahun</label>
                                                    <input type="text" name="history_years[]" class="form-control-custom" placeholder="Contoh: 1920-1930" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Deskripsi</label>
                                                    <textarea name="history_descriptions[]" class="form-control-custom" rows="2" placeholder="Deskripsi timeline"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn-add" onclick="addHistoryItem()">
                                        <i class="fas fa-plus me-2"></i>Tambah Timeline
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Spesifikasi -->
                    <div class="wizard-step" data-step="4">
                        <div class="step-content">
                            <div class="form-card">
                                <div class="card-header-custom">
                                    <h4><i class="fas fa-cogs text-primary me-2"></i>Spesifikasi Teknis</h4>
                                </div>
                                <div class="card-body-custom">
                                    <div class="mb-4">
                                        <label class="form-label">Overview Spesifikasi Teknis</label>
                                        <textarea name="technical_overview" class="form-control-custom" rows="4" placeholder="Masukkan overview spesifikasi teknis koleksi">{{ old('technical_overview') }}</textarea>
                                        <div class="form-text">Konten ini akan ditampilkan di tab "Details" bagian spesifikasi teknis</div>
                                        @error('technical_overview')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Status Konservasi</label>
                                        <input type="text" name="conservation_status" class="form-control-custom" placeholder="Contoh: Baik, Perlu Perbaikan" value="{{ old('conservation_status') }}" />
                                        @error('conservation_status')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Overview Konservasi</label>
                                        <textarea name="conservation_overview" class="form-control-custom" rows="4" placeholder="Masukkan overview konservasi koleksi">{{ old('conservation_overview') }}</textarea>
                                        <div class="form-text">Konten ini akan ditampilkan di tab "Details" bagian informasi konservasi</div>
                                        @error('conservation_overview')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 5: Selesai -->
                    <div class="wizard-step" data-step="5">
                        <div class="step-content">
                            <div class="completion-card">
                                <div class="completion-icon">
                                    <i class="fas fa-check-circle"></i>
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
                    <div class="wizard-navigation">
                        <button type="button" class="btn-nav btn-prev" id="prev-btn" onclick="prevStep()" style="display: none;">
                            <i class="fas fa-arrow-left me-2"></i>Sebelumnya
                        </button>
                        <div class="ms-auto">
                            <button type="button" class="btn-nav btn-next" id="next-btn" onclick="nextStep()">
                                Selanjutnya<i class="fas fa-arrow-right ms-2"></i>
                            </button>
                            <button type="submit" class="btn-nav btn-submit" id="submit-btn" style="display: none;">
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
/* Wizard Progress */
.wizard-progress {
    margin-bottom: 3rem;
}

.progress-container {
    position: relative;
    max-width: 800px;
    margin: 0 auto;
}

.progress-bar {
    position: absolute;
    top: 25px;
    left: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    transition: width 0.3s ease;
    z-index: 1;
}

.steps-container {
    display: flex;
    justify-content: space-between;
    position: relative;
    z-index: 2;
}

.step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
}

.step-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #f8f9fa;
    border: 3px solid #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 0.5rem;
    transition: all 0.3s ease;
    color: #6c757d;
    font-size: 1.2rem;
}

.step.active .step-icon {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: #667eea;
    color: white;
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.step.completed .step-icon {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border-color: #28a745;
    color: white;
    transform: scale(1.05);
}

.step-text {
    font-size: 0.875rem;
    font-weight: 600;
    color: #6c757d;
    transition: all 0.3s ease;
}

.step.active .step-text {
    color: #667eea;
    font-weight: 700;
}

.step.completed .step-text {
    color: #28a745;
}

/* Step Content */
.wizard-step {
    display: none;
    animation: slideIn 0.5s ease;
}

.wizard-step.active {
    display: block;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.step-content {
    max-width: 1200px;
    margin: 0 auto;
}

/* Form Cards */
.form-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
    margin-bottom: 1.5rem;
}

.card-header-custom {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 1.5rem;
    border-bottom: 1px solid #dee2e6;
}

.card-header-custom h4 {
    margin: 0;
    color: #495057;
    font-weight: 700;
    font-size: 1.1rem;
}

.card-body-custom {
    padding: 2rem;
}

/* Form Controls */
.form-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: #495057;
    font-size: 0.9rem;
}

.form-label.required::after {
    content: " *";
    color: #dc3545;
}

.form-control-custom {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.form-control-custom:focus {
    outline: none;
    border-color: #667eea;
    background: white;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-control-custom::placeholder {
    color: #adb5bd;
}

/* Switch */
.switch-container {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 34px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}

input:checked + .slider {
    background-color: #667eea;
}

input:checked + .slider:before {
    transform: translateX(26px);
}

.switch-label {
    font-weight: 500;
    color: #495057;
}

/* Image Upload */
.image-upload-area, .gallery-upload-area {
    border: 3px dashed #dee2e6;
    border-radius: 15px;
    padding: 3rem 2rem;
    text-align: center;
    transition: all 0.3s ease;
    background: #f8f9fa;
    cursor: pointer;
}

.image-upload-area:hover, .gallery-upload-area:hover {
    border-color: #667eea;
    background: #f0f2ff;
}

.upload-content i {
    font-size: 3rem;
    color: #adb5bd;
    margin-bottom: 1rem;
}

.upload-content h5 {
    color: #495057;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.upload-content p {
    color: #6c757d;
    margin-bottom: 1.5rem;
}

.btn-upload {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 0.75rem 2rem;
    border-radius: 25px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-upload:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.upload-info {
    margin-top: 1rem;
    text-align: center;
    color: #6c757d;
}

/* Gallery Preview */
.gallery-preview {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

.gallery-preview-item {
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.gallery-preview-item img {
    width: 100%;
    height: 100px;
    object-fit: cover;
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
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
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

.btn-remove {
    background: #dc3545;
    color: white;
    border: none;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-remove:hover {
    background: #c82333;
    transform: scale(1.1);
}

.btn-add {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 25px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
}

/* Completion Step */
.completion-card {
    text-align: center;
    padding: 3rem 2rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.completion-icon {
    margin-bottom: 2rem;
}

.completion-icon i {
    font-size: 5rem;
    color: #28a745;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(-5px);
    }
}

.completion-card h3 {
    color: #495057;
    font-weight: 700;
    margin-bottom: 1rem;
}

.completion-card p {
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
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    border-left: 4px solid #667eea;
}

.summary-item i {
    font-size: 1.5rem;
    margin-right: 1rem;
    color: #667eea;
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

.btn-nav {
    padding: 0.75rem 2rem;
    border-radius: 25px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.btn-prev {
    background: #6c757d;
    color: white;
}

.btn-prev:hover {
    background: #5a6268;
    transform: translateX(-2px);
}

.btn-next {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-next:hover {
    transform: translateX(2px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.btn-submit {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
}

/* Error Messages */
.error-message {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.form-text {
    color: #6c757d;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

/* Responsive */
@media (max-width: 768px) {
    .steps-container {
        flex-direction: column;
        gap: 1rem;
    }

    .progress-bar {
        display: none;
    }

    .completion-summary {
        grid-template-columns: 1fr;
    }

    .wizard-navigation {
        flex-direction: column;
        gap: 1rem;
    }

    .btn-nav {
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
let currentStep = 1;
const totalSteps = 5;

function updateWizardSteps() {
    // Update progress bar
    const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
    document.getElementById('progress-bar').style.width = progress + '%';

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
            <button type="button" class="btn-remove" onclick="removeHistoryItem(this)">
                <i class="fas fa-trash"></i>
            </button>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label class="form-label">Judul</label>
                <input type="text" name="history_titles[]" class="form-control-custom" placeholder="Contoh: Periode Pembuatan" />
            </div>
            <div class="col-md-3">
                <label class="form-label">Tahun</label>
                <input type="text" name="history_years[]" class="form-control-custom" placeholder="Contoh: 1920-1930" />
            </div>
            <div class="col-md-6">
                <label class="form-label">Deskripsi</label>
                <textarea name="history_descriptions[]" class="form-control-custom" rows="2" placeholder="Deskripsi timeline"></textarea>
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
    const imageUploadArea = document.getElementById('image-upload-area');
    const imageInput = document.getElementById('image-input');

    imageUploadArea.addEventListener('click', () => imageInput.click());

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imageUploadArea.innerHTML = `
                    <div class="upload-content">
                        <img src="${e.target.result}" style="width: 100%; max-width: 200px; height: 150px; object-fit: cover; border-radius: 10px; margin-bottom: 1rem;">
                        <h5>Gambar Terpilih</h5>
                        <p>${file.name}</p>
                        <button type="button" class="btn-upload" onclick="document.getElementById('image-input').click()">
                            Ganti Gambar
                        </button>
                    </div>
                `;
            };
            reader.readAsDataURL(file);
        }
    });

    // Gallery upload
    const galleryUploadArea = document.getElementById('gallery-upload-area');
    const galleryInput = document.getElementById('gallery-input');
    const galleryPreview = document.getElementById('gallery-preview');

    galleryUploadArea.addEventListener('click', () => galleryInput.click());

    galleryInput.addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        galleryPreview.innerHTML = '';

        files.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewItem = document.createElement('div');
                previewItem.className = 'gallery-preview-item';
                previewItem.innerHTML = `
                    <img src="${e.target.result}">
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
