<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
use App\Product;
use \LoggingAction;
use Logger;



class ProductController extends Controller
{

    public function __construct()
    {
        //we have to be logged in
        //$this->middleware('auth');
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){

        if(Auth::check()){

            $this->validate($request,
                [
                    'sku' => 'required|max:225',
                    'title' => 'required|max:225',
                    'slug' => 'required|max:225',
                    'price' => 'required|integer',
                ]);

            $product = new Product();

            $product->sku = $request->sku;
            $product->title = $request->title;
            $product->slug = $request->slug;

            $product->price = $request->price;

            $product->short_description = $request->short_description;
            $product->description = $request->description;


            return logAction(LoggingAction::CR_PROD);


            //$product->save();
            return $product;
        }
    }

    public function show(Product $product){

    }

    public function showAllProducts(){
        //return view with all products
        return "null";
    }


}
