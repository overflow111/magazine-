<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    public function index()
    {
        $main = Post::whereMain(1)
            ->whereActive(1)
            ->where('published_at', '<=', Carbon::now()->toDateTimeString())
            ->whereHas('category', function ($query) {
                $query->whereActive(1);
            })
            ->whereHas('author', function ($query) {
                $query->whereActive(1);
            })
            ->orderBy('published_at', 'desc')
            ->orderBy('id', 'desc')
            ->with([
                'category:id,name_tm,name_ru,name_en,slug'
            ])
            ->firstOrFail(['id', 'category_id', 'title_tm', 'title_ru', 'title_en', 'slug', 'image']);

        $recommended = Post::where('id', '<>', $main->id)
            ->whereRecommended(1)
            ->whereActive(1)
            ->where('published_at', '<=', Carbon::now()->toDateTimeString())
            ->whereHas('category', function ($query) {
                $query->whereActive(1);
            })
            ->whereHas('author', function ($query) {
                $query->whereActive(1);
            })
            ->orderBy('published_at', 'desc')
            ->orderBy('id', 'desc')
            ->take(4)
            ->with([
                'category:id,name_tm,name_ru,name_en,slug'
            ])
            ->get(['id', 'category_id', 'title_tm', 'title_ru', 'title_en', 'slug', 'image']);

        $recommendedId = array_merge([$main->id], $recommended->pluck('id')->toArray());

        $mainCategories = Category::whereMain(1)
            ->whereActive(1)
            ->orderBy('sort_order')
            ->get();

        $mainPosts = Post::whereNotIn('id', $recommendedId)
            ->whereIn('category_id', $mainCategories->pluck('id'))
            ->whereActive(1)
            ->where('published_at', '<=', Carbon::now()->toDateTimeString())
            ->whereHas('category', function ($query) {
                $query->whereActive(1);
            })
            ->whereHas('author', function ($query) {
                $query->whereActive(1);
            })
            ->orderBy('published_at', 'desc')
            ->orderBy('id', 'desc')
            ->take(4)
            ->with([
                'category:id,name_tm,name_ru,name_en,slug'
            ])
            ->get(['id', 'category_id', 'title_tm', 'title_ru', 'title_en', 'slug', 'image']);;

        $adviceCategories = Category::whereAdvice(1)
            ->whereActive(1)
            ->orderBy('sort_order')
            ->get();

        $advicePosts = Post::whereNotIn('id', $recommendedId)
            ->whereIn('category_id', $adviceCategories->pluck('id'))
            ->whereActive(1)
            ->where('published_at', '<=', Carbon::now()->toDateTimeString())
            ->whereHas('category', function ($query) {
                $query->whereActive(1);
            })
            ->whereHas('author', function ($query) {
                $query->whereActive(1);
            })
            ->orderBy('published_at', 'desc')
            ->orderBy('id', 'desc')
            ->take(6)
            ->with([
                'category:id,name_tm,name_ru,name_en,slug',
                'author:id,name_tm,name_ru,name_en,slug,job_tm,job_ru,job_en'
            ])
            ->get(['id', 'category_id', 'author_id', 'title_tm', 'title_ru', 'title_en', 'slug', 'image', 'published_at']);

        return view('front.home.index')
            ->with([
                'main' => $main,
                'recommended' => $recommended,
                'mainCategories' => $mainCategories,
                'mainPosts' => $mainPosts,
                'adviceCategories' => $adviceCategories,
                'advicePosts' => $advicePosts,
            ]);
    }


    public function search() {
        return view('front.home.search');
    }


    public function api(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'q' => 'required|string|max:40',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
            ], Response::HTTP_NOT_FOUND);
        }
        $search = $request->q;

        $posts = Post::where(
            function ($query) use ($search) {
                $query->orWhere('title_tm', 'ilike', "%{$search}%");
                $query->orWhere('title_ru', 'ilike', "%{$search}%");
                $query->orWhere('title_en', 'ilike', "%{$search}%");
                $query->orWhere('slug', 'ilike', "%{$search}%");
                $query->orWhereHas('category', function ($query) use ($search) {
                    $query->where('name_tm', 'ilike', "%{$search}%");
                    $query->orWhere('name_ru', 'ilike', "%{$search}%");
                    $query->orWhere('name_en', 'ilike', "%{$search}%");
                    $query->orWhere('slug', 'ilike', "%{$search}%");
                });
                $query->orWhereHas('author', function ($query) use ($search) {
                    $query->where('name_tm', 'ilike', "%{$search}%");
                    $query->orWhere('name_ru', 'ilike', "%{$search}%");
                    $query->orWhere('name_en', 'ilike', "%{$search}%");
                    $query->orWhere('slug', 'ilike', "%{$search}%");
                });
            })
            ->whereActive(1)
            ->where('published_at', '<=', Carbon::now()->toDateTimeString())
            ->whereHas('category', function ($query) {
                $query->whereActive(1);
            })
            ->whereHas('author', function ($query) {
                $query->whereActive(1);
            })
            ->orderBy('viewed', 'desc')
            ->orderBy('id', 'desc')
            ->take(10)
            ->get(['id', 'title_tm', 'title_ru', 'title_en', 'slug'])
            ->transform(function ($obj) {
                return [
                    'slug' => route('post', $obj->slug),
                    'title' => $obj->getTitle()
                ];
            })
            ->toArray();

        return response()->json([
            'status' => 1,
            'posts' => $posts,
        ], Response::HTTP_OK);
    }


    public function language($key)
    {
        switch ($key) {
            case 'tm':
                session()->put('locale', 'tm');
                return redirect()->back();
                break;
            case 'ru':
                session()->put('locale', 'ru');
                return redirect()->back();
                break;
            case 'en':
                session()->put('locale', 'en');
                return redirect()->back();
                break;
            default:
                session()->put('locale', 'tm');
                return redirect()->back();
        }
    }
}
