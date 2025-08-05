@extends('layouts.dashboard.dashboard')

@section('title', 'Edit Koleksi - BDARU Museum')

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
                        <i class="fas fa-edit me-3 text-primary"></i>
                        Edit Koleksi
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

                                        <div class="mt-4">
                                            <label class="form-label required">Deskripsi</label>
                                            <textarea name="description" class="form-input" rows="4" placeholder="Masukkan deskripsi koleksi" required>{{ old('description', $collection->description) }}</textarea>
                                            @error('description')
                                                <div class="error-text">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row g-3 mt-4">
                                            <div class="col-md-6">
                                                <label class="form-label">Periode Tahun</label>
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

                                        <div class="row g-3 mt-4">
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

                                    <!--begin::QR Code Management-->
                                    <div class="form-section mt-6">
                                        <h5 class="section-title">QR Code Management</h5>

                                        <div class="mb-4">
                                            <label class="form-label">Status QR Code</label>
                                            <div id="qrStatus" class="alert alert-info">
                                                <i class="fas fa-info-circle me-2"></i>
                                                <span id="qrStatusText">Memeriksa status QR Code...</span>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <button type="button" class="btn btn-primary w-100 mb-2" id="generateQrBtn" style="display: none;">
                                                <i class="fas fa-qrcode me-2"></i>
                                                Generate QR Code
                                            </button>
                                            <button type="button" class="btn btn-warning w-100" id="resetQrBtn" style="display: none;">
                                                <i class="fas fa-sync-alt me-2"></i>
                                                Reset QR Code
                                            </button>
                                        </div>

                                        <div id="qrCodeDisplay" class="d-none">
                                            <div class="mb-3">
                                                <label class="form-label">QR Code Terbaru</label>
                                                <div class="text-center">
                                                    <img id="qrCodeImage" src="" alt="QR Code" class="img-fluid border rounded" style="max-width: 200px;">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Kode QR</label>
                                                <div class="input-group">
                                                    <input type="text" id="qrCodeText" class="form-control" readonly>
                                                    <button class="btn btn-outline-secondary" type="button" onclick="copyQrCode()">
                                                        <i class="fas fa-copy"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">URL QR Code</label>
                                                <div class="input-group">
                                                    <input type="text" id="qrCodeUrl" class="form-control" readonly>
                                                    <button class="btn btn-outline-secondary" type="button" onclick="copyQrCodeUrl()">
                                                        <i class="fas fa-copy"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="qrCodesList" class="d-none">
                                            <div class="mb-3">
                                                <label class="form-label">Semua QR Code</label>
                                                <div id="qrCodesTable" class="table-responsive">
                                                    <!-- QR codes will be loaded here -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::QR Code Management-->
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-section">
                                        <h5 class="section-title">Gambar Utama</h5>

                                        <div class="upload-zone" id="upload-zone" style="{{ $collection->image_path ? 'display: none;' : '' }}">
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
                                        <div id="image-preview-area" class="mt-3" style="{{ $collection->image_path ? 'display: block;' : 'display: none;' }}">
                                            <div class="image-preview-container w-full rounded-lg overflow-hidden border border-gray-200" style="height: 192px; background-color: #f8f9fa;">
                                                <img id="preview-image" class="w-full h-full object-contain" alt="Preview" src="{{ $collection->image_path ? asset('storage/' . $collection->image_path) : '' }}">
                                            </div>
                                            <div class="text-center mt-2">
                                                <h6 class="text-sm font-semibold text-gray-800 mb-1">{{ $collection->image_path ? 'Gambar Saat Ini' : 'Gambar Terpilih' }}</h6>
                                                <p id="preview-filename" class="text-xs text-gray-600 mb-2">{{ $collection->image_path ? basename($collection->image_path) : '' }}</p>
                                                <div class="text-xs text-gray-500 mb-2">
                                                    <span id="preview-size" class="inline-block bg-blue-100 text-blue-800 px-1 py-0.5 rounded text-xs">{{ $collection->image_path ? 'Gambar tersimpan' : '' }}</span>
                                                    <span id="preview-dimensions" class="inline-block bg-green-100 text-green-800 px-1 py-0.5 rounded text-xs ml-1">{{ $collection->image_path ? '800×600px' : '' }}</span>
                                                </div>
                                                <div class="text-xs text-gray-500 mb-2">
                                                    <span class="inline-block bg-yellow-100 text-yellow-800 px-1 py-0.5 rounded text-xs">Akan di-resize ke 800×600px</span>
                                                </div>
                                                <button type="button" class="btn-change-image" onclick="changeImage()">
                                                    <i class="fas fa-edit" style="font-size: 12px;"></i>
                                                    <span>Ganti Gambar</span>
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
                                        <h6>Tambah Gambar ke Galeri</h6>
                                        <p>Drag & drop atau klik untuk menambah gambar baru ke galeri</p>
                                        <button type="button" class="upload-btn" id="gallery-upload-btn">
                                            Tambah Gambar
                                        </button>
                                    </div>
                                </div>
                                <input type="file" name="gallery_images[]" id="gallery-input" accept=".png, .jpg, .jpeg, .gif" multiple style="display: none;" />

                                <div class="gallery-preview" id="gallery-preview">
                                    @if($collection->galleryImages && count($collection->galleryImages) > 0)
                                        @foreach($collection->galleryImages as $index => $galleryImage)
                                            <div class="gallery-preview-item" data-gallery-id="{{ $galleryImage->id }}">
                                                <div class="gallery-item-container w-full rounded overflow-hidden border border-gray-200" style="height: 192px; background-color: #f8f9fa;">
                                                    <img src="{{ $galleryImage->image_url }}" class="w-full h-full object-contain" alt="Gallery Image">
                                                </div>
                                                <div class="gallery-item-info mt-2 text-center">
                                                    <p class="text-xs text-gray-600 truncate">{{ basename($galleryImage->image_path) }}</p>
                                                    <p class="text-xs text-gray-500">Gambar tersimpan</p>
                                                    <p class="text-xs text-yellow-600">300×200px</p>
                                                    <button type="button" class="btn btn-sm btn-outline-danger mt-1" onclick="removeGalleryImage({{ $galleryImage->id }}, this)">
                                                        <i class="fas fa-trash" style="font-size: 10px;"></i>
                                                        <span class="ms-1">Hapus</span>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <!-- Debug info -->
                                        <div class="text-center text-gray-500 py-4">
                                            <p>Belum ada gambar galeri</p>
                                            <small>Gallery Images Count: {{ $collection->galleryImages ? count($collection->galleryImages) : 0 }}</small>
                                        </div>
                                    @endif
                                </div>

                                <div class="upload-info">
                                    <small>
                                        <strong>Format:</strong> PNG, JPG, JPEG, GIF. Maksimal 2MB per gambar.<br>
                                        <strong>Ukuran Optimal:</strong> 600×400px (3:2 ratio) atau 450×300px (3:2 ratio)<br>
                                        <strong>Catatan:</strong> Gambar akan di-resize ke ukuran 300×200px untuk tampilan optimal di galeri.<br>
                                        <strong>Info:</strong> Anda bisa menambah gambar baru tanpa menghapus gambar yang sudah ada.
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
                                    <textarea name="technical_overview" class="form-input" rows="4" placeholder="Masukkan ringkasan spesifikasi teknis koleksi">{{ old('technical_overview', $collection->technical_overview) }}</textarea>
                                    <div class="form-hint">Konten ini akan ditampilkan di tab "Details" bagian spesifikasi teknis</div>
                                    @error('technical_overview')
                                        <div class="error-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Status Konservasi</label>
                                    <input type="text" name="conservation_status" class="form-input" placeholder="Contoh: Baik, Perlu Perbaikan, Sedang Diproses" value="{{ old('conservation_status', $collection->conservation_status) }}" />
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
                                <button type="button" class="nav-btn nav-submit btn btn-success" id="submit-btn" style="display: none;" onclick="confirmSubmit()">
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

 /* Hide all wizard steps by default */
 .wizard-step {
     display: none;
 }

 /* Show only active step */
 .wizard-step.active {
     display: block;
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

 /* Custom Button Styles */
 .btn-change-image {
     background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
     border: none !important;
     color: white !important;
     padding: 8px 16px !important;
     border-radius: 8px !important;
     font-weight: 500 !important;
     transition: all 0.3s ease !important;
     box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
     display: inline-flex !important;
     align-items: center !important;
     gap: 8px !important;
     text-decoration: none !important;
 }

 .btn-change-image:hover {
     background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%) !important;
     transform: translateY(-2px) !important;
     box-shadow: 0 4px 12px rgba(0,0,0,0.2) !important;
     color: white !important;
 }

 .btn-change-image:active {
     transform: translateY(0) !important;
     box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
 }

.image-preview-container:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transform: translateY(-2px);
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
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    transform: translateY(-1px);
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

    // Update step content - hide all steps first
    document.querySelectorAll('.wizard-step').forEach((step) => {
        step.classList.remove('active');
        step.style.display = 'none';
    });

    // Show only current step
    const currentStepElement = document.querySelector(`.wizard-step[data-step="${currentStep}"]`);
    if (currentStepElement) {
        currentStepElement.classList.add('active');
        currentStepElement.style.display = 'block';
    }

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
    Swal.fire({
        title: 'Error!',
        text: message,
        icon: 'error',
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'OK'
    });
}

function showStepWarning(message) {
    Swal.fire({
        title: 'Warning!',
        text: message,
        icon: 'warning',
        confirmButtonColor: '#ffc107',
        confirmButtonText: 'OK'
    });
}

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
    const form = document.getElementById('collection-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            if (!validateAllSteps()) {
                e.preventDefault();
                showStepError('Mohon lengkapi semua field yang wajib diisi sebelum menyimpan koleksi');

                // Go to first step with error
                currentStep = 1;
                updateWizardSteps();
                validateCurrentStep();
            } else {
                // Reset alert flag when form is successfully submitted
                window.alertsShown = false;
            }
        });
    }

    // Main image upload
    const uploadZone = document.getElementById('upload-zone');
    const imageInput = document.getElementById('image-input');
    const uploadBtn = document.getElementById('upload-btn');

         // Check if there's an existing image
     const existingImage = document.getElementById('preview-image');
     if (existingImage && existingImage.src && !existingImage.src.includes('data:')) {
         // Hide upload zone if image exists
         if (uploadZone) {
             uploadZone.style.display = 'none';
         }
     }

     // Check if there are existing gallery images - but keep upload zone visible
     const galleryPreview = document.getElementById('gallery-preview');
     const galleryUploadZone = document.getElementById('gallery-upload-zone');
     if (galleryPreview && galleryUploadZone) {
         const existingGalleryImages = galleryPreview.querySelectorAll('.gallery-preview-item');
         // Upload zone tetap tampil untuk menambah gambar baru
         // Tidak perlu disembunyikan
     }

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
    const galleryInput = document.getElementById('gallery-input');
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
        // Tidak menghapus gallery yang sudah ada, hanya menambah yang baru

        files.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewItem = document.createElement('div');
                previewItem.className = 'gallery-preview-item';
                previewItem.setAttribute('data-new-image', 'true'); // Tandai sebagai gambar baru
                previewItem.innerHTML = `
                    <div class="gallery-item-container w-full rounded overflow-hidden border border-gray-200" style="height: 192px; background-color: #f8f9fa;">
                        <img src="${e.target.result}" class="w-full h-full object-contain" alt="Gallery Preview">
                    </div>
                    <div class="gallery-item-info mt-2 text-center">
                        <p class="text-xs text-gray-600 truncate">${file.name}</p>
                        <p class="text-xs text-gray-500">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                        <p class="text-xs text-yellow-600">Akan di-resize ke 300×200px</p>
                        <p class="text-xs text-blue-600 font-semibold">Gambar Baru</p>
                        <button type="button" class="btn btn-sm btn-outline-danger mt-1" onclick="removeNewGalleryImage(this)">
                            <i class="fas fa-trash" style="font-size: 10px;"></i>
                            <span class="ms-1">Hapus</span>
                        </button>
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
     const uploadZone = document.getElementById('upload-zone');

     if (imageInput) {
         imageInput.click();
         // Sembunyikan preview dan tampilkan upload zone saat memilih file baru
         previewArea.style.display = 'none';
         if (uploadZone) {
             uploadZone.style.display = 'block';
         }
     } else {
         console.error('Image input not found in changeImage function!');
     }
 }

 // Function to remove existing gallery image
 function removeGalleryImage(galleryId, button) {
     Swal.fire({
         title: 'Konfirmasi Hapus',
         text: 'Apakah Anda yakin ingin menghapus gambar ini dari galeri?',
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#dc3545',
         cancelButtonColor: '#6c757d',
         confirmButtonText: 'Ya, Hapus!',
         cancelButtonText: 'Batal',
         reverseButtons: true
     }).then((result) => {
         if (result.isConfirmed) {
             // Remove from DOM
             const galleryItem = button.closest('.gallery-preview-item');
             galleryItem.remove();

             // Add hidden input to mark for deletion
             const form = document.getElementById('collection-form');
             const deleteInput = document.createElement('input');
             deleteInput.type = 'hidden';
             deleteInput.name = 'delete_gallery_images[]';
             deleteInput.value = galleryId;
             form.appendChild(deleteInput);
         }
     });
 }

 // Function to remove new gallery image (not yet saved)
 function removeNewGalleryImage(button) {
     Swal.fire({
         title: 'Konfirmasi Hapus',
         text: 'Apakah Anda yakin ingin menghapus gambar baru ini?',
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#dc3545',
         cancelButtonColor: '#6c757d',
         confirmButtonText: 'Ya, Hapus!',
         cancelButtonText: 'Batal',
         reverseButtons: true
     }).then((result) => {
         if (result.isConfirmed) {
             // Remove from DOM
             const galleryItem = button.closest('.gallery-preview-item');
             galleryItem.remove();
         }
     });
 }

// Function to confirm submit
function confirmSubmit() {
    Swal.fire({
        title: 'Konfirmasi Simpan',
        text: 'Apakah Anda yakin ingin menyimpan koleksi ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Simpan!',
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
    // Flag to prevent multiple alerts
    if (window.alertsShown) {
        return;
    }
    window.alertsShown = true;

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
    let isValid = true;

    // Validate Step 1 - Required fields
    const name = document.querySelector('input[name="name"]');
    const category = document.querySelector('select[name="category_id"]');
    const description = document.querySelector('textarea[name="description"]');

    if (name && !name.value.trim()) {
        isValid = false;
    }

    if (category && !category.value) {
        isValid = false;
    }

    if (description && !description.value.trim()) {
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

    if (historyTitles.length > 0 && !hasHistory) {
        isValid = false;
    }

    return isValid;
}

// QR Code Management Functions
document.addEventListener('DOMContentLoaded', function() {
    const collectionId = {{ $collection->id }};

    // Load QR codes on page load
    loadQrCodes();

    // Generate QR Code button
    document.getElementById('generateQrBtn').addEventListener('click', function() {
        generateQrCode();
    });

    // Reset QR Code button
    document.getElementById('resetQrBtn').addEventListener('click', function() {
        resetQrCode();
    });
});

function loadQrCodes() {
    const collectionId = {{ $collection->id }};

    fetch(`/admin/collections/${collectionId}/qr-codes`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateQrStatus(data.qr_codes);
            }
        })
        .catch(error => {
            console.error('Error loading QR codes:', error);
            document.getElementById('qrStatusText').textContent = 'Error loading QR codes';
        });
}

function updateQrStatus(qrCodes) {
    const qrStatus = document.getElementById('qrStatus');
    const qrStatusText = document.getElementById('qrStatusText');
    const qrCodeDisplay = document.getElementById('qrCodeDisplay');
    const qrCodesList = document.getElementById('qrCodesList');

    if (qrCodes.length === 0) {
        qrStatus.className = 'alert alert-warning';
        qrStatusText.innerHTML = '<i class="fas fa-exclamation-triangle me-2"></i>Belum ada QR Code. Silakan generate QR Code baru.';
        document.getElementById('generateQrBtn').style.display = 'inline-flex';
        document.getElementById('resetQrBtn').style.display = 'none';
        qrCodeDisplay.classList.add('d-none');
        qrCodesList.classList.add('d-none');
    } else {
        qrStatus.className = 'alert alert-success';
        qrStatusText.innerHTML = `<i class="fas fa-check-circle me-2"></i>Ada ${qrCodes.length} QR Code aktif.`;

        // Show latest QR code
        const latestQr = qrCodes[0];
        document.getElementById('qrCodeImage').src = latestQr.qr_image_url;
        document.getElementById('qrCodeText').value = latestQr.qr_code;
        document.getElementById('qrCodeUrl').value = `${window.location.origin}/collections/{{ $collection->slug }}?qr=${latestQr.qr_code}`;
        qrCodeDisplay.classList.remove('d-none');

        // Show buttons based on QR code status
        document.getElementById('generateQrBtn').style.display = 'none';
        document.getElementById('resetQrBtn').style.display = 'inline-flex';

        // Show all QR codes table
        if (qrCodes.length > 1) {
            showQrCodesTable(qrCodes);
            qrCodesList.classList.remove('d-none');
        } else {
            qrCodesList.classList.add('d-none');
        }
    }
}

function showQrCodesTable(qrCodes) {
    const tableContainer = document.getElementById('qrCodesTable');

    let tableHTML = `
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>QR Code</th>
                    <th>Scan Count</th>
                    <th>Last Scanned</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
    `;

    qrCodes.forEach(qr => {
        tableHTML += `
            <tr>
                <td><code>${qr.qr_code}</code></td>
                <td>${qr.scan_count}</td>
                <td>${qr.last_scanned_at || '-'}</td>
                <td>${qr.created_at}</td>
            </tr>
        `;
    });

    tableHTML += `
            </tbody>
        </table>
    `;

    tableContainer.innerHTML = tableHTML;
}

function generateQrCode() {
    const collectionId = {{ $collection->id }};

    Swal.fire({
        title: 'Generate QR Code?',
        text: 'Apakah Anda yakin ingin membuat QR Code baru?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Generate!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/admin/collections/${collectionId}/generate-qr`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Berhasil!', data.message, 'success');
                    loadQrCodes(); // Reload QR codes
                } else {
                    Swal.fire('Error!', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'Terjadi kesalahan saat generate QR Code', 'error');
            });
        }
    });
}

function resetQrCode() {
    const collectionId = {{ $collection->id }};

    Swal.fire({
        title: 'Reset QR Code?',
        text: 'QR Code baru akan dibuat, tapi QR Code lama tetap bisa digunakan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ffc107',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Reset!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/admin/collections/${collectionId}/reset-qr`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Berhasil!', data.message, 'success');
                    loadQrCodes(); // Reload QR codes
                } else {
                    Swal.fire('Error!', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'Terjadi kesalahan saat reset QR Code', 'error');
            });
        }
    });
}

function copyQrCode() {
    const qrCodeText = document.getElementById('qrCodeText');
    qrCodeText.select();
    qrCodeText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(qrCodeText.value);

    Swal.fire({
        title: 'Copied!',
        text: 'QR Code berhasil disalin ke clipboard',
        icon: 'success',
        timer: 1500,
        showConfirmButton: false
    });
}

function copyQrCodeUrl() {
    const qrCodeUrl = document.getElementById('qrCodeUrl');
    qrCodeUrl.select();
    qrCodeUrl.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(qrCodeUrl.value);

    Swal.fire({
        title: 'Copied!',
        text: 'URL QR Code berhasil disalin ke clipboard',
        icon: 'success',
        timer: 1500,
        showConfirmButton: false
    });
}
</script>
@endsection
