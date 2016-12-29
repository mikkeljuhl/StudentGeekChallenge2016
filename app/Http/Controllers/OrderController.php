<?php

namespace App\Http\Controllers;

use App\InvoiceLine;
use Illuminate\Http\Request;
use App\Basket;
use App\Order;
use Auth;

class OrderController extends Controller
{

    public function __construct(Basket $basket)
    {
        $this->middleware('auth');
    }

    public function create(){

        $basket_items = BasketController::getCartItems();
        $subtotal = BasketController::getSubTotal();
        $tax = BasketController::getTax();

        return view("orders.details", ['user' => Auth::user(), 'basket_items' => $basket_items, 'subtotal' => $subtotal, 'tax' => $tax]);
    }

    public function store(Request $request){
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

        $order = new Order();
        $order->save(); // so we can get an id

        foreach(BasketController::getCartItems() as $item){
            $invoice_line = new InvoiceLine();

            $invoice_line->price = $item->price;
            $invoice_line->qty = $item->qty;
            $invoice_line->product_sku = $item->product_sku;
            $invoice_line->title = $item->title;
            $invoice_line->order_id = $order->id;

        }

        $user = Auth::user();
        //assign address to this user

        $user->shipping_address = $request->shipping_address;
        $user->shipping_city = $request->shipping_city;
        $user->shipping_postcode = $request->shipping_postcode;
        $user->shipping_country = $request->shipping_country;

        $user->billing_address = $request->billing_address;
        $user->billing_postcode = $request->billing_postcode;
        $user->billing_city = $request->billing_city;
        $user->billing_country = $request->billing_country;

        $user->phone = $request->phone;

        $user->save();

        $order->shipping_address = $request->shipping_address;
        $order->shipping_postcode = $request->shipping_postcode;
        $order->shipping_city = $request->shipping_city;
        $order->shipping_country = $request->shipping_country;

        $order->billing_address = $request->billing_address;
        $order->billing_postcode = $request->billing_postcode;
        $order->billing_city = $request->billing_city;
        $order->billing_country = $request->billing_country;

        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->subtotal = BasketController::getSubTotal();

        $order->save();

        BasketController::clearBasket();

        return $order;

    }
}
