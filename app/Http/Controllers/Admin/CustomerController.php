<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('admin.customer.index');
    }


    public function show($id)
    {
        $obj = Customer::with(['sales', 'buys.magazine'])
            ->findOrFail($id);

        return view('admin.customer.show')
            ->with([
                'obj' => $obj,
            ]);
    }


    public function edit($id)
    {
        $obj = Customer::findOrFail($id);

        return view('admin.customer.edit')
            ->with([
                'obj' => $obj,
            ]);
    }


    public function update(Request $request, $id)
    {
        $obj = Customer::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:150',
            'surname' => 'required|string|max:150',
            'email' => 'required|email',
            'username' => 'required|integer|between:60000000,65999999|unique:customers,username,' . $request->id,
        ]);

        $obj->name = $request->name;
        $obj->surname = $request->surname;
        $obj->email = $request->email;
        $obj->username = $request->username;
        $obj->update();

        $success = $obj->getName() . ' ' . trans('transAdmin.updated');
        return redirect()->route('admin.customers.show', $obj->id)
            ->with([
                'success' => $success
            ]);
    }


    public function delete($id)
    {
        $obj = Customer::withCount(['sales', 'buys'])
            ->findOrFail($id);
        if ($obj->sales_count > 0 or $obj->buys_count > 0) {
            return redirect()->back()
                ->with([
                    'error' => trans('transFront.error')
                        . '<br>' . trans('transAdmin.sale') . ': ' . $obj->sales_count
                        . '<br>' . trans('transAdmin.buy') . ': ' . $obj->buys_count,
                ]);
        }

        $objName = $obj->getName();
        $obj->delete();

        $success = $objName . ' ' . trans('transAdmin.deleted');
        return redirect()->route('admin.customers.index')
            ->with([
                'success' => $success
            ]);
    }


    public function api(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'surname',
            3 => 'email',
            4 => 'username',
        );

        $totalData = Customer::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (!$request->input('search.value')) {
            $rs = Customer::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Customer::count();
        } else {
            $search = $request->input('search.value');
            $rs = Customer::orWhere('id', 'ilike', "%{$search}%")
                ->orWhere('name', 'ilike', "%{$search}%")
                ->orWhere('surname', 'ilike', "%{$search}%")
                ->orWhere('email', 'ilike', "%{$search}%")
                ->orWhere('username', 'ilike', "%{$search}%")
                ->orWhere('created_at', 'ilike', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Customer::orWhere('id', 'ilike', "%{$search}%")
                ->orWhere('name', 'ilike', "%{$search}%")
                ->orWhere('surname', 'ilike', "%{$search}%")
                ->orWhere('email', 'ilike', "%{$search}%")
                ->orWhere('username', 'ilike', "%{$search}%")
                ->orWhere('created_at', 'ilike', "%{$search}%")
                ->count();
        }

        $data = array();
        if ($rs) {
            foreach ($rs as $r) {
                $nestedData['id'] = $r->id;
                $nestedData['name'] = $r->name;
                $nestedData['surname'] = $r->surname;
                $nestedData['email'] = $r->email;
                $nestedData['username'] = '<i class="fas fa-mobile-alt text-gray-500"></i> ' . $r->username;
                $nestedData['action'] = '<a href= "' . route('admin.customers.show', $r->id) . '" class="btn btn-outline-info btn-sm mb-1"><i class="fas fa-th-large"></i></a>'
                    . ' <a href = "' . route('admin.customers.edit', $r->id) . '" class="btn btn-outline-success btn-sm mb-1"><i class="fas fa-pen"></i></a>';
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
