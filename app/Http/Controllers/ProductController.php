<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
use App\Product;
use \LoggingAction;
use Logger;
use Cart;



class ProductController extends Controller
{


    public function __construct()
    {
        //we have to be logged in
        //$this->middleware('auth');
    }

    public function create(){
        if(!Auth::check() || Auth::user()->role != "a"){
            return view ('auth.restricted');
        }

        return view('products.admin.create');
    }

    public function store(Request $request){

        if(!Auth::check() || Auth::user()->role != "a"){
            return view ('auth.restricted');
        }

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

            Log::info('Product created: '.$product->title);

            $product->save();
            return $product;
    }

    public function index(){

        if(Auth::check() && Auth::user()->role == "a") {
            $products = Product::orderBy('created_at', 'asc')->get();
            return view('products.admin.index', ['products' => $products]);
        }else{
            $categories = Category::orderby('updated_at','asc')->get();
            return view('products.index', ['categories' => $categories]);
        }
    }

    public function update(Product $product, Request $request){

        if(!Auth::check() || Auth::user()->role != "a"){
            return view ('auth.restricted');
        }

        $this->validate($request,
            [
                'sku' => 'required|max:225',
                'title' => 'required|max:225',
                'slug' => 'required|max:225',
                'price' => 'required|integer',
            ]);

        $product->sku = $request->sku;
        $product->title = $request->title;
        $product->slug = $request->slug;

        $product->price = $request->price;

        $product->short_description = $request->short_description;
        $product->description = $request->description;

        $product->save();

        Log::info('Product updated: '.$product->title);

        return $product;
    }

    public function edit(Product $product){
        if(!Auth::check() || Auth::user()->role != "a"){
            return view ('auth.restricted');
        }

        return view('products.admin.edit', ['product' => $product]);
    }


    public function show($slug){
        $product = Product::where('slug',$slug)->first();
        return view('products.show', ['product' => $product]);
    }
}
