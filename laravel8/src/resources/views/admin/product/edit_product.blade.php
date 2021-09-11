@extends('layouts.dashboard')
@section('title', 'Edit product')
@section('content')
    <div class="container-full">
        <h2 class="text-center mt-4">Edit Sản phẩm</h2>
        <div class="container">
            <form action="{{asset('/update-product/'.$product->product_id)}}" method="POST">
                @csrf
                <select class="form-select my-2 choosecate" id="loadsubcate" name="category_id" aria-label="Default select example">
                    <option value="{{$product->category->category_id}}">{{$product->category->category_name}}</option>
                    @foreach($category as $cate)
                        <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                    @endforeach
                </select>
                
                <select class="form-select my-2" id="subcategory_showpro_edit" name="subcategory_id" aria-label="Default select example">
                    <option value="{{$product->subcategory->subcategory_id}}">{{$product->subcategory->subcategory_name}}</option>
                </select>

                <input type="hidden" name="product_ingredient" value="{{$product->product_ingredient}}">
                <div class="form-check form-check-inline">
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
                </div>
        
                <input class="form-control my-2" type="text" name="product_name" placeholder="Tên sản phẩm" aria-label="default input example" value="{{$product->product_name}}">
                <?php $pro_price = $product->product_price /100; ?>
                <input class="form-control my-2" type="text" name="product_price" placeholder="Giá sản phẩm" aria-label="default input example" value="{{$pro_price}}">
                <div class="form-floating my-2">
                    <textarea class="form-control" name="product_desc" placeholder="Leave a comment here" id="editor" style="height: 100px">{{$product->product_desc}}</textarea>
                </div>

                <button class="btn btn-success" type="submit">Sửa sản phẩm</button>
            </form>
        </div>
    </div>


    @section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('.choosecate').on('change',function(){ //Chọn cate show sub
            var action = $(this).attr('id');
            var cate_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';

            if(action=='loadsubcate'){
                result = 'subcategory_showpro_edit';
            }
            
            $.ajax({
                url: '{{url('/select-subcategory-edit')}}',
                method: 'post',
                data: {action:action,cate_id:cate_id,_token:_token},
                success: function(data){
                    $('#'+result).html(data);
                }
            });
        }); //Chọn cate show sub

        // check những ô đã đc check
        var x = $('input[name="product_ingredient"]').val();
        if(x == 10){
            for(var i = 1; i < 5; i++){
                $( "#inlineCheckbox"+i+"" ).prop( "checked", true );
            }
        }else if(x == 7){
            $( "#inlineCheckbox1" ).prop( "checked", true );
            $( "#inlineCheckbox2" ).prop( "checked", true );
            $( "#inlineCheckbox4" ).prop( "checked", true );
        }
        // check những ô đã đc check

    })
</script>
@endsection
@endsection
