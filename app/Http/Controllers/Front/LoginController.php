<?php

namespace App\Http\Controllers\Front;

use App\Models\Customer;
use App\Models\Verification;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|integer|between:60000000,65999999',
            'code' => 'required|integer|between:10000,99999',
        ]);

        $verification = Verification::where('username', $request->phone)
            ->where('code', $request->code)
            ->where('updated_at', '>', Carbon::now()->subMinutes(3)->toDateTimeString())
            ->orderBy('id', 'desc')
            ->first();
        if (!$verification) {
            return redirect()->route('verification')
                ->with([
                    'error' => trans('transFront.verification-not-found'),
                ]);
        }

        $customer = Customer::where('username', $request->phone)
            ->first();

        if ($customer) {
            $customer->password = bcrypt($request->code);
            $customer->update();
        } else {
            $request->validate([
                'name' => 'required|string|max:150',
                'surname' => 'required|string|max:150',
                'email' => 'required|email',
            ]);
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->surname = $request->surname;
            $customer->email = $request->email;
            $customer->username = $request->phone;
            $customer->password = bcrypt($request->code);
            $customer->save();
        }

        Auth::guard('customer_web')->login($customer);

        return redirect()->route('sales');
    }


    public function destroy(Request $request)
    {
        Auth::guard('customer_web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('sales');
    }
}
