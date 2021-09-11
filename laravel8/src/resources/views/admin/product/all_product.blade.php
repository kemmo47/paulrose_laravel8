@extends('layouts.dashboard')
@section('title', 'All Product')
@section('content')
    <div class="container-xl">
        @csrf
        <h2 class="text-center mt-4">Tất cả sản phẩm</h2>
        <div class="show_product_with_cate">
            <select class="form-select my-2 choosecate" id="category_showpro" name="category_showpro" aria-label="Default select example">
                <option value="">---Chọn danh mục---</option>
                @foreach($category as $cate)
                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                @endforeach
            </select>
            <select class="form-select my-2 choosesub" id="subcategory_showpro" name="subcategory" aria-label="Default select example">
                <option value="0">-Chọn danh mục con-</option>
            </select>
            
        </div>
        <div class="table_list_product">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" width="30px"></th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">giá</th>
                        <th>Ảnh</th>
                        <th></th>
                        <th width="150px"></th>
                    </tr>
                </thead>
                <tbody id="table_list_product">

                </tbody>
            </table>
        </div>
    </div>

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('.choosecate').on('change',function(){//chọn cate show subcate
            var action = $(this).attr('id');
            var cate_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';

            if(action=='category_showpro'){
                result = 'subcategory_showpro';
            }
            
            $.ajax({
                url: '{{url('/select-subcategory')}}',
                method: 'post',
                data: {action:action,cate_id:cate_id,_token:_token},
                success: function(data){
                    $('#'+result).html(data);
                }
            });
        });//chọn cate show subcate

        $('#category_showpro').change(function(){ //Hiện sản phẩm khi chọn cate
            var cate_id_show = $(this).val();
            var _token = $('input[name="_token"]').val();
            var subcate_id_show = '';

            $.ajax({
                url: '{{url('/show-list-product')}}',
                method: 'post',
                data: {subcate_id_show:subcate_id_show,cate_id_show:cate_id_show,_token:_token},
                success: function(data){
                    $('#table_list_product').html(data);
                }
            });

            $('#subcategory_showpro').change(function(){//Hiện sản phẩm khi chọn cate và subcate
                var subcate_id_show = $(this).val();
                var _token = $('input[name="_token"]').val();

                if(subcate_id_show){
                    $.ajax({
                        url: '{{url('/show-list-product')}}',
                        method: 'post',
                        data: {subcate_id_show:subcate_id_show,cate_id_show:cate_id_show,_token:_token},
                        success: function(data){
                            $('#table_list_product').html(data);
                        }
                    });
                }
            });//Hiện sản phẩm khi chọn cate và subcate

        })

    });

    function del_gallery(gal_id){ //Xóa ảnh chi tiết sản phẩm
        var _token = $('input[name="_token"]').val();
        swal({
            title: "Bạn có chắc?",
            text: "Xóa 1 ảnh chi tiết sản phẩm này",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({ 
                    url: '{{url('/delete-gallery')}}', 
                    method: 'post',
                    data: {gal_id:gal_id,_token:_token},
                    success: function(data){
                        swal("xong! ảnh chi tiết này đã được xóa", {
                            icon: "success",
                        });
                        location.reload();
                    }
                });
            }
        });
    }//Xóa ảnh chi tiết sản phẩm

    function del_all_gallery(pro_id) { //Xóa tất cả ảnh chi tiết sản phẩm
        var _token = $('input[name="_token"]').val();
        swal({
            title: "Bạn có chắc?",
            text: "Xóa tất cả ảnh chi tiết sản phẩm này",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({ 
                    url: '{{url('/delete-all-gallery')}}', 
                    method: 'post',
                    data: {pro_id:pro_id,_token:_token},
                    success: function(data){
                        swal("xong! tất cả ảnh chi tiết này đã được xóa", {
                            icon: "success",
                        });
                        location.reload();
                    }
                });
            }
        });
    }//Xóa tất cả ảnh chi tiết sản phẩm

    function showBtnDelAll(k){ //khi nhấn xem chi tiết ảnh thì mới bấm đc xóa tất cả
        var href = k.slice('35');
        $('#check_'+href+'').toggleClass('disabled');
    }//khi nhấn xem chi tiết ảnh thì mới bấm đc xóa tất cả

    function del_product(pro_id){
        var _token = $('input[name="_token"]').val();
        swal({
            title: "Bạn có chắc?",
            text: "Xóa sản phẩm này",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({ 
                    url: '{{url('/delete-product')}}', 
                    method: 'post',
                    data: {pro_id:pro_id,_token:_token},
                    success: function(data){
                        swal("xong! Đã xóa sản phẩm này", {
                            icon: "success",
                        });
                        location.reload();
                    }
                });
            }
        });
    }

</script>
@endsection
@endsection