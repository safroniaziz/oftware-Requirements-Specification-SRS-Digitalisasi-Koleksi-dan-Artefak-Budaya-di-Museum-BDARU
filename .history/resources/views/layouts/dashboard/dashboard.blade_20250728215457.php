<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Dashboard - BDARU</title>
    <meta name="description" content="Dashboard BDARU" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="/assets/media/logos/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f8fa;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background: #1e1e2d;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid #2b2b40;
        }

        .sidebar-brand {
            color: #ffffff;
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .sidebar-item {
            padding: 0.75rem 1.5rem;
            color: #a1a5b7;
            text-decoration: none;
            display: block;
            transition: all 0.3s ease;
        }

        .sidebar-item:hover,
        .sidebar-item.active {
            background: #1b1b28;
            color: #ffffff;
        }

        .main-content {
            margin-left: 280px;
            padding: 2rem;
            min-height: 100vh;
        }

        .header {
            background: #ffffff;
            padding: 1rem 2rem;
            border-bottom: 1px solid #e1e5e9;
            margin-bottom: 2rem;
        }

        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 0 20px 0 rgba(76, 87, 125, 0.02);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid #e1e5e9;
            padding: 1.5rem;
        }

        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stats-label {
            font-size: 0.875rem;
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>

    @include('layouts.dashboard.css')
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="/dashboard" class="sidebar-brand">BDARU</a>
        </div>

        <div class="sidebar-menu">
            <a href="/dashboard" class="sidebar-item active">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
            <a href="/collections-management" class="sidebar-item">
                <i class="bi bi-collection me-2"></i>
                Koleksi
            </a>
            <a href="/news-management" class="sidebar-item">
                <i class="bi bi-newspaper me-2"></i>
                Berita
            </a>
            <a href="/events-management" class="sidebar-item">
                <i class="bi bi-calendar-event me-2"></i>
                Agenda
            </a>
            <a href="/testimonials-management" class="sidebar-item">
                <i class="bi bi-chat-quote me-2"></i>
                Testimoni
            </a>
            <a href="/team-members-management" class="sidebar-item">
                <i class="bi bi-people me-2"></i>
                Tim
            </a>
            <a href="/categories-management" class="sidebar-item">
                <i class="bi bi-tags me-2"></i>
                Kategori
            </a>
            <a href="/settings-management" class="sidebar-item">
                <i class="bi bi-gear me-2"></i>
                Pengaturan
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">Dashboard</h1>
            <div class="d-flex align-items-center">
                <span class="me-3">Selamat datang, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-box-arrow-right me-1"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Content -->
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @include('layouts.dashboard.js')
</body>
</html>
