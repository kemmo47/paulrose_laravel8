@extends('layouts.layout')
@section('title', $title) 
@section('content')
<div class="container-xsl">
    <?php 
        $x = ($product->category->category_id == 1) ? ('Products') : (''); 
        $cate_slug = Str::slug($product->category->category_name);
    ?>
    <div class="breadcrumb_details">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
                    <i class="icofont-curved-right"></i>
                <li class="breadcrumb-item"><a href="{{URL::asset('/collections/'.$cate_slug)}}">{{$product->category->category_name}} {{$x}}</a></li>
                    <i class="icofont-curved-right"></i>
                <li class="breadcrumb-item active" aria-current="page">{{$product->product_name}}</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex">
        <div class="gallery_details_product">
            <ul id="imageGallery">
                @foreach($product->gallery as $key => $gal)
                    <li id="imageGallery_thumb_{{$key}}" data-thumb="{{asset('uploads/gallery/'.$gal->gallery_image)}}">
                        <img src="{{asset('uploads/gallery/'.$gal->gallery_image)}}"/>
                        <a class="lslider" data-src="{{asset('uploads/gallery/'.$gal->gallery_image)}}"
                            data-thumb="{{asset('uploads/gallery/'.$gal->gallery_image)}}">
                            <img src="{{asset('uploads/gallery/'.$gal->gallery_image)}}" />
                            <i class="icofont-search-2"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="details_product_info">
            <div class="product_section_details">
                <h2 class="product_name">{{$product->product_name}}</h2>
                <span class="product_evaluate d-flex">
                    <li><i class="icofont-battery-empty"></i></i></li>
                    <li><i class="icofont-battery-empty"></i></i></li>
                    <li><i class="icofont-battery-empty"></i></i></li>
                    <li><i class="icofont-battery-empty"></i></i></li>
                    <li><i class="icofont-battery-empty"></i></i></li>
                </span>
                @if($product->product_ingredient != 0)
                    <div class="smarth_wrapper my-4">
                        <div class="smarth_wrapper_item">
                            <img src="{{asset('uploads/no-gluten.png')}}">
                            <span>Gluten-Free Product</span>
                        </div>
                        @if($product->product_ingredient == 10)
                            <div class="smarth_wrapper_item">
                                <img src="{{asset('uploads/vegan-symbol.png')}}">
                                <span>Vegan</span>
                            </div>
                        @endif
                        <div class="smarth_wrapper_item">
                            <img src="{{asset('uploads/rabbit--v2.png')}}">
                            <span>Cruelty-Free</span>
                        </div>
                        <div class="smarth_wrapper_item">
                            <img src="{{asset('uploads/no-parabens.png')}}">
                            <span>Paraben-Free</span>
                        </div>
                    </div>
                @endif
                <dl class="details_price mt-0">{{$product->product_price}}</dl>
                <div class="shopify-installments">
                    <span>Pay in full or in 4 interest-free installments for orders between $50 and $1000 with</span>
                    <span class="shop_pay">
                        <span class="title_pay">Shop</span>
                        <span class="logo_pay">Pay</span>
                    </span>
                    <span><a href="">Learn more</a></span>
                </div>
                <div class="gallery_color mt-3">
                    @if(!blank($gallery_color))
                        <span class="fw-bold">Color: </span>
                        @foreach($gallery_color as $galcolor) 
                            <span class="gal_color">{{$galcolor->gallery_color}}</span>
                        @endforeach
                    @endif
                </div>
                <div class="gallery_title mt-3">
                    @if(!blank($gallery_title))
                        <p class="fw-bold">Title: <span class="display_title_text fw-lighter"></span></p>
                        <div class="gallery_title_container">
                            @foreach($gallery_title as $key => $gal_title)
                            <button id="goToSlide_{{$key}}" class="btn btn-light gal_title {{$key==0 ? 'active_title' : ''}}">
                                {{$gal_title->gallery_title}}
                            </button>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="pb-5 border-bottom form_product_details">
                    @csrf
                    <div class="product_quantity my-3">
                        <p class="fw-bold h4">Quantity</p>
                        <div class="quantity buttons_added" id="btn_quantity_pro_modal_{{$product->product_id}}">
                            <input type="button" value="-" class="btn minus">
                            <input type="number" step="1" min="1" max="" name="product_quantity" value="1" 
                                title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">
                            <input type="button" value="+" class="btn plus">
                        </div>
                    </div> 
                    <div class="group_btn_details">
                        <a class="mb-2 btn_form_details btn_add_my_cart text-decoration-none" 
                            data-pro_id="{{$product->product_id}}">Add to Cart</a>
                        <button class="mb-2 btn_form_details buy_it_now">Buy it now</button> 
                    </div>
                </div>
                <div class="trustpitcher-pitchbox-container">
                    <div class="trustpitcher-pitchbox-box">
                        <img height="46" width="46" src="https://cdn.trustpitcher.com/assets/svg_icons/guarantee.svg" alt="">
                        <p>Customer Satisfaction Guaranteed.</p>
                    </div>
                    <div class="trustpitcher-pitchbox-box">
                        <img  height="46" width="46" src="https://cdn.trustpitcher.com/assets/svg_icons/shield.svg" alt="">
                        <p>Safe Checkout with 128bit Encryption.</p>
                    </div>
                    <div class="trustpitcher-pitchbox-box">
                        <img height="46" width="46" src="https://cdn.trustpitcher.com/assets/svg_icons/shipped.svg" alt="">
                        <p>Free Shipping over $59</p>
                    </div>
                    <div class="trustpitcher-pitchbox-box">
                        <img height="46" width="46" src="https://cdn.trustpitcher.com/assets/svg_icons/box-4.svg" alt="">
                        <p>Hassel free returns</p>
                    </div>
                </div>
                <div class="trustpitcher-trustbadges-container">
                    <div class="trustpitcher-trustbadges-trusttext-container">
                        <p class="trustpitcher-trustbadges-trusttext">Secure Checkout</p>
                    </div>
                    <div class="trustpitcher-trustbadges-badges-container">
                        <i class="fab fa-google-wallet"></i>
                        <i class="fab fa-cc-paypal"></i>
                        <i class="fab fa-cc-discover"></i>
                        <i class="fab fa-cc-mastercard"></i>
                        <i class="fab fa-cc-visa"></i>
                        <i class="fab fa-cc-amex"></i>
                    </div>
                </div>
                <div class="product_description_container my-3">
                    <div class="rte_description">
                        <?php echo $product->product_desc; ?>
                    </div>
                </div>
                <div class="share-icons">
                    <a href=""><i class="icofont-facebook"></i></a>
                    <a href=""><i class="icofont-twitter"></i></a>
                    <a href=""><i class="icofont-pinterest"></i></a>
                </div>
                <div class="contact-us my-3">
                    <a href="" class="text-dark">Contact us</a>
                </div>
            </div>
        </div>
    </div>

    <div id="show_product_related">
        @csrf
    </div>

    <div id="show_retaled_product"><!-- Sản phẩm liên quan -->
        @csrf
        <input type="hidden" value="{{$product->subcategory_id}}" name="subcate_show_related">
        <input type="hidden" value="{{$product->category_id}}" name="cate_show_related">
    </div><!-- Sản phẩm liên quan -->

</div>
@section('script')
<script type="text/javascript">
    $(document).ready(function() { //Gallery hình ảnh chi tiết sp
        load_related();

        var countgal = $('#imageGallery li');
        if(countgal.length >= 2){
            var slider = $('#imageGallery').lightSlider({
                gallery:true,
                item:1,
                thumbItem:5,
                slideMargin:0,
                vertical:true,
                enableDrag: true,
                prevHtml: '<i class="icofont-rounded-up"></i>',
                nextHtml: '<i class="icofont-rounded-down"></i>',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslider'
                    });
                }   
            });  //Gallery hình ảnh chi tiết sp 
        }else{
            var slider = $('#imageGallery').lightSlider({
                prevHtml: '',
                nextHtml: '',
                item:1,
                vertical:true,
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslider'
                    });
                }   
            });  //Gallery hình ảnh chi tiết sp 
        }
            
        $('.gal_title').click(function() { //button di chuyển tới từng ảnh chi tiết
            $('.gal_title ').removeClass('active_title');
            $(this).addClass('active_title');
            const b = $('.active_title').text();
            $('.display_title_text').text(b);

            var gal_id = $('.active_title').attr('id');
            var key = gal_id.slice(10);
            slider.goToSlide(key);
        })//button di chuyển tới từng ảnh chi tiết

        function load_related(){ // load sản phâm liên quan
            var sub_id = $('input[name="subcate_show_related"]').val();
            var cate_id = $('input[name="cate_show_related"]').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/show-related-product')}}',
                method: 'post',
                data: {cate_id:cate_id,sub_id:sub_id,_token:_token},
                success: function(data){
                    $('#show_retaled_product').html(data);
                }
            });
        }// load sản phâm liên quan


    });
</script>

<script type="text/javascript"> // nút chọn số lượng sản phẩm để thêm giỏ hàng or thanh toán
    function wcqib_refresh_quantity_increments(){jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(e,d){
    var f=jQuery(d);f.addClass("buttons_added"),f.children().first().before('<input type="button" value="-" class="btn minus"/>'),f.children().last()
    .after('<input type="button" value="+" class="btn plus"/>')})}String.prototype.getDecimals||(String.prototype.getDecimals=function(){var d=this,c=(""+d)
    .match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);return c?Math.max(0,(c[1]?c[1].length:0)-(c[2]?+c[2]:0)):0}),jQuery(document).ready(function(){
    wcqib_refresh_quantity_increments()}),jQuery(document).on("updated_wc_div",function(){wcqib_refresh_quantity_increments()}),jQuery(document)
    .on("click",".plus, .minus",function(){var g=jQuery(this).closest(".quantity").find(".qty"),f=parseFloat(g.val()),j=parseFloat(g.attr("max")),
    i=parseFloat(g.attr("min")),h=g.attr("step");f&&""!==f&&"NaN"!==f||(f=0),""!==j&&"NaN"!==j||(j=""),""!==i&&"NaN"!==i||(i=0),"any"!==h&&""!==h&&void 
    0!==h&&"NaN"!==parseFloat(h)||(h=1),jQuery(this).is(".plus")?j&&f>=j?g.val(j):g.val((f+parseFloat(h)).toFixed(h.getDecimals())):i&&f<=i?g.val(i):f>0&&g
    .val((f-parseFloat(h)).toFixed(h.getDecimals())),g.trigger("change")});
</script>

<script type="text/javascript">
    $(document).ready(function(){ // Hiển thị màu sản phẩm or title sp
        var text_co = $('.gal_color').text();
        var gal_co = $('.gallery_color');
        var text_ti = $('.gal_title').text();
        var gal_ti = $('.gallery_title');

        if(text_co == ''){
            gal_co.remove();
        }
        if(text_ti == ''){
            gal_ti.remove();
        }
        // Hiển thị màu sản phẩm or title sp
        const a = $('.active_title').text();
        $('.display_title_text').text(a);

        //add Cart

    })   
</script>

@endsection
@endsection