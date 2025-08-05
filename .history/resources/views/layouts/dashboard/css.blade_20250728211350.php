    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="{{ asset('assets/src/images/logo_unib.png') }}" />
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
    <!-- Toastr CSS -->
    <link href="{{ asset('assets/src/plugins/toastr/build/toastr.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center; /* Menjaga tombol agar rata tengah */
            gap: 8px; /* Memberikan jarak antar tombol */
        }

        .button-container .btn {
            flex: 1 1 auto; /* Tombol bisa menyusut dan berkembang */
            min-width: 80px; /* Tentukan lebar minimum tombol */
            max-width: 150; /* Menambahkan batasan lebar maksimum */
        }

        @media (max-width: 576px) {
            .button-container {
                flex-direction: column; /* Pada layar kecil, tombol ditata dalam kolom */
                align-items: center; /* Rata tengah secara vertikal */
            }

            .button-container .btn {
                width: auto; /* Tombol akan mengambil lebar yang sesuai dengan kontennya */
                max-width: 150px; /* Membatasi lebar tombol pada layar kecil */
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
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
            border-color: rgba(0, 123, 255, 0.2);
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
            border-left-color: #007bff;
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

        /* Toast Notification Styles */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 400px;
        }

        .toast {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            margin-bottom: 10px;
            padding: 16px;
            border-left: 4px solid #007bff;
            display: flex;
            align-items: center;
            gap: 12px;
            transform: translateX(100%);
            opacity: 0;
            animation: toastSlideIn 0.3s ease forwards;
        }

        .toast.toast-error {
            border-left-color: #dc3545;
        }

        .toast.toast-warning {
            border-left-color: #ffc107;
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
        }

        .toast.toast-error .toast-icon {
            background: #dc3545;
        }

        .toast.toast-warning .toast-icon {
            background: #ffc107;
        }

        .toast .toast-content {
            flex: 1;
        }

        .toast .toast-title {
            font-weight: 600;
            margin-bottom: 4px;
            color: #333;
        }

        .toast .toast-message {
            color: #666;
            font-size: 14px;
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

/* Prevent layout shift and ensure consistent rendering */
.app-root {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

.app-page {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

.app-wrapper {
    flex: 1;
    display: flex;
    min-height: calc(100vh - 65px); /* Adjust based on header height */
}

.app-main {
    flex: 1;
    display: flex;
    flex-direction: column;
    min-height: 100%;
}

/* Ensure sidebar doesn't cause layout shift */
.app-sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    z-index: 99;
    transition: transform 0.3s ease;
}

/* Prevent content overlap */
.app-content {
    margin-left: 225px; /* Match sidebar width */
    transition: margin-left 0.3s ease;
}

@media (max-width: 991.98px) {
    .app-content {
        margin-left: 0;
    }
}

/* Ensure header stays in place */
.app-header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 100;
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(10px);
}

/* Prevent flash of unstyled content */
.app-toolbar {
    margin-top: 65px; /* Match header height */
}

/* Ensure smooth transitions */
* {
    transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}

/* Prevent layout shift for images */
img {
    max-width: 100%;
    height: auto;
}

/* Ensure consistent card rendering */
.card {
    background: #fff;
    border-radius: 0.75rem;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    transition: box-shadow 0.3s ease;
}

.card:hover {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

/* Ensure consistent button rendering */
.btn {
    transition: all 0.3s ease;
}

/* Prevent text layout shift */
.text-truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Ensure consistent spacing */
.mb-0 { margin-bottom: 0 !important; }
.mt-0 { margin-top: 0 !important; }
.p-0 { padding: 0 !important; }

/* Prevent animation conflicts */
.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: .5;
    }
}

/* Ensure consistent loading states */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

.loaded {
    opacity: 1;
    pointer-events: auto;
}
