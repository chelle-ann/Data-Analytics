<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar sticky-top navbar-expand-lg bg-pink">
        <div class="container-fluid">
            <a class="navbar-brand bold-link" href="#">DA4B_GROUP4</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">MEMBERS</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Michelle Ann Alberto</a></li>
                            <li><a class="dropdown-item" href="#">Cherry Mae Sanchez</a></li>
                            <li><a class="dropdown-item" href="#">Gwen Timbal</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="nav flex-column mb-4">
            <li class="nav-item">
                <a href="#" class="nav-link active">Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Reports</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Data Management</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Charts and Insights</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Settings</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">About Us</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>CAR SALES DASHBOARD</h1>

        <!-- Filter Dropdowns -->
        <div class="filter-container row">
            <!-- Filter by Month -->
            <div class="col-md-4">
                <label for="filterByDate" class="form-label">Filter by Date</label>
                <input type="month" id="filterByDate" class="form-control form-control-sm" />
            </div>

            <div class="col-md-4">
                <label for="filterByModel" class="form-label">Filter by Car Model</label>
                <select id="filterByModel" class="form-select form-select-sm">
                    <option value="all">Loading...</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="filterByColor" class="form-label">Filter by Car Color</label>
                <select id="filterByColor" class="form-select form-select-sm">
                    <option value="all">Loading...</option>
                </select>
            </div>
        </div>



        <!-- Charts -->
        <div class="container mt-4 charts-container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="chart-wrapper">
                        <h5>Car Sales Trend</h5>
                        <canvas id="lineChart" style="max-height: 300px; max-width: 100%;"></canvas>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="chart-wrapper">
                        <h5>Car Sales by Color Distribution</h5>
                        <canvas id="donutChart" style="max-height: 300px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="chart-wrapper">
                        <h5>Top Car Models by Sales and Revenue</h5>
                        <canvas id="barChart" style="max-height: 300px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    const lineChart = new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: { labels: [], datasets: [{ label: 'Car Sales Trend', data: [] }] },
        options: { responsive: true }
    });
    
    const donutChart = new Chart(document.getElementById('donutChart'), {
        type: 'doughnut',
        data: { labels: [], datasets: [{ label: 'Color Distribution', data: [] }] },
        options: { responsive: true }
    });
    
    const barChart = new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: { labels: [], datasets: [{ label: 'Sales Revenue', data: [] }] },
        options: { responsive: true }
    });
    
    document.addEventListener('DOMContentLoaded', () => {
        const fetchSalesData = () => {
        const month = document.getElementById('filterByDate').value;
        const model = document.getElementById('filterByModel').value;
        const color = document.getElementById('filterByColor').value;

        axios.get('/fetch-sales-data', {
            params: { month, model, color }
        })
        .then(response => {
            const data = response.data;

            // Update Line Chart
            updateLineChart(data);

            // Update Donut Chart
            updateDonutChart(data);

            // Update Bar Chart
            updateBarChart(data);
        })
        .catch(error => console.error(error));
    };


    const updateLineChart = (data) => {
        const labels = [...new Set(data.map(item => item.sale_month))];
        const sales = labels.map(month => {
            const monthData = data.filter(item => item.sale_month === month);
            return monthData.reduce((sum, item) => sum + item.total_sales, 0);
        });

        lineChart.data.labels = labels;
        lineChart.data.datasets[0].data = sales;
        lineChart.update();
    };

    const pastelColors = [
    "#ffb3c1", // Pastel pink
    "#ffcc99", // Pastel orange
    "#99ccff", // Pastel blue
    "#c4e1ff", // Pastel light blue
    "#b3e6b3", // Pastel green
    "#f3c6e8"  // Pastel purple
];

const updateDonutChart = (data) => {
    const labels = [...new Set(data.map(item => item.Color))];
    const counts = labels.map(color => {
        return data.filter(item => item.Color === color).reduce((sum, item) => sum + item.total_sales, 0);
    });

    // Ensure that there are enough pastel colors for the segments
    const chartColors = pastelColors.slice(0, labels.length);  // Adjust number of colors based on unique labels

    donutChart.data.labels = labels;
    donutChart.data.datasets[0].data = counts;
    donutChart.data.datasets[0].backgroundColor = chartColors;  // Apply pastel colors to segments
    donutChart.update();
};


    const updateBarChart = (data) => {
        const labels = [...new Set(data.map(item => item.Model))];
        const revenues = labels.map(model => {
            return data.filter(item => item.Model === model).reduce((sum, item) => sum + item.total_revenue, 0);
        });

        barChart.data.labels = labels;
        barChart.data.datasets[0].data = revenues;
        barChart.update();
    };

    // Event Listeners
    document.getElementById('filterByDate').addEventListener('change', fetchSalesData);
    document.getElementById('filterByModel').addEventListener('change', fetchSalesData);
    document.getElementById('filterByColor').addEventListener('change', fetchSalesData);

    fetchSalesData();
});

document.addEventListener('DOMContentLoaded', () => {
    const fetchFilters = () => {
        axios.get('/fetch-filters')
            .then(response => {
                const { models, colors } = response.data;

                // Populate Car Model Dropdown
                const modelDropdown = document.getElementById('filterByModel');
                modelDropdown.innerHTML = '<option value="all">All Models</option>';
                models.forEach(model => {
                    modelDropdown.innerHTML += `<option value="${model}">${model}</option>`;
                });

                // Populate Car Color Dropdown
                const colorDropdown = document.getElementById('filterByColor');
                colorDropdown.innerHTML = '<option value="all">All Colors</option>';
                colors.forEach(color => {
                    colorDropdown.innerHTML += `<option value="${color}">${color}</option>`;
                });
            })
            .catch(error => console.error(error));
    };

    // Fetch filters on page load
    fetchFilters();
});


    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</body>
</html>
