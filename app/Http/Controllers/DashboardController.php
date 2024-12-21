<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function fetchData(Request $request)
    {
        $month = $request->query('month');
        $color = $request->query('color');
        $model = $request->query('model');

        // Example query logic
        $query = DB::table('sales'); // Update 'sales' to your actual table name

        if ($month !== 'all') {
            $query->whereMonth('date', '=', $month);
        }

        if ($color !== 'all') {
            $query->where('color', '=', $color);
        }

        if ($model !== 'all') {
            $query->where('model', '=', $model);
        }

        $results = $query->get();

        // Format data for the frontend
        $data = [
            'monthlySales' => $results->pluck('monthly_sales')->toArray(),
            'colorDistribution' => $results->pluck('color_distribution')->toArray(),
            'modelSales' => $results->pluck('model_sales')->toArray(),
        ];

        return response()->json($data);
    }
}
