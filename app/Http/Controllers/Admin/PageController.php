<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $objs = Page::orderBy('id')
            ->get();

        return view('admin.page.index')
            ->with([
                'objs' => $objs,
            ]);
    }


    public function edit($id)
    {
        $obj = Page::findOrFail($id);

        return view('admin.page.edit')
            ->with([
                'obj' => $obj,
            ]);
    }


    public function update(Request $request, $id)
    {
        $obj = Page::findOrFail($id);
        $request->validate([
            'body_tm' => 'required|string|max:25500',
            'body_ru' => 'nullable|string|max:25500',
            'body_en' => 'nullable|string|max:25500',
        ]);

        $obj->body_tm = $request->body_tm;
        $obj->body_ru = $request->body_ru ?: null;
        $obj->body_en = $request->body_en ?: null;
        $obj->update();

        $success = '#' . $obj->id . ' ' . trans('transAdmin.updated');
        return redirect()->route('admin.pages.index')
            ->with([
                'success' => $success
            ]);
    }
}
