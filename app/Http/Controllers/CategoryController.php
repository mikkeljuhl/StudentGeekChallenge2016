<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Illuminate\Http\Request;
use Auth;
use Search;
use Redirect;
use App\Category;
use App\Product;

class CategoryController extends Controller
{
    public function create(){
        return view('categories.admin.create');
    }

    public function index(){
        $categories = Category::orderBy('created_at', 'asc')->get();

        return view('categories.index', ['categories' => $categories]);
    }

    public function store(Request $request){
        if(!Auth::check() || Auth::user()->role != "a"){
            return view ('auth.restricted');
        }

        $this->validate($request,
            [
                'title' => 'required|max:225',
                'slug' => 'required|max:225',
            ]);

        $category = new Category();
        $category->title =  $request->title;
        $category->slug =  $request->slug;

        $category->save();

        Search::insert("category_index", array(
            'title' => $category->title,
            'slug' => $category->slug,
        ));

        return Redirect::back()->with('message', 'Category created');

    }



    public function edit(Category $category){
        if(!Auth::check() || Auth::user()->role != "a"){
            return view ('auth.restricted');
        }

        return view ('categories.admin.edit',['category' => $category]);
    }

    public function update(Category $category, Request $request){
        if(!Auth::check() || Auth::user()->role != "a"){
            return view ('auth.restricted');
        }

        $this->validate($request,
            [
                'title' => 'required|max:225',
                'slug' => 'required|max:225',
            ]);

        $category->title =  $request->title;
        $category->slug =  $request->slug;

        $category->save();

        return Redirect::back()->with('message', 'Category updated');
    }

    public function show($slug){

        $category = Category::where('slug',$slug)->first();
        if($category == null){
            return "404";
        }
        $product_ids = ProductCategory::where('category_id',$category->id)->get();

        $products = array();
        foreach($product_ids as $product_id){
            $product = Product::where('id',$product_id->product_id)->first();
            array_push($products, $product);
        }

        return view('products.listing', ['products' => $products]);
    }
}
