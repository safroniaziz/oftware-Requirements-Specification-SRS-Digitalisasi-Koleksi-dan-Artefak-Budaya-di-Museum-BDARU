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
                                    <p class="text-white fs-6 mb-5 lh-base fw-medium" style="text-shadow: 0 1px 2px rgba(0,0,0,0.2); opacity: 0.95;">
                                        @if(Auth::user()->hasRole('admin'))
                                            Dashboard Analytics & Performance Monitoring yang menyediakan insight komprehensif
                                            untuk monitoring museum digital, evaluasi kinerja, dan pengembangan berkelanjutan
                                            dalam rangka peningkatan kualitas layanan museum.
                                        @elseif(Auth::user()->hasRole('pengelola'))
                                            Dashboard untuk mengelola konten museum digital, koleksi, berita, dan agenda
                                            dalam rangka memberikan informasi terbaik kepada pengunjung.
                                        @else
                                            Dashboard untuk melihat informasi museum dan aktivitas terbaru.
                                        @endif
                                    </p>

                                    <!-- Enhanced Quick Stats -->
                                    <div class="row g-4">
                                        <div class="col-auto">
                                            <div class="rounded-4 px-4 py-3 shadow-lg" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                                <div class="text-white fs-8 fw-bold mb-1" style="opacity: 0.9;">TOTAL KOLEKSI</div>
                                                <div class="text-white fs-5 fw-bold">{{ $stats['total_collections'] ?? 0 }}</div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="rounded-4 px-4 py-3 shadow-lg" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                                <div class="text-white fs-8 fw-bold mb-1" style="opacity: 0.9;">TOTAL BERITA</div>
                                                <div class="text-white fs-5 fw-bold">{{ $stats['total_news'] ?? 0 }}</div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="rounded-4 px-4 py-3 shadow-lg" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                                <div class="text-white fs-8 fw-bold mb-1" style="opacity: 0.9;">TOTAL AGENDA</div>
                                                <div class="text-white fs-5 fw-bold">{{ $stats['total_events'] ?? 0 }}</div>
                                            </div>
                                        </div>
                                        @if(Auth::user()->hasRole('admin'))
                                        <div class="col-auto">
                                            <div class="rounded-4 px-4 py-3 shadow-lg" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                                <div class="text-white fs-8 fw-bold mb-1" style="opacity: 0.9;">TOTAL PENGGUNA</div>
                                                <div class="text-white fs-5 fw-bold">{{ $stats['total_users'] ?? 0 }}</div>
                                            </div>
                                        </div>
                                        @endif
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

            <!-- Key Metrics Cards -->
            <div class="row g-5 g-xl-8 mb-8">
                <!-- Total Collections -->
                <div class="col-xl-3 col-md-6">
                    <x-dashboard-stats-card
                        title="Total Koleksi"
                        :value="$stats['total_collections'] ?? 0"
                        icon="ki-duotone ki-boxes"
                        color="primary"
                        :percentage="$performanceMetrics['collection_completion_rate'] ?? 85"
                        description="Koleksi museum yang tersedia"
                    />
                </div>

                <!-- Total News -->
                <div class="col-xl-3 col-md-6">
                    <x-dashboard-stats-card
                        title="Total Berita"
                        :value="$stats['total_news'] ?? 0"
                        icon="ki-duotone ki-newspaper"
                        color="success"
                        :percentage="$performanceMetrics['news_publish_rate'] ?? 78"
                        description="Berita yang dipublikasikan"
                    />
                </div>

                <!-- Total Events -->
                <div class="col-xl-3 col-md-6">
                    <x-dashboard-stats-card
                        title="Total Agenda"
                        :value="$stats['total_events'] ?? 0"
                        icon="ki-duotone ki-calendar"
                        color="warning"
                        :percentage="$performanceMetrics['event_completion_rate'] ?? 65"
                        description="Agenda museum yang aktif"
                    />
                </div>

                <!-- Total Users (Admin Only) -->
                @if(Auth::user()->hasRole('admin'))
                <div class="col-xl-3 col-md-6">
                    <x-dashboard-stats-card
                        title="Total Pengguna"
                        :value="$stats['total_users'] ?? 0"
                        icon="ki-duotone ki-profile-user"
                        color="info"
                        :percentage="$performanceMetrics['user_activity_rate'] ?? 92"
                        description="Pengguna terdaftar dalam sistem"
                    />
                </div>
                @else
                <!-- Total Categories for Pengelola -->
                <div class="col-xl-3 col-md-6">
                    <x-dashboard-stats-card
                        title="Total Kategori"
                        :value="$stats['total_categories'] ?? 0"
                        icon="ki-duotone ki-tag"
                        color="info"
                        :percentage="$performanceMetrics['category_usage_rate'] ?? 88"
                        description="Kategori koleksi yang tersedia"
                    />
                </div>
                @endif
            </div>

            <!-- Additional Stats Row -->
            <div class="row g-5 g-xl-8 mb-8">
                <!-- Total Categories -->
                <div class="col-xl-3 col-md-6">
                    <x-dashboard-stats-card
                        title="Kategori"
                        :value="$stats['total_categories'] ?? 0"
                        icon="ki-duotone ki-tag"
                        color="danger"
                        percentage="92"
                        description="Kategori koleksi museum"
                    />
                </div>

                <!-- Total Testimonials -->
                <div class="col-xl-3 col-md-6">
                    <x-dashboard-stats-card
                        title="Testimoni"
                        :value="$stats['total_testimonials'] ?? 0"
                        icon="ki-duotone ki-message-text-2"
                        color="dark"
                        percentage="78"
                        description="Testimoni pengunjung"
                    />
                </div>

                <!-- Total Visits -->
                <div class="col-xl-3 col-md-6">
                    <x-dashboard-stats-card
                        title="Kunjungan"
                        :value="$stats['total_visits'] ?? 0"
                        icon="ki-duotone ki-eye"
                        color="success"
                        percentage="65"
                        description="Kunjungan website hari ini"
                    />
                </div>

                <!-- System Status -->
                <div class="col-xl-3 col-md-6">
                    <x-dashboard-stats-card
                        title="Status Sistem"
                        value="Aktif"
                        icon="ki-duotone ki-shield-tick"
                        color="primary"
                        percentage="100"
                        description="Sistem berjalan normal"
                    />
                </div>
            </div>

            <!-- Charts Row -->
            <div class="row g-5 g-xl-8 mb-8">
                <!-- Collections Distribution Chart -->
                <div class="col-xl-8">
                    <div class="card card-flush border-0 bg-white shadow-sm">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <h3 class="fw-bold text-dark">Distribusi Koleksi per Kategori</h3>
                                <span class="text-gray-600 fw-semibold fs-6">Top 8 kategori dengan koleksi terbanyak</span>
                            </div>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-light-primary" data-bs-toggle="dropdown">
                                    <i class="ki-duotone ki-gear fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <canvas id="collectionsChart" style="height: 350px;"></canvas>
                        </div>
                    </div>
                </div>

                <!-- News Status Chart -->
                <div class="col-xl-4">
                    <div class="card card-flush border-0 bg-white shadow-sm h-100">
                        <div class="card-header pt-5">
                            <h3 class="card-title fw-bold text-dark">Status Berita</h3>
                        </div>
                        <div class="card-body pt-0">
                            <canvas id="newsStatusChart" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Charts Row -->
            <div class="row g-5 g-xl-8 mb-8">
                <!-- Performance Metrics -->
                <div class="col-xl-6">
                    <div class="card card-flush border-0 bg-white shadow-sm">
                        <div class="card-header pt-5">
                            <h3 class="card-title fw-bold text-dark">Indikator Kinerja</h3>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column gap-4">
                                <!-- Collection Completion Rate -->
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px me-4">
                                        <div class="symbol-label bg-light-primary">
                                            <i class="ki-duotone ki-check-circle fs-2x text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="fw-semibold text-gray-800">Tingkat Penyelesaian Koleksi</span>
                                            <span class="fw-bold text-primary">{{ $performanceMetrics['collection_completion_rate'] ?? 85 }}%</span>
                                        </div>
                                        <div class="text-gray-600 fs-8 mb-2">Koleksi dengan informasi lengkap</div>
                                        <div class="progress h-6px w-100">
                                            <div class="progress-bar bg-primary" style="width: {{ $performanceMetrics['collection_completion_rate'] ?? 85 }}%"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- News Publish Rate -->
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px me-4">
                                        <div class="symbol-label bg-light-success">
                                            <i class="ki-duotone ki-newspaper fs-2x text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="fw-semibold text-gray-800">Tingkat Publikasi Berita</span>
                                            <span class="fw-bold text-success">{{ $performanceMetrics['news_publish_rate'] ?? 78 }}%</span>
                                        </div>
                                        <div class="text-gray-600 fs-8 mb-2">Berita yang dipublikasikan bulan ini</div>
                                        <div class="progress h-6px w-100">
                                            <div class="progress-bar bg-success" style="width: {{ $performanceMetrics['news_publish_rate'] ?? 78 }}%"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Event Completion -->
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px me-4">
                                        <div class="symbol-label bg-light-warning">
                                            <i class="ki-duotone ki-calendar fs-2x text-warning">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="fw-semibold text-gray-800">Penyelesaian Agenda</span>
                                            <span class="fw-bold text-warning">{{ $performanceMetrics['event_completion_rate'] ?? 65 }}%</span>
                                        </div>
                                        <div class="text-gray-600 fs-8 mb-2">Agenda yang sudah selesai</div>
                                        <div class="progress h-6px w-100">
                                            <div class="progress-bar bg-warning" style="width: {{ $performanceMetrics['event_completion_rate'] ?? 65 }}%"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- User Activity (Admin Only) -->
                                @if(Auth::user()->hasRole('admin'))
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px me-4">
                                        <div class="symbol-label bg-light-info">
                                            <i class="ki-duotone ki-profile-user fs-2x text-info">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="fw-semibold text-gray-800">Aktivitas Pengguna</span>
                                            <span class="fw-bold text-info">{{ $performanceMetrics['user_activity_rate'] ?? 92 }}%</span>
                                        </div>
                                        <div class="text-gray-600 fs-8 mb-2">Pengguna login dalam 7 hari terakhir</div>
                                        <div class="progress h-6px w-100">
                                            <div class="progress-bar bg-info" style="width: {{ $performanceMetrics['user_activity_rate'] ?? 92 }}%"></div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Category Distribution Chart -->
                <div class="col-xl-6">
                    <div class="card card-flush border-0 bg-white shadow-sm">
                        <div class="card-header pt-5">
                            <h3 class="card-title fw-bold text-dark">Distribusi Kategori Koleksi</h3>
                        </div>
                        <div class="card-body pt-0">
                            <canvas id="categoryChart" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Row -->
            <div class="row g-5 g-xl-8">
                <!-- Recent Activities -->
                <div class="col-xl-6">
                    <div class="card card-flush border-0 bg-white shadow-sm">
                        <div class="card-header pt-5">
                            <h3 class="card-title fw-bold text-dark">Recent Activities</h3>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-light-primary">View All</button>
                            </div>
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

                <!-- Quick Actions -->
                <div class="col-xl-6">
                    <div class="card card-flush border-0 bg-white shadow-sm">
                        <div class="card-header pt-5">
                            <h3 class="card-title fw-bold text-dark">Quick Actions</h3>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column gap-4">
                                <!-- Admin Actions -->
                                @if(Auth::user()->hasRole('admin'))
                                <div>
                                    <h6 class="fw-bold text-gray-800 mb-3">Admin Actions</h6>
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <a href="#" class="btn btn-light-primary w-100">
                                                <i class="ki-duotone ki-user fs-2 me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                Kelola Pengguna
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="#" class="btn btn-light-success w-100">
                                                <i class="ki-duotone ki-gear fs-2 me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                Pengaturan Sistem
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="#" class="btn btn-light-warning w-100">
                                                <i class="ki-duotone ki-chart-bar fs-2 me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                Laporan Analitik
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="#" class="btn btn-light-info w-100">
                                                <i class="ki-duotone ki-shield-tick fs-2 me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                Backup Database
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <!-- Pengelola Actions -->
                                @if(Auth::user()->hasRole('pengelola'))
                                <div>
                                    <h6 class="fw-bold text-gray-800 mb-3">Pengelola Actions</h6>
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <a href="#" class="btn btn-light-primary w-100">
                                                <i class="ki-duotone ki-boxes fs-2 me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                Tambah Koleksi
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="#" class="btn btn-light-success w-100">
                                                <i class="ki-duotone ki-newspaper fs-2 me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                Tambah Berita
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="#" class="btn btn-light-warning w-100">
                                                <i class="ki-duotone ki-calendar fs-2 me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                Tambah Agenda
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="#" class="btn btn-light-info w-100">
                                                <i class="ki-duotone ki-upload fs-2 me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                Upload Media
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <!-- Common Actions -->
                                <div>
                                    <h6 class="fw-bold text-gray-800 mb-3">Common Actions</h6>
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <a href="/" class="btn btn-light-dark w-100">
                                                <i class="ki-duotone ki-home fs-2 me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                Lihat Website
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="#" class="btn btn-light-primary w-100">
                                                <i class="ki-duotone ki-profile-circle fs-2 me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                Edit Profil
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('styles')
<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e1e3ea;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-badge {
    position: absolute;
    left: -22px;
    top: 0;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1;
}

.timeline-content {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    margin-left: 10px;
}

.progress {
    background-color: #e1e3ea;
    border-radius: 10px;
}

.progress-bar {
    border-radius: 10px;
    transition: width 0.6s ease;
}

.symbol-label {
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
}

.card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%);
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Collections Distribution Chart
    const collectionsCtx = document.getElementById('collectionsChart').getContext('2d');

    // Sample data - replace with actual data from backend
    const collectionsData = {
        labels: ['Artefak', 'Seni Rupa', 'Teknologi', 'Sejarah', 'Budaya', 'Arkeologi', 'Etnografi', 'Numismatik'],
        data: [25, 20, 15, 18, 12, 10, 8, 7]
    };

    new Chart(collectionsCtx, {
        type: 'bar',
        data: {
            labels: collectionsData.labels,
            datasets: [{
                label: 'Jumlah Koleksi',
                data: collectionsData.data,
                backgroundColor: [
                    'rgba(13, 148, 136, 0.8)',
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(239, 68, 68, 0.8)',
                    'rgba(139, 92, 246, 0.8)',
                    'rgba(236, 72, 153, 0.8)',
                    'rgba(34, 197, 94, 0.8)'
                ],
                borderColor: [
                    'rgba(13, 148, 136, 1)',
                    'rgba(16, 185, 129, 1)',
                    'rgba(59, 130, 246, 1)',
                    'rgba(245, 158, 11, 1)',
                    'rgba(239, 68, 68, 1)',
                    'rgba(139, 92, 246, 1)',
                    'rgba(236, 72, 153, 1)',
                    'rgba(34, 197, 94, 1)'
                ],
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    },
                    ticks: {
                        color: '#6c757d',
                        stepSize: 1
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#6c757d',
                        maxRotation: 45,
                        minRotation: 45
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });

    // News Status Chart
    const newsCtx = document.getElementById('newsStatusChart').getContext('2d');
    const newsData = {
        labels: ['Dipublikasikan', 'Draft', 'Arsip'],
        data: [65, 20, 15]
    };

    new Chart(newsCtx, {
        type: 'doughnut',
        data: {
            labels: newsData.labels,
            datasets: [{
                data: newsData.data,
                backgroundColor: [
                    'rgba(16, 185, 129, 0.8)',    // Hijau - Dipublikasikan
                    'rgba(245, 158, 11, 0.8)',    // Kuning - Draft
                    'rgba(107, 114, 128, 0.8)'    // Abu-abu - Arsip
                ],
                borderColor: [
                    'rgba(16, 185, 129, 1)',
                    'rgba(245, 158, 11, 1)',
                    'rgba(107, 114, 128, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Category Distribution Chart
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    const categoryData = {
        labels: ['Artefak', 'Seni Rupa', 'Teknologi', 'Sejarah'],
        data: [30, 25, 25, 20]
    };

    new Chart(categoryCtx, {
        type: 'pie',
        data: {
            labels: categoryData.labels,
            datasets: [{
                data: categoryData.data,
                backgroundColor: [
                    'rgba(13, 148, 136, 0.8)',
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(245, 158, 11, 0.8)'
                ],
                borderColor: [
                    'rgba(13, 148, 136, 1)',
                    'rgba(16, 185, 129, 1)',
                    'rgba(59, 130, 246, 1)',
                    'rgba(245, 158, 11, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });

    // Animate progress bars
    const progressBars = document.querySelectorAll('.progress-bar');
    progressBars.forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0%';
        setTimeout(() => {
            bar.style.width = width;
        }, 500);
    });

    // Add hover effects to cards
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-4px)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endpush
