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
                        <div class="col-md-8">
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
