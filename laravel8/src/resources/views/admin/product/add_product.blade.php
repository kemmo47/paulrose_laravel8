@extends('layouts.dashboard')
@section('title', 'Add Product')
@section('content')
    <div class="container-xl">
        <h2 class="text-center mt-4">Thêm sản phẩm</h2>
        <form action="{{asset('/insert-product')}}" method="post">
            @csrf
            <select class="form-select my-2" id="loadsubcate" name="category_id" aria-label="Default select example">
                <option selected>---Chọn danh mục---</option>
                @foreach($category as $cate)
                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                @endforeach
            </select>
            <div class="error-message"><span>{{ $errors->first('category_id') }}</span></div>

            <div id="show_subcate_add_product"></div>
            <div class="error-message"><span>{{ $errors->first('subcategory_id') }}</span></div>

            <input class="form-control my-2" type="text" name="product_name" placeholder="Tên sản phẩm" aria-label="default input example" value="{{ old('product_name') }}">
            <div class="error-message"><span>{{ $errors->first('product_name') }}</span></div>

            <input class="form-control my-2" type="text" name="product_price" placeholder="Giá sản phẩm" aria-label="default input example" value="{{ old('product_price') }}">
            <div class="error-message"><span>{{ $errors->first('product_price') }}</span></div>

            <div class="form-floating my-2">
                <textarea class="form-control" name="product_desc" placeholder="Leave a comment here" id="editor" style="height: 100px" value="{{ old('product_desc') }}">Mô tả sản phẩm</textarea>
            </div>
            <div class="error-message"><span>{{ $errors->first('product_desc') }}</span></div>

            <button type="submit" class="btn btn-success my-3">Thêm sản phẩm</button>
        </form>
    </div>

@section('script')
<!--  show danh mục con - add product --><script>
    show_subcate_add_product();
	function show_subcate_add_product(){
        $('#loadsubcate').change(function (){
            var cate_id = $('#loadsubcate').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/show-subcate-add-product')}}',
                method: 'post',
                data: {cate_id:cate_id,_token:_token},
                success: function(data){
                    $('#show_subcate_add_product').html(data);
                }
            });
        });
    }
</script><!--  show danh mục con - add product -->

@endsection
@endsection