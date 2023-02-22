<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalePanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $daysBySale = Sale::where('status', 1)
            ->where('created_at', '>', Carbon::now()->firstOfMonth()->subYear()->toDateTimeString())
            ->selectRaw("COUNT(id) as count, date_trunc('day', created_at) as day")
            ->groupBy('day')
            ->orderBy('day', 'asc')
            ->get();
        
        $monthsBySale = Sale::where('status', 1)
            ->where('created_at', '>', Carbon::now()->firstOfMonth()->subYear()->toDateTimeString())
            ->selectRaw("COUNT(id) as count, date_trunc('month', created_at) as name")
            ->groupBy('name')
            ->orderBy('name')
            ->get();
        
        $monthsByPrice = Sale::where('status', 1)
            ->where('created_at', '>', Carbon::now()->firstOfMonth()->subYear()->toDateTimeString())
            ->selectRaw("SUM(price) as count, date_trunc('month', created_at) as name")
            ->groupBy('name')
            ->orderBy('name')
            ->get();

        return view('admin.salePanel.index')
            ->with([
                'daysBySale' => $daysBySale,
                'monthsBySale' => $monthsBySale,
                'monthsByPrice' => $monthsByPrice,
            ]);
    }
}
