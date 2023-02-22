<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IpAddress;
use Illuminate\Http\Request;

class IpAddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('admin.ipAddress.index');
    }


    public function disabled($id)
    {
        $obj = IpAddress::findOrFail($id);
        if ($obj->disabled) {
            $obj->disabled = 0;
            $obj->update();
            $success = $obj->ip_address . ' ' . trans('transAdmin.enabled');
        } else {
            $obj->disabled = 1;
            $obj->update();
            $success = $obj->ip_address . ' ' . trans('transAdmin.disabled');
        }
        return redirect()->back()
            ->with([
                'success' => $success,
            ]);
    }


    public function api(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'ip_address',
            2 => 'country_code',
            3 => 'country_name',
            4 => 'city_name',
            5 => 'disabled',
        );

        $totalData = IpAddress::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (!$request->input('search.value')) {
            $rs = IpAddress::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = IpAddress::count();
        } else {
            $search = $request->input('search.value');
            $rs = IpAddress::orWhere('id', 'ilike', "%{$search}%")
                ->orWhere('ip_address', 'ilike', "%{$search}%")
                ->orWhere('country_code', 'ilike', "%{$search}%")
                ->orWhere('country_name', 'ilike', "%{$search}%")
                ->orWhere('city_name', 'ilike', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = IPAddress::orWhere('id', 'ilike', "%{$search}%")
                ->orWhere('ip_address', 'ilike', "%{$search}%")
                ->orWhere('country_code', 'ilike', "%{$search}%")
                ->orWhere('country_name', 'ilike', "%{$search}%")
                ->orWhere('city_name', 'ilike', "%{$search}%")
                ->count();
        }
        $data = array();
        if ($rs) {
            foreach ($rs as $r) {
                $nestedData['id'] = $r->id;
                $nestedData['ip_address'] = ($r->country_code != Null ? '<img src="' .
                        asset('flag/' . $r->country_code . '.png') . '" class="border"/> ' : '<img src="' .
                        asset('flag/flag.png') . '" class="border"/> ') . $r->ip_address;
                $nestedData['country_code'] = $r->country_code;
                $nestedData['country_name'] = $r->country_name;
                $nestedData['city_name'] = $r->city_name;
                $nestedData['disabled'] = ($r->disabled ? '<span class="badge badge-dark">' . trans('transAdmin.disable') . '</span> <a href="' .
                    route('admin.ip-addresses.disabled', $r->id)
                    . '" class="btn btn-sm btn-light">' . trans('transAdmin.do-enable') . '</a>' : '<span class="badge badge-info">' . trans('transAdmin.enable') . '</span> <a href="' .
                    route('admin.ip-addresses.disabled', $r->id)
                    . '" class="btn btn-sm btn-light">' . trans('transAdmin.do-disable') . '</a>');
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
