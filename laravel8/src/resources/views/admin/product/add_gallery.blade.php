@extends('layouts.dashboard')
@section('title', 'Add Gallery Product')
@section('content')

<div class="container-xl">
    <h2 class="text-center mt-4">Thêm ảnh chi tiết sản phẩm <p>{{$product->product_name}}</p></h2>
    <form action="{{asset('/insert-gallery-product')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="product_id" value="{{$product->product_id}}" >
        <div class="error-message"><span>{{ $errors->first('galleryimage') }}</span></div>
        <div class="row">
            <div class="col-5">
                <label for="formFileGallery1" class="form-label">Thêm ảnh</label>
                <input class="form-control" name="galleryimage[]" type="file" accept="image/*" id="input_img1" onchange="loadFileImg(id,event)">
            </div>
            <div class="col-3">
                <label class="form-label" for="flexCheckDisabledColor">Color</label>
                <input type="text" name="gallerycolor[]" class="form-control" placeholder="Màu">
            </div>
            <div class="col-3">
                <label class="form-label" for="flexCheckDisabledTitle">Title</label>
                <input type="text" name="gallerytitle[]" class="form-control" placeholder="Title">
            </div>
            <div class="col-1 my-auto">
                <a class="add_form_insert_imd btn"><i class="icofont-ui-add"></i></a>
            </div>
        </div>
        <img width="150px" class="mb-2" id="output_img1"/>

        <div id="show_insert_gallery"></div>

        <button type="submit" class="btn btn-success my-3">Thêm ảnh chi tiết</button>
    </form>
</div> 

@section('script')
<script type="text/javascript">
    var x = 1;
	$('.add_form_insert_imd').click(function() { // Thêm ô thêm ảnh
		x++;
		$('#show_insert_gallery').append(`
            <div class="row" id="form_insert_gallery`+x+`">
                <div class="col-5">
                    <input class="form-control" name="galleryimage[]" type="file" accept="image/*" id="input_img`+x+`" onchange="loadFileImg(id,event)">
                    <img width="150px" class="mb-2" id="output_img`+x+`"/>
                </div>
                <div class="col-3">
                    <input type="text" name="gallerycolor[]" class="form-control" placeholder="Màu">
                </div>
                <div class="col-3">
                    <input type="text" name="gallerytitle[]" class="form-control" placeholder="Title">
                </div>
                <div class="col-1">
                    <a class="remove_form_insert_imd btn" ><i class="icofont-ui-remove"></i></a>
                </div>
            </div>
        `);
	})// Thêm ô thêm ảnh

    $(document).ready(function(){ //Xóa ô thêm ảnh
        $('#show_insert_gallery').on('click','.remove_form_insert_imd',function(){
            $(this).closest('.row').remove();
        });
    });//Xóa ô thêm ảnh

	function loadFileImg(id,event) {//load ảnh trước khi insert
		var b = id.slice(9);
		var a = document.getElementById('output_img'+b+'');

		a.src = URL.createObjectURL(event.target.files[0]);
		a.onload = function() {
			URL.revokeObjectURL(a.src)
		}
	}//load ảnh trước khi insert

</script>
@endsection
@endsection