<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        $page = Page::findOrFail(1);

        return view('front.page.about')
            ->with([
                'page' => $page,
            ]);
    }
}
