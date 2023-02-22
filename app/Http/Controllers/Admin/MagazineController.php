<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magazine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class MagazineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('admin.magazine.index');
    }


    public function show($id)
    {
        $obj = Magazine::findOrFail($id);

        return view('admin.magazine.show')
            ->with([
                'obj' => $obj,
            ]);
    }


    public function create()
    {
        return view('admin.magazine.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title_tm' => 'required|string|max:150',
            'title_ru' => 'nullable|string|max:150',
            'title_en' => 'nullable|string|max:150',
            'body_tm' => 'required|string|max:25500',
            'body_ru' => 'nullable|string|max:25500',
            'body_en' => 'nullable|string|max:25500',
            'published_at' => 'required|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048|dimensions:width=450,height=600|distinct',
            'file' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $obj = new Magazine();
        $obj->title_tm = $request->title_tm;
        $obj->title_ru = $request->title_ru ?: null;
        $obj->title_en = $request->title_en ?: null;
        $obj->slug = Str::slug($request->title_tm) . '-' . Str::random(5);
        $obj->body_tm = $request->body_tm;
        $obj->body_ru = $request->body_ru ?: null;
        $obj->body_en = $request->body_en ?: null;
        $obj->active = $request->has('active') ? true : false;
        $obj->published_at = Carbon::parse($request->published_at)->toDateTimeString();
        $obj->save();

        if ($request->hasfile('image')) {
            $newImage = $request->file('image');
            $newImageName = Str::slug($request->title_tm) . '-' . Str::random(5) . '.' . 'jpg';
            $image = Image::make($newImage);
            $image = (string)$image->encode('jpg', 80);
            $imagePath = 'public/m/' . $newImageName;
            Storage::put($imagePath, $image);
            $obj->image = 'm/' . $newImageName;
            $obj->update();
        }
        if ($request->hasfile('file')) {
            $newFile = $request->file('file');
            $newFileName = Str::slug($request->title_tm) . '-' . Str::random(5) . '.' . $newFile->getClientOriginalExtension();
            $newFile->storeAs('private/m/', $newFileName);
            $obj->file = 'm/' . $newFileName;
            $obj->update();
        }

        $success = $obj->getTitle() . ' ' . trans('transAdmin.created');
        return redirect()->route('admin.magazines.show', $obj->id)
            ->with([
                'success' => $success
            ]);
    }


    public function edit($id)
    {
        $obj = Magazine::findOrFail($id);

        return view('admin.magazine.edit')
            ->with([
                'obj' => $obj,
            ]);
    }


    public function update(Request $request, $id)
    {
        $obj = Magazine::findOrFail($id);
        $request->validate([
            'title_tm' => 'required|string|max:150',
            'title_ru' => 'nullable|string|max:150',
            'title_en' => 'nullable|string|max:150',
            'body_tm' => 'required|string|max:25500',
            'body_ru' => 'nullable|string|max:25500',
            'body_en' => 'nullable|string|max:25500',
            'published_at' => 'required|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048|dimensions:width=450,height=600|distinct',
            'file' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $obj->title_tm = $request->title_tm;
        $obj->title_ru = $request->title_ru ?: null;
        $obj->title_en = $request->title_en ?: null;
        $obj->slug = Str::slug($request->title_tm) . '-' . Str::random(5);
        $obj->body_tm = $request->body_tm;
        $obj->body_ru = $request->body_ru ?: null;
        $obj->body_en = $request->body_en ?: null;
        $obj->active = $request->has('active') ? true : false;
        $obj->published_at = Carbon::parse($request->published_at)->toDateTimeString();
        $obj->update();

        if ($request->hasfile('image')) {
            if ($obj->image) {
                Storage::delete('public/' . $obj->image);
            }
            $newImage = $request->file('image');
            $newImageName = Str::slug($request->title_tm) . '-' . Str::random(5) . '.' . 'jpg';
            $image = Image::make($newImage);
            $image = (string)$image->encode('jpg', 80);
            $imagePath = 'public/m/' . $newImageName;
            Storage::put($imagePath, $image);
            $obj->image = 'm/' . $newImageName;
            $obj->update();
        }
        if ($request->hasfile('file')) {
            if ($obj->file) {
                Storage::delete('private/' . $obj->file);
            }
            $newFile = $request->file('file');
            $newFileName = Str::slug($request->title_tm) . '-' . Str::random(5) . '.' . $newFile->getClientOriginalExtension();
            $newFile->storeAs('private/m/', $newFileName);
            $obj->file = 'm/' . $newFileName;
            $obj->update();
        }

        $success = $obj->getTitle() . ' ' . trans('transAdmin.updated');
        return redirect()->route('admin.magazines.show', $obj->id)
            ->with([
                'success' => $success
            ]);
    }


    public function delete($id)
    {
        $obj = Magazine::findOrFail($id);
        Storage::delete('public/' . $obj->image);
        Storage::delete('private/' . $obj->file);
        $objName = $obj->getTitle();
        $obj->delete();

        $success = $objName . ' ' . trans('transAdmin.deleted');
        return redirect()->route('admin.magazines.index')
            ->with([
                'success' => $success
            ]);
    }


    public function download($id)
    {
        $obj = Magazine::findOrFail($id);
        return $obj->getFile();
    }


    public function api(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'image',
            2 => 'title',
            3 => 'published_at',
            4 => 'downloaded',
            5 => 'active',
        );

        $totalData = Magazine::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (!$request->input('search.value')) {
            $rs = Magazine::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = Magazine::count();
        } else {
            $search = $request->input('search.value');
            $rs = Magazine::orWhere('id', 'ilike', "%{$search}%")
                ->orWhere('title_tm', 'ilike', "%{$search}%")
                ->orWhere('title_ru', 'ilike', "%{$search}%")
                ->orWhere('title_en', 'ilike', "%{$search}%")
                ->orWhere('slug', 'ilike', "%{$search}%")
                ->orWhere('published_at', 'ilike', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = Magazine::orWhere('id', 'ilike', "%{$search}%")
                ->orWhere('title_tm', 'ilike', "%{$search}%")
                ->orWhere('title_ru', 'ilike', "%{$search}%")
                ->orWhere('title_en', 'ilike', "%{$search}%")
                ->orWhere('slug', 'ilike', "%{$search}%")
                ->orWhere('published_at', 'ilike', "%{$search}%")
                ->count();
        }

        $data = array();
        if ($rs) {
            foreach ($rs as $r) {
                $nestedData['id'] = $r->id;
                $nestedData['image'] = '<a href = "' . route('admin.magazines.show', $r->id) . '">'
                    . ($r->image ? '<img src="' . Storage::disk('local')->url($r->image) . '" alt="' . $r->image . '" class="img-fluid img-max">'
                        : '<img src="' . asset('img/temp/magazine.png') . '" alt="' . trans('transAdmin.not-found') . '" class="img-fluid img-max">')
                    . '</a>';
                $nestedData['title'] = '<div class="mb-1"><img src="' . asset('img/flag/tkm.png') . '" alt="TKM" class="border"> ' . $r->title_tm . '</div>'
                    . '<div class="mb-1"><img src="' . asset('img/flag/rus.png') . '" alt="RUS" class="border"> ' . $r->title_ru . '</div>'
                    . '<div><img src="' . asset('img/flag/eng.png') . '" alt="ENG" class="border"> ' . $r->title_en . '</div>';
                $nestedData['published_at'] = $r->published_at->format('Y-m-d H:i');
                $nestedData['downloaded'] = $r->downloaded . '<div class="small text-secondary">' . trans('transAdmin.downloaded') . '</div>';
                $nestedData['active'] = ($r->active ? '<span class="badge badge-info">' . trans('transAdmin.enable') . '</span>'
                    : '<span class="badge badge-dark">' . trans('transAdmin.disable') . '</span>');
                $nestedData['action'] = '<a href= "' . route('admin.magazines.show', $r->id) . '" class="btn btn-outline-info btn-sm mb-1"><i class="fas fa-th-large"></i></a>'
                    . ' <a href = "' . route('admin.magazines.edit', $r->id) . '" class="btn btn-outline-success btn-sm mb-1"><i class="fas fa-pen"></i></a>';
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
