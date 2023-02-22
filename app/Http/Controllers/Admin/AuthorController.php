<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class AuthorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('admin.author.index');
    }


    public function show($id)
    {
        $obj = Author::findOrFail($id);

        return view('admin.author.show')
            ->with([
                'obj' => $obj,
            ]);
    }


    public function create()
    {
        return view('admin.author.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name_tm' => 'required|string|max:150',
            'name_ru' => 'nullable|string|max:150',
            'name_en' => 'nullable|string|max:150',
            'job_tm' => 'required|string|max:255',
            'job_ru' => 'nullable|string|max:255',
            'job_en' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048|dimensions:width=300,height=300|distinct',
        ]);

        $obj = new Author();
        $obj->name_tm = $request->name_tm;
        $obj->name_ru = $request->name_ru ?: null;
        $obj->name_en = $request->name_en ?: null;
        $obj->slug = Str::slug($request->name_tm) . '-' . Str::random(5);
        $obj->job_tm = $request->job_tm;
        $obj->job_ru = $request->job_ru ?: null;
        $obj->job_en = $request->job_en ?: null;
        $obj->active = $request->has('active') ? true : false;
        $obj->save();

        if ($request->hasfile('image')) {
            $newImage = $request->file('image');
            $newImageName = Str::slug($request->name_tm) . '-' . Str::random(5) . '.' . 'jpg';
            $image = Image::make($newImage);
            $image = (string)$image->encode('jpg', 80);
            $imagePath = 'public/a/' . $newImageName;
            Storage::put($imagePath, $image);
            $obj->image = 'a/' . $newImageName;
            $obj->update();
        }

        $success = $obj->getName() . ' ' . trans('transAdmin.created');
        return redirect()->route('admin.authors.show', $obj->id)
            ->with([
                'success' => $success
            ]);
    }


    public function edit($id)
    {
        $obj = Author::findOrFail($id);

        return view('admin.author.edit')
            ->with([
                'obj' => $obj,
            ]);
    }


    public function update(Request $request, $id)
    {
        $obj = Author::findOrFail($id);
        $request->validate([
            'name_tm' => 'required|string|max:150',
            'name_ru' => 'nullable|string|max:150',
            'name_en' => 'nullable|string|max:150',
            'job_tm' => 'required|string|max:255',
            'job_ru' => 'nullable|string|max:255',
            'job_en' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048|dimensions:width=300,height=300|distinct',
        ]);

        $obj->name_tm = $request->name_tm;
        $obj->name_ru = $request->name_ru ?: null;
        $obj->name_en = $request->name_en ?: null;
        $obj->slug = Str::slug($request->name_tm) . '-' . Str::random(5);
        $obj->job_tm = $request->job_tm;
        $obj->job_ru = $request->job_ru ?: null;
        $obj->job_en = $request->job_en ?: null;
        $obj->active = $request->has('active') ? true : false;
        $obj->update();

        if ($request->hasfile('image')) {
            if ($obj->image) {
                Storage::delete('public/' . $obj->image);
            }
            $newImage = $request->file('image');
            $newImageName = Str::slug($request->name_tm) . '-' . Str::random(5) . '.' . 'jpg';
            $image = Image::make($newImage);
            $image = (string)$image->encode('jpg', 80);
            $imagePath = 'public/a/' . $newImageName;
            Storage::put($imagePath, $image);
            $obj->image = 'a/' . $newImageName;
            $obj->update();
        }

        $success = $obj->getName() . ' ' . trans('transAdmin.updated');
        return redirect()->route('admin.authors.show', $obj->id)
            ->with([
                'success' => $success
            ]);
    }


    public function delete($id)
    {
        $obj = Author::findOrFail($id);
        Storage::delete('public/' . $obj->image);
        $objName = $obj->getName();
        $obj->delete();

        $success = $objName . ' ' . trans('transAdmin.deleted');
        return redirect()->route('admin.authors.index')
            ->with([
                'success' => $success
            ]);
    }


    public function api(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'image',
            2 => 'name',
            3 => 'job',
            4 => 'active',
        );

        $totalData = Author::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (!$request->input('search.value')) {
            $rs = Author::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = Author::count();
        } else {
            $search = $request->input('search.value');
            $rs = Author::orWhere('id', 'ilike', "%{$search}%")
                ->orWhere('name_tm', 'ilike', "%{$search}%")
                ->orWhere('name_ru', 'ilike', "%{$search}%")
                ->orWhere('name_en', 'ilike', "%{$search}%")
                ->orWhere('slug', 'ilike', "%{$search}%")
                ->orWhere('job_tm', 'ilike', "%{$search}%")
                ->orWhere('job_ru', 'ilike', "%{$search}%")
                ->orWhere('job_en', 'ilike', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = Author::orWhere('id', 'ilike', "%{$search}%")
                ->orWhere('name_tm', 'ilike', "%{$search}%")
                ->orWhere('name_ru', 'ilike', "%{$search}%")
                ->orWhere('name_en', 'ilike', "%{$search}%")
                ->orWhere('slug', 'ilike', "%{$search}%")
                ->orWhere('job_tm', 'ilike', "%{$search}%")
                ->orWhere('job_ru', 'ilike', "%{$search}%")
                ->orWhere('job_en', 'ilike', "%{$search}%")
                ->count();
        }

        $data = array();
        if ($rs) {
            foreach ($rs as $r) {
                $nestedData['id'] = $r->id;
                $nestedData['image'] = '<a href = "' . route('admin.authors.show', $r->id) . '">'
                    . ($r->image ? '<img src="' . Storage::disk('local')->url($r->image) . '" alt="' . $r->image . '" class="img-fluid img-max">'
                        : '<img src="' . asset('img/temp/author.png') . '" alt="' . trans('transAdmin.not-found') . '" class="img-fluid img-max">')
                    . '</a>';
                $nestedData['name'] = '<div class="mb-1"><img src="' . asset('img/flag/tkm.png') . '" alt="TKM" class="border"> ' . $r->name_tm . '</div>'
                    . '<div class="mb-1"><img src="' . asset('img/flag/rus.png') . '" alt="RUS" class="border"> ' . $r->name_ru . '</div>'
                    . '<div><img src="' . asset('img/flag/eng.png') . '" alt="ENG" class="border"> ' . $r->name_en . '</div>';
                $nestedData['job'] = '<div class="mb-1"><img src="' . asset('img/flag/tkm.png') . '" alt="TKM" class="border"> ' . $r->job_tm . '</div>'
                    . '<div class="mb-1"><img src="' . asset('img/flag/rus.png') . '" alt="RUS" class="border"> ' . $r->job_ru . '</div>'
                    . '<div><img src="' . asset('img/flag/eng.png') . '" alt="ENG" class="border"> ' . $r->job_en . '</div>';
                $nestedData['active'] = ($r->active ? '<span class="badge badge-info">' . trans('transAdmin.enable') . '</span>'
                    : '<span class="badge badge-dark">' . trans('transAdmin.disable') . '</span>');
                $nestedData['action'] = '<a href= "' . route('admin.authors.show', $r->id) . '" class="btn btn-outline-info btn-sm mb-1"><i class="fas fa-th-large"></i></a>'
                    . ' <a href = "' . route('admin.authors.edit', $r->id) . '" class="btn btn-outline-success btn-sm mb-1"><i class="fas fa-pen"></i></a>';
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
