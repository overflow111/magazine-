<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\Post;
use App\Models\View;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostPanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $daysByViewed = View::where('date', '>', Carbon::today()->firstOfMonth()->subYear()->toDateString())
            ->selectRaw("SUM(viewed) as count, date_trunc('day', date) as day")
            ->groupBy('day')
            ->orderBy('day', 'asc')
            ->get();

        $monthsByViewed = View::where('date', '>', Carbon::today()->firstOfMonth()->subYear()->toDateString())
            ->selectRaw("SUM(viewed) as count, date_trunc('month', date) as name")
            ->groupBy('name')
            ->orderBy('name')
            ->get();

        return view('admin.postPanel.index')
            ->with([
                'daysByViewed' => $daysByViewed,
                'monthsByViewed' => $monthsByViewed,
            ]);
    }
}
