<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // ? size=15 & page=2
        $request->validate([
            'size' => 'nullable|integer|min:1',
            'page' => 'nullable|integer|min:1',
        ]);
        $size = $request->size ?: 20;
        $page = $request->page ?: 1;

        $posts = Post::whereActive(1)
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
                'category:id,name_tm,name_ru,name_en,slug',
                'author:id,name_tm,name_ru,name_en,slug,job_tm,job_ru,job_en'
            ])
            ->simplePaginate($size, [
                'id', 'category_id', 'author_id', 'title_tm', 'title_ru', 'title_en', 'slug', 'image', 'published_at'
            ], 'page', $page);

        return view('front.post.index')
            ->with([
                'posts' => $posts,
            ]);
    }


    public function category(Request $request, $slug)
    {
        // ? size=15 & page=2
        $request->validate([
            'size' => 'nullable|integer|min:1',
            'page' => 'nullable|integer|min:1',
        ]);
        $size = $request->size ?: 20;
        $page = $request->page ?: 1;

        $category = Category::whereSlug($slug)
            ->whereActive(1)
            ->firstOrFail();

        $posts = Post::where('category_id', $category->id)
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
                'category:id,name_tm,name_ru,name_en,slug',
                'author:id,name_tm,name_ru,name_en,slug,job_tm,job_ru,job_en'
            ])
            ->simplePaginate($size, [
                'id', 'category_id', 'author_id', 'title_tm', 'title_ru', 'title_en', 'slug', 'image', 'published_at'
            ], 'page', $page);

        return view('front.post.category')
            ->with([
                'category' => $category,
                'posts' => $posts,
            ]);
    }


    public function author(Request $request, $slug)
    {
        // ? size=15 & page=2
        $request->validate([
            'size' => 'nullable|integer|min:1',
            'page' => 'nullable|integer|min:1',
        ]);
        $size = $request->size ?: 20;
        $page = $request->page ?: 1;

        $author = Author::whereSlug($slug)
            ->whereActive(1)
            ->firstOrFail();

        $posts = Post::where('author_id', $author->id)
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
                'category:id,name_tm,name_ru,name_en,slug',
                'author:id,name_tm,name_ru,name_en,slug,job_tm,job_ru,job_en'
            ])
            ->simplePaginate($size, [
                'id', 'category_id', 'author_id', 'title_tm', 'title_ru', 'title_en', 'slug', 'image', 'published_at'
            ], 'page', $page);

        return view('front.post.author')
            ->with([
                'author' => $author,
                'posts' => $posts,
            ]);
    }


    public function show($slug)
    {
        $post = Post::whereSlug($slug)
            ->whereActive(1)
            ->where('published_at', '<=', Carbon::now()->toDateTimeString())
            ->whereHas('category', function ($query) {
                $query->whereActive(1);
            })
            ->whereHas('author', function ($query) {
                $query->whereActive(1);
            })
            ->with([
                'category:id,name_tm,name_ru,name_en,slug',
                'author:id,name_tm,name_ru,name_en,slug,job_tm,job_ru,job_en',
                'images'
            ])
            ->firstOrFail();

        if (Cookie::get('syyahat_vpost')) {
            $cookies = explode(",", Cookie::get('syyahat_vpost'));
            if (!in_array($post->id, $cookies)) {
                $post->increment('viewed');
                $view = View::firstOrCreate([
                    'post_id' => $post->id,
                    'date' => Carbon::today()->toDateString()
                ]);
                $view->increment('viewed');
                Cookie::queue('syyahat_vpost', implode(",", array_merge($cookies, [$post->id])), 60 * 24);
            }
        } else {
            $post->increment('viewed');
            $view = View::firstOrCreate([
                'post_id' => $post->id,
                'date' => Carbon::today()->toDateString()
            ]);
            $view->increment('viewed');
            Cookie::queue('syyahat_vpost', $post->id, 60 * 24);
        }

        $categoryPosts = Post::where('id', '<>', $post->id)
            ->where('category_id', $post->category_id)
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
            ->take(3)
            ->with([
                'category:id,name_tm,name_ru,name_en,slug',
                'author:id,name_tm,name_ru,name_en,slug,job_tm,job_ru,job_en'
            ])
            ->get(['id', 'category_id', 'author_id', 'title_tm', 'title_ru', 'title_en', 'slug', 'image', 'published_at']);

        $authorPosts = Post::where('id', '<>', $post->id)
            ->where('author_id', $post->author_id)
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
            ->take(3)
            ->with([
                'category:id,name_tm,name_ru,name_en,slug',
                'author:id,name_tm,name_ru,name_en,slug,job_tm,job_ru,job_en'
            ])
            ->get(['id', 'category_id', 'author_id', 'title_tm', 'title_ru', 'title_en', 'slug', 'image', 'published_at']);

        return view('front.post.show')
            ->with([
                'post' => $post,
                'categoryPosts' => $categoryPosts,
                'authorPosts' => $authorPosts,
            ]);
    }
}
