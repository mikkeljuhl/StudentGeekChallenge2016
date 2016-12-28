<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Product;
use App\Basket;

class BasketController extends Controller
{

    /*
     * Add Item: sku, qty, price
     * Total
     * Cart Items
     * Remove item: sku (minus 1 qty, if exists)
     */
    protected $basket;

    public function __construct(Basket $basket)
    {
        $this->middleware('auth');
        $this->basket = $basket;
    }


    public function index(){

        $this->add(Product::where('id',2)->first());


        $basket_items = $this->getCartItems();

        $subtotal = $this->getSubTotal();
        $tax = $this->getTax();

        return view("basket", ["basket_items" => $basket_items, "subtotal" => $subtotal, "tax" => $tax]);
    }

    public function add(Product $product){

            $basket_items = Basket::where('user_id',Auth::user()->id)->where('product_sku',$product->sku)->first();
            if($basket_items != null) {
                $basket_items->qty = $basket_items->qty + 1;
                $basket_items->save();
            }else{
                $basket_item = new Basket();
                $basket_item->title = $product->title;
                $basket_item->user_id = Auth::user()->id;
                $basket_item->product_sku = $product->sku;
                $basket_item->price = $product->price;
                $basket_item->qty = 1;
                $basket_item->save();
            }
    }

    public function remove(Product $product){

            $basket_items = Basket::where('user_id',Auth::user()->id)->where('product_sku',$product->sku)->get();
            if($basket_items == null) {
                return Redirect::back()->with('message','You did not have this product in your cart!');
            }else if(sizeof($basket_items) > 1) {
                $basket_items->qty = $basket_items->qty - 1;
                $basket_items->save();
            }else if(sizeof($basket_items) == 1) {
                Basket::where('user_id', Auth::user()->id)->where('product_sku', $product->sku)->first()->delete();
            }
                return Redirect::back()->with('message','Operation Successful!');

    }

    public function getCartItems(){
            $basket = Basket::where('user_id',Auth::user()->id)->get();
            return $basket;
    }

    public function getSubTotal(){
        $basket_items = Basket::where('user_id',Auth::user()->id)->get();
        $subtotal = 0;
        foreach($basket_items as $item){
            $subtotal += $item->price * $item->qty;
        }
        return $subtotal;
    }

    public function getTax(){
        $basket_items = Basket::where('user_id',Auth::user()->id)->get();
        $total = 0;
        foreach($basket_items as $item){
            $total += $item->price * $item->qty;
        }
        return $total * Basket::getTaxFraction();
    }

}
