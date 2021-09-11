@extends('layouts.layout')
@section('title', $title) 
@section('content')
    <div class="container-xsl">
        <?php 
            $x = ($catepro->category_id == 1) ? ('Products') : (''); 
            $cate_slug = Str::slug($catepro->category_name);
        ?>
        <div class="my-3 text-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mt-5 mb-4">
                    <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
                    <i class="icofont-curved-right"></i>
                    <li class="breadcrumb-item active" aria-current="page">{{$catepro->category_name}} {{$x}}</li>
                </ol>
            </nav>
            <h2 class="mb-5">{{$catepro->category_name}} {{$x}}</h2>
        </div>
        <p class="mb-4">{{$catepro->category_desc}}</p>
        <div class="row">
            <div class="col-sm-3 product_cate_left">
                <div class="text-center">
                    <img width="98%" src="{{asset('/uploads/category/'.$catepro->category_image)}}" alt="">
                </div>
                <div class="product-filter">
                    <select class="form-select" id="category-filter-sort" name="sort">
                        <!-- <option value="{{Request::url()}}?sort_by=manual">Featured</option>
                        <option value="{{Request::url()}}?sort_by=best-selling">Best selling</option> -->
                        <option value="{{Request::url()}}?sort_by=title-ascending">Alphabetically, A-Z</option>
                        <option value="{{Request::url()}}?sort_by=title-descending">Alphabetically, Z-A</option>
                        <option value="{{Request::url()}}?sort_by=price-ascending">Price, low to high</option>
                        <option value="{{Request::url()}}?sort_by=price-descending">Price, high to low</option>
                        <option value="{{Request::url()}}?sort_by=created-ascending">Date, old to new</option>
                        <option value="{{Request::url()}}?sort_by=created-descending">Date, new to old</option>
                    </select>
                </div>
                <div class="category_list_product">
                    <div class="border-bottom py-1 fs-4">
                        Explore
                    </div>
                    <div class="list_menu_cate my-2">
                        <a href="">Home</a>
                        @foreach($category as $cate)
                            <?php $slug = Str::slug($cate->category_name); ?>
                            <a href="{{URL::asset('/collections/'.$slug)}}">{{$cate->category_name}}</a>
                        @endforeach 
                        <a href="">About Us</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 product_cate_right">
                <div class="show_product">
                    @foreach ($product as $key => $pro)
                        <div class="product_item" id="product_item_{{$key}}">
                            <div class="product_item_image">
                                <a href="{{URL::asset('/collections/'.$cate_slug.'/product/'.$pro->product_slug)}}">
                                    @foreach ($pro->gallery as $i => $gal)
                                        <img class="product_img{{$i}}" src="{{asset('/uploads/gallery/'.$gal->gallery_image)}}" width="100%" alt="">
                                    @endforeach
                                </a>
                                <button type="button" onclick="OpenDetailsModal({{$pro->product_id}})" class="btn btn-dark quick_view_pro" data-bs-toggle="modal" 
                                    data-bs-target="#quickviewModal{{$pro->product_id}}">Quick view
                                </button>
                            </div>
                            <div class="product_item_info">
                                <a href="{{URL::asset('/collections/'.$cate_slug.'/product/'.$pro->product_slug)}}">
                                    <span>{{$pro->product_name}}</span>
                                </a>
                                <dl class="mt-1 product_price">{{$pro->product_price}}</dl>
                            </div>

                            <!-- Modal Quick view -->
                            <div class="modal fade" id="quickviewModal{{$pro->product_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <ul id="sliderGalleryModal_{{$pro->product_id}}">
                                                        @foreach($pro->gallery as $gal)
                                                            <li>
                                                                <img src="{{asset('uploads/gallery/'.$gal->gallery_image)}}"/>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="container_pro_modal">
                                                        <div class="product_item_info_modal">
                                                            <a href="{{URL::asset('/collections/'.$cate_slug.'/product/'.$pro->product_slug)}}">
                                                                <span>{{$pro->product_name}}</span>
                                                            </a>
                                                            <dl class="mt-1 product_price_modal">{{$pro->product_price}}</dl>
                                                        </div>
                                                        <div class="shopify-installments">
                                                            <span>Pay in full or in 4 interest-free installments for orders between $50 and $1000 with</span>
                                                            <span class="shop_pay">
                                                                <span class="title_pay">Shop</span>
                                                                <span class="logo_pay">Pay</span>
                                                            </span>
                                                            <span><a href="" class="text-decoration-underline">Learn more</a></span>
                                                        </div>
                                                        <div class="form_quantity_pro_modal">
                                                            <span>Quantity</span>
                                                            <div class="btn_quantity_pro_modal" id="btn_quantity_pro_modal_{{$pro->product_id}}">
                                                                <button class="btn_remove_qty_item_modal" onclick="removeQuantity({{$pro->product_id}})"><i class="icofont-ui-remove"></i></button>
                                                                <input type="number" step="1" min="1" max="" id="product_quantity_cart_modal_{{$pro->product_id}}" 
                                                                    name="product_quantity" oninput="validity.valid||(value='');" value="1">
                                                                <button class="btn_add_qty_item_modal" onclick="addQuantity({{$pro->product_id}})"><i class="icofont-ui-add"></i></button>
                                                            </div>
                                                        </div>
                                                        <button class="btn_add_to_cart_modal btn_add_my_cart" data-pro_id="{{$pro->product_id}}">
                                                            Add to cart
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-1">
                                                    <div class="btn_close_pro_modal">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Quick view -->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@section('script')
<script type="text/javascript">
$(document).ready(function() {
    var x = $('.product_item');
    for(var i = 0; i < x.length; i++){ //Hiển thị giá tiền
        var a = $('#product_item_'+i+' .product_price').text(); 
        var b = parseFloat(a/100).toFixed(2);
        $('#product_item_'+i+' .product_price').text('$'+b);    
        //Hiển thị giá tiền

        //Hiển thị giá tiền modal
            var am = $('#product_item_'+i+' .product_price_modal').text(); 
            var bm = parseFloat(am/100).toFixed(2);
            $('#product_item_'+i+' .product_price_modal').text('$'+bm);    
        //Hiển thị giá tiền modal

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
});
</script>

<script type="text/javascript">
	$(document).ready(function() { // Lọc sản phẩm
		$('#category-filter-sort').on('change', function() {
			var url = $(this).val();
			if(url){
				window.location = url;
			}
			return false;
		})
	})// Lọc sản phẩm
</script>
@endsection
@endsection