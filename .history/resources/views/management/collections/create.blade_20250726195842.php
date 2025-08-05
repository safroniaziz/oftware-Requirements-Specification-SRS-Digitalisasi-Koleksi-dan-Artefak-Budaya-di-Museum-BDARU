@extends('layouts.dashboard.dashboard')

@section('title', 'Tambah Koleksi - BDARU Museum')

@section('content')
<!-- Toast Notification Styles -->
<style>
    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 99999;
        max-width: 400px;
        pointer-events: none;
    }

    .toast {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        margin-bottom: 10px;
        padding: 16px;
        border-left: 4px solid #007bff;
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 300px;
        pointer-events: auto;
        position: relative;
        z-index: 99999;
    }

    .toast.toast-error {
        border-left-color: #dc3545;
        background: #fff5f5;
    }

    .toast.toast-warning {
        border-left-color: #ffc107;
        background: #fffbf0;
    }

    .toast.toast-success {
        border-left-color: #28a745;
        background: #f0fff4;
    }

    .toast .toast-icon {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        color: #ffffff;
        flex-shrink: 0;
    }

    .toast.toast-error .toast-icon {
        background: #dc3545;
    }

    .toast.toast-warning .toast-icon {
        background: #ffc107;
    }

    .toast.toast-success .toast-icon {
        background: #28a745;
    }

    .toast .toast-content {
        flex: 1;
    }

    .toast .toast-title {
        font-weight: 600;
        margin-bottom: 4px;
        color: #333;
        font-size: 14px;
    }

    .toast .toast-message {
        color: #666;
        font-size: 13px;
        line-height: 1.4;
    }

    @keyframes toastSlideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes toastSlideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
</style>

<!-- Toast Container -->
<div class="toast-container" id="toast-container"></div>

<!-- Toast Notification JavaScript -->
<script>
    function showToast(type, title, message, duration = 5000) {
        console.log('showToast called with:', type, title, message);

        const toastContainer = document.getElementById('toast-container');
        console.log('toastContainer in showToast:', toastContainer);

        if (!toastContainer) {
            console.error('Toast container not found');
            alert('Toast container not found in showToast!');
            return;
        }

        console.log('Creating toast element...');
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;

        const icon = type === 'error' ? '✕' : type === 'warning' ? '⚠' : '✓';

        toast.innerHTML = `
            <div class="toast-icon">${icon}</div>
            <div class="toast-content">
                <div class="toast-title">${title}</div>
                <div class="toast-message">${message}</div>
            </div>
        `;

        console.log('Toast HTML created:', toast.outerHTML);
        console.log('Appending toast to container...');
        toastContainer.appendChild(toast);
        console.log('Toast appended successfully');

        // Auto remove after duration
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, duration);

        // Click to dismiss
        toast.addEventListener('click', () => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        });
    }
</script>

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
                        <!--begin::Test Toast Button-->
                        <button type="button" class="btn btn-info me-3" onclick="alert('JavaScript is working!'); testToast();">
                            <i class="fas fa-bell me-2"></i>
                            Test Toast
                        </button>
                        <!--end::Test Toast Button-->
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
                <div class="wizard-container mb-8">
                    <div class="wizard-steps">
                        <div class="step active" data-step="1">
                            <div class="step-dot"></div>
                            <span class="step-label">Dasar</span>
                        </div>
                        <div class="step" data-step="2">
                            <div class="step-dot"></div>
                            <span class="step-label">Media</span>
                        </div>
                        <div class="step" data-step="3">
                            <div class="step-dot"></div>
                            <span class="step-label">Sejarah</span>
                        </div>
                        <div class="step" data-step="4">
                            <div class="step-dot"></div>
                            <span class="step-label">Detail</span>
                        </div>
                        <div class="step" data-step="5">
                            <div class="step-dot"></div>
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
                                    </div>

                                    <div class="form-section mt-6">
                                        <h5 class="section-title">Detail Teknis</h5>

                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Material</label>
                                                <input type="text" name="material" class="form-input" placeholder="Contoh: Kayu, Logam, Kain" value="{{ old('material') }}" />
                                                @error('material')
                                                    <div class="error-text">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Dimensi</label>
                                                <input type="text" name="dimensions" class="form-input" placeholder="Contoh: 50cm x 30cm x 20cm" value="{{ old('dimensions') }}" />
                                                @error('dimensions')
                                                    <div class="error-text">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Rating</label>
                                                <input type="number" name="rating" class="form-input" placeholder="0.00" step="0.01" min="0" max="5" value="{{ old('rating') }}" />
                                                @error('rating')
                                                    <div class="error-text">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row g-3 mt-4">
                                            <div class="col-md-6">
                                                <label class="form-label">Status</label>
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
                                                <button type="button" class="upload-btn" onclick="document.getElementById('image-input').click()">
                                                    Pilih File
                                                </button>
                                            </div>
                                            <input type="file" name="image" id="image-input" accept=".png, .jpg, .jpeg, .gif" class="d-none" />
                                        </div>

                                        <div class="upload-info">
                                            <small>Format: PNG, JPG, JPEG, GIF. Maksimal 2MB.</small>
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
                                        <button type="button" class="upload-btn" onclick="document.getElementById('gallery-input').click()">
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
                                    <div class="error-text">{{ $message }}</div>
                                @enderror

                                <div class="mt-6">
                                    <label class="form-label">Signifikansi Budaya</label>
                                    <textarea name="cultural_significance" class="form-input" rows="4" placeholder="Masukkan signifikansi budaya koleksi">{{ old('cultural_significance') }}</textarea>
                                    <div class="form-hint">Konten ini akan ditampilkan di bagian "Signifikansi Budaya"</div>
                                    @error('cultural_significance')
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
                                    <label class="form-label">Overview Spesifikasi Teknis</label>
                                    <textarea name="technical_overview" class="form-input" rows="4" placeholder="Masukkan overview spesifikasi teknis koleksi">{{ old('technical_overview') }}</textarea>
                                    <div class="form-hint">Konten ini akan ditampilkan di tab "Details" bagian spesifikasi teknis</div>
                                    @error('technical_overview')
                                        <div class="error-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Status Konservasi</label>
                                    <input type="text" name="conservation_status" class="form-input" placeholder="Contoh: Baik, Perlu Perbaikan" value="{{ old('conservation_status') }}" />
                                    @error('conservation_status')
                                        <div class="error-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Overview Konservasi</label>
                                    <textarea name="conservation_overview" class="form-input" rows="4" placeholder="Masukkan overview konservasi koleksi">{{ old('conservation_overview') }}</textarea>
                                    <div class="form-hint">Konten ini akan ditampilkan di tab "Details" bagian informasi konservasi</div>
                                    @error('conservation_overview')
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
                    <div class="wizard-navigation">
                        <button type="button" class="nav-btn nav-prev" id="prev-btn" onclick="prevStep()" style="display: none;">
                            <i class="fas fa-arrow-left me-2"></i>Sebelumnya
                        </button>
                        <div class="ms-auto">
                            <button type="button" class="nav-btn nav-next" id="next-btn" onclick="nextStep()">
                                Selanjutnya<i class="fas fa-arrow-right ms-2"></i>
                            </button>
                            <button type="submit" class="nav-btn nav-submit" id="submit-btn" style="display: none;">
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
    margin-bottom: 3rem;
}

.wizard-steps {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 800px;
    margin: 0 auto;
    position: relative;
}

.wizard-steps::before {
    content: '';
    position: absolute;
    top: 15px;
    left: 0;
    right: 0;
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
}

.step-dot {
    width: 30px;
    height: 30px;
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

.step.active .step-dot {
    background: #0d6efd;
    border-color: #0d6efd;
    transform: scale(1.2);
}

.step.completed .step-dot {
    background: #198754;
    border-color: #198754;
}

.step-dot::after {
    content: '';
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.step.active .step-dot::after,
.step.completed .step-dot::after {
    opacity: 1;
}

.step-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #6c757d;
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
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    gap: 0.75rem;
    margin-top: 1rem;
}

.gallery-preview-item {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.gallery-preview-item img {
    width: 100%;
    height: 80px;
    object-fit: cover;
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

/* Toast styles moved to top of file */

/* Responsive */
@media (max-width: 768px) {
    .wizard-steps {
        flex-direction: column;
        gap: 1rem;
    }

    .wizard-steps::before {
        display: none;
    }

    .completion-summary {
        grid-template-columns: 1fr;
    }

    .wizard-navigation {
        flex-direction: column;
        gap: 1rem;
    }

    .nav-btn {
        width: 100%;
        justify-content: center;
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
        // Validate cultural_significance (optional but recommended)
        const culturalSignificance = currentStepElement.querySelector('textarea[name="cultural_significance"]');
        if (!culturalSignificance.value.trim()) {
            // Show warning but allow to continue
            showStepWarning('Signifikansi budaya belum diisi. Disarankan untuk mengisi field ini.');
            return true; // Allow to continue with warning
        }
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

    uploadZone.addEventListener('click', () => imageInput.click());

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                uploadZone.innerHTML = `
                    <div class="upload-content">
                        <img src="${e.target.result}" style="width: 100%; max-width: 150px; height: 120px; object-fit: cover; border-radius: 8px; margin-bottom: 1rem;">
                        <h6>Gambar Terpilih</h6>
                        <p>${file.name}</p>
                        <button type="button" class="upload-btn" onclick="document.getElementById('image-input').click()">
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

    galleryUploadZone.addEventListener('click', () => galleryInput.click());

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
                `;
                galleryPreview.appendChild(previewItem);
            };
            reader.readAsDataURL(file);
        });
    });
});

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

// Test Toast Function
function testToast() {
    console.log('testToast function called');

    // Configure Toastr
    toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: true,
        progressBar: true,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
    };

    // Test different types of toasts
    toastr.error('Ini adalah test toast notification error!', 'Test Error');
    setTimeout(() => {
        toastr.warning('Ini adalah test toast notification warning!', 'Test Warning');
    }, 1000);
    setTimeout(() => {
        toastr.success('Ini adalah test toast notification success!', 'Test Success');
    }, 2000);
}
</script>
@endsection
