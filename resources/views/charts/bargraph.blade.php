// sales-bar.blade.php
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Top Car Models by Sales and Revenue</h3>
    </div>
    <div class="card-body">
        <canvas id="carSalesBarChart" style="min-height: 400px;"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let carSalesBarChart = null;

function updateCarSalesBarChart() {
    fetch('/car-sales-bar-data')
        .then(response => response.json())
        .then(data => {
            if (carSalesBarChart) {
                carSalesBarChart.destroy();
            }

            const ctx = document.getElementById('carSalesBarChart').getContext('2d');
            carSalesBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: data.datasets
                },
                options: {
                    responsive: true,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Top Car Models Performance'
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Car Models'
                            },
                            ticks: {
                                maxRotation: 45,
                                minRotation: 45
                            }
                        },
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Number of Sales'
                            },
                            beginAtZero: true
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Revenue (USD)'
                            },
                            beginAtZero: true,
                            grid: {
                                drawOnChartArea: false
                            },
                            ticks: {
                                callback: function(value) {
                                    return '$' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching car sales bar data:', error));
}

// Initial load
document.addEventListener('DOMContentLoaded', function() {
    updateCarSalesBarChart();
});

// Update every 5 minutes
setInterval(updateCarSalesBarChart, 300000);
</script>