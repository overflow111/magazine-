<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Sale;
use App\Repos\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customer_web');
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

        $sales = Sale::where('customer_id', auth('customer_web')->id())
            ->orderBy('id', 'desc')
            ->with(['plan'])
            ->simplePaginate($size, [
                'id', 'plan_id', 'plan_month', 'plan_download', 'date_start', 'date_end', 'downloaded', 'price', 'status'
            ], 'page', $page);

        return view('front.sale.index')
            ->with([
                'sales' => $sales,
            ]);
    }


    public function create()
    {
        $plans = Plan::whereActive(1)
            ->orderBy('month')
            ->orderBy('download')
            ->get();

        return view('front.sale.create')
            ->with([
                'plans' => $plans,
            ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'plan' => 'required|integer|min:1',
        ]);

        $plan = Plan::whereActive(1)
            ->findOrFail($request->plan);
        
        $price = (int) "{$plan->price}00";
        $orderNumber = "01122017".$this->generateUniqId();

        $sale = new Sale();
        $sale->customer_id = auth('customer_web')->id();
        $sale->plan_id = $plan->id;
        $sale->customer_name = auth('customer_web')->user()->name;
        $sale->customer_surname = auth('customer_web')->user()->surname;
        $sale->customer_email = auth('customer_web')->user()->email;
        $sale->customer_username = auth('customer_web')->user()->username;
        $sale->plan_month = $plan->month;
        $sale->plan_download = $plan->download;
        $sale->date_start = Carbon::today()->toDateString();
        $sale->date_end = Carbon::today()->addMonths($plan->month)->toDateString();
        $sale->price = $plan->price;
        $sale->status = 0; # online payment
        $sale->save();

        $response = Http::get('hidden_url');

        if ($response['errorCode'] == 0) {
            return redirect($response['formUrl']);
        }

        return back()->with('error', 'Ýerine ýetirilmedi, täzeden synanşyp görüň.');  
    }

    public function check($id) 
    {
        $request = request();

        $response = Http::asForm()->post('https://mpi.gov.tm/payment/rest/getOrderStatus.do', [
            "language" => "ru",
            "orderId" => $request->orderId,
            "password" => $request->password,
            "userName" => $request->login
        ]);

        $saleModel = Sale::find($id);

        if (! $saleModel) {
            abort(404);
        }

        if ($response['ErrorCode'] == 0) {
            $saleModel->status = 1; # online payment
            $saleModel->save();

            $success = trans('transFront.sale-completed');
            return redirect()->route('sales')
                ->with([
                    'success' => $success
                ]);
        } 

        $saleModel->delete();
        return redirect()->route('sales')
            ->with([
                'success' => 'not-success'
            ]);
    }

    public function generateUniqId() 
    {
        $count = (int) File::get(app_path().'/paymentid') + 1;
        File::put(app_path().'/paymentid', $count);

        return str_pad(0 + $count, 5, 0, STR_PAD_LEFT);
    }
}
