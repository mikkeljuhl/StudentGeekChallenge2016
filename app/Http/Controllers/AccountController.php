<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('auth.overview', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $this->validate($request,
            [
                'shipping_address' => 'required|max:225',
                'shipping_postcode' => 'required|max:225',
                'shipping_city' => 'required|max:225',
                'shipping_country' => 'required|max:225',
                'billing_address' => 'required|max:225',
                'billing_postcode' => 'required|max:225',
                'billing_city' => 'required|max:225',
                'billing_country' => 'required|max:225',
                'name' => 'required|max:225',
                'phone' => 'required|max:225',
            ]);

        $user->shipping_address = $request->shipping_address;
        $user->shipping_city = $request->shipping_city;
        $user->shipping_postcode = $request->shipping_postcode;
        $user->shipping_country = $request->shipping_country;

        $user->billing_address = $request->billing_address;
        $user->billing_postcode = $request->billing_postcode;
        $user->billing_city = $request->billing_city;
        $user->billing_country = $request->billing_country;

        $user->phone = $request->phone;
        $user->name = $request->name;

        $user->save();

        return redirect("/auth/overview");

    }
}
