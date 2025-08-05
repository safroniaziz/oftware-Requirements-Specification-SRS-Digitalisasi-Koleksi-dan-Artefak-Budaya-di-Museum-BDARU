    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom Dashboard Scripts -->
    <script>
        // Initialize charts when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            // Collections by Category Chart
            const collectionsCtx = document.getElementById('collectionsChart');
            if (collectionsCtx) {
                new Chart(collectionsCtx, {
                    type: 'doughnut',
                    data: {
                        labels: @json($chartData['collectionsByCategory']->pluck('name')),
                        datasets: [{
                            data: @json($chartData['collectionsByCategory']->pluck('count')),
                            backgroundColor: [
                                '#0d9488',
                                '#0f766e',
                                '#14b8a6',
                                '#06b6d4',
                                '#0891b2',
                                '#0ea5e9',
                                '#0284c7',
                                '#0369a1'
                            ],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            }

            // News Status Chart
            const newsCtx = document.getElementById('newsChart');
            if (newsCtx) {
                new Chart(newsCtx, {
                    type: 'bar',
                    data: {
                        labels: @json(array_keys($chartData['newsStatus'])),
                        datasets: [{
                            label: 'Jumlah Berita',
                            data: @json(array_values($chartData['newsStatus'])),
                            backgroundColor: '#0d9488',
                            borderColor: '#0f766e',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            // Category Distribution Chart
            const categoryCtx = document.getElementById('categoryChart');
            if (categoryCtx) {
                new Chart(categoryCtx, {
                    type: 'pie',
                    data: {
                        labels: @json(array_keys($chartData['categoryDistribution'])),
                        datasets: [{
                            data: @json(array_values($chartData['categoryDistribution'])),
                            backgroundColor: [
                                '#0d9488',
                                '#0f766e',
                                '#14b8a6',
                                '#06b6d4',
                                '#0891b2'
                            ],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            }

            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Initialize popovers
            const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl);
            });
        });

        // Utility functions
        function formatNumber(num) {
            return new Intl.NumberFormat('id-ID').format(num);
        }

        function formatDate(dateString) {
            return new Date(dateString).toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }

        // Auto refresh stats every 30 seconds
        setInterval(function() {
            // You can add AJAX call here to refresh stats
            console.log('Stats refreshed');
        }, 30000);
    </script>
