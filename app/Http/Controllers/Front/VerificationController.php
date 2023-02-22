<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Verification;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function create()
    {
        return view('front.auth.verification');
    }
    
    public static function sendSms($phone, $message)
    {

        $ch = curl_init();

        //curl_setopt($ch, CURLOPT_URL, "http://192.168.1.100:3000");
        curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:3000/sendSMS?phoneNumber=".$phone."&text=".$message);
        curl_setopt($ch, CURLOPT_POST, 1);
        

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        $result = json_decode($server_output);

        curl_close($ch);

        if ($result == null) dd('sms servere connect yok');

        return $result;

    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|integer|between:60000000,65999999',
        ]);
        $code = rand(1000,9999);
        $this->sendSms($request->phone,$code);
        Verification::updateOrCreate(
            ['username' => $request->phone],
            ['code' => $code]
        );

        $customer = Customer::where('username', $request->phone)
            ->first();

        return view('front.auth.login')
            ->with([
                'customer' => $customer ? 1 : 0,
                'phone' => $request->phone,
            ]);
    }
}
