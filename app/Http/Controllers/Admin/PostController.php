<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image as InterImage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('admin.post.index');
    }


    public function show($id)
    {
        $obj = Post::with(['category', 'author', 'images'])
            ->findOrFail($id);
        $daysByViewed = View::where('date', '>', Carbon::today()->firstOfMonth()->subYear()->toDateString())
            ->selectRaw("SUM(viewed) as count, date_trunc('day', date) as day")
            ->groupBy('day')
            ->orderBy('day', 'asc')
            ->get();

        return view('admin.post.show')
            ->with([
                'obj' => $obj,
                'daysByViewed' => $daysByViewed,
            ]);
    }


    public function create()
    {
        $categories = Category::orderBy('sort_order')
            ->get();
        $authors = Author::orderBy('name_tm')
            ->get();

        return view('admin.post.create')
            ->with([
                'categories' => $categories,
                'authors' => $authors,
            ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|integer|min:1',
            'author' => 'required|integer|min:1',
            'title_tm' => 'required|string|max:150',
            'title_ru' => 'nullable|string|max:150',
            'title_en' => 'nullable|string|max:150',
            'body_tm' => 'required|string|max:25500',
            'body_ru' => 'nullable|string|max:25500',
            'body_en' => 'nullable|string|max:25500',
            'published_at' => 'required|date',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048|dimensions:width=900,height=600|distinct',
        ]);

        $obj = new Post();
        $obj->category_id = $request->category;
        $obj->author_id = $request->author;
        $obj->title_tm = $request->title_tm;
        $obj->title_ru = $request->title_ru ?: null;
        $obj->title_en = $request->title_en ?: null;
        $obj->slug = Str::slug($request->title_tm) . '-' . Str::random(5);
        $obj->body_tm = $request->body_tm;
        $obj->body_ru = $request->body_ru ?: null;
        $obj->body_en = $request->body_en ?: null;
        $obj->main = $request->has('main') ? true : false;
        $obj->recommended = $request->has('recommended') ? true : false;
        $obj->active = $request->has('active') ? true : false;
        $obj->published_at = Carbon::parse($request->published_at)->toDateTimeString();
        $obj->save();

        if ($request->hasfile('images')) {
            foreach (array_reverse($request->file('images')) as $newImage) {
                $newImageName = Str::slug($request->title_tm) . '-' . Str::random(5) . '.' . 'jpg';
                // resize image
                $image = InterImage::make($newImage);
                $image = (string)$image->encode('jpg', 80);
                $imagePath = 'public/p/' . $newImageName;
                Storage::put($imagePath, $image);
                // resize image
                $smallImage = InterImage::make($newImage)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $smallImage = (string)$smallImage->encode('jpg', 80);
                $smallImagePath = 'public/sm/p/' . $newImageName;
                Storage::put($smallImagePath, $smallImage);
                // model
                $postImage = new Image();
                $postImage->post_id = $obj->id;
                $postImage->image = 'p/' . $newImageName;
                $postImage->save();
            }
            $obj->image = 'p/' . $newImageName;
            $obj->update();
        }

        $success = $obj->getTitle() . ' ' . trans('transAdmin.created');
        return redirect()->route('admin.posts.show', $obj->id)
            ->with([
                'success' => $success
            ]);
    }


    public function edit($id)
    {
        $obj = Post::findOrFail($id);
        $categories = Category::orderBy('sort_order')
            ->get();
        $authors = Author::orderBy('name_tm')
            ->get();

        return view('admin.post.edit')
            ->with([
                'obj' => $obj,
                'categories' => $categories,
                'authors' => $authors,
            ]);
    }


    public function update(Request $request, $id)
    {
        $obj = Post::findOrFail($id);
        $request->validate([
            'category' => 'required|integer|min:1',
            'author' => 'required|integer|min:1',
            'title_tm' => 'required|string|max:150',
            'title_ru' => 'nullable|string|max:150',
            'title_en' => 'nullable|string|max:150',
            'body_tm' => 'required|string|max:25500',
            'body_ru' => 'nullable|string|max:25500',
            'body_en' => 'nullable|string|max:25500',
            'published_at' => 'required|date',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048|dimensions:width=900,height=600|distinct',
        ]);

        $obj->category_id = $request->category;
        $obj->author_id = $request->author;
        $obj->title_tm = $request->title_tm;
        $obj->title_ru = $request->title_ru ?: null;
        $obj->title_en = $request->title_en ?: null;
        $obj->slug = Str::slug($request->title_tm) . '-' . Str::random(5);
        $obj->body_tm = $request->body_tm;
        $obj->body_ru = $request->body_ru ?: null;
        $obj->body_en = $request->body_en ?: null;
        $obj->main = $request->has('main') ? true : false;
        $obj->recommended = $request->has('recommended') ? true : false;
        $obj->active = $request->has('active') ? true : false;
        $obj->published_at = Carbon::parse($request->published_at)->toDateTimeString();
        $obj->update();

        if ($request->hasfile('images')) {
            foreach (array_reverse($request->file('images')) as $newImage) {
                $newImageName = Str::slug($request->title_tm) . '-' . Str::random(5) . '.' . 'jpg';
                // resize image
                $image = InterImage::make($newImage);
                $image = (string)$image->encode('jpg', 80);
                $imagePath = 'public/p/' . $newImageName;
                Storage::put($imagePath, $image);
                // resize image
                $smallImage = InterImage::make($newImage)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $smallImage = (string)$smallImage->encode('jpg', 80);
                $smallImagePath = 'public/sm/p/' . $newImageName;
                Storage::put($smallImagePath, $smallImage);
                // model
                $postImage = new Image();
                $postImage->post_id = $obj->id;
                $postImage->image = 'p/' . $newImageName;
                $postImage->save();
            }
            $obj->image = 'p/' . $newImageName;
            $obj->update();
        }

        $success = $obj->getTitle() . ' ' . trans('transAdmin.updated');
        return redirect()->route('admin.posts.show', $obj->id)
            ->with([
                'success' => $success
            ]);
    }


    public function delete($id)
    {
        $obj = Post::findOrFail($id);
        foreach ($obj->images as $image) {
            Storage::delete('public/' . $image->image);
            Storage::delete('public/sm/' . $image->image);
        }
        $obj->images()->delete();
        $objName = $obj->getTitle();
        $obj->delete();

        $success = $objName . ' ' . trans('transAdmin.deleted');
        return redirect()->route('admin.posts.index')
            ->with([
                'success' => $success
            ]);
    }


    public function image($id)
    {
        $obj = Image::with(['post'])
            ->findOrFail($id);
        Storage::delete('public/' . $obj->image);
        Storage::delete('public/sm/' . $obj->image);
        $post = $obj->post;
        $obj->delete();

        if ($post->images->count() > 0) {
            $post->image = $post->images->first()->image;
        } else {
            $post->image = null;
        }
        $post->update();

        $success = trans('transAdmin.image') . ' ' . trans('transAdmin.deleted');
        return redirect()->back()
            ->with([
                'success' => $success
            ]);
    }


    public function api(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'image',
            2 => 'title',
            3 => 'author',
            4 => 'category',
            5 => 'published_at',
            6 => 'viewed',
            7 => 'active',
        );

        $totalData = Post::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (!$request->input('search.value')) {
            $rs = Post::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = Post::count();
        } else {
            $search = $request->input('search.value');
            $rs = Post::orWhere('id', 'ilike', "%{$search}%")
                ->orWhereHas('category', function ($query) use ($search) {
                    $query->where('name_tm', 'ilike', "%{$search}%");
                    $query->orWhere('name_ru', 'ilike', "%{$search}%");
                    $query->orWhere('name_en', 'ilike', "%{$search}%");
                })
                ->orWhereHas('author', function ($query) use ($search) {
                    $query->where('name_tm', 'ilike', "%{$search}%");
                    $query->orWhere('name_ru', 'ilike', "%{$search}%");
                    $query->orWhere('name_en', 'ilike', "%{$search}%");
                })
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
            $totalFiltered = Post::orWhere('id', 'ilike', "%{$search}%")
                ->orWhereHas('category', function ($query) use ($search) {
                    $query->where('name_tm', 'ilike', "%{$search}%");
                    $query->orWhere('name_ru', 'ilike', "%{$search}%");
                    $query->orWhere('name_en', 'ilike', "%{$search}%");
                })
                ->orWhereHas('author', function ($query) use ($search) {
                    $query->where('name_tm', 'ilike', "%{$search}%");
                    $query->orWhere('name_ru', 'ilike', "%{$search}%");
                    $query->orWhere('name_en', 'ilike', "%{$search}%");
                })
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
                $nestedData['image'] = '<a href = "' . route('admin.posts.show', $r->id) . '">'
                    . ($r->image ? '<img src="' . Storage::disk('local')->url('sm/' . $r->image) . '" alt="' . $r->image . '" class="img-fluid img-max">'
                        : '<img src="' . asset('img/temp/post-sm.png') . '" alt="' . trans('transAdmin.not-found') . '" class="img-fluid img-max">')
                    . '</a>';
                $nestedData['title'] = '<div class="mb-1"><img src="' . asset('img/flag/tkm.png') . '" alt="TKM" class="border"> ' . $r->title_tm . '</div>'
                    . '<div class="mb-1"><img src="' . asset('img/flag/rus.png') . '" alt="RUS" class="border"> ' . $r->title_ru . '</div>'
                    . '<div><img src="' . asset('img/flag/eng.png') . '" alt="ENG" class="border"> ' . $r->title_en . '</div>';
                $nestedData['author'] = $r->author->getName();
                $nestedData['category'] = $r->category->getName();
                $nestedData['published_at'] = $r->published_at->format('Y-m-d H:i');
                $nestedData['viewed'] = $r->viewed . '<div class="small text-secondary">' . trans('transAdmin.viewed') . '</div>';
                $nestedData['active'] = ($r->active ? '<span class="badge badge-info">' . trans('transAdmin.enable') . '</span>'
                    : '<span class="badge badge-dark">' . trans('transAdmin.disable') . '</span>');
                $nestedData['action'] = '<a href= "' . route('admin.posts.show', $r->id) . '" class="btn btn-outline-info btn-sm mb-1"><i class="fas fa-th-large"></i></a>'
                    . ' <a href = "' . route('admin.posts.edit', $r->id) . '" class="btn btn-outline-success btn-sm mb-1"><i class="fas fa-pen"></i></a>';
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
