<?php

namespace App\Http\Controllers;

use App\ShippingMethod;
use Illuminate\Http\Request;
use Redirect;

class ShippingMethodController extends Controller
{
    public function index()
    {
        $methods = ShippingMethod::get();
        return view("shipping_methods.index", ["methods" => $methods]);
    }

    public function create()
    {
        return view("shipping_methods.create");
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'title' => 'required',
                'price' => 'required|integer',
                'min_order_price' => 'required|integer',
            ]);

        $method = new ShippingMethod();

        $method->title = $request->title;
        $method->price = $request->price;
        $method->min_order_price = $request->min_order_price;
        $method->save();

        return Redirect::back()->with('message', 'Shipping method created');

    }

    public function edit(ShippingMethod $method)
    {
        return view("shipping_methods.edit", ["method" => $method]);
    }

    public function update(Request $request, ShippingMethod $method)
    {
        $this->validate($request,
            [
                'title' => 'required',
                'price' => 'required|integer',
                'min_order_price' => 'required|integer',
            ]);

        $method->title = $request->title;
        $method->price = $request->price;
        $method->min_order_price = $request->min_order_price;
        $method->save();

        return Redirect::back()->with('message', 'Shipping method updated');

    }

}
