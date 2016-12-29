<?php

namespace App\Http\Controllers;


use App\Attribute;
use App\AttributeRelation;
use App\ProductAttribute;
use App\ProductCategory;
use Illuminate\Http\Request;
use Auth;
use Log;
use Redirect;
use App\Product;
use Input;
use App\Category;


class ProductController extends Controller
{

    public function create()
    {
        if (!Auth::check() || Auth::user()->role != "a") {
            return view('auth.restricted');
        }

        $attributes = Attribute::get();
        $attribute_relations = AttributeRelation::get();
        $categories = Category::get();

        return view('products.admin.create', ["categories" => $categories, "attributes" => $attributes, "attribute_relations" => $attribute_relations]);
    }

    public function store(Request $request)
    {

        if (!Auth::check() || Auth::user()->role != "a") {
            return view('auth.restricted');
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

        if($request->hasFile('image_url')){

            $file = $request->file('image_url');
            $name = $product->sku . '.' . $request->file('image_url')->getClientOriginalExtension();

            $file->move(base_path() . '/public/img/products/', $name);

            $product->image_url = '/img/products/'. $name;
            Log::info('Product image added: ' . $product->image_url);

        }

        $product->save();

        Log::info('Product created: ' . $product->title);

        foreach (AttributeRelation::get() as $attribute_relation) {
            $attribute_relations_request_id = "att_r_" . $attribute_relation->id;

            if ($request->$attribute_relations_request_id != null) {
                $product_attribute = new ProductAttribute();
                $product_attribute->product_id = $product->id;
                $product_attribute->attribute_id = $request->$attribute_relations_request_id;
                $product_attribute->save();

                Log::info('Product and attribute relation associated: ' . $product->title . ' ' . $attribute_relation->title);
            }
        }

        foreach($request->categories as $category_id){
            $product_category = new ProductCategory();
            $product_category->product_id = $product->id;
            $product_category->category_id = $category_id;
            $product_category->save();
            Log::info('Product ' . $product->title . ' is in category: ' . $category_id);
        }

        return Redirect::back()->with('message', 'Product with title '.$product->title.' created!');
    }

    public function index()
    {

        if (Auth::check() && Auth::user()->role == "a") {
            $products = Product::orderBy('created_at', 'asc')->get();
            return view('products.admin.index', ['products' => $products]);
        } else {
            $categories = Category::orderby('updated_at', 'asc')->get();
            return view('products.index', ['categories' => $categories]);
        }
    }

    public function update(Product $product, Request $request)
    {

        if (!Auth::check() || Auth::user()->role != "a") {
            return view('auth.restricted');
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

        if($request->hasFile('image_url')){

            $file = $request->file('image_url');
            $name = $product->sku . '.' . $request->file('image_url')->getClientOriginalExtension();

            $file->move(base_path() . '/public/img/products/', $name);

            $product->image_url = '/img/products/'. $name;
            Log::info('Product image added: ' . $product->image_url);

        }

        $product->save();

        Log::info('Product updated: ' . $product->title);

        //brute force: delete all product attributes with associated product id -- works ok for now
        ProductAttribute::where('product_id',$product->id)->delete();

        foreach (AttributeRelation::get() as $attribute_relation) {
            $attribute_relations_request_id = "att_r_" . $attribute_relation->id;

            if ($request->$attribute_relations_request_id != null) {

                $product_attribute = new ProductAttribute();
                $product_attribute->product_id = $product->id;
                $product_attribute->attribute_id = $request->$attribute_relations_request_id;
                $product_attribute->save();

                Log::info('[EDIT]: Product and attribute relation associated: ' . $product->title . ' ' . $attribute_relation->title);
            }
        }

        ProductCategory::where('product_id',$product->id)->delete();

        foreach($request->categories as $category_id){
            $product_category = new ProductCategory();
            $product_category->product_id = $product->id;
            $product_category->category_id = $category_id;
            $product_category->save();

            Log::info('Product ' . $product->title . ' is in category: ' . $category_id);
        }

        return Redirect::back()->with('message', 'Product with title '.$product->title.' updated!');
    }

    public function edit(Product $product)
    {
        if (!Auth::check() || Auth::user()->role != "a") {
            return view('auth.restricted');
        }

        $categories = Category::get();
        $attributes = Attribute::get();
        $attribute_relations = AttributeRelation::get();
        $product_attributes = ProductAttribute::where("product_id",$product->id)->get();
        $product_categories = ProductCategory::where("product_id",$product->id)->get();

        $product_categories_id = array();
        foreach($product_categories as $product_category){
            array_push($product_categories_id,$product_category->category_id);
        }

        $product_attribute_id = array();
        foreach($product_attributes as $product_attribute){
            array_push($product_attribute_id,$product_attribute->attribute_id);
        }



        return view('products.admin.edit',
            [
                "product" => $product,
                "categories" => $categories,
                "product_categories_id" => $product_categories_id,
                "attributes" => $attributes,
                "attribute_relations" => $attribute_relations,
                "product_attribute_id" => $product_attribute_id
            ]);
    }


    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('products.show', ['product' => $product]);
    }
}
