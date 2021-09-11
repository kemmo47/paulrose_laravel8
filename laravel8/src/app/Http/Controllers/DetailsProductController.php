<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\Category;
use App\Models\SubCategory;

class DetailsProductController extends Controller
{
    public function details_product($slug, $pro_slug){
        $product = Product::where('product_slug',$pro_slug)->with('category','gallery')->first();
        $product_id = $product->product_id;

        $gallery_color = Gallery::where('product_id',$product_id)->select('gallery_color','gallery_id')->distinct()->get();
        $gallery_title = Gallery::where('product_id',$product_id)->select('gallery_title','gallery_id')->distinct()->get();

        $title = $product->product_name;

        return view('pages.product.details_product')->with(compact('title','product','gallery_color','gallery_title'));
    }

    public function show_related_product(Request $request){
        $cate = Category::where('category_id', $request->cate_id)->with('subcategory')->first();
        foreach($cate->subcategory as $key => $sub){
            $count_sub = SubCategory::where('category_id',$request->cate_id)->count();
            if($sub->subcategory_id == $request->sub_id){
                if($key+1 < $count_sub){
                    $pro_related = Product::where('subcategory_id', $cate->subcategory[$key+1]->subcategory_id)
                    ->with('gallery')->limit(5)->get();
                }else{
                    $pro_related = Product::where('subcategory_id', $cate->subcategory[$key-1]->subcategory_id)
                    ->with('gallery')->limit(5)->get();
                }
            }
        }

        return view('pages.product.related_product')->with(compact('pro_related','cate'));
    }
}
