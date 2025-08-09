@extends('layouts.dashboard.dashboard')
@section('menu')
    Dashboard Analytics
@endsection

@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Dashboard</li>
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">

            <!-- Welcome Section -->
            <div class="row mb-8">
                <div class="col-12">
                    <div class="card card-flush border-0 position-relative overflow-hidden shadow-lg">
                        <!-- Animated Background Pattern -->
                        <div class="position-absolute top-0 end-0 opacity-5">
                            <i class="ki-duotone ki-museum fs-20x text-white">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>

                        <!-- Modern Gradient Background -->
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, #0d9488 0%, #0f766e 25%, #14b8a6 50%, #06b6d4 75%, #0891b2 100%); opacity: 0.9;"></div>

                        <!-- Glass Effect Overlay -->
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px);"></div>

                        <div class="card-body p-8 position-relative">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <!-- Main Title with Modern Design -->
                                    <div class="d-flex align-items-center mb-4">
                                        <div>
                                            <h1 class="text-white fw-bold fs-2hx mb-2" style="text-shadow: 0 2px 4px rgba(0,0,0,0.3);">Selamat Datang di BDARU</h1>
                                            <div class="d-flex align-items-center">
                                                <span class="badge fs-8 fw-bold me-2 px-3 py-2" style="background: linear-gradient(45deg, #0d9488, #0f766e); color: white; border: none;">v1.0</span>
                                                <span class="text-white fs-7 fw-semibold" style="text-shadow: 0 1px 2px rgba(0,0,0,0.2);">Museum Digital Balai Adat Rajo Penghulu</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Subtitle with Enhanced Styling -->
                                    <h2 class="text-white fs-4 fw-semibold mb-4" style="text-shadow: 0 1px 3px rgba(0,0,0,0.3);">
                                        @if(Auth::user()->hasRole('admin'))
                                            Dashboard Admin - Manajemen Sistem Lengkap
                                        @elseif(Auth::user()->hasRole('pengelola'))
                                            Dashboard Pengelola - Manajemen Konten
                                        @else
                                            Dashboard User - Akses Terbatas
                                        @endif
                                    </h2>

                                    <!-- Description with Better Typography -->
                                    <div class="text-white fs-5 mb-6" style="text-shadow: 0 1px 2px rgba(0,0,0,0.2);">
                                        Selamat datang di sistem manajemen museum digital BDARU. Kelola koleksi, berita, agenda, testimoni, dan data museum dengan mudah dan efisien.
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="text-end">
                                        <!-- Enhanced Date and Time -->
                                        <div class="rounded-4 p-5 mb-4 shadow-lg" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                            <div class="text-white fs-8 fw-bold mb-2" style="opacity: 0.9;">TANGGAL & WAKTU</div>
                                            <div class="text-white fs-1 fw-bold mb-2" style="text-shadow: 0 2px 4px rgba(0,0,0,0.3);">{{ now()->format('d') }}</div>
                                            <div class="text-white fs-5 fw-semibold mb-2" style="text-shadow: 0 1px 2px rgba(0,0,0,0.2);">{{ now()->translatedFormat('F Y') }}</div>
                                            <div class="text-white fs-7 fw-medium" style="opacity: 0.9;">{{ now()->translatedFormat('l, H:i') }}</div>
                                        </div>

                                        <!-- Enhanced System Status -->
                                        <div class="rounded-4 p-4 shadow-lg" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                            <div class="d-flex align-items-center justify-content-end mb-2">
                                                <div class="rounded-circle w-10px h-10px me-2" style="background: linear-gradient(45deg, #00b894, #00cec9); box-shadow: 0 0 10px rgba(0, 184, 148, 0.5);"></div>
                                                <span class="text-white fs-8 fw-bold">SISTEM AKTIF</span>
                                            </div>
                                            <div class="text-white fs-7 fw-medium" style="opacity: 0.9;">Real-time monitoring</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Timeline Recent Activities -->
            <div class="row mb-8">
                <div class="col-12">
                    <div class="card card-flush border-0 shadow-lg">
                        <div class="card-header">
                            <h3 class="card-title fw-bold">Aktivitas Terbaru</h3>
                        </div>
                        <div class="card-body pt-0">
                            <div class="timeline">
                                @forelse($recentActivities ?? [] as $activity)
                                <div class="timeline-item">
                                    <div class="timeline-badge bg-light-{{ $activity['color'] }}">
                                        <i class="{{ $activity['icon'] }} fs-2 text-{{ $activity['color'] }}">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="fw-bold text-gray-800">{{ $activity['title'] }}</div>
                                        <div class="text-gray-600 fs-7">{{ $activity['description'] }}</div>
                                        <div class="text-gray-500 fs-8 mt-1">{{ $activity['time'] }}</div>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-8">
                                    <i class="ki-duotone ki-information-5 fs-3x text-gray-400 mb-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <div class="text-gray-600">Belum ada aktivitas terbaru</div>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions, Stats, etc. -->
            <!-- ... (tambahkan section lain sesuai kebutuhan Anda) ... -->

        </div>
    </div>
@endsection
