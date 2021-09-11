<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\SubCategory;
use App\Models\Product;
use Str;
use DB;
use Cart;

class HomesController extends Controller
{
    public function home() {
        return view('pages.home.home');
    }
    public function test() {
        return view('pages.home.test');
    }

    public function product_with_category($slug){
        $category = Category::orderBy('category_id', 'desc')->get();

        foreach($category as $cate){
            if(Str::slug($cate->category_name) == $slug){
                $catepro = Category::where('category_name',$cate->category_name)->first();
                
                if(isset($_GET['sort_by'])){
                    $sort_by = $_GET['sort_by'];
        
                    if($sort_by == 'price-descending'){
                        $product = Product::with('gallery')->where('category_id', $catepro->category_id)->orderBy('product_price', 'DESC')->get()->append(request()->query());
                    }elseif($sort_by == 'price-ascending'){
                        $product = Product::with('gallery')->where('category_id', $catepro->category_id)->orderBy('product_price', 'ASC')->get()->append(request()->query());
                    }elseif($sort_by == 'title-ascending'){
                        $product = Product::with('gallery')->where('category_id', $catepro->category_id)->orderBy('product_name', 'ASC')->get()->append(request()->query());
                    }elseif($sort_by == 'title-descending'){
                        $product = Product::with('gallery')->where('category_id', $catepro->category_id)->orderBy('product_name', 'DESC')->get()->append(request()->query());
                    }elseif($sort_by == 'created-ascending'){
                        $product = Product::with('gallery')->where('category_id', $catepro->category_id)->orderBy('updated_at', 'ASC')->get()->append(request()->query());
                    }elseif($sort_by == 'created-descending'){
                        $product = Product::with('gallery')->where('category_id', $catepro->category_id)->orderBy('updated_at', 'DESC')->get()->append(request()->query());
                    }
                }else{
                    $product = Product::where('category_id',$catepro->category_id)->with('gallery')->get()->append(request()->query());
                }
        
            }
        }

        $title = $catepro->category_name.' Product' ;

        return view('pages.product.product_with_cate')->with(compact('category','catepro','product','title'));
    }

    public function product_with_subcategory($slug, $sub_id){
        $category = Category::orderBy('category_id', 'desc')->get();

        foreach($category as $cate){
            if(Str::slug($cate->category_name) == $slug){
                $subcatepro = SubCategory::where('subcategory_id',$sub_id)->with('category')->first();
            }
        }
        $product = Product::where('subcategory_id',$sub_id)->with('gallery')->get();
        $title = "Vegan Beauty Products by Paul Rose Products";

        return view('pages.product.product_with_subcate')->with(compact('category','subcatepro','product','title'));
    }

    public function search_item(Request $request){
        $product = Product::where('product_name', 'like', '%' . $request->keyword . '%')->with('onegallery')->get();
        $output = '<table>
                        <tbody>';
        foreach ($product as $pro){
            $output .= '    <tr>
                                <td><img src="'.url('uploads/gallery/'.$pro->onegallery->gallery_image.'').'" width="65px"/></td>
                                <td class="pl-2">
                                    <a href="'.url('/collections/search/product/'.$pro->product_slug).'">
                                        '.$pro->product_name.'
                                    </a>
                                </td>
                            </tr>';
        }
        $output .='     </tbody>
                    </table>';
        echo $output;
    }

    public function search_keywords(Request $request){
        $title = 'Search keys: '.$request->searchbox;
        $keyw = $request->searchbox;
        return view('pages.home.search')->with(compact('title','keyw'));
    }

    public function load_search_products(Request $request){
        $output = '';
        if($request->key != ''){
            $product = Product::where('product_name', 'like', '%' . $request->key . '%')->with('gallery')->get();

            if(!blank($product)){
                $output .='<div class="container_show_pro_search">';
                foreach($product as $key => $pro){
                    $output .= '<div class="product_item_search">
                                    <div class="product_item" id="product_item_'.$key.'">
                                        <div class="product_item_image">
                                            <a href="'.url('/collections/search/product/'.$pro->product_slug.'').'">';
                                                foreach ($pro->gallery as $i => $gal){
                                                    $output .='<img class="product_img'.$i.'" src="'.url('/uploads/gallery/'.$gal->gallery_image.'').'" width="100%" alt="">';
                                                }
                    $output .= '            </a>
                                        </div>
                                        <div class="product_item_info">
                                            <a href="'.url('/collections/search/product/'.$pro->product_slug.'').'">
                                                <span>'.$pro->product_name.'</span>
                                            </a>
                                            <dl class="mt-1 product_price">'.$pro->product_price.'</dl>
                                        </div>
                                    </div>
                                </div>';
                }
                $output .= '</div>';
            }else{
                $output .= '<div class="text-center">
                                <p class="fw-bold text-decoration-underline">Để tìm được kết quả chính xác hơn, bạn vui lòng:</p>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Kiểm tra lỗi chính tả của từ khóa đã nhập</li>
                                    <li class="list-group-item">Thử lại bằng từ khóa khác</li>
                                    <li class="list-group-item">Thử lại bằng những từ khóa tổng quát hơn</li>
                                    <li class="list-group-item">Thử lại bằng những từ khóa ngắn gọn hơn</li>
                                </ul>
                            </div>';
            }
            
        }else{
            $output .= '<div class="text-center">Cần nhập từ khóa để tìm kiếm</div>';
        }
        echo $output;
    }

}
