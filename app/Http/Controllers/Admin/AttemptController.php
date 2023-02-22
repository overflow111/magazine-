<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attempt;
use Illuminate\Http\Request;

class AttemptController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('admin.attempt.index');
    }


    public function api(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'ip_address',
            2 => 'username',
            3 => 'event',
            4 => 'created_at',
        );

        $totalData = Attempt::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (!$request->input('search.value')) {
            $rs = Attempt::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Attempt::count();
        } else {
            $search = $request->input('search.value');
            $rs = Attempt::orWhere('id', 'ilike', "%{$search}%")
                ->orWhereHas('ipAddress', function ($query) use ($search) {
                    $query->where('ip_address', 'ilike', "%{$search}%");
                })
                ->orWhere('username', 'ilike', "%{$search}%")
                ->orWhere('event', 'ilike', "%{$search}%")
                ->orWhere('created_at', 'ilike', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Attempt::orWhere('id', 'ilike', "%{$search}%")
                ->orWhereHas('ipAddress', function ($query) use ($search) {
                    $query->where('ip_address', 'ilike', "%{$search}%");
                })
                ->orWhere('username', 'ilike', "%{$search}%")
                ->orWhere('event', 'ilike', "%{$search}%")
                ->orWhere('created_at', 'ilike', "%{$search}%")
                ->count();
        }
        $data = array();
        if ($rs) {
            foreach ($rs as $r) {
                $nestedData['id'] = $r->id;
                $nestedData['ip_address'] = ($r->ipAddress->country_code != Null ? '<img src="' .
                        asset('flag/' . $r->ipAddress->country_code . '.png') . '" class="border"/> ' : '<img src="' .
                        asset('flag/flag.png') . '" class="border"/> ') . $r->ipAddress->ip_address .
                    ($r->ipAddress->disabled ? ' <i class="fas fa-times-circle text-dark"></i>' : ' <i class="fas fa-check-circle text-info"></i>');
                $nestedData['username'] = $r->username;
                $nestedData['event'] = $r->event;
                $nestedData['created_at'] = $r->created_at->format('Y-m-d H:i:s');
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
    }
}