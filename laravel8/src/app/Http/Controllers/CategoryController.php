<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Category;
use App\Models\SubCategory;
use Session;

class CategoryController extends Controller
{
    public function add_category(){
        $category = Category::orderBy('category_id','ASC')->get();

        return view('admin.category.add_category')->with(compact('category'));
    }

    public function insert_category(Request $request){
        $get_image = $request->file('category_image');

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/category',$new_image);
           
            $category = new Category();
            $category->category_name = $request->category_name;
            $category->category_desc = $request->category_desc;
            $category->category_image = $new_image;
            $category->save();

            Session::flash('success','Thêm danh mục thành công');
            return Redirect::to('add-category');
        }else{
            Session::flash('error','Thêm danh mục Không thành công');
            return Redirect::to('add-category');
        } 
    }

    public function show_category(){
        $category = Category::orderBy('category_id','ASC')->get();
        $output = '';
        $output .='<table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Stt</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Mô tả danh mục</th>
                                <th scope="col">Ảnh danh mục</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach($category as $key => $cate){
                $output .='<tr>
                                <td scope="row">'.$cate->category_id.'</td>
                                <td>'.$cate->category_name.'</td>
                                <td>'.$cate->category_desc.'</td>
                                <td><img src="uploads/category/'.$cate->category_image.'" alt="'.$cate->category_name.'" width="80%"></td>
                                <td class="text-center">
                                    <a href="'.url("/edit-category/".$cate->category_id).'" class="btn btn-info my-2">Edit</a>
                                    <a class="btn btn-danger" onclick="del_category('.$cate->category_id.')">Del</a>
                                </td>
                            </tr>';
        }
        $output .='</tbody>
                </table>';
        echo $output;
    }

    public function edit_category($category_id){
        $edit_cate = Category::where('category_id',$category_id)->first();
        return view('admin.category.edit_category')->with(compact('edit_cate'));
    }

    public function update_category(Request $request, $category_id){
        $category = Category::find($category_id);
        $path = public_path('/uploads/category/');

        $get_image = $request->file('category_image');

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/category',$new_image);

            if($category->category_image){
                $file_old = $path.$category->category_image;
                unlink($file_old);
            }

            $category->category_name = $request->category_name;
            $category->category_desc = $request->category_desc;
            $category->category_image = $new_image;
            $category->update();

            return Redirect::to('add-category');
        }else{
            return Redirect::to('add-category');
        } 
    }

    public function delete_category(Request $request){
        $cate_id = $request->cate_id;
        $category = Category::find($cate_id);

        if($category->category_image){
            $path = public_path('/uploads/category/');
            $file_old = $path.$category->category_image;
            unlink($file_old);
        }

        $category->delete();
    }

    

}





















