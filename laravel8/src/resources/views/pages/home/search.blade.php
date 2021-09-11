@extends('layouts.layout')
@section('title', $title) 
@section('content')
    <div class="container-xsl">
        <div class="my-3 text-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mt-5 mb-4">
                    <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
                    <i class="icofont-curved-right"></i>
                    <li class="breadcrumb-item active" aria-current="page">Search: "{{$keyw}}"</li>
                </ol>
            </nav>
            <h2 class="mb-5">Search our store</h2>
        </div>
        <div class="search_continue">
            <div class="searched_keywords">
                Your search for "{{$keyw}}" revealed the following:
            </div>
            <div class="search_input_box">
                <form action="{{asset('/search-keywords')}}" method="POST">
                    @csrf
                    <input type="search" name="searchbox" class="form-control-search" placeholder="Search">
                </form>
            </div>
        </div>
        <div id="load_search_products">
            @csrf
            <input type="hidden" name="keywords_show_pro" value="{{$keyw}}">
        </div>
    </div>

@section('script')
<script type="text/javascript">
$(document).ready(function() {
    load_pro_searched();

    function load_img_price() { //Load 2 ảnh và load giá tiền
        var x = $('.product_item');
        for(var i = 0; i < x.length; i++){ //Hiển thị giá tiền
            var a = $('#product_item_'+i+' .product_price').text(); 
            var b = parseFloat(a/100).toFixed(2);
            $('#product_item_'+i+' .product_price').text('$'+b);    
            //Hiển thị giá tiền

            //Chỉ hiển thị 2 ảnh sản phẩm
            var n = $('#product_item_'+i+' .product_item_image img');
            for(var j = 0; j < n.length; j++) {
                var m = $('#product_item_'+i+' .product_img'+j+'');
                if(j>1){
                    m.remove();
                }
            }
            //Chỉ hiển thị 2 ảnh sản phẩm

            if(n.hasClass('product_img1')){
                n.removeClass('product_img0').addClass('product_img2');
            }
            if($('.product_img1').hasClass('product_img2')){
                $('.product_img1').removeClass('product_img2');
            }
        }
    }//Load 2 ảnh và load giá tiền

    function load_pro_searched(){ //Load show sản phẩm
        var key = $('input[name="keywords_show_pro"]').val();
        var _token = $('input[name="_token"]').val();

        $.ajax({
            url: '{{url('/load-search-products')}}',
            data:{key:key,_token:_token},
            type: "POST",
            success: function(data) {
                $('#load_search_products').html(data);
                load_img_price();
            }
        })
    }//Load show sản phẩm

});
</script>
@endsection
@endsection