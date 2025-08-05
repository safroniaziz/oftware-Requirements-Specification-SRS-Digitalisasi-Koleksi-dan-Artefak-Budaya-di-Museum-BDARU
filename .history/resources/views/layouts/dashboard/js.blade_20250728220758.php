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
    </script>
