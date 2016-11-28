<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


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

        if(Auth::check() && Auth::user()->role == "admin"){

            $product = new Product();

            $product->sku = $request->sku;
            $product->title = $request->title;
            $product->slug = $request->slug;

            $product->price = $request->price;

            $product->short_description = $request->short_description;
            $product->description = $request->description;


            $product->save();

        }
    }

    public function show(Product $product){

    }

    public function showAllProducts(){
        //return view with all products
        return "null";
    }


}
