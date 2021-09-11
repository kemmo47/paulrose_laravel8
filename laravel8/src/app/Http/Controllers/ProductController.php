<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Gallery;
use App\Http\Requests\ProductRequest;
use Session;
use Str;

class ProductController extends Controller
{
    public function add_product(){
        $category = Category::get();

        return view('admin.product.add_product')->with(compact('category'));
    }

    public function show_subcate_add_product(Request $request){
        $category_id = $request->cate_id;
        $sub_category = SubCategory::where('category_id', $category_id)->get();
        $output='<select class="form-select my-2" name="subcategory_id" aria-label="Default select example">
                    <option selected>---Chọn danh mục con---</option>';
        foreach($sub_category as $sub){
            $output .= '<option value="'.$sub->subcategory_id.'">'.$sub->subcategory_name.'</option>';
        }
        $output .= '</select>';
        $x='';
        if($category_id == 1){
            $x .= '<div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="ingredient1" id="inlineCheckbox1" value="1">
                    <label class="form-check-label" for="inlineCheckbox1">
                        <img width="30px" src="https://img.icons8.com/444444/windows/8x/no-gluten.png"/>
                        <span>Gluten-Free Product</span>
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="ingredient2" id="inlineCheckbox2" value="2">
                    <label class="form-check-label" for="inlineCheckbox2">
                        <img width="30px" src="https://img.icons8.com/444444/ios/8x/rabbit--v2.png"/>
                        <span>Cruelty-Free</span>
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="ingredient3" id="inlineCheckbox3" value="3">
                    <label class="form-check-label" for="inlineCheckbox3">
                        <img width="30px" src="https://img.icons8.com/444444/color/8x/vegan-symbol.png"/>
                        <span>Vegan</span>
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="ingredient4" id="inlineCheckbox4" value="4">
                    <label class="form-check-label" for="inlineCheckbox4">
                        <img width="30px" src="https://img.icons8.com/444444/windows/8x/no-parabens.png"/>
                        <span>Paraben-Free</span>
                    </label>
                </div>';
        }

        echo $output;
        echo $x;
    }

    public function insert_product(ProductRequest $request){

        $product = new Product();
        
        $product_ingredient = $request->ingredient1 + $request->ingredient2 + $request->ingredient3 + $request->ingredient4;
        $slug = Str::slug($request->product_name);
        $product_price = $request->product_price * 100;

        $product->product_name = $request->product_name;
        $product->product_price = $product_price;
        $product->product_desc = $request->product_desc;
        $product->product_ingredient = $product_ingredient;
        $product->product_slug = $slug;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        
        $pro = Product::where('product_name',$request->product_name)->first();
        if($pro){
            Session::flash('error','Thêm sản phẩm không thành công, Trùng tên sản phẩm ');
            return Redirect::to('add-product');
        }else{
            $product->save();
            Session::flash('success','Thêm sản phẩm thành công ^^');
            return Redirect::to('list-product');
        }
        
    }

    public function list_product(){
        $category = Category::orderBy('category_id', 'desc')->get();

        return view('admin.product.all_product')->with(compact('category'));
    }

    public function select_subcategory(Request $request){
        $data = $request->all();
        $output ='';
        if($data['action'] == 'category_showpro'){
            $sub_category = SubCategory::where('category_id', $data['cate_id'])->orderBy('subcategory_id','ASC')->get();
            $output .= '<option value="">---Chọn danh mục con---</option>';
            foreach($sub_category as $sub){
                $output .='<option value="'.$sub->subcategory_id.'">'.$sub->subcategory_name.'</option>';
            }
        }

        echo $output;
    }

    public function list_show_product(Request $request){
        $data = $request->all();
        $x = '';
        
        if($data['subcate_id_show']){
            $product = Product::where('category_id',$data['cate_id_show'])->where('subcategory_id',$data['subcate_id_show'])->with('gallery')->orderBy('product_id','DESC')->get();
        }else{
            $product = Product::where('category_id',$data['cate_id_show'])->with('gallery')->orderBy('product_id','DESC')->get();
        }

        foreach($product as $key => $pro){
            $gallery = Gallery::where('product_id', $pro->product_id)->limit(2)->get();
            $x.='<tr>
                    <td scope="row">'.$pro->product_id.'</td>
                    <td>'.$pro->product_name.'</td>
                    <td>$'.$pro->product_price/100 .'</td>
                    <td>
                        <div class="d-flex">';
                            foreach($gallery as $gall){
                                $x.='<img width="190px" src="uploads/gallery/'.$gall->gallery_image.'">';
                            }
            $x.=        '</div> 
                    </td>
                    <td>';
                        if($pro->product_ingredient == 10){
                            $x.= '<img width="30px" src="https://img.icons8.com/444444/windows/8x/no-gluten.png"/>
                                <img width="30px" src="https://img.icons8.com/444444/ios/8x/rabbit--v2.png"/>
                                <img width="30px" src="https://img.icons8.com/444444/color/8x/vegan-symbol.png"/>
                                <img width="30px" src="https://img.icons8.com/444444/windows/8x/no-parabens.png"/>';
                        }elseif($pro->product_ingredient == 7){
                            $x.= '<img width="30px" src="https://img.icons8.com/444444/windows/8x/no-gluten.png"/>
                                <img width="30px" src="https://img.icons8.com/444444/ios/8x/rabbit--v2.png"/>
                                <img width="30px" src="https://img.icons8.com/444444/windows/8x/no-parabens.png"/>';
                        }else{
                            $x.='0';
                        }
            $x.=    '</td>
                    <td class="text-center">
                        <a href="'.url("/edit-product/".$pro->product_id).'" class="btn btn-info my-2">Edit</a>
                        <a class="btn btn-danger my-2" onclick="del_product('.$pro->product_id.')">Del</a>
                        <a class="btn btn-primary mb-2" onclick="showBtnDelAll(this.href)" data-bs-toggle="collapse" href="#collapseExample'.$key.'" role="button" aria-expanded="false" aria-controls="collapseExample'.$key.'">
                            Ảnh chi tiết
                        </a>
                        <a class="btn btn-danger disabled" id="check_collapseExample'.$key.'" onclick="del_all_gallery('.$pro->product_id.')">Xóa tất cả ảnh chi tiết</a>
                    </td>
                </tr>';

            $x.='<tr>
                    <td colspan="6">
                        <div class="collapse" id="collapseExample'.$key.'">
                            <div class="card card-body">';
                                foreach($pro->gallery as $gal){
                                    $x.='<div class="row">
                                            <div class="col-4">
                                                <img width="140px" class="my-1" src="uploads/gallery/'.$gal->gallery_image.'">
                                            </div>
                                            <div class="col-3">'.$gal->gallery_color.'</div>
                                            <div class="col-3">'.$gal->gallery_title.'</div>
                                            <div class="col-1">
                                                <a class="btn btn-danger" onclick="del_gallery('.$gal->gallery_id.')">x</a>
                                            </div>
                                        </div>';
                                }
                            $x.='<a href="'.url("/add-gallery-product/".$pro->product_id).'">Thêm ảnh chi tiết</a>';
            $x.=            '</div>
                        </div>
                    </td>
                </tr>';
        }
        if(blank($product)){
            $x .='<tr>
                    <td colspan="7" class="text-center">Danh mục này chưa có sản phẩm</td>
                </tr>';
        }

        echo $x;
    }

    public function edit_product($product_id) {
        $product = Product::where('product_id', $product_id)->with('category','subcategory')->first();
        $category = Category::orderBy('category_id')->get();

        return view('admin.product.edit_product')->with(compact('product','category'));
    }

    public function select_subcate_edit(Request $request){
        $data = $request->all();
        $output ='';
        if($data['action'] == 'loadsubcate'){
            $sub_category = SubCategory::where('category_id', $data['cate_id'])->orderBy('subcategory_id','ASC')->get();
            $output .= '<option value="">---Chọn danh mục con---</option>';
            foreach($sub_category as $sub){
                $output .='<option value="'.$sub->subcategory_id.'">'.$sub->subcategory_name.'</option>';
            }
        }

        echo $output;
    }

    public function update_product($product_id,Request $request){
        $product = Product::find($product_id);

        $product->product_name = $request->product_name;
        $product->product_desc = $request->product_desc;
        $product->product_price = $request->product_price * 100;

        $product_ingredient = $request->ingredient1 + $request->ingredient2 + $request->ingredient3 + $request->ingredient4;
        $product->product_ingredient = $product_ingredient;

        $slug = Str::slug($request->product_name);
        $product->product_slug = $slug;
        
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;

        $product->update();

        Session::flash('success','Sửa sản phẩm thành công');
        return Redirect::to('list-product');
    }


    public function delete_product(Request $request){
        $product = Product::where('product_id',$request->pro_id)->first();
        $product->delete();
        $gallery = Gallery::where('product_id',$request->pro_id)->get();
        foreach($gallery as $gal){
            if($gal->gallery_image){
                $path = public_path('/uploads/gallery/');
                $file_old = $path.$gal->gallery_image;
                unlink($file_old);
            }
            $gal->delete();
        }
    }

}
