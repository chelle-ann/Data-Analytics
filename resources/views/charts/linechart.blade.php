<div class="card">
    <div class="card-header">
        <h3 class="card-title">Car Sales Trends</h3>
    </div>
    <div class="card-body">
        <canvas id="carSalesChart" style="min-height: 400px;"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let carSalesChart = null;

function updateCarSalesChart() {
    fetch('/car-sales-data')
        .then(response => response.json())
        .then(data => {
            if (carSalesChart) {
                carSalesChart.destroy();
            }

            const ctx = document.getElementById('carSalesChart').getContext('2d');
            carSalesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: data.datasets
                },
                options: {
                    responsive: true,
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Monthly Car Sales by Company'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.dataset.label}: ${context.parsed.y} sales`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Number of Sales'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching car sales data:', error));
}

// Initial load
document.addEventListener('DOMContentLoaded', function() {
    updateCarSalesChart();
});

// Update every 5 minutes
setInterval(updateCarSalesChart, 300000);
</script>