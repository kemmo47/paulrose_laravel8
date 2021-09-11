<?php 
    $cate_slug = Str::slug($cate->category_name);
?>

<div class="mb-5 text-center">
    <h3>You may also like</h3>
    <div class="product-loop">
        @foreach ($pro_related as $k => $rel_pro)
            <div class="product_item_related" id="product_item_related_{{$k}}">
                <div class="product_item_image_related">
                    <a href="{{URL::asset('/collections/'.$cate_slug.'/product/'.$rel_pro->product_slug)}}">
                        @foreach ($rel_pro->gallery as $i => $gal)
                            <img class="product_img_related_{{$i}}" src="{{asset('/uploads/gallery/'.$gal->gallery_image)}}" width="100%" alt="">
                        @endforeach
                    </a>
                </div>
                <div class="product_item_info">
                    <a href="{{URL::asset('/collections/'.$cate_slug.'/product/'.$rel_pro->product_slug)}}">
                        <span>{{$rel_pro->product_name}}</span>
                    </a>
                    <dl class="mt-1 product_price">{{$rel_pro->product_price}}</dl>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    var x = $('.product_item_related');
    for(var i = 0; i < x.length; i++){ //Hiển thị giá tiền
        var a = $('#product_item_related_'+i+' .product_price').text(); 
        var b = parseFloat(a/100).toFixed(2);
        $('#product_item_related_'+i+' .product_price').text('$'+b);    
        //Hiển thị giá tiền

        //Chỉ hiển thị 2 ảnh sản phẩm
        var n = $('#product_item_related_'+i+' img');
        for(var j = 0; j < n.length; j++) {
            var m = $('#product_item_related_'+i+' .product_img_related_'+j+'');
            if(j>1){
                m.remove();
            }
        }
        //Chỉ hiển thị 2 ảnh sản phẩm

        if(n.hasClass('product_img_related_1')){
            n.removeClass('product_img_related_0').addClass('product_img_related_2');
        }
        if($('.product_img_related_1').hasClass('product_img_related_2')){
            $('.product_img_related_1').removeClass('product_img_related_2');
        }
    }
})
</script>

