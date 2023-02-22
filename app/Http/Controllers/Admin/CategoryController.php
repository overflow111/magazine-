<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $objs = Category::orderBy('sort_order')
            ->get();

        return view('admin.category.index')
            ->with([
                'objs' => $objs,
            ]);
    }


    public function create()
    {
        return view('admin.category.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name_tm' => 'required|string|max:150',
            'name_ru' => 'nullable|string|max:150',
            'name_en' => 'nullable|string|max:150',
            'sort_order' => 'required|integer|between:1,100000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048|dimensions:width=300,height=300',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png|max:2048|dimensions:width=200,height=200',
        ]);

        $obj = new Category();
        $obj->name_tm = $request->name_tm;
        $obj->name_ru = $request->name_ru ?: null;
        $obj->name_en = $request->name_en ?: null;
        $obj->slug = Str::slug($request->name_tm);
        $obj->menu = $request->has('menu') ? true : false;
        $obj->main = $request->has('main') ? true : false;
        $obj->advice = $request->has('advice') ? true : false;
        $obj->sort_order = $request->sort_order;
        $obj->active = $request->has('active') ? true : false;
        if ($request->hasfile('image')) {
            $newImage = $request->file('image');
            $newImageName = Str::slug($request->name_tm) . '-' . Str::random(5) . '.' . $newImage->getClientOriginalExtension();
            $newImage->storeAs('public/c/', $newImageName);
            $obj->image = 'c/' . $newImageName;
        }
        if ($request->hasfile('icon')) {
            $newIcon = $request->file('icon');
            $newIconName = Str::slug($request->name_tm) . '-' . Str::random(5) . '.' . $newIcon->getClientOriginalExtension();
            $newIcon->storeAs('public/c/', $newIconName);
            $obj->icon = 'c/' . $newIconName;
        }
        $obj->save();

        $success = $obj->getName() . ' ' . trans('transAdmin.created');
        return redirect()->route('admin.categories.index')
            ->with([
                'success' => $success
            ]);
    }


    public function edit($id)
    {
        $obj = Category::findOrFail($id);

        return view('admin.category.edit')
            ->with([
                'obj' => $obj,
            ]);
    }


    public function update(Request $request, $id)
    {
        $obj = Category::findOrFail($id);
        $request->validate([
            'name_tm' => 'required|string|max:150',
            'name_ru' => 'nullable|string|max:150',
            'name_en' => 'nullable|string|max:150',
            'sort_order' => 'required|integer|between:1,100000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048|dimensions:width=300,height=300',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png|max:2048|dimensions:width=200,height=200',
        ]);

        $obj->name_tm = $request->name_tm;
        $obj->name_ru = $request->name_ru ?: null;
        $obj->name_en = $request->name_en ?: null;
        $obj->slug = Str::slug($request->name_tm);
        $obj->menu = $request->has('menu') ? true : false;
        $obj->main = $request->has('main') ? true : false;
        $obj->advice = $request->has('advice') ? true : false;
        $obj->sort_order = $request->sort_order;
        $obj->active = $request->has('active') ? true : false;
        if ($request->hasfile('image')) {
            if ($obj->image) {
                Storage::delete('public/' . $obj->image);
            }
            $newImage = $request->file('image');
            $newImageName = Str::slug($request->name_tm) . '-' . Str::random(5) . '.' . $newImage->getClientOriginalExtension();
            $newImage->storeAs('public/c/', $newImageName);
            $obj->image = 'c/' . $newImageName;
        }
        if ($request->hasfile('icon')) {
            if ($obj->icon) {
                Storage::delete('public/' . $obj->icon);
            }
            $newIcon = $request->file('icon');
            $newIconName = Str::slug($request->name_tm) . '-' . Str::random(5) . '.' . $newIcon->getClientOriginalExtension();
            $newIcon->storeAs('public/c/', $newIconName);
            $obj->icon = 'c/' . $newIconName;
        }
        $obj->update();

        $success = $obj->getName() . ' ' . trans('transAdmin.updated');
        return redirect()->route('admin.categories.index')
            ->with([
                'success' => $success
            ]);
    }


    public function delete($id)
    {
        $obj = Category::withCount(['posts'])
            ->findOrFail($id);
        if ($obj->posts_count > 0) {
            return redirect()->back()
                ->with([
                    'error' => trans('transFront.error')
                        . '<br>' . trans('transAdmin.post') . ': ' . $obj->posts_count,
                ]);
        }
        if ($obj->image) {
            Storage::delete('public/' . $obj->image);
        }
        if ($obj->icon) {
            Storage::delete('public/' . $obj->icon);
        }
        $objName = $obj->getName();
        $obj->delete();

        $success = $objName . ' ' . trans('transAdmin.deleted');
        return redirect()->route('admin.categories.index')
            ->with([
                'success' => $success
            ]);
    }
}
