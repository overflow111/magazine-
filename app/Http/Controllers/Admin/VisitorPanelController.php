<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitorPanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $request->validate([
            'robot' => 'nullable|integer|between:0,1',
        ]);
        $robot = $request->robot ?: 0;

        $maps = DB::table("ip_addresses")
            ->leftJoin('visitors', function ($join) use ($robot) {
                $join->on('ip_addresses.id', '=', 'visitors.ip_address_id')
                    ->where('visitors.robot', $robot)
                    ->where('visitors.updated_at', '>', Carbon::now()->subWeek()->toDateTimeString());
            })
            ->whereNotNull('ip_addresses.country_code')
            ->where('ip_addresses.country_code', "!=", '')
            ->havingRaw('COUNT(visitors.id) > ?', [0])
            ->selectRaw("COUNT(visitors.id) as count, ip_addresses.country_name, ip_addresses.country_code")
            ->groupBy('ip_addresses.country_name', 'ip_addresses.country_code')
            ->get();

        $days = Visitor::where('robot', $robot)
            ->where('updated_at', '>', Carbon::now()->firstOfMonth()->subYear()->toDateTimeString())
            ->selectRaw("COUNT(id) as count, date_trunc('day', updated_at) as day")
            ->groupBy('day')
            ->orderBy('day', 'asc')
            ->get();

        $devices = Visitor::leftJoin('user_agents', 'user_agents.id', '=', 'visitors.user_agent_id')
            ->where('visitors.updated_at', '>', Carbon::now()->firstOfMonth()->subYear()->toDateTimeString())
            ->where('visitors.robot', $robot)
            ->selectRaw("user_agents.device as name, count(visitors.id) as count")
            ->whereNotNull('user_agents.device')
            ->groupBy('user_agents.device')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();

        $platforms = Visitor::leftJoin('user_agents', 'user_agents.id', '=', 'visitors.user_agent_id')
            ->where('visitors.updated_at', '>', Carbon::now()->firstOfMonth()->subYear()->toDateTimeString())
            ->where('visitors.robot', $robot)
            ->selectRaw("user_agents.platform as name, count(visitors.id) as count")
            ->whereNotNull('user_agents.platform')
            ->groupBy('user_agents.platform')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();

        $browsers = Visitor::leftJoin('user_agents', 'user_agents.id', '=', 'visitors.user_agent_id')
            ->where('visitors.updated_at', '>', Carbon::now()->firstOfMonth()->subYear()->toDateTimeString())
            ->where('visitors.robot', $robot)
            ->selectRaw("user_agents.browser as name, count(visitors.id) as count")
            ->whereNotNull('user_agents.browser')
            ->groupBy('user_agents.browser')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();

        $robots = Visitor::leftJoin('user_agents', 'user_agents.id', '=', 'visitors.user_agent_id')
            ->where('visitors.updated_at', '>', Carbon::now()->firstOfMonth()->subYear()->toDateTimeString())
            ->where('visitors.robot', $robot)
            ->selectRaw("user_agents.robot as name, count(visitors.id) as count")
            ->whereNotNull('user_agents.robot')
            ->groupBy('user_agents.robot')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();

        return view('admin.visitorPanel.index')
            ->with([
                'robot' => $robot,
                'maps' => $maps,
                'days' => $days,
                'devices' => $devices,
                'platforms' => $platforms,
                'browsers' => $browsers,
                'robots' => $robots,
            ]);
    }
}