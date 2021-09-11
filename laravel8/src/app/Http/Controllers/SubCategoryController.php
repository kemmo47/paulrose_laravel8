<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Category;
use App\Models\SubCategory;
use Session;

class SubCategoryController extends Controller
{
    public function insert_subcategory(Request $request){
        $data = $request->all();
        $subcategory_name = $data['subcategory_name'];
        $category_id = $data['category_id'];

        foreach($subcategory_name as $key => $value){
            $subcategory = new SubCategory();
            $subcategory->subcategory_name = $value;
            $subcategory->category_id = $category_id[$key];
            $subcategory->subcategory_image = '';
            $subcategory->save();
        }

        Session::flash('success', 'Thêm danh mục con thành công');
        return Redirect::to('add-category');
    }

    public function show_subcategory(Request $request){
        $category_id = $request->cate_id;
        $subcategory = SubCategory::where('category_id', $category_id)->orderBy('subcategory_id', 'asc')->with('category')->get();

        $output = '';
        $output .='<table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Stt</th>
                                <th scope="col">Tên danh mục con</th>
                                <th scope="col">thuộc danh mục</th>
                                <th>Ảnh</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>';
            foreach($subcategory as $key => $subcate){
                    $output .='<tr>
                                    <td scope="row">'.$subcate->subcategory_id.'</td>
                                    <td class="input_editer'.$subcate->subcategory_id.'">'.$subcate->subcategory_name.'</td>
                                    <td>'.$subcate->category->category_name.'</td>
                                    <td>';
                                        if(!blank($subcate->subcategory_image)){
                    $output .=              '<img src="uploads/subcategory/'.$subcate->subcategory_image.'" alt="'.$subcate->subcategory_name.'" width="170px">';
                                        }else{
                    $output .=              '<button class="btn btn-primary" onclick="add_image_subcategory('.$subcate->subcategory_id.')">Thêm ảnh</button>';
                                        }
                                    
                    $output .=      '</td>
                                    <td class="text-center">
                                        <a class="btn btn-info my-2 show_edit_cate" id="show_edit_cate'.$subcate->subcategory_id.'" onclick="show_edit_subcategory('.$subcate->subcategory_id.')">Edit</a>
                                        <a class="btn btn-danger" onclick="del_subcategory('.$subcate->subcategory_id.')">Del</a>
                                    </td>
                                </tr>';
            }
            if(blank($subcategory)){
                $output .= '<tr>
                                <td colspan="5" class="text-center"><a class="text-dark">Chưa có danh mục con</a></td>
                            </tr>';
            }
            
        $output .='</tbody>
                </table>';
        echo $output;
    }

    public function edit_subcategory(Request $request){
        $subcate_name = $request->cate_name;
        $subcate_id = $request->sub_id;

        SubCategory::where('subcategory_id', $subcate_id)->update(['subcategory_name' => $subcate_name]);
    }

    public function del_subcategory(Request $request){
        $sub_id = $request->cate_id;
        SubCategory::find($sub_id)->delete();
    }

    public function insert_img_subcategory(Request $request){
        $get_image = $request->file('insert_img_insert_sub');
       
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/subcategory',$new_image);

            SubCategory::where('subcategory_id', $request->sub_id_insert_img)->update(['subcategory_image' => $new_image]);
            Session::flash('success','Thêm ảnh danh mục thành công');
            return Redirect::to('add-category');
        }else{
            Session::flash('error','Thêm ảnh danh mục Không thành công');
            return Redirect::to('add-category');
        }
        
    }

}
