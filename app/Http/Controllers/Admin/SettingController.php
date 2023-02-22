<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $obj = Setting::orderBy('id')
            ->get();

        return view('admin.setting.index')
            ->with([
                'obj' => $obj,
            ]);
    }


    public function edit()
    {
        $obj = Setting::orderBy('id')
            ->get();

        return view('admin.setting.edit')
            ->with([
                'obj' => $obj,
            ]);
    }


    public function update(Request $request)
    {
        $request->validate([
            'name_tm' => 'required|string|max:255',
            'name_ru' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048|dimensions:width=300,height=300',
        ]);

        if ($request->hasfile('image')) {
            $obj = Setting::findOrFail(1);
            if ($obj->image) {
                Storage::delete('public/' . $obj->image);
            }
            $newImage = $request->file('image');
            $newImageName = Str::slug($request->name_tm) . '.' . $newImage->getClientOriginalExtension();
            $newImage->storeAs('public/', $newImageName);
            $obj->setting = $newImageName;
            $obj->update();
        }

        $obj = Setting::findOrFail(2);
        $obj->setting = $request->name_tm;
        $obj->update();

        $obj = Setting::findOrFail(3);
        $obj->setting = $request->name_ru ?: null;
        $obj->update();

        $obj = Setting::findOrFail(4);
        $obj->setting = $request->name_en ?: null;
        $obj->update();

        $success = trans('transAdmin.settings') . ' ' . trans('transAdmin.updated');
        return redirect()->route('admin.settings.index')
            ->with([
                'success' => $success
            ]);
    }
}
