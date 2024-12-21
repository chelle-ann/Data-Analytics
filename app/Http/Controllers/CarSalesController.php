<?php

// CarSalesController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sale;
use App\Models\Car;

class CarSalesController extends Controller
{
    public function getCarSalesData()
    {
        // Get sales data grouped by month and car model
        $salesData = DB::table('sales')
            ->join('cars', 'sales.CarID', '=', 'cars.CarID')
            ->select(
                DB::raw('MONTH(SaleDate) as month'),
                DB::raw('YEAR(SaleDate) as year'),
                'cars.Company',
                'cars.Model',
                DB::raw('COUNT(*) as total_sales')
            )
            ->whereYear('SaleDate', date('Y'))
            ->groupBy('year', 'month', 'cars.Company', 'cars.Model')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Process data for Chart.js
        $labels = [];
        $datasets = [];
        $companies = $salesData->pluck('Company')->unique();

        // Generate labels (months)
        for ($i = 1; $i <= 12; $i++) {
            $labels[] = date('F', mktime(0, 0, 0, $i, 1));
        }

        // Generate random colors for each company
        $colors = [];
        foreach ($companies as $company) {
            $colors[$company] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        }

        // Organize data by company
        foreach ($companies as $company) {
            $monthlyData = array_fill(0, 12, 0); // Initialize with zeros
            
            foreach ($salesData as $sale) {
                if ($sale->Company === $company) {
                    $monthlyData[$sale->month - 1] = $sale->total_sales;
                }
            }

            $datasets[] = [
                'label' => $company,
                'data' => $monthlyData,
                'backgroundColor' => $colors[$company],
                'borderColor' => $colors[$company],
                'borderWidth' => 2,
            ];
        }

        return response()->json([
            'labels' => $labels,
            'datasets' => $datasets
        ]);
    }


    public function getColorSalesData()
    {
        // Get sales data grouped by car color
        $colorData = DB::table('sales')
            ->join('cars', 'sales.CarID', '=', 'cars.CarID')
            ->select(
                'cars.Color',
                DB::raw('COUNT(*) as total_sales')
            )
            ->groupBy('cars.Color')
            ->orderBy('total_sales', 'desc')
            ->get();

        // Prepare data for Chart.js
        $labels = $colorData->pluck('Color')->toArray();
        $values = $colorData->pluck('total_sales')->toArray();

        return response()->json([
            'labels' => $labels,
            'values' => $values
        ]);
    }


    public function getSalesByModel()
    {
        // Get sales data grouped by car model and company
        $salesData = DB::table('sales')
            ->join('cars', 'sales.CarID', '=', 'cars.CarID')
            ->select(
                DB::raw("CONCAT(cars.Company, ' ', cars.Model) as car_name"),
                DB::raw('COUNT(*) as total_sales'),
                'cars.Price'
            )
            ->groupBy('cars.Company', 'cars.Model', 'cars.Price')
            ->orderBy('total_sales', 'desc')
            ->limit(10)  // Top 10 models
            ->get();

        // Calculate revenue for each model
        $labels = [];
        $salesValues = [];
        $revenueValues = [];

        foreach ($salesData as $data) {
            $labels[] = $data->car_name;
            $salesValues[] = $data->total_sales;
            $revenueValues[] = $data->total_sales * $data->Price;
        }

        return response()->json([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Number of Sales',
                    'data' => $salesValues,
                    'backgroundColor' => 'rgba(30, 100, 180, 0.7)',
                    'borderColor' => 'rgba(30, 100, 180, 1)',
                    'borderWidth' => 1,
                    'yAxisID' => 'y'
                ],
                [
                    'label' => 'Revenue (USD)',
                    'data' => $revenueValues,
                    'backgroundColor' => 'rgba(200, 50, 80, 0.7)',
                    'borderColor' => 'rgba(200, 50, 80, 1)',
                    'borderWidth' => 1,
                    'yAxisID' => 'y1'
                ]
            ]
        ]);
    }

}
