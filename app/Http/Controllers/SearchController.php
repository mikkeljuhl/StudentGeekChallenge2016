<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Search;
use App\Product;

class SearchController extends Controller
{
    public function search(Request $request){

        $results = Search::search("title", $request->search_query, array('fuzzy'=>true))->get();


        // if there is only one result, jump directly to page
        if(count($results) == 1){
            foreach ($results as $result) {
                return redirect('/products/'. $result['slug']);
            }
        }

        $products = array();

        foreach($results as $result){
            array_push( $products, Product::where("slug", $result['slug'])->first());
        }

        return view("products.listing", ["products" => $products]);

    }
}
