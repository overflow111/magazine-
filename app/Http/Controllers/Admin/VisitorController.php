<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('admin.visitor.index');
    }


    public function api(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'ip_address',
            2 => 'user_agent',
            3 => 'hits',
            4 => 'suspect_hits',
            5 => 'robot',
            6 => 'created_at',
            7 => 'updated_at',
        );

        $totalData = Visitor::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (!$request->input('search.value')) {
            $rs = Visitor::with(['ipAddress', 'userAgent'])
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Visitor::count();
        } else {
            $search = $request->input('search.value');
            $rs = Visitor::orWhere('id', 'ilike', "%{$search}%")
                ->orWhereHas('ipAddress', function ($query) use ($search) {
                    $query->where('ip_address', 'ilike', "%{$search}%");
                    $query->orWhere('country_code', 'ilike', "%{$search}%");
                    $query->orWhere('country_name', 'ilike', "%{$search}%");
                    $query->orWhere('city_name', 'ilike', "%{$search}%");
                })
                ->orWhereHas('userAgent', function ($query) use ($search) {
                    $query->where('user_agent', 'ilike', "%{$search}%");
                    $query->orWhere('device', 'ilike', "%{$search}%");
                    $query->orWhere('platform', 'ilike', "%{$search}%");
                    $query->orWhere('browser', 'ilike', "%{$search}%");
                    $query->orWhere('robot', 'ilike', "%{$search}%");
                })
                ->orWhere('hits', 'ilike', "%{$search}%")
                ->orWhere('suspect_hits', 'ilike', "%{$search}%")
                ->orWhere('created_at', 'ilike', "%{$search}%")
                ->orWhere('updated_at', 'ilike', "%{$search}%")
                ->with(['ipAddress', 'userAgent'])
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Visitor::orWhere('id', 'ilike', "%{$search}%")
                ->orWhereHas('ipAddress', function ($query) use ($search) {
                    $query->where('ip_address', 'ilike', "%{$search}%");
                    $query->orWhere('country_code', 'ilike', "%{$search}%");
                    $query->orWhere('country_name', 'ilike', "%{$search}%");
                    $query->orWhere('city_name', 'ilike', "%{$search}%");
                })
                ->orWhereHas('userAgent', function ($query) use ($search) {
                    $query->where('user_agent', 'ilike', "%{$search}%");
                    $query->orWhere('device', 'ilike', "%{$search}%");
                    $query->orWhere('platform', 'ilike', "%{$search}%");
                    $query->orWhere('browser', 'ilike', "%{$search}%");
                    $query->orWhere('robot', 'ilike', "%{$search}%");
                })
                ->orWhere('hits', 'ilike', "%{$search}%")
                ->orWhere('suspect_hits', 'ilike', "%{$search}%")
                ->orWhere('created_at', 'ilike', "%{$search}%")
                ->orWhere('updated_at', 'ilike', "%{$search}%")
                ->count();
        }
        $data = array();
        if ($rs) {
            foreach ($rs as $r) {
                $nestedData['id'] = $r->id;
                $nestedData['ip_address'] = ($r->ipAddress->country_code != Null ? '<img src="' .
                        asset('flag/' . $r->ipAddress->country_code . '.png') . '" class="border"/> ' : '<img src="' .
                        asset('flag/flag.png') . '" class="border"/> ') .
                    ($r->suspect_hits > 20 ? '<span class="badge badge-pill badge-warning" style="font-size: 1rem;">' . $r->ipAddress->ip_address . '</span>' : $r->ipAddress->ip_address) .
                    ($r->ipAddress->disabled ? ' <i class="fas fa-times-circle text-dark"></i>' : ' <i class="fas fa-check-circle text-info"></i>');
                $nestedData['user_agent'] = $r->userAgent->ua() .
                    ($r->userAgent->disabled ? ' <i class="fas fa-times-circle text-dark"></i>' : ' <i class="fas fa-check-circle text-info"></i>');
                $nestedData['hits'] = $r->hits;
                $nestedData['suspect_hits'] = $r->suspect_hits;
                $nestedData['robot'] = $r->robot ? '<i class="fas fa-robot text-secondary"></i>' : '<i class="fas fa-user text-secondary"></i>';
                $nestedData['created_at'] = $r->created_at->format('Y-m-d H:i:s');
                $nestedData['updated_at'] = $r->updated_at->format('Y-m-d H:i:s');
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
