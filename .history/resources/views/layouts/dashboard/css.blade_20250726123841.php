    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!--end::Vendor Stylesheets(used for this page only)-->
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <!--end::Global Stylesheets Bundle-->
    <style>
        :root {
            --primary-color: #0d9488;
            --secondary-color: #0f766e;
            --accent-color: #14b8a6;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        .app-sidebar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            min-height: 100vh;
        }

        .app-sidebar .menu-link {
            color: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
        }

        .app-sidebar .menu-link:hover,
        .app-sidebar .menu-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .app-sidebar .menu-heading {
            color: rgba(255, 255, 255, 0.6);
        }

        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border-radius: 0.5rem;
        }

        .card-flush {
            border: none;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .text-primary {
            color: var(--primary-color) !important;
        }

        .bg-primary {
            background-color: var(--primary-color) !important;
        }

        .progress-bar {
            background-color: var(--primary-color);
        }

        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 8px;
        }

        .button-container .btn {
            flex: 1 1 auto;
            min-width: 80px;
            max-width: 150px;
        }

        @media (max-width: 576px) {
            .button-container {
                flex-direction: column;
                align-items: center;
            }

            .button-container .btn {
                width: auto;
                max-width: 150px;
            }
        }

        .custom-swal-button {
            padding-top: .8rem;
            padding-bottom: .8rem;
        }

        /* Dashboard Stats Cards */
        .stats-card {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .stats-card .stats-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stats-card .stats-number {
            font-size: 2rem;
            font-weight: bold;
            margin: 0.5rem 0;
        }

        .stats-card .stats-label {
            font-size: 0.875rem;
            opacity: 0.9;
        }

        /* Welcome Section */
        .welcome-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 25%, var(--accent-color) 50%, #06b6d4 75%, #0891b2 100%);
            color: white;
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .welcome-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(50%, -50%);
        }

        /* Chart Container */
        .chart-container {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        /* Quick Actions */
        .quick-actions .btn {
            margin-bottom: 0.5rem;
            border-radius: 0.5rem;
        }

        /* Recent Activities */
        .activity-item {
            padding: 1rem;
            border-left: 4px solid var(--primary-color);
            background: white;
            margin-bottom: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .activity-item:hover {
            transform: translateX(5px);
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .welcome-section {
                padding: 1.5rem;
            }

            .stats-card {
                padding: 1rem;
            }

            .stats-card .stats-number {
                font-size: 1.5rem;
            }
        }
    </style>
