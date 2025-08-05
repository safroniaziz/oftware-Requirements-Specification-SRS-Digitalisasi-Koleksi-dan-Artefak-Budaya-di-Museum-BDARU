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

    <!-- Prevent Vue.js interference and ensure dashboard loads properly -->
    <script>
        // Immediately hide any Vue/Inertia elements
        (function() {
            // Hide Vue app
            const vueApp = document.getElementById('app');
            if (vueApp) {
                vueApp.style.display = 'none !important';
                vueApp.style.visibility = 'hidden !important';
            }

            // Hide Inertia elements
            const inertiaElements = document.querySelectorAll('[data-page], [inertia]');
            inertiaElements.forEach(el => {
                el.style.display = 'none !important';
                el.style.visibility = 'hidden !important';
            });

            // Force dashboard visibility
            const dashboardElements = document.querySelectorAll('.app-root, .app-page, .app-wrapper, .app-main, .app-content');
            dashboardElements.forEach(el => {
                el.style.display = 'block !important';
                el.style.visibility = 'visible !important';
                el.style.opacity = '1 !important';
            });
        })();

        // Disable Vue.js on dashboard pages
        if (document.querySelector('meta[name="dashboard-page"]')) {
            // Remove any existing Vue instances
            if (window.Vue) {
                console.log('Vue.js detected, ensuring dashboard compatibility');
            }

            // Hide any Vue app containers
            const vueApps = document.querySelectorAll('#app, [v-cloak], [v-app]');
            vueApps.forEach(app => {
                app.style.display = 'none !important';
            });

            // Ensure dashboard elements are visible
            const dashboardElements = document.querySelectorAll('.app-root, .app-header, .app-sidebar, .app-content');
            dashboardElements.forEach(element => {
                element.style.display = 'block !important';
                element.style.visibility = 'visible !important';
            });
        }

        // Force dashboard layout on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Ensure dashboard is properly rendered
            const appRoot = document.querySelector('.app-root');
            if (appRoot) {
                appRoot.style.display = 'block';
                appRoot.style.visibility = 'visible';
            }

            // Force reflow to ensure proper rendering
            if (appRoot) appRoot.offsetHeight;

            // Remove any loading states
            document.body.classList.remove('loading');
            document.body.classList.add('loaded');

            // Final check - ensure dashboard is visible
            setTimeout(() => {
                const dashboardContainer = document.querySelector('.app-page');
                if (dashboardContainer) {
                    dashboardContainer.style.display = 'block !important';
                    dashboardContainer.style.visibility = 'visible !important';
                    dashboardContainer.style.opacity = '1 !important';
                }
            }, 100);
        });

        // Prevent any Vue-related scripts from running
        window.addEventListener('load', function() {
            // Ensure dashboard is fully visible
            const dashboardContainer = document.querySelector('.app-page');
            if (dashboardContainer) {
                dashboardContainer.style.display = 'block';
                dashboardContainer.style.visibility = 'visible';
            }

            // Final cleanup
            setTimeout(() => {
                // Hide any remaining Vue elements
                const vueElements = document.querySelectorAll('#app, [v-cloak], [v-app], [data-page]');
                vueElements.forEach(el => {
                    el.style.display = 'none !important';
                });

                // Show dashboard elements
                const dashboardElements = document.querySelectorAll('.app-root, .app-page, .app-wrapper');
                dashboardElements.forEach(el => {
                    el.style.display = 'block !important';
                    el.style.visibility = 'visible !important';
                });
            }, 200);
        });
    </script>

    <!-- Prevent layout shift and ensure proper loading -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
