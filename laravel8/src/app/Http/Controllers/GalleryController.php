<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\GalleryRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Gallery;
use Session;

class GalleryController extends Controller
{
    public function add_gallery($product_id){
        $product = Product::where('product_id',$product_id)->first();

        return view('admin.product.add_gallery')->with(compact('product'));
    }

    public function insert_gallery_product(GalleryRequest $request){
        $data = $request->all();
        
        $product_id = $data['product_id'];
        $product = Product::where('product_id', $product_id)->with('category')->first();

        $gallery_color = $data['gallerycolor'];
        $gallery_title = $data['gallerytitle'];
       
        $get_image = $request->file('galleryimage');

        if($get_image){
            foreach($get_image as $key => $value){
                $get_name_image = $value->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,999).'.'.$value->getClientOriginalExtension();
                $value->move('uploads/gallery',$new_image);

                $gallery = new Gallery();
                $gallery->gallery_image = $new_image;
                $gallery->product_id = $product_id;
                if(blank($gallery_title)){
                    $gallery->gallery_title = '';
                }else{
                    $gallery->gallery_title = $gallery_title[$key];
                }
                if(blank($gallery_color)){
                    $gallery->gallery_color = '';
                }else{
                    $gallery->gallery_color = $gallery_color[$key];
                }
                
                $gallery->save();
            }

            Session::flash('success', 'Thêm ảnh chi tiết thành công');
            return Redirect::to('list-product');
        }else{
            Session::flash('error', 'Thiếu ảnh');
            return Redirect::to('add-gallery-product/'.$product_id.'');
        }
    }

    public function delete_gallery(Request $request){
        $gallery_id = $request->gal_id;
        $gallery = Gallery::where('gallery_id',$gallery_id)->with('product')->first();
        if($gallery->gallery_image){
            $path = public_path('/uploads/gallery/');
            $file_old = $path.$gallery->gallery_image;
            unlink($file_old);
        }
        $gallery->delete();
    }

    public function delete_all_gallery(Request $request){
        $product_id = $request->pro_id;
        $product = Gallery::where('product_id',$product_id)->get();
        foreach($product as $pro){
            if($pro->gallery_image){
                $path = public_path('/uploads/gallery/');
                $file_old = $path.$pro->gallery_image;
                unlink($file_old);
            }
            $pro->delete();
        }
    }

}
