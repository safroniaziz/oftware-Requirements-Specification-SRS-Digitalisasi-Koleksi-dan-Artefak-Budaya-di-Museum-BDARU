    <!-- Essential JavaScript for dashboard -->
    <script>
        // Basic dashboard functionality
        document.addEventListener('DOMContentLoaded', function() {
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

        // User menu dropdown functionality
        document.addEventListener('DOMContentLoaded', function() {
            const userMenuToggle = document.getElementById('kt_header_user_menu_toggle');
            const userMenu = userMenuToggle ? userMenuToggle.querySelector('.menu') : null;

            if (userMenuToggle && userMenu) {
                userMenuToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Toggle menu visibility
                    if (userMenu.classList.contains('show')) {
                        userMenu.classList.remove('show');
                    } else {
                        // Close other menus first
                        document.querySelectorAll('.menu.show').forEach(menu => {
                            if (menu !== userMenu) {
                                menu.classList.remove('show');
                            }
                        });
                        userMenu.classList.add('show');
                    }
                });

                // Close menu when clicking outside
                document.addEventListener('click', function(e) {
                    if (!userMenuToggle.contains(e.target)) {
                        userMenu.classList.remove('show');
                    }
                });
            }
        });

        // Theme mode toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const themeModeButtons = document.querySelectorAll('[data-kt-element="mode"]');

            themeModeButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const mode = this.getAttribute('data-kt-value');

                    // Set theme mode
                    document.documentElement.setAttribute('data-bs-theme', mode);
                    localStorage.setItem('data-bs-theme', mode);

                    // Close theme menu
                    const themeMenu = this.closest('.menu');
                    if (themeMenu) {
                        themeMenu.classList.remove('show');
                    }
                });
            });
        });
    </script>
