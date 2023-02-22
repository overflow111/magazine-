<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Buy;
use App\Models\Magazine;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MagazineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customer_web')->except(['index']);
    }


    public function index(Request $request)
    {
        // ? size=15 & page=2
        $request->validate([
            'size' => 'nullable|integer|min:1',
            'page' => 'nullable|integer|min:1',
        ]);
        $size = $request->size ?: 20;
        $page = $request->page ?: 1;

        $magazines = Magazine::whereActive(1)
            ->where('published_at', '<=', Carbon::now()->toDateTimeString())
            ->orderBy('published_at', 'desc')
            ->orderBy('id', 'desc')
            ->simplePaginate($size, [
                'id', 'title_tm', 'title_ru', 'title_en', 'slug', 'image', 'body_tm', 'body_ru', 'body_en', 'published_at'
            ], 'page', $page);

        return view('front.magazine.index')
            ->with([
                'magazines' => $magazines,
            ]);
    }


    public function download($slug)
    {
        $magazine = Magazine::whereSlug($slug)
            ->whereActive(1)
            ->where('published_at', '<=', Carbon::now()->toDateTimeString())
            ->firstOrFail();
        $customer = auth('customer_web')->user();
        $buy = Buy::where('customer_id', $customer->id)
            ->where('magazine_id', $magazine->id)
            ->first();

        if ($buy) {
            return $magazine->getFile();
        } else {
            $sale = Sale::where('customer_id', $customer->id)
                ->where('date_start', '<=', Carbon::today()->toDateString())
                ->where('date_end', '>=', Carbon::today()->toDateString())
                ->whereRaw('plan_download > downloaded')
                ->where('status', 1)
                ->orderBy('id')
                ->first();

            if ($sale) {
                Buy::create([
                    'customer_id' => $customer->id,
                    'sale_id' => $sale->id,
                    'magazine_id' => $magazine->id,
                ]);
                return $magazine->getFile();
            } else {
                return redirect()->route('sale.create');
            }
        }
    }
}
