<?php

namespace App\Http\Controllers;
use Auth;
use App\AttributeRelation;
use Illuminate\Http\Request;

class AttributeRelationController extends Controller
{
    public function index(){
        $attributes = AttributeRelation::orderBy('created_at','asc')->get();

        return view('attributes.relations.index', ["attributes" => $attributes]);
    }
    public function create(){
        return view('attributes.relations.create');
    }
    public function store(Request $request){
        if(!Auth::check() || Auth::user()->role != "a"){
            return view ('auth.restricted');
        }

        $this->validate($request,
            [
                'title' => 'required|max:225',
            ]);

        $attribute = new AttributeRelation();

        $attribute->title = $request->title;

        $attribute->save();
        return $attribute;
    }
    public function edit(AttributeRelation $attribute){
        return view('attributes.relations.edit', ["attribute" => $attribute]);
    }
    public function update(AttributeRelation $attribute, Request $request){
        if(!Auth::check() || Auth::user()->role != "a"){
            return view ('auth.restricted');
        }

        $this->validate($request,
            [
                'title' => 'required|max:225',
            ]);

        $attribute->title = $request->title;

        $attribute->save();
        return $attribute;
    }
}
