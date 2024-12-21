// color-chart.blade.php
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Car Sales by Color Distribution</h3>
    </div>
    <div class="card-body">
        <canvas id="carColorChart" style="min-height: 300px;"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let carColorChart = null;

// Color mapping for consistency
const colorMapping = {
    'Black': 'rgba(0, 0, 0, 0.8)',
    'White': 'rgba(220, 220, 220, 1)',
    'Red': 'rgba(200, 50, 50, 1)',
    'Blue': 'rgba(30, 100, 180, 1)',
    'Silver': 'rgba(192, 192, 192, 1)',
    'Gray': 'rgba(128, 128, 128, 1)',
    'Green': 'rgba(50, 150, 50, 1)',
    'Yellow': 'rgba(200, 200, 40, 1)',
    'Brown': 'rgba(139, 69, 19, 1)',
    'Orange': 'rgba(255, 140, 0, 1)',
    'Purple': 'rgba(128, 0, 128, 1)',
    'Gold': 'rgba(255, 215, 0, 1)'
};

function getColorCode(colorName) {
    return colorMapping[colorName] || `hsl(${Math.random() * 360}, 70%, 50%)`;
}

function updateCarColorChart() {
    fetch('/car-color-data')
        .then(response => response.json())
        .then(data => {
            if (carColorChart) {
                carColorChart.destroy();
            }

            // Generate colors based on car color names
            const backgroundColor = data.labels.map(color => getColorCode(color));
            const borderColor = backgroundColor;

            const ctx = document.getElementById('carColorChart').getContext('2d');
            carColorChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.labels,
                    datasets: [{
                        data: data.values,
                        backgroundColor: backgroundColor,
                        borderColor: borderColor,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                        },
                        title: {
                            display: true,
                            text: 'Sales Distribution by Car Color'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.parsed || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return `${label}: ${value} sales (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching car color data:', error));
}

// Initial load
document.addEventListener('DOMContentLoaded', function() {
    updateCarColorChart();
});

// Update every 5 minutes
setInterval(updateCarColorChart, 300000);
</script>