<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $objs = Plan::orderBy('price')
            ->get();

        return view('admin.plan.index')
            ->with([
                'objs' => $objs,
            ]);
    }


    public function create()
    {
        return view('admin.plan.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name_tm' => 'required|string|max:150',
            'name_ru' => 'nullable|string|max:150',
            'name_en' => 'nullable|string|max:150',
            'month' => 'required|integer|between:1,36',
            'download' => 'required|integer|between:1,36',
            'price' => 'required|numeric|min:1',
        ]);

        $obj = new Plan();
        $obj->name_tm = $request->name_tm;
        $obj->name_ru = $request->name_ru ?: null;
        $obj->name_en = $request->name_en ?: null;
        $obj->month = $request->month;
        $obj->download = $request->download;
        $obj->price = round($request->price, 1);
        $obj->active = $request->has('active') ? true : false;
        $obj->save();

        $success = $obj->getName() . ' ' . trans('transAdmin.created');
        return redirect()->route('admin.plans.index')
            ->with([
                'success' => $success
            ]);
    }


    public function edit($id)
    {
        $obj = Plan::findOrFail($id);

        return view('admin.plan.edit')
            ->with([
                'obj' => $obj,
            ]);
    }


    public function update(Request $request, $id)
    {
        $obj = Plan::findOrFail($id);
        $request->validate([
            'name_tm' => 'required|string|max:150',
            'name_ru' => 'nullable|string|max:150',
            'name_en' => 'nullable|string|max:150',
            'month' => 'required|integer|between:1,36',
            'download' => 'required|integer|between:1,36',
            'price' => 'required|numeric|min:1',
        ]);

        $obj->name_tm = $request->name_tm;
        $obj->name_ru = $request->name_ru ?: null;
        $obj->name_en = $request->name_en ?: null;
        $obj->month = $request->month;
        $obj->download = $request->download;
        $obj->price = round($request->price, 1);
        $obj->active = $request->has('active') ? true : false;
        $obj->update();

        $success = $obj->getName() . ' ' . trans('transAdmin.updated');
        return redirect()->route('admin.plans.index')
            ->with([
                'success' => $success
            ]);
    }


    public function delete($id)
    {
        $obj = Plan::withCount(['sales'])
            ->findOrFail($id);
        if ($obj->sales_count > 0) {
            return redirect()->back()
                ->with([
                    'error' => trans('transFront.error')
                        . '<br>' . trans('transAdmin.sale') . ': ' . $obj->sales_count,
                ]);
        }
        $objName = $obj->getName();
        $obj->delete();

        $success = $objName . ' ' . trans('transAdmin.deleted');
        return redirect()->route('admin.plans.index')
            ->with([
                'success' => $success
            ]);
    }
}
