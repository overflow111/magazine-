<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('admin.sale.index');
    }


    public function show($id)
    {
        $obj = Sale::with(['customer', 'plan', 'buys.magazine'])
            ->findOrFail($id);

        return view('admin.sale.show')
            ->with([
                'obj' => $obj,
            ]);
    }


    public function api(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'customer_name',
            2 => 'customer_username',
            3 => 'plan_month',
            4 => 'date_start',
            5 => 'status',
        );

        $totalData = Sale::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (!$request->input('search.value')) {
            $rs = Sale::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Sale::count();
        } else {
            $search = $request->input('search.value');
            $rs = Sale::orWhere('id', 'ilike', "%{$search}%")
                ->orWhere('customer_name', 'ilike', "%{$search}%")
                ->orWhere('customer_surname', 'ilike', "%{$search}%")
                ->orWhere('customer_email', 'ilike', "%{$search}%")
                ->orWhere('customer_username', 'ilike', "%{$search}%")
                ->orWhere('price', 'ilike', "%{$search}%")
                ->orWhere('created_at', 'ilike', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Sale::orWhere('id', 'ilike', "%{$search}%")
                ->orWhere('customer_name', 'ilike', "%{$search}%")
                ->orWhere('customer_surname', 'ilike', "%{$search}%")
                ->orWhere('customer_email', 'ilike', "%{$search}%")
                ->orWhere('customer_username', 'ilike', "%{$search}%")
                ->orWhere('price', 'ilike', "%{$search}%")
                ->orWhere('created_at', 'ilike', "%{$search}%")
                ->count();
        }

        $data = array();
        if ($rs) {
            foreach ($rs as $r) {
                $nestedData['id'] = $r->id;
                $nestedData['customer_name'] = $r->customer_name . ' ' . $r->customer_surname;
                $nestedData['customer_username'] = $r->customer_email . '<br>' . '<i class="fas fa-mobile-alt text-gray-500"></i> ' . $r->customer_username;
                $nestedData['plan_month'] = trans('transAdmin.month') . ': ' . $r->plan_month . '<br>' . trans('transAdmin.magazine') . ': ' . $r->plan_download;
                $nestedData['date_start'] = $r->date_start->format('Y-m-d');
                $nestedData['status'] = $r->status() . ' ' . $r->icon();
                $nestedData['action'] = '<a href= "' . route('admin.sales.show', $r->id) . '" class="btn btn-outline-info btn-sm"><i class="fas fa-th-large"></i></a>';
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
