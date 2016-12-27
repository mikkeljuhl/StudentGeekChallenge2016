<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Category;

class CategoryController extends Controller
{
    public function create(){
        return view('categories.admin.create');
    }

    public function index(){
        $categories = Category::orderBy('created_at', 'asc')->get();
        if(Auth::check() && Auth::user()->role == "a") {
            return view('categories.admin.index', ['categories' => $categories]);
        }else {
            return view('categories.index', ['categories' => $categories]);
        }
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
    }
}
