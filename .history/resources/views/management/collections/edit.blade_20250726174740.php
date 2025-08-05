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
            <div class="card-body py-4">
                <form action="{{ route('collections-management.update', $collection->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
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
                                <label class="fw-semibold fs-6 mb-2">Konten Sejarah</label>
                                <textarea name="history_content" class="form-control form-control-solid" rows="4" placeholder="Masukkan konten untuk tab sejarah koleksi">{{ old('history_content', $collection->history_content) }}</textarea>
                                <div class="form-text">Konten ini akan ditampilkan di tab "Sejarah" pada halaman detail koleksi</div>
                                @error('history_content')
                                    <div class="text-danger fs-7 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Form group-->

                            <!--begin::Form group-->
                            <div class="fv-row mb-7">
                                <label class="fw-semibold fs-6 mb-2">Signifikansi Budaya</label>
                                <textarea name="cultural_significance" class="form-control form-control-solid" rows="4" placeholder="Masukkan signifikansi budaya koleksi">{{ old('cultural_significance', $collection->cultural_significance) }}</textarea>
                                <div class="form-text">Konten ini akan ditampilkan di bagian "Signifikansi Budaya"</div>
                                @error('cultural_significance')
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
