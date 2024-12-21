<body class="bg-gray-100">

    <header class="bg-gray-100 border-b border-gray-300 py-4">
        <h1 class="text-4xl font-bold text-center text-gray-800">CAR SALES DASHBOARD</h1>
    </header>

    <div class="container mx-auto p-4">
        <!-- Filter Section -->
        <form id="filters" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 items-center" method="GET">
            <div>
                <label for="clinic" class="block font-medium text-black">Name of Clinic:</label>
                <select id="clinic" name="clinic" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                    <option value="">All</option>
                    @foreach($clinics as $clinic)
                        <option value="{{ $clinic->clinic_id }}">{{ $clinic->clinic_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="startDate" class="block font-medium text-black">Start Date:</label>
                <input type="date" id="startDate" name="startDate" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
            </div>
            <div>
                <label for="endDate" class="block font-medium text-black">End Date:</label>
                <input type="date" id="endDate" name="endDate" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
            </div>
            <div>
                <label for="species" class="block font-medium text-black">Name of Animal:</label>
                <select id="species" name="species" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                    <option value="">All</option>
                    @foreach($species as $animal)
                        <option value="{{ $animal->species_id }}">{{ $animal->species_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="barangay" class="block font-medium text-black">From Barangay:</label>
                <select id="barangay" name="barangay" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                    <option value="">All</option>
                    @foreach($barangays as $barangay)
                        <option value="{{ $barangay->id }}">{{ $barangay->brgy_name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    <!-- Charts Section -->
    <div class="container mx-auto p-6">
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div>
                <h2 class="text-xl font-bold mb-4">Population of Each Clinic</h2>
                <canvas id="barChart"></canvas>
                @include('charts.barchart')
            </div>
            <div>
                <h2 class="text-xl font-bold mb-4">Animal Bites over the Months</h2>
                <canvas id="lineChart"></canvas>
                @include('charts.linechart')
            </div>
            <div>
                <h2 class="text-xl font-bold mb-4">Animals Ratio</h2>
                <canvas id="pieChart"></canvas>
                @include('charts.pie')
                
            </div>
            {{-- <div>
                <h2 class="text-xl font-bold mb-4"></h2>
                <canvas id="polarAreaChart"></canvas>
                @include('charts.polararea')
            </div> --}}
            <div>
                <h2 class="text-xl font-bold mb-4">Clinic Victim and Species Bite Data</h2>
                <canvas id="radarChart"></canvas>
                @include('charts.radar')
            </div>

        </div>
    </div>

    <!-- Chart Scripts -->
    <script>
                // Chart Instances (to allow updating and destroying)
        let barChartInstance, lineChartInstance, pieChartInstance, radarChartInstance, polarAreaChartInstance;

        // Fetch Chart Data and Update Charts
        function fetchChartData() {
            // Serialize filters
            const filters = $('#filters').serialize();

            // Fetch data from the server
            fetch('{{ route("charts.data") }}?' + filters, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',  // Ensure it's requesting JSON
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('Chart data received:', data);

                // Update charts with new data
                updateBarChart(data.bar);
                updateLineChart(data.line);
                updatePieChart(data.pie);
                // updatePolarAreaChart(data.polar);
                updateRadarChart(data.radar);
            })
            .catch(error => console.error('Error fetching chart data:', error));
        }

        // Automatically Fetch and Update Charts on Filter Change
        $('#filters select, #filters input').on('change', function() {
            fetchChartData();
        });

        // Initial Data Fetch
        fetchChartData();
        
    </script>

</body>
</html>
