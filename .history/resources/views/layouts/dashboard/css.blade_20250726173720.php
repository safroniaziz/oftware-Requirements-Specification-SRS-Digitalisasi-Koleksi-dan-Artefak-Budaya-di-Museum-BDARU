    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('assets/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/assets/plugins/custom/vis-timeline/vis-timeline.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <style>
        /* BDARU Custom Styles */
        :root {
            --bdaru-primary: #0d9488;
            --bdaru-secondary: #0f766e;
            --bdaru-accent: #14b8a6;
        }

        .app-sidebar {
            background: linear-gradient(135deg, var(--bdaru-primary), var(--bdaru-secondary)) !important;
        }

        .app-sidebar .menu-link {
            color: rgba(255, 255, 255, 0.8) !important;
            transition: all 0.3s ease;
        }

        .app-sidebar .menu-link:hover,
        .app-sidebar .menu-link.active {
            background-color: rgba(255, 255, 255, 0.1) !important;
            color: white !important;
        }

        .app-sidebar .menu-heading {
            color: rgba(255, 255, 255, 0.6) !important;
        }

        .btn-primary {
            background-color: var(--bdaru-primary) !important;
            border-color: var(--bdaru-primary) !important;
        }

        .btn-primary:hover {
            background-color: var(--bdaru-secondary) !important;
            border-color: var(--bdaru-secondary) !important;
        }

        .text-primary {
            color: var(--bdaru-primary) !important;
        }

        .bg-primary {
            background-color: var(--bdaru-primary) !important;
        }

        .progress-bar {
            background-color: var(--bdaru-primary) !important;
        }

        /* Welcome Section Enhancement */
        .welcome-section {
            background: linear-gradient(135deg, var(--bdaru-primary) 0%, var(--bdaru-secondary) 25%, var(--bdaru-accent) 50%, #06b6d4 75%, #0891b2 100%) !important;
        }

        /* Stats Cards Enhancement */
        .stats-card {
            background: linear-gradient(135deg, var(--bdaru-primary), var(--bdaru-secondary)) !important;
            color: white !important;
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

        /* Activity Log Button Styling */
        #kt_activity_log_toggle {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        #kt_activity_log_toggle:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 148, 136, 0.3);
            border-color: rgba(13, 148, 136, 0.2);
        }

        #kt_activity_log_toggle:active {
            transform: translateY(0);
        }

        /* Activity Counter Badge */
        #activity-counter {
            font-size: 0.7rem !important;
            font-weight: 600;
            min-width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: badgePulse 2s infinite;
        }

        /* Activity Indicator */
        #activity-indicator {
            animation: pulse 2s infinite;
        }

        /* Animations */
        @keyframes pulse {
            0% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 1;
            }
            50% {
                transform: translate(-50%, -50%) scale(1.2);
                opacity: 0.7;
            }
            100% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 1;
            }
        }

        @keyframes badgePulse {
            0% {
                transform: translate(-50%, -50%) scale(1);
            }
            50% {
                transform: translate(-50%, -50%) scale(1.1);
            }
            100% {
                transform: translate(-50%, -50%) scale(1);
            }
        }

        /* Activity Log Drawer Styling */
        .activity-log-drawer {
            background: #ffffff;
        }

        .activity-log-header {
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        .activity-item {
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            background: #ffffff;
            border: 1px solid #e9ecef;
        }

        .activity-item:hover {
            background-color: #f8f9fa;
            border-left-color: var(--bdaru-primary);
            transform: translateX(5px);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .activity-item.unread {
            background-color: #e8f5e8;
            border-left-color: #28a745;
            border: 1px solid #c3e6c3;
        }

        .activity-time {
            font-size: 0.75rem;
            color: #6c757d;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border: 1px solid #e9ecef;
        }
    </style>
