<?php

namespace App\Http\Controllers;

use Auth;
use App\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index(){
        $attributes = Attribute::orderBy('created_at','asc')->get();

        return view('attributes.index', ["attributes" => $attributes]);
    }
    public function create(){
        return view('attributes.create');
    }
    public function store(Request $request){
        if(!Auth::check() || Auth::user()->role != "a"){
            return view ('auth.restricted');
        }

        $this->validate($request,
            [
                'title' => 'required|max:225',
                'relation' => 'required|max:225',
            ]);

        $attribute = new Attribute();

        $attribute->title = $request->title;
        $attribute->relation = $request->relation;

        $attribute->save();
        return $attribute;
    }
    public function edit(Attribute $attribute){
        return view('attributes.edit', ["attribute" => $attribute]);
    }
    public function update(Attribute $attribute, Request $request){
        if(!Auth::check() || Auth::user()->role != "a"){
            return view ('auth.restricted');
        }

        $this->validate($request,
            [
                'title' => 'required|max:225',
                'relation' => 'required|max:225',
            ]);

        $attribute->title = $request->title;
        $attribute->relation = $request->relation;

        $attribute->save();
        return $attribute;
    }
}
