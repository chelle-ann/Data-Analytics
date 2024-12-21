<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Car;
use App\Models\Customer;
use App\Models\Dealer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function fetchSalesData(Request $request)
    {
        $month = $request->input('month');
        $model = $request->input('model');
        $color = $request->input('color');

        $query = DB::table('sales')
            ->join('cars', 'sales.CarID', '=', 'cars.CarID')
            ->select(
                DB::raw('MONTH(sales.SaleDate) as sale_month'),
                'cars.Model',
                'cars.Color',
                DB::raw('COUNT(sales.SaleID) as total_sales'),
                DB::raw('SUM(cars.Price) as total_revenue')
            )
            ->groupBy('sale_month', 'cars.Model', 'cars.Color');

        if ($month && $month !== 'all') {
            $query->whereMonth('sales.SaleDate', $month);
        }

        if ($model && $model !== 'all') {
            $query->where('cars.Model', $model);
        }

        if ($color && $color !== 'all') {
            $query->where('cars.Color', $color);
        }

        $data = $query->get();

        return response()->json($data);
    }

    public function fetchFilters()
    {
        $models = DB::table('cars')->select('Model')->distinct()->pluck('Model');
        $colors = DB::table('cars')->select('Color')->distinct()->pluck('Color');
        
        return response()->json([
            'models' => $models,
            'colors' => $colors
        ]);
    }

}