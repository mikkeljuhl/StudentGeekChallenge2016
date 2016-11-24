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

    public function store(Request $request){

        if(Auth::check()){

            $product = new Product();

            $request->title = $product->title;
            $request->description = $product->description;
            $request->sku = $product->sku;

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
