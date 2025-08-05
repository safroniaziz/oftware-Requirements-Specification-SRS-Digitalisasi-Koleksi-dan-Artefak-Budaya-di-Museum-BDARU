    <script>var hostUrl = "assets/";</script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('assets/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('assets/src/plugins/toastr/build/toastr.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('assets/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/assets/plugins/custom/vis-timeline/vis-timeline.bundle.js') }}"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/type.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/budget.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/settings.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/team.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/targets.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/files.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/complete.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/main.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/new-address.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/users-search.js') }}"></script>
    <!--end::Custom Javascript-->

    <!-- Toast Notification JavaScript -->
    <script>
        function showToast(type, title, message, duration = 5000) {
            const toastContainer = document.getElementById('toast-container');
            if (!toastContainer) {
                console.error('Toast container not found');
                return;
            }

            const toast = document.createElement('div');
            toast.className = `toast toast-${type}`;

            const icon = type === 'error' ? '✕' : type === 'warning' ? '⚠' : 'ℹ';

            toast.innerHTML = `
                <div class="toast-icon">${icon}</div>
                <div class="toast-content">
                    <div class="toast-title">${title}</div>
                    <div class="toast-message">${message}</div>
                </div>
            `;

            toastContainer.appendChild(toast);

            // Auto remove after duration
            setTimeout(() => {
                toast.style.animation = 'toastSlideOut 0.3s ease forwards';
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 300);
            }, duration);

            // Click to dismiss
            toast.addEventListener('click', () => {
                toast.style.animation = 'toastSlideOut 0.3s ease forwards';
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 300);
            });
        }
    </script>

    <!-- Prevent layout shift and ensure proper loading -->
    <script>
        // Check if dashboard is loaded properly
        document.addEventListener('DOMContentLoaded', function() {
            // Check if dashboard elements are visible
            const dashboardElements = document.querySelectorAll('.app-root, .app-page, .app-wrapper');
            let dashboardVisible = false;

            dashboardElements.forEach(el => {
                if (el.offsetHeight > 0 && el.offsetWidth > 0) {
                    dashboardVisible = true;
                }
            });

            // If dashboard is not visible, force reload
            if (!dashboardVisible) {
                console.log('Dashboard not loaded properly, forcing reload...');
                window.location.reload(true);
                return;
            }

            // Add loading class to body initially
            document.body.classList.add('loading');

            // Ensure all images are loaded
            const images = document.querySelectorAll('img');
            let loadedImages = 0;

            function imageLoaded() {
                loadedImages++;
                if (loadedImages === images.length) {
                    document.body.classList.remove('loading');
                    document.body.classList.add('loaded');
                }
            }

            // If no images, remove loading immediately
            if (images.length === 0) {
                document.body.classList.remove('loading');
                document.body.classList.add('loaded');
            } else {
                images.forEach(img => {
                    if (img.complete) {
                        imageLoaded();
                    } else {
                        img.addEventListener('load', imageLoaded);
                        img.addEventListener('error', imageLoaded);
                    }
                });
            }

            // Ensure sidebar is properly positioned
            const sidebar = document.querySelector('.app-sidebar');
            const content = document.querySelector('.app-content');

            if (sidebar && content) {
                // Force reflow to ensure proper positioning
                sidebar.offsetHeight;
                content.offsetHeight;
            }
        });

        // Additional check after window load
        window.addEventListener('load', function() {
            setTimeout(() => {
                const dashboardContainer = document.querySelector('.app-page');
                if (dashboardContainer && (dashboardContainer.offsetHeight === 0 || dashboardContainer.offsetWidth === 0)) {
                    console.log('Dashboard container not properly sized, forcing reload...');
                    window.location.reload(true);
                }
            }, 1000);
        });

        // Timeout-based reload if dashboard doesn't load properly
        setTimeout(() => {
            const dashboardContainer = document.querySelector('.app-page');
            const welcomeCard = document.querySelector('.card-flush');

            if (!dashboardContainer || !welcomeCard ||
                dashboardContainer.offsetHeight === 0 ||
                welcomeCard.offsetHeight === 0) {
                console.log('Dashboard not loaded within timeout, forcing reload...');
                window.location.reload(true);
            }
        }, 3000); // 3 second timeout

        // Ensure smooth transitions for sidebar toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileToggle = document.getElementById('kt_app_sidebar_mobile_toggle');
            const sidebar = document.querySelector('.app-sidebar');

            if (mobileToggle && sidebar) {
                mobileToggle.addEventListener('click', function() {
                    // Add transition class
                    sidebar.classList.add('transitioning');

                    // Remove transition class after animation completes
                    setTimeout(() => {
                        sidebar.classList.remove('transitioning');
                    }, 300);
                });
            }
        });

        // Prevent layout shift on window resize
        window.addEventListener('resize', function() {
            // Debounce resize events
            clearTimeout(window.resizeTimeout);
            window.resizeTimeout = setTimeout(function() {
                const sidebar = document.querySelector('.app-sidebar');
                const content = document.querySelector('.app-content');

                if (sidebar && content) {
                    // Force reflow
                    sidebar.offsetHeight;
                    content.offsetHeight;
                }
            }, 100);
        });

        // Ensure proper z-index stacking
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.querySelector('.app-header');
            const sidebar = document.querySelector('.app-sidebar');
            const content = document.querySelector('.app-content');

            if (header) header.style.zIndex = '1000';
            if (sidebar) sidebar.style.zIndex = '999';
            if (content) content.style.zIndex = '1';
        });
    </script>
