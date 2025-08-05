@extends('layouts.dashboard.dashboard')

@section('title', 'Edit Koleksi - BDARU Museum')

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
                    <h2 class="fw-bold">Edit Koleksi</h2>
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

                <form action="{{ route('collections-management.update', $collection->id) }}" method="POST" enctype="multipart/form-data" id="collection-form">
                    @csrf
                    @method('PUT')

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
                                                <input type="text" name="name" class="form-input" placeholder="Masukkan nama koleksi" value="{{ old('name', $collection->name) }}" required />
                                                @error('name')
                                                    <div class="error-text">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label required">Kategori</label>
                                                <select name="category_id" class="form-input" required>
                                                    <option value="">Pilih kategori</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" {{ old('category_id', $collection->category_id) == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <div class="error-text">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label required">Deskripsi</label>
                                            <textarea name="description" class="form-input" rows="4" placeholder="Masukkan deskripsi koleksi" required>{{ old('description', $collection->description) }}</textarea>
                                            @error('description')
                                                <div class="error-text">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Tahun Periode</label>
                                                <input type="text" name="year_period" class="form-input" placeholder="Contoh: 1920-1930" value="{{ old('year_period', $collection->year_period) }}" />
                                                @error('year_period')
                                                    <div class="error-text">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Lokasi Asal</label>
                                                <input type="text" name="origin_location" class="form-input" placeholder="Contoh: Jawa Tengah" value="{{ old('origin_location', $collection->origin_location) }}" />
                                                @error('origin_location')
                                                    <div class="error-text">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Bahan Material</label>
                                                <input type="text" name="material" class="form-input" placeholder="Contoh: Kayu, Logam, Kain" value="{{ old('material', $collection->material) }}" />
                                                @error('material')
                                                    <div class="error-text">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Ukuran Dimensi</label>
                                                <input type="text" name="dimensions" class="form-input" placeholder="Contoh: 50cm x 30cm x 20cm" value="{{ old('dimensions', $collection->dimensions) }}" />
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
                                                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $collection->is_active) ? 'checked' : '' }} />
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
                                                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $collection->is_featured) ? 'checked' : '' }} />
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

                                        <!-- Preview area di luar dropzone -->
                                        <div id="image-preview-area" class="mt-3" style="display: none;">
                                            <div class="image-preview-container w-full rounded-lg overflow-hidden border border-gray-200" style="height: 192px; background-color: #f8f9fa;">
                                                <img id="preview-image" class="w-full h-full object-contain" alt="Preview">
                                            </div>
                                            <div class="text-center mt-2">
                                                <h6 class="text-sm font-semibold text-gray-800 mb-1">Gambar Terpilih</h6>
                                                <p id="preview-filename" class="text-xs text-gray-600 mb-2"></p>
                                                <div class="text-xs text-gray-500 mb-2">
                                                    <span id="preview-size" class="inline-block bg-blue-100 text-blue-800 px-1 py-0.5 rounded text-xs"></span>
                                                    <span id="preview-dimensions" class="inline-block bg-green-100 text-green-800 px-1 py-0.5 rounded text-xs ml-1"></span>
                                                </div>
                                                <div class="text-xs text-gray-500 mb-2">
                                                    <span class="inline-block bg-yellow-100 text-yellow-800 px-1 py-0.5 rounded text-xs">Akan di-resize ke 800×600px</span>
                                                </div>
                                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="changeImage()">
                                                    Ganti
                                                </button>
                                            </div>
                                        </div>

                                        <div class="upload-info">
                                            <small>
                                                <strong>Format:</strong> PNG, JPG, JPEG, GIF. Maksimal 2MB.<br>
                                                <strong>Ukuran Optimal:</strong> 800×600px (4:3 ratio) atau 1200×800px (3:2 ratio)<br>
                                                <strong>Catatan:</strong> Gambar akan di-resize ke ukuran 800×600px untuk tampilan optimal di website.
                                            </small>
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
                                     <small>
                                         <strong>Format:</strong> PNG, JPG, JPEG, GIF. Maksimal 2MB per gambar.<br>
                                         <strong>Ukuran Optimal:</strong> 600×400px (3:2 ratio) atau 450×300px (3:2 ratio)<br>
                                         <strong>Catatan:</strong> Gambar akan di-resize ke ukuran 300×200px untuk tampilan optimal di galeri.
                                     </small>
                                 </div>
                                 @error('gallery_images.*')
                                     <div class="error-text">{{ $message }}</div>
                                 @enderror
                             </div>

                             <div class="form-section mt-6">
                                 <h5 class="section-title">Nilai Koleksi</h5>

                                 <div class="mb-4">
                                     <label class="form-label">Nilai Budaya</label>
                                     <textarea name="nilai_budaya" class="form-input" rows="4" placeholder="Masukkan nilai budaya koleksi">{{ old('nilai_budaya', $collection->nilai_budaya) }}</textarea>
                                     <div class="form-hint">Konten ini akan ditampilkan di bagian "Nilai Budaya" pada detail koleksi</div>
                                     @error('nilai_budaya')
                                         <div class="error-text">{{ $message }}</div>
                                     @enderror
                                 </div>

                                 <div class="mb-4">
                                     <label class="form-label">Nilai Historis</label>
                                     <textarea name="nilai_historis" class="form-input" rows="4" placeholder="Masukkan nilai historis koleksi">{{ old('nilai_historis', $collection->nilai_historis) }}</textarea>
                                     <div class="form-hint">Konten ini akan ditampilkan di bagian "Nilai Historis" pada detail koleksi</div>
                                     @error('nilai_historis')
                                         <div class="error-text">{{ $message }}</div>
                                     @enderror
                                 </div>

                                 <div class="mb-4">
                                     <label class="form-label">Nilai Edukatif</label>
                                     <textarea name="nilai_edukatif" class="form-input" rows="4" placeholder="Masukkan nilai edukatif koleksi">{{ old('nilai_edukatif', $collection->nilai_edukatif) }}</textarea>
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
                                     @if($collection->histories && count($collection->histories) > 0)
                                         @foreach($collection->histories as $index => $history)
                                             <div class="history-item">
                                                 <div class="history-header">
                                                     <h6>Timeline #{{ $index + 1 }}</h6>
                                                     <button type="button" class="remove-btn" onclick="removeHistoryItem(this)">
                                                         <i class="fas fa-times"></i>
                                                     </button>
                                                 </div>
                                                 <div class="row g-3">
                                                     <div class="col-md-3">
                                                         <label class="form-label">Judul</label>
                                                         <input type="text" name="history_titles[]" class="form-input" placeholder="Contoh: Periode Pembuatan" value="{{ $history->title }}" />
                                                     </div>
                                                     <div class="col-md-3">
                                                         <label class="form-label">Tahun</label>
                                                         <input type="text" name="history_years[]" class="form-input" placeholder="Contoh: 1920-1930" value="{{ $history->year }}" />
                                                     </div>
                                                     <div class="col-md-6">
                                                         <label class="form-label">Deskripsi</label>
                                                         <textarea name="history_descriptions[]" class="form-input" rows="2" placeholder="Deskripsi timeline">{{ $history->description }}</textarea>
                                                     </div>
                                                 </div>
                                             </div>
                                         @endforeach
                                     @else
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
                                     @endif
                                 </div>

                                 <button type="button" class="btn btn-outline-primary mt-3" onclick="addHistoryItem()">
                                     <i class="fas fa-plus me-2"></i>Tambah Timeline
                                 </button>
                             </div>
                         </div>
                     </div>

                     <!-- Step 4: Detail Teknis -->
                     <div class="wizard-step" data-step="4">
                         <div class="step-content">
                             <div class="form-section">
                                 <h5 class="section-title">Detail Teknis</h5>

                                 <div class="mb-4">
                                     <label class="form-label">Status Konservasi</label>
                                     <select name="conservation_status" class="form-input">
                                         <option value="">Pilih status konservasi</option>
                                         <option value="Baik" {{ old('conservation_status', $collection->conservation_status) == 'Baik' ? 'selected' : '' }}>Baik</option>
                                         <option value="Sedang" {{ old('conservation_status', $collection->conservation_status) == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                         <option value="Rusak Ringan" {{ old('conservation_status', $collection->conservation_status) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                         <option value="Rusak Berat" {{ old('conservation_status', $collection->conservation_status) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                                         <option value="Perlu Konservasi" {{ old('conservation_status', $collection->conservation_status) == 'Perlu Konservasi' ? 'selected' : '' }}>Perlu Konservasi</option>
                                     </select>
                                     <div class="form-hint">Status kondisi fisik koleksi saat ini</div>
                                     @error('conservation_status')
                                         <div class="error-text">{{ $message }}</div>
                                     @enderror
                                 </div>

                                 <div class="mb-4">
                                     <label class="form-label">Ringkasan Spesifikasi Teknis</label>
                                     <textarea name="technical_overview" class="form-input" rows="4" placeholder="Masukkan ringkasan spesifikasi teknis koleksi">{{ old('technical_overview', $collection->technical_overview) }}</textarea>
                                     <div class="form-hint">Ringkasan detail teknis dan spesifikasi koleksi</div>
                                     @error('technical_overview')
                                         <div class="error-text">{{ $message }}</div>
                                     @enderror
                                 </div>
                             </div>
                         </div>
                     </div>

                     <!-- Step 5: Selesai -->
                     <div class="wizard-step" data-step="5">
                         <div class="step-content">
                             <div class="form-section">
                                 <h5 class="section-title">Ringkasan Data</h5>
                                 <p class="text-muted mb-4">Berikut adalah ringkasan data koleksi yang akan diperbarui:</p>

                                 <div class="completion-summary">
                                     <div class="summary-item">
                                         <h6>Informasi Dasar</h6>
                                         <p><strong>Nama:</strong> <span id="summary-name">{{ $collection->name }}</span></p>
                                         <p><strong>Kategori:</strong> <span id="summary-category">{{ $collection->category->name ?? 'Tidak ada kategori' }}</span></p>
                                         <p><strong>Deskripsi:</strong> <span id="summary-description">{{ Str::limit($collection->description, 100) }}</span></p>
                                     </div>

                                     <div class="summary-item">
                                         <h6>Detail Koleksi</h6>
                                         <p><strong>Periode:</strong> <span id="summary-period">{{ $collection->year_period ?? 'Tidak ada data' }}</span></p>
                                         <p><strong>Lokasi:</strong> <span id="summary-location">{{ $collection->origin_location ?? 'Tidak ada data' }}</span></p>
                                         <p><strong>Material:</strong> <span id="summary-material">{{ $collection->material ?? 'Tidak ada data' }}</span></p>
                                     </div>

                                     <div class="summary-item">
                                         <h6>Pengaturan</h6>
                                         <p><strong>Status:</strong> <span id="summary-status">{{ $collection->is_active ? 'Aktif' : 'Tidak Aktif' }}</span></p>
                                         <p><strong>Unggulan:</strong> <span id="summary-featured">{{ $collection->is_featured ? 'Ya' : 'Tidak' }}</span></p>
                                         <p><strong>Konservasi:</strong> <span id="summary-conservation">{{ $collection->conservation_status ?? 'Tidak ada data' }}</span></p>
                                     </div>
                                 </div>

                                 <div class="alert alert-info mt-4">
                                     <i class="fas fa-info-circle me-2"></i>
                                     <strong>Catatan:</strong> Klik tombol "Update Koleksi" di bawah untuk menyimpan perubahan.
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
                                 <button type="button" class="nav-btn nav-submit btn btn-success" id="submit-btn" style="display: none;" onclick="confirmSubmit()">
                                     <i class="fas fa-save me-2"></i>
                                     <span class="d-none d-sm-inline">Update Koleksi</span>
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

 /* Form Styles */
 .form-section {
     background: white;
     border-radius: 12px;
     padding: 2rem;
     box-shadow: 0 2px 8px rgba(0,0,0,0.1);
     margin-bottom: 2rem;
 }

 .section-title {
     color: #495057;
     font-weight: 700;
     margin-bottom: 1.5rem;
     font-size: 1.25rem;
     border-bottom: 2px solid #e9ecef;
     padding-bottom: 0.5rem;
 }

 .form-label {
     color: #495057;
     font-weight: 600;
     margin-bottom: 0.5rem;
     font-size: 0.9rem;
 }

 .form-label.required::after {
     content: ' *';
     color: #dc3545;
 }

 .form-input {
     width: 100%;
     padding: 0.75rem 1rem;
     border: 2px solid #e9ecef;
     border-radius: 8px;
     font-size: 0.9rem;
     transition: all 0.3s ease;
     background: #fff;
 }

 .form-input:focus {
     outline: none;
     border-color: #0d6efd;
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
     height: 24px;
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
     transition: .4s;
     border-radius: 24px;
 }

 .toggle-slider:before {
     position: absolute;
     content: "";
     height: 18px;
     width: 18px;
     left: 3px;
     bottom: 3px;
     background-color: white;
     transition: .4s;
     border-radius: 50%;
 }

 input:checked + .toggle-slider {
     background-color: #0d6efd;
 }

 input:checked + .toggle-slider:before {
     transform: translateX(26px);
 }

 .toggle-label {
     font-size: 0.9rem;
     color: #495057;
     font-weight: 500;
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
     display: inline-block;
     margin: 0.5rem;
     padding: 0.75rem;
     background: white;
     border-radius: 0.5rem;
     box-shadow: 0 2px 4px rgba(0,0,0,0.1);
     transition: all 0.3s ease;
     min-width: 200px;
     max-width: 250px;
 }

 .gallery-preview-item:hover {
     transform: translateY(-2px);
     box-shadow: 0 4px 12px rgba(0,0,0,0.15);
 }

 .gallery-item-container {
     border: 1px solid #e9ecef;
     border-radius: 8px;
     overflow: hidden;
 }

 .gallery-item-info {
     margin-top: 0.5rem;
     text-align: center;
 }

 /* History Items */
 .history-item {
     background: white;
     border: 2px solid #e9ecef;
     border-radius: 12px;
     padding: 1.5rem;
     margin-bottom: 1rem;
     transition: all 0.3s ease;
 }

 .history-item:hover {
     border-color: #0d6efd;
     box-shadow: 0 4px 12px rgba(0,0,0,0.1);
 }

 .history-header {
     display: flex;
     justify-content: space-between;
     align-items: center;
     margin-bottom: 1rem;
     padding-bottom: 0.5rem;
     border-bottom: 1px solid #e9ecef;
 }

 .history-header h6 {
     color: #495057;
     font-weight: 600;
     margin: 0;
 }

 .remove-btn {
     background: #dc3545;
     color: white;
     border: none;
     width: 30px;
     height: 30px;
     border-radius: 50%;
     cursor: pointer;
     transition: all 0.3s ease;
     display: flex;
     align-items: center;
     justify-content: center;
 }

 .remove-btn:hover {
     background: #c82333;
     transform: scale(1.1);
 }

 /* Completion Summary */
 .completion-summary {
     display: grid;
     grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
     gap: 1.5rem;
     margin-top: 1rem;
 }

 .summary-item {
     background: #f8f9fa;
     border-radius: 8px;
     padding: 1.5rem;
     border-left: 4px solid #0d6efd;
 }

 .summary-item h6 {
     color: #495057;
     font-weight: 600;
     margin-bottom: 1rem;
     font-size: 1rem;
 }

 .summary-item p {
     color: #6c757d;
     margin-bottom: 0.5rem;
     font-size: 0.9rem;
 }

 .summary-item span {
     font-weight: 500;
     color: #495057;
     font-size: 0.9rem;
 }

 /* Navigation */
 .wizard-navigation {
     margin-top: 2rem;
     padding-top: 1rem;
     border-top: 1px solid #e9ecef;
 }

 .wizard-navigation .d-flex {
     display: flex !important;
     justify-content: space-between !important;
     align-items: center !important;
     width: 100% !important;
 }

 .wizard-navigation .ms-auto {
     margin-left: auto !important;
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

 .gallery-preview {
     display: flex;
     flex-wrap: wrap;
     gap: 1rem;
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

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
         step.style.display = stepNumber === currentStep ? 'block' : 'none';
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
         updateSummary();
     }
 }

 function prevStep() {
     if (currentStep > 1) {
         currentStep--;
         updateWizardSteps();
     }
 }

 function updateSummary() {
     // Update summary with current form values
     const name = document.querySelector('input[name="name"]').value;
     const categorySelect = document.querySelector('select[name="category_id"]');
     const category = categorySelect.options[categorySelect.selectedIndex].text;
     const description = document.querySelector('textarea[name="description"]').value;
     const period = document.querySelector('input[name="year_period"]').value;
     const location = document.querySelector('input[name="origin_location"]').value;
     const material = document.querySelector('input[name="material"]').value;
     const isActive = document.querySelector('input[name="is_active"]').checked;
     const isFeatured = document.querySelector('input[name="is_featured"]').checked;
     const conservation = document.querySelector('select[name="conservation_status"]').value;

     document.getElementById('summary-name').textContent = name || 'Tidak ada data';
     document.getElementById('summary-category').textContent = category || 'Tidak ada kategori';
     document.getElementById('summary-description').textContent = description ? (description.length > 100 ? description.substring(0, 100) + '...' : description) : 'Tidak ada data';
     document.getElementById('summary-period').textContent = period || 'Tidak ada data';
     document.getElementById('summary-location').textContent = location || 'Tidak ada data';
     document.getElementById('summary-material').textContent = material || 'Tidak ada data';
     document.getElementById('summary-status').textContent = isActive ? 'Aktif' : 'Tidak Aktif';
     document.getElementById('summary-featured').textContent = isFeatured ? 'Ya' : 'Tidak';
     document.getElementById('summary-conservation').textContent = conservation || 'Tidak ada data';
 }

 // History management
 function addHistoryItem() {
     const container = document.getElementById('history-container');
     const itemCount = container.children.length + 1;

     const historyItem = document.createElement('div');
     historyItem.className = 'history-item';
     historyItem.innerHTML = `
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

     container.appendChild(historyItem);
 }

 function removeHistoryItem(button) {
     const historyItem = button.closest('.history-item');
     historyItem.remove();

     // Renumber remaining items
     const container = document.getElementById('history-container');
     container.querySelectorAll('.history-item').forEach((item, index) => {
         const header = item.querySelector('.history-header h6');
         header.textContent = `Timeline #${index + 1}`;
     });
 }

 // Image upload functionality
 document.addEventListener('DOMContentLoaded', function() {
     const uploadZone = document.getElementById('upload-zone');
     const imageInput = document.getElementById('image-input');
     const uploadBtn = document.getElementById('upload-btn');

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
                 // Tampilkan preview area
                 const previewArea = document.getElementById('image-preview-area');
                 const previewImage = document.getElementById('preview-image');
                 const previewFilename = document.getElementById('preview-filename');
                 const previewSize = document.getElementById('preview-size');
                 const previewDimensions = document.getElementById('preview-dimensions');

                 previewImage.src = e.target.result;
                 previewFilename.textContent = file.name;
                 previewSize.textContent = `${(file.size / 1024 / 1024).toFixed(2)} MB`;

                 // Tampilkan dimensi gambar
                 previewImage.onload = function() {
                     const width = this.naturalWidth;
                     const height = this.naturalHeight;
                     previewDimensions.textContent = `${width}×${height}px`;
                 };

                 previewArea.style.display = 'block';

                 // Dropzone tetap tampil, tidak disembunyikan
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
                     <div class="gallery-item-container w-full rounded overflow-hidden border border-gray-200" style="height: 192px; background-color: #f8f9fa;">
                         <img src="${e.target.result}" class="w-full h-full object-contain" alt="Gallery Preview">
                     </div>
                     <div class="gallery-item-info mt-2 text-center">
                         <p class="text-xs text-gray-600 truncate">${file.name}</p>
                         <p class="text-xs text-gray-500">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                         <p class="text-xs text-yellow-600">Akan di-resize ke 300×200px</p>
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
     const previewArea = document.getElementById('image-preview-area');

     if (imageInput) {
         imageInput.click();
         // Sembunyikan preview saat memilih file baru
         previewArea.style.display = 'none';
     } else {
         console.error('Image input not found in changeImage function!');
     }
 }

 // Function to confirm submit
 function confirmSubmit() {
     Swal.fire({
         title: 'Konfirmasi Update',
         text: 'Apakah Anda yakin ingin memperbarui koleksi ini?',
         icon: 'question',
         showCancelButton: true,
         confirmButtonColor: '#198754',
         cancelButtonColor: '#6c757d',
         confirmButtonText: 'Ya, Update!',
         cancelButtonText: 'Batal',
         reverseButtons: true
     }).then((result) => {
         if (result.isConfirmed) {
             // Submit form
             document.getElementById('collection-form').submit();
         }
     });
 }

 // Check for success message on page load
 document.addEventListener('DOMContentLoaded', function() {
     // Check if there's a success message in session
     @if(session('success'))
         Swal.fire({
             title: 'Berhasil!',
             text: '{{ session('success') }}',
             icon: 'success',
             confirmButtonColor: '#198754',
             confirmButtonText: 'OK'
         });
     @endif

     // Check if there's an error message
     @if(session('error'))
         Swal.fire({
             title: 'Error!',
             text: '{{ session('error') }}',
             icon: 'error',
             confirmButtonColor: '#dc3545',
             confirmButtonText: 'OK'
         });
     @endif

     // Check for validation errors
     @if($errors->any())
         Swal.fire({
             title: 'Validasi Error!',
             html: `
                 <div class="text-left">
                     <p class="mb-2">Mohon perbaiki kesalahan berikut:</p>
                     <ul class="text-left">
                         @foreach($errors->all() as $error)
                             <li class="mb-1">• {{ $error }}</li>
                         @endforeach
                     </ul>
                 </div>
             `,
             icon: 'error',
             confirmButtonColor: '#dc3545',
             confirmButtonText: 'OK'
         });
     @endif
 });

 function validateAllSteps() {
     // Add validation logic here if needed
     return true;
 }
 </script>
                            <!--begin::Form group-->
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Nama Koleksi</label>
                                <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan nama koleksi" value="{{ old('name', $collection->name) }}" required />
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
                                        <option value="{{ $category->id }}" {{ old('category_id', $collection->category_id) == $category->id ? 'selected' : '' }}>
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
                                <textarea name="description" class="form-control form-control-solid" rows="5" placeholder="Masukkan deskripsi koleksi" required>{{ old('description', $collection->description) }}</textarea>
                                @error('description')
                                    <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Form group-->

                            <div class="row">
                                <!--begin::Form group-->
                                <div class="col-md-6 fv-row mb-7">
                                    <label class="fw-semibold fs-6 mb-2">Periode Tahun</label>
                                    <input type="text" name="year_period" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Contoh: 1920-1930" value="{{ old('year_period', $collection->year_period) }}" />
                                    @error('year_period')
                                        <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!--end::Form group-->

                                <!--begin::Form group-->
                                <div class="col-md-6 fv-row mb-7">
                                    <label class="fw-semibold fs-6 mb-2">Lokasi Asal</label>
                                    <input type="text" name="origin_location" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Contoh: Jawa Tengah" value="{{ old('origin_location', $collection->origin_location) }}" />
                                    @error('origin_location')
                                        <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!--end::Form group-->
                            </div>

                            <div class="row">
                                <!--begin::Form group-->
                                <div class="col-md-6 fv-row mb-7">
                                    <label class="fw-semibold fs-6 mb-2">Bahan Material</label>
                                    <input type="text" name="material" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Contoh: Kayu, Logam, Kain" value="{{ old('material', $collection->material) }}" />
                                    @error('material')
                                        <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!--end::Form group-->

                                <!--begin::Form group-->
                                <div class="col-md-6 fv-row mb-7">
                                    <label class="fw-semibold fs-6 mb-2">Ukuran Dimensi</label>
                                    <input type="text" name="dimensions" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Contoh: 50cm x 30cm x 20cm" value="{{ old('dimensions', $collection->dimensions) }}" />
                                    @error('dimensions')
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
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', $collection->is_active) ? 'checked' : '' }} />
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
                                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ old('is_featured', $collection->is_featured) ? 'checked' : '' }} />
                                        <label class="form-check-label fw-semibold fs-6">Tampilkan di halaman utama</label>
                                    </div>
                                    @error('is_featured')
                                        <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!--end::Form group-->
                            </div>

                            <!--begin::Form group-->
                            <div class="fv-row mb-7">
                                <label class="fw-semibold fs-6 mb-2">Nilai Budaya</label>
                                <textarea name="nilai_budaya" class="form-control form-control-solid" rows="4" placeholder="Masukkan nilai budaya koleksi">{{ old('nilai_budaya', $collection->nilai_budaya) }}</textarea>
                                <div class="form-text">Konten ini akan ditampilkan di bagian "Nilai Budaya" pada detail koleksi</div>
                                @error('nilai_budaya')
                                    <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Form group-->

                            <!--begin::Form group-->
                            <div class="fv-row mb-7">
                                <label class="fw-semibold fs-6 mb-2">Nilai Historis</label>
                                <textarea name="nilai_historis" class="form-control form-control-solid" rows="4" placeholder="Masukkan nilai historis koleksi">{{ old('nilai_historis', $collection->nilai_historis) }}</textarea>
                                <div class="form-text">Konten ini akan ditampilkan di bagian "Nilai Historis" pada detail koleksi</div>
                                @error('nilai_historis')
                                    <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Form group-->

                            <!--begin::Form group-->
                            <div class="fv-row mb-7">
                                <label class="fw-semibold fs-6 mb-2">Nilai Edukatif</label>
                                <textarea name="nilai_edukatif" class="form-control form-control-solid" rows="4" placeholder="Masukkan nilai edukatif koleksi">{{ old('nilai_edukatif', $collection->nilai_edukatif) }}</textarea>
                                <div class="form-text">Konten ini akan ditampilkan di bagian "Nilai Edukatif" pada detail koleksi</div>
                                @error('nilai_edukatif')
                                    <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Form group-->

                            <!--begin::Form group-->
                            <div class="fv-row mb-7">
                                <label class="fw-semibold fs-6 mb-2">Ringkasan Spesifikasi Teknis</label>
                                <textarea name="technical_overview" class="form-control form-control-solid" rows="4" placeholder="Masukkan ringkasan spesifikasi teknis koleksi">{{ old('technical_overview', $collection->technical_overview) }}</textarea>
                                <div class="form-text">Konten ini akan ditampilkan di tab "Details" bagian spesifikasi teknis</div>
                                @error('technical_overview')
                                    <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Form group-->

                            <!--begin::Form group-->
                            <div class="fv-row mb-7">
                                <label class="fw-semibold fs-6 mb-2">Status Konservasi</label>
                                <input type="text" name="conservation_status" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Contoh: Baik, Perlu Perbaikan, Sedang Diproses" value="{{ old('conservation_status', $collection->conservation_status) }}" />
                                <div class="form-text">Status kondisi fisik koleksi saat ini</div>
                                @error('conservation_status')
                                    <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Form group-->



                            <div class="row">
                                <!--begin::Form group-->
                                <div class="col-md-4 fv-row mb-7">
                                    <label class="fw-semibold fs-6 mb-2">Material</label>
                                    <input type="text" name="material" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Contoh: Kayu, Logam, Kain" value="{{ old('material', $collection->material) }}" />
                                    @error('material')
                                        <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!--end::Form group-->

                                <!--begin::Form group-->
                                <div class="col-md-4 fv-row mb-7">
                                    <label class="fw-semibold fs-6 mb-2">Dimensi</label>
                                    <input type="text" name="dimensions" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Contoh: 50cm x 30cm x 20cm" value="{{ old('dimensions', $collection->dimensions) }}" />
                                    @error('dimensions')
                                        <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!--end::Form group-->

                                <!--begin::Form group-->
                                <div class="col-md-4 fv-row mb-7">
                                    <label class="fw-semibold fs-6 mb-2">Status Konservasi</label>
                                    <input type="text" name="conservation_status" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Contoh: Baik, Perlu Perbaikan" value="{{ old('conservation_status', $collection->conservation_status) }}" />
                                    @error('conservation_status')
                                        <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!--end::Form group-->
                            </div>

                            <!--begin::Form group-->
                            <div class="fv-row mb-7">
                                <label class="fw-semibold fs-6 mb-2">Spesifikasi Teknis</label>
                                <textarea name="technical_specifications" class="form-control form-control-solid" rows="4" placeholder="Masukkan spesifikasi teknis koleksi">{{ old('technical_specifications', $collection->technical_specifications) }}</textarea>
                                <div class="form-text">Konten ini akan ditampilkan di tab "Details" bagian spesifikasi teknis</div>
                                @error('technical_specifications')
                                    <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Form group-->

                            <!--begin::Form group-->
                            <div class="fv-row mb-7">
                                <label class="fw-semibold fs-6 mb-2">Informasi Konservasi</label>
                                <textarea name="conservation_info" class="form-control form-control-solid" rows="4" placeholder="Masukkan informasi konservasi koleksi">{{ old('conservation_info', $collection->conservation_info) }}</textarea>
                                <div class="form-text">Konten ini akan ditampilkan di tab "Details" bagian informasi konservasi</div>
                                @error('conservation_info')
                                    <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Form group-->

                            <!--begin::Form group-->
                            <div class="fv-row mb-7">
                                <label class="fw-semibold fs-6 mb-2">Rating</label>
                                <input type="number" name="rating" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="0.00" step="0.01" min="0" max="5" value="{{ old('rating', $collection->rating) }}" />
                                <div class="form-text">Rating koleksi (0.00 - 5.00)</div>
                                @error('rating')
                                    <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Form group-->

                            <!--begin::Form group-->
                            <div class="fv-row mb-7">
                                <label class="fw-semibold fs-6 mb-2">Galeri Gambar</label>
                                <input type="file" name="gallery_images[]" class="form-control form-control-solid mb-3 mb-lg-0" accept=".png, .jpg, .jpeg, .gif" multiple />
                                <div class="form-text">Upload multiple gambar untuk galeri (opsional). Format: png, jpg, jpeg, gif. Maksimal 2MB per gambar.</div>
                                @if($collection->gallery_images)
                                    <div class="mt-3">
                                        <p class="text-sm text-gray-600 mb-2">Galeri gambar saat ini:</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($collection->gallery_images as $image)
                                                <div class="relative">
                                                    <img src="{{ asset('storage/' . $image) }}" alt="Gallery Image" class="w-20 h-20 object-cover rounded border">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                @error('gallery_images.*')
                                    <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Form group-->
                        </div>

                        <div class="col-md-4">
                            <!--begin::Form group-->
                            <div class="fv-row mb-7">
                                <label class="fw-semibold fs-6 mb-2">Gambar Koleksi</label>
                                <div class="image-input image-input-outline" data-kt-image-input="true">
                                    <div class="image-input-wrapper w-150px h-150px" style="background-image: url('{{ $collection->image_path ? asset('storage/' . $collection->image_path) : asset('assets/media/avatars/blank.png') }}')"></div>
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

                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="submit" class="btn btn-primary">
                            <i class="ki-duotone ki-check fs-2"></i>
                            Update Koleksi
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
@endsection
