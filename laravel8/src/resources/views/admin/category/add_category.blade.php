@extends('layouts.dashboard')
@section('title', 'Add Category')
@section('content')
    <div class="container-full">
        <h2 class="text-center mt-4">Danh mục</h2>
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#add_category" type="button" role="tab" aria-controls="add_category" aria-selected="true">Thêm danh mục sản phẩm</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#add_subcategory" type="button" role="tab" aria-controls="add_subcategory" aria-selected="false">Thêm danh mục con</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#all_category" type="button" role="tab" aria-controls="all_category" aria-selected="false">List danh mục</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="subcate-tab" data-bs-toggle="tab" data-bs-target="#all_subcategory" type="button" role="tab" aria-controls="all_subcategory" aria-selected="false">List danh mục con</button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="add_category" role="tabpanel" aria-labelledby="home-tab">
                    <form action="{{asset('/insert-category')}}" method="POST" class="my-3" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Tên danh mục</label>
                            <input type="text" class="form-control" name="category_name" id="category_name" value="{{ old('category_name') }}" placeholder="Nhập tên danh mục">
                        </div>
                        <div class="mb-3">
                            <label for="category_desc" class="form-label">Mô tả danh mục</label>
                            <textarea class="form-control" name="category_desc" id="category_desc" rows="3" value="{{ old('category_desc') }}"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="category_image" class="form-label">Ảnh danh mục</label>
                            <input class="form-control" name="category_image" type="file" id="category_image" value="{{ old('category_image') }}">
                        </div>
                        <button class="btn btn-success" type="submit">Thêm danh mục</button>
                    </form>
                </div>

                <div class="tab-pane fade" id="add_subcategory" role="tabpanel" aria-labelledby="profile-tab">
                    <form action="{{asset('/insert-subcategory')}}" method="post">
                        @csrf
                        <div class="my-3">
                            <label for="subcategory_name" class="form-label">Thêm danh mục con</label>
                            <div class="d-flex align-items-center mb-2">
                                <select class="form-select" id="select_cateid" aria-label="Default select example" name="category_id[]">
                                    <option value="0">Chọn danh mục</option>
                                    @foreach($category as $key => $cate)
                                        <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                    @endforeach
                                </select>
                                <input type="text" class="form-control" name="subcategory_name[]" id="subcategory_name" placeholder="Nhập tên danh mục con">
                                <a class="btn text-decoration-none fs-4 mx-2 p-0 text-success add_column_subcate"><i class="icofont-ui-love-add"></i></a>
                            </div>
                            <div id="plus_column"></div>

                            <button class="btn btn-success" type="submit">Thêm danh mục con</button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="all_category" role="tabpanel" aria-labelledby="contact-tab">
                    <div id="category_show" class="my-3">
                        @csrf
                    </div>
                </div>

                <div class="tab-pane fade" id="all_subcategory" role="tabpanel" aria-labelledby="subcate-tab">
                    <select class="form-select my-3" id="select_show" aria-label="Default select example">
                        <option value="0">Xem danh mục con</option>
                        @foreach($category as $key => $cate)
                            <option class="selected_show" value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                        @endforeach
                    </select>
                    <div id="subcategory_show" class="my-3">
                        @csrf
                    </div>
                </div>
                
            </div>
        </div>
    </div>

@section('script')
<script type="text/javascript">
    $('document').ready(function() {
        load_category();
        function load_category(){ //load danh mục
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/show-category')}}',
                method: 'post',
                data: {_token:_token},
                success: function(data){
                    $('#category_show').html(data);
                }
            });
        }//load danh mục
    });

    function del_category(cate_id){ // Xóa danh mục
        swal({
            title: "DELETE?",
            text: "Bạn có chắc muốn xóa danh mục này",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var cate_id = cate_id;
                var _token = $('input[name="_token"]').val();
                $.ajax({ 
                    url: '{{url('/delete-category')}}', 
                    method: 'post',
                    data: {cate_id:cate_id,_token:_token},
                    success: function(data){
                        swal("Đã xóa danh mục thành công", {icon: "success",});
                        location.reload();
                        load_category();
                    }
                });
            } else {
                swal("Đã hủy xóa");
            }
        });
    }// Xóa danh mục

    $(document).ready(function() {// Thêm hàng để add nhiều danh mục con
        var plus_column = $('#plus_column');
        var list = $('#select_cateid');
        $('.add_column_subcate').on('click',function() {
            var mylist = document.getElementById("select_cateid");
            var value_input =  mylist.options[mylist.selectedIndex].value;
            var text_input =mylist.options[mylist.selectedIndex].text;
            if(value_input != 0){plus_column.append(`<div class="d-flex align-items-center mb-2"><select 
                class="form-select" id="select_cateid" name="category_id[]"><option class="selected" 
                value="${value_input}">${text_input}</option</select><input type="text" class="form-control" 
                name="subcategory_name[]" id="subcategory_name" placeholder="Nhập tên danh mục con">
                <a class="btn text-decoration-none fs-4 p-0 mx-2 text-danger" id="remove_col">
                <i class="icofont-close-circled"></i></a></div>`);
            }else{
                swal('vui lòng chọn danh mục sản phẩm trước để thêm danh mục con');
            }
        }); 
        
        list.change(function (){
            $(".selected").val(list.val());
            const texted = $('#select_cateid :selected').text();
            $(".selected").text(texted);
        });
        
        plus_column.on('click','#remove_col',function(){
            $(this).closest('div').remove();
        }); 
    });// Thêm hàng để add nhiều danh mục con

    load_subcategory();
	function load_subcategory(){ // Load danh mục con
        $('#select_show').change(function (){
            var cate_id = $('#select_show').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/show-subcategory')}}',
                method: 'post',
                data: {cate_id:cate_id,_token:_token},
                success: function(data){
                    $('#subcategory_show').html(data);
                }
            });
        });
    }// Load danh mục con

    function show_edit_subcategory(cate_id){// Sửa danh mục con
        var btnedit = $('.show_edit_cate');
        var btnedit_up = $('#show_edit_cate'+cate_id+'');
        var text_edit = $('td[class="input_editer'+cate_id+'"]').text();
        var cleartext = $('.input_editer'+cate_id+'');
        btnedit.toggleClass('disabled');

        if(btnedit_up.hasClass('disabled')){
            btnedit_up.before(`<a class="btn btn-outline-info">Thực hiện</a>`);
        }
        cleartext.empty();
        cleartext.append(`<input type="text" class="form-control"id="subcategory_name${cate_id}" 
            value="${text_edit}" />`);
            
        $('#subcategory_name'+cate_id+'').blur(function(){ // Sửa danh mục con
            var cate_name = $('#subcategory_name'+cate_id+'').val();
            var sub_id = cate_id;
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/edit-subcategory')}}',
                method: 'post',
                data: {cate_name:cate_name,sub_id:sub_id,_token:_token},
                success: function(data){
                    swal("Đã sửa danh mục con thành công", {icon: "success",});
                    location.reload();
                }
            });
        }); // Sửa danh mục con
    }// Sửa danh mục con

    function del_subcategory(cate_id) {//Xóa danh mục con
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '{{url('/del-subcategory')}}',
            method: 'post',
            data: {cate_id:cate_id,_token:_token},
            success: function(data){
                swal("Đã xóa danh mục con thành công", {icon: "success",});
                location.reload();
            }
        });//Xóa danh mục con
    }

    function add_image_subcategory(sub_id){ //Thêm ảnh danh mục con
        swal({
            text: "Thêm ảnh danh mục con",
            className: "show_img_insert_sub",
            button: false,
        });

        if($('.show_img_insert_sub')){
            $('.show_img_insert_sub').append(`
                <form action="{{asset('/insert-img-subcategory')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="sub_id_insert_img" value="`+sub_id+`">
                    <input type="file" class="form-control" id="insert_img_sub" name="insert_img_insert_sub" accept="image/*">
                    <img id="output_img_sub" src="#" width="150px"/>
                    <button class="btn btn-success" type="submit">Thêm ảnh</button>
                </form>
            `);
            insert_img_sub.onchange = evt => {
            const [file] = insert_img_sub.files
            if (file) {
                output_img_sub.src = URL.createObjectURL(file)
            }
        }
        }
        

    }//Thêm ảnh danh mục con

    
</script>
@endsection

@endsection
