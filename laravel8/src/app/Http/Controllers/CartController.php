<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use App\Models\Product;
use App\Cart;
use Session;
use DB;

class CartController extends Controller
{
    public function add_my_cart(Request $request){
        $product = Product::where('product_id', $request->pro_id)->with('onegallery','category')->first();

        if($product != null){
            $oldcart = Session('Cart') ? Session('Cart') : null;
            $newcart = new Cart($oldcart);
            $newcart->AddCart($product, $request->pro_id, $request->pro_qty);

            $request->Session()->put('Cart', $newcart, 900000);
        }
    }

    public function load_my_cart(Request $request){
        $mycart = Session::get('Cart');
dd($mycart);
        return view('pages.cart.my_cart');
    }

    public function del_my_cart(Request $request){
        $oldcart = Session('Cart') ? Session('Cart') : null;
        $newcart = new Cart($oldcart);
        $newcart->DeleteCart($request->pro_id);
        if(count($newcart->products) > 0 ){
            $request->Session()->put('Cart', $newcart);
        }else{
            $request->Session()->forget('Cart');
        }
    }

    public function show_cart(){
        $title="Your Shopping Cart";

        return view('pages.cart.details_cart')->with(compact('title'));
    }

    public function load_details_my_cart(Request $request){
        return view('pages.cart.load_details_cart');
    }

    public function update_my_cart(Request $request){
        $oldcart = Session('Cart') ? Session('Cart') : null;
        $newcart = new Cart($oldcart);
        $newcart->UpdateCart($request->id, $request->qty);

        $request->Session()->put('Cart', $newcart, 900000);
    }

}
