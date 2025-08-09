@extends('layouts.dashboard.dashboard')

@section('content')
<div class="container-fluid">
    <!-- Welcome Card -->
    <div class="card mb-4">
        <div class="card-body text-center py-5">
            <h2 class="card-title mb-3">Selamat Datang di BDARU</h2>
            <p class="card-text text-muted">Sistem Manajemen Museum Digital Balai Adat Rajo Penghulu</p>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-number">{{ $stats['totalCollections'] }}</div>
                <div class="stats-label">Total Koleksi</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-number">{{ $stats['totalNews'] }}</div>
                <div class="stats-label">Berita Dipublikasikan</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-number">{{ $stats['totalEvents'] }}</div>
                <div class="stats-label">Total Agenda</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-number">{{ $stats['totalUsers'] }}</div>
                <div class="stats-label">Pengguna Terdaftar</div>
            </div>
        </div>
    </div>

    <!-- Additional Stats Row -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-number">{{ $stats['totalCategories'] }}</div>
                <div class="stats-label">Kategori Koleksi</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-number">{{ $stats['totalTestimonials'] }}</div>
                <div class="stats-label">Testimoni Pengunjung</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-number">{{ $stats['totalVisits'] }}</div>
                <div class="stats-label">Kunjungan Hari Ini</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-number">{{ $stats['totalTeamMembers'] }}</div>
                <div class="stats-label">Anggota Tim</div>
            </div>
        </div>
    </div>

    <!-- Performance Metrics -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Metrik Performa</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Koleksi Museum</span>
                            <span>{{ $performanceMetrics['collectionsPercentage'] }}%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" style="width: {{ $performanceMetrics['collectionsPercentage'] }}%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Berita</span>
                            <span>{{ $performanceMetrics['newsPercentage'] }}%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" style="width: {{ $performanceMetrics['newsPercentage'] }}%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Agenda</span>
                            <span>{{ $performanceMetrics['eventsPercentage'] }}%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" style="width: {{ $performanceMetrics['eventsPercentage'] }}%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Pengguna</span>
                            <span>{{ $performanceMetrics['usersPercentage'] }}%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" style="width: {{ $performanceMetrics['usersPercentage'] }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Status Sistem</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-success rounded-circle me-3" style="width: 12px; height: 12px;"></div>
                        <span>Sistem Aktif</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-success rounded-circle me-3" style="width: 12px; height: 12px;"></div>
                        <span>Database Terhubung</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-success rounded-circle me-3" style="width: 12px; height: 12px;"></div>
                        <span>File Storage Aktif</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="bg-success rounded-circle me-3" style="width: 12px; height: 12px;"></div>
                        <span>Cache System Aktif</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

