<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - BDARU Museum</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/src/images/bdaru.jpeg') }}" />
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/src/images/bdaru.jpeg') }}" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 4px 0;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }
        .main-content {
            background-color: #f8f9fa;
        }
        .card-stats {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .card-stats:hover {
            transform: translateY(-5px);
        }
        .navbar-brand {
            font-weight: bold;
            color: #0d9488 !important;
        }
        .user-info {
            background: linear-gradient(135deg, #0d9488, #0f766e);
            color: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 sidebar">
                <div class="p-4">
                    <h4 class="text-white text-center mb-4">
                        <i class="fas fa-museum me-2"></i>
                        BDARU Admin
                    </h4>

                    <!-- User Info -->
                    <div class="user-info">
                        <div class="d-flex align-items-center">
                            <div class="bg-white rounded-circle p-2 me-3">
                                <i class="fas fa-user text-primary"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                <small class="opacity-75">{{ Auth::user()->email }}</small>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <nav class="nav flex-column">
                        <a class="nav-link active" href="#dashboard" data-bs-toggle="tab">
                            <i class="fas fa-tachometer-alt me-2"></i>
                            Dashboard
                        </a>
                        <a class="nav-link" href="#collections" data-bs-toggle="tab">
                            <i class="fas fa-boxes me-2"></i>
                            Koleksi
                        </a>
                        <a class="nav-link" href="#news" data-bs-toggle="tab">
                            <i class="fas fa-newspaper me-2"></i>
                            Berita
                        </a>
                        <a class="nav-link" href="#events" data-bs-toggle="tab">
                            <i class="fas fa-calendar-alt me-2"></i>
                            Agenda
                        </a>
                        <a class="nav-link" href="#users" data-bs-toggle="tab">
                            <i class="fas fa-users me-2"></i>
                            Pengguna
                        </a>
                        <a class="nav-link" href="#analytics" data-bs-toggle="tab">
                            <i class="fas fa-chart-bar me-2"></i>
                            Analitik
                        </a>
                        <a class="nav-link" href="#settings" data-bs-toggle="tab">
                            <i class="fas fa-cog me-2"></i>
                            Pengaturan
                        </a>
                        <hr class="text-white-50">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            Logout
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <!-- Top Navbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
                    <div class="container-fluid">
                        <span class="navbar-brand">
                            <i class="fas fa-tachometer-alt me-2"></i>
                            Dashboard Admin
                        </span>
                        <div class="navbar-nav ms-auto">
                            <span class="navbar-text">
                                <i class="fas fa-clock me-1"></i>
                                <span id="current-time"></span>
                            </span>
                        </div>
                    </div>
                </nav>

                <!-- Content Area -->
                <div class="p-4">
                    <div class="tab-content">
                        <!-- Dashboard Tab -->
                        <div class="tab-pane fade show active" id="dashboard">
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h2 class="mb-3">Dashboard Overview</h2>
                                </div>
                            </div>

                            <!-- Stats Cards -->
                            <div class="row mb-4">
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card card-stats border-left-primary">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        Total Koleksi
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="total-collections">0</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-boxes fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card card-stats border-left-success">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Total Berita
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="total-news">0</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card card-stats border-left-info">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Total Agenda
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="total-events">0</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card card-stats border-left-warning">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                        Total Pengguna
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="total-users">0</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Charts Row -->
                            <div class="row">
                                <div class="col-xl-8 col-lg-7">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Kunjungan Bulanan</h6>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="visitsChart" width="400" height="200"></canvas>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-5">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Distribusi Koleksi</h6>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="collectionsChart" width="400" height="200"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Collections Tab -->
                        <div class="tab-pane fade" id="collections">
                            <h3>Manajemen Koleksi</h3>
                            <p>Fitur manajemen koleksi akan ditampilkan di sini.</p>
                        </div>

                        <!-- News Tab -->
                        <div class="tab-pane fade" id="news">
                            <h3>Manajemen Berita</h3>
                            <p>Fitur manajemen berita akan ditampilkan di sini.</p>
                        </div>

                        <!-- Events Tab -->
                        <div class="tab-pane fade" id="events">
                            <h3>Manajemen Agenda</h3>
                            <p>Fitur manajemen agenda akan ditampilkan di sini.</p>
                        </div>

                        <!-- Users Tab -->
                        <div class="tab-pane fade" id="users">
                            <h3>Manajemen Pengguna</h3>
                            <p>Fitur manajemen pengguna akan ditampilkan di sini.</p>
                        </div>

                        <!-- Analytics Tab -->
                        <div class="tab-pane fade" id="analytics">
                            <h3>Analitik</h3>
                            <p>Fitur analitik akan ditampilkan di sini.</p>
                        </div>

                        <!-- Settings Tab -->
                        <div class="tab-pane fade" id="settings">
                            <h3>Pengaturan</h3>
                            <p>Fitur pengaturan akan ditampilkan di sini.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Update current time
            function updateTime() {
                const now = new Date();
                const timeString = now.toLocaleString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
                $('#current-time').text(timeString);
            }

            updateTime();
            setInterval(updateTime, 1000);

            // Navigation active state
            $('.nav-link').click(function() {
                $('.nav-link').removeClass('active');
                $(this).addClass('active');
            });

            // Load dashboard data
            loadDashboardData();

            // Initialize charts
            initializeCharts();
        });

        function loadDashboardData() {
            // Simulate loading data (replace with actual AJAX calls)
            $('#total-collections').text('125');
            $('#total-news').text('48');
            $('#total-events').text('12');
            $('#total-users').text('1,234');
        }

        function initializeCharts() {
            // Visits Chart
            const visitsCtx = document.getElementById('visitsChart').getContext('2d');
            new Chart(visitsCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Kunjungan',
                        data: [65, 59, 80, 81, 56, 55],
                        borderColor: '#0d9488',
                        backgroundColor: 'rgba(13, 148, 136, 0.1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Collections Chart
            const collectionsCtx = document.getElementById('collectionsChart').getContext('2d');
            new Chart(collectionsCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Artefak', 'Seni Rupa', 'Teknologi', 'Sejarah'],
                    datasets: [{
                        data: [30, 25, 25, 20],
                        backgroundColor: [
                            '#0d9488',
                            '#10b981',
                            '#3b82f6',
                            '#f59e0b'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }
    </script>
</body>
</html>
