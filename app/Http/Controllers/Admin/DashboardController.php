<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Contact;
use App\Models\Customer;
use App\Models\Magazine;
use App\Models\Post;
use App\Models\Sale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $colors = ['primary', 'secondary', 'success', 'info', 'warning', 'danger'];
        $counts = collect(array(
            ['name' => trans('transAdmin.posts'), 'count' => Post::count(), 'color' => $colors[0], 'icon' => 'file-word'],
            ['name' => trans('transAdmin.magazines'), 'count' => Magazine::count(), 'color' => $colors[5], 'icon' => 'file-pdf'],
            ['name' => trans('transAdmin.authors'), 'count' => Author::count(), 'color' => $colors[2], 'icon' => 'pen-nib'],
            ['name' => trans('transAdmin.customers'), 'count' => Customer::count(), 'color' => $colors[1], 'icon' => 'user-friends'],
            ['name' => trans('transAdmin.sales'), 'count' => Sale::count(), 'color' => $colors[3], 'icon' => 'file-invoice'],
            ['name' => trans('transAdmin.contacts'), 'count' => Contact::count(), 'color' => $colors[4], 'icon' => 'envelope'],
        ));

        return view('admin.dashboard.index')
            ->with([
                'counts' => $counts,
            ]);
    }
}
