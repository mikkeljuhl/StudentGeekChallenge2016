<?php

namespace App\Http\Controllers;

use App\InvoiceLine;
use App\ShippingMethod;
use Illuminate\Http\Request;
use App\Basket;
use App\Order;
use Auth;
use Redirect;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::where("user_id", Auth::user()->id)->get();
        return view("orders.overview.index", ["orders" => $orders]);
    }

    public function show(Order $order)
    {
        $invoice_lines = InvoiceLine::where("order_id", $order->id)->get();
        $date = new \DateTime($order->created_at);
        $date = $date->format("d/m-Y H:i");

        return view("orders.overview.show", ["order" => $order, "date" => $date, "invoice_lines" => $invoice_lines]);
    }

    public function create()
    {

        $basket_items = BasketController::getCartItems();
        $subtotal = BasketController::getSubTotal();
        $tax = BasketController::getTax();
        $total = $tax + $subtotal;
        $shipping_methods = ShippingMethod::where('min_order_price', '<=', $total)->get();

        return view("orders.details", ['user' => Auth::user(), 'basket_items' => $basket_items, 'subtotal' => $subtotal, 'tax' => $tax, 'shipping_methods' => $shipping_methods]);
    }

    public function store(Request $request)
    {
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

        $method = ShippingMethod::where('id', $request->shipping_method)->first();

        $order->shipping_method_id = $request->shipping_method;
        $order->shipping_method_price = $method->price;
        $order->shipping_method_title = $method->title;

        foreach (BasketController::getCartItems() as $item) {
            $invoice_line = new InvoiceLine();

            $invoice_line->price = $item->price;
            $invoice_line->qty = $item->qty;
            $invoice_line->product_sku = $item->product_sku;
            $invoice_line->title = $item->title;
            $invoice_line->order_id = $order->id;

            $invoice_line->save();

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
        $order->user_id = Auth()->user()->id;
        $order->phone = $request->phone;
        $order->subtotal = BasketController::getSubTotal();
        $order->tax = BasketController::getTax();

        $order->save();

        BasketController::clearBasket();

        return redirect("/orders/overview/" . $order->id)->with("message", "Thank you for the order!");

    }


    public static function getVAT($price)
    {
        return $price * 0.25;
    }


}
