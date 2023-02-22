<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        return view('front.contact.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'phone_or_email' => 'required|string|max:150',
            'message' => 'required|string|max:500',
        ]);
        $obj = new Contact();
        $obj->name = $request->name;
        $obj->contact = $request->phone_or_email;
        $obj->message = $request->message;
        $obj->save();

        $success = trans('transFront.contact-success');
        return redirect()->back()
            ->with([
                'success' => $success,
            ]);
    }
}
