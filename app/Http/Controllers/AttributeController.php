<?php

namespace App\Http\Controllers;

use App\AttributeRelation;
use Auth;
use Redirect;
use App\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index(){
        $attributes = Attribute::orderBy('created_at','asc')->get();
        $relations = AttributeRelation::get();

        return view('attributes.index', ["attributes" => $attributes, "relations" => $relations]);
    }
    public function create(){

        $relations = AttributeRelation::get();

        return view('attributes.create', ['relations' => $relations]);
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
        return Redirect::back()->with('message', 'Attribute created');

    }
    public function edit(Attribute $attribute){

        $relations = AttributeRelation::get();

        return view('attributes.edit', ["attribute" => $attribute, "relations" => $relations]);
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

        return Redirect::back()->with('message', 'Attribute updated');
    }
}
