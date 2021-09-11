<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Styles -->
    <link href="{{ asset('fontend/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('fontend/css/cssfontend.css') }}" rel="stylesheet">

	<link rel="stylesheet" href="{{URL::asset('owlcarousel/assets/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{URL::asset('owlcarousel/assets/owl.theme.default.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
    <link rel="stylesheet" href="{{asset('fontend/css/lightslider.css')}}" />
    <link rel="stylesheet" href="{{asset('fontend/css/prettify.css')}}" />
    <link rel="stylesheet" href="{{asset('fontend/css/lightgallery.min.css')}}" />
    
    <!-- Fonts -->
    <script src="{{URL::to('js/icondep.js')}}" crossorigin="anonymous"></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <!-- Icon -->
    <link rel="stylesheet" href="{{ asset('icofont/icofont.min.css') }}">

</head>
<body>
    <header>
        <div class="top-header">
            <div class="container-xsl">
                <div class="header-ingredient">
                    <div class="text-center center-top-header">
                        <div class="my-3">Free shipping on all Purchase $59 and up!</div>
                        <div class="my-3">30-Day returns made easy</div>
                    </div>
                    <div class="top_header_right mt-3">
                        <div class="d-flex">
                            <a href="javascript:void(0)" class="pe-2 btn_searchbox">
                                <i class="icofont-search-2"></i>
                            </a>
                            <a href="" class="pe-2"><i class="icofont-user-alt-7"></i></a>
                            <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalShowCart">
                                MY CART
                                <span class="ps-2"><i class="icofont-bag"></i><span class="item_bag_cart">0</span></span>
                            </a>
                        </div>
                        <form action="{{asset('/search-keywords')}}" method="POST">
                            @csrf
                            <div class="input-group animate-hide fadeOut" id="form_searchnox">
                                <input type="search" id="searchbox" class="form-control" autocomplete="off"
                                    name="searchbox" placeholder="Search" aria-label="Username" aria-describedby="basic-addon1">
                                <button type="submit" class="input-group-text" id="basic-addon1"><i class="icofont-ui-search"></i></button>
                            </div>
                            <div id="show_item_search"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="img_logo text-center">
            <button class="navbar_toggler" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalShowMenu">
                <i class="icofont-listine-dots"></i>
            </button>
            <a href="/">
                <img src="https://cdn.shopify.com/s/files/1/0536/8623/9393/files/paul_rose_logo_no_background_2_600x.png?v=1615770507" width="300px" alt="Paul Rose" itemprop="logo">
            </a>
            <span class="ps-2 icofont_bag" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalShowCart"><i class="icofont-bag"></i><span class="item_bag_cart">0</span></span>
        </div>
    </header>

        <!-- Modal Menu-->
            <div class="modal fade" id="exampleModalShowMenu" tabindex="-1" aria-labelledby="exampleModalLabelShowMenu" aria-hidden="true">
                <div class="modal-dialog modal_dialog_menu">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="content_modal_card d-flex justify-content-between">
                                <span>CART<strong class="ml-2"><span class="item_bag_cart">0</span></strong></span>
                                <span><i class="icofont-bag"></i></span>
                            </div>
                            <div class="show_menu_modal my-3">
                                <div class="menu_category"><a href="{{asset('/')}}">Home</a></div>
                                @foreach ($category as $key => $cate_col)
                                    <?php $x = str_replace('and', '&', $cate_col->category_name); ?>
                                    @if(!blank($cate_col->subcategory))
                                        <div class="menu_category">
                                            <div class="d-flex bd-highlight">
                                                <a href="" class="flex-grow-1 bd-highlight">{{$x}}</a>
                                                <div class="bd-highlight hr-straight"></div>
                                                <a class="collapse_menu collapsed bd-highlight" id="IconShow{{$cate_col->category_id}}" data-bs-toggle="collapse" href="#collapseShowMenu{{$cate_col->category_id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                    <i class="icofont-simple-down"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <!-- collapse menu--><div class="collapse" id="collapseShowMenu{{$cate_col->category_id}}"> 
                                                <ul class="list-group list-group-flush">
                                                    @foreach($cate_col->subcategory as $key => $sub_col)
                                                        <li class="list-group-item"><a href="">{{$sub_col->subcategory_name}}</a></li>
                                                    @endforeach
                                                </ul>
                                        <!-- collapse menu--></div>
                                    @else
                                        <div class="menu_category"><a href="">{{$x}}</a></div>
                                    @endif
                                @endforeach
                                
                                <div class="menu_category"><a href="">About Us</a></div>
                                <div class="menu_category"><i class="icofont-user-alt-7"></i><a href="">Log In/Create Account</a></div>
                            </div>
                            <div class="menu_category" style="padding: 10px 10px 0px 10px;">
                                <form action="">
                                    <input type="search" class="form-menu-search" placeholder="Search">
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <p class="fw-bold">Buy 2, Get 1 Free Lashes</p>
                            <span>All Paul Rose Lashes are buy 2, get 1 free!</span>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Modal Menu-->
        <!-- Modal Cart-->
            <div class="modal fade modal_dialog_cart" id="exampleModalShowCart" tabindex="-1" aria-labelledby="exampleModalLabelShowCart" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <h5 class="modal-title" id="exampleModalLabelShowCart">Cart</h5>
                            <span><span class="item_bag_cart">0</span> Item(s)</span>
                        </div>
                        <div class="modal-body">
                            <div id="my_cart">
                                @csrf
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Modal Cart-->

    <nav class="navbar navbar-expand-lg border-bottom border-3 pb-0 sticky-top navbar_sticky">
        <div class="body_navbar_bot">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item px-2"><a class="nav-link" href="{{asset('/')}}">Home</a></li>
                        @foreach ($category as $key => $cate)
                            <?php 
                                $slug = Str::slug($cate->category_name); 
                                $y = str_replace('and', '&', $cate->category_name);
                            ?>
                            @if(!blank($cate->subcategory))
                                <li class="nav-item dropdown has-megamenu px-2"> 
                                    <a class="nav-link dropdown-toggle" href="{{URL::asset('/collections/'.$slug)}}">{{$y}}</a>
                                    <div class="dropdown-menu megamenu" role="menu">
                                        <div class="row">
                                            <div class="col-12 col-sm-3 text-center">
                                                <img src="{{asset('/uploads/category/'.$cate->category_image)}}" width="100%" alt="">
                                            </div>
                                            <div class="col-12 col-sm-9">
                                                <div class="d-flex align-content-between flex-wrap">
                                                    @foreach($cate->subcategory as $key => $sub)
                                                        <a href="{{URL::asset('/collections/'.$slug.'/'.$sub->subcategory_id)}}" class="flex_a4">
                                                            <div class="p-2 pt-0 lh-1 bd-highlight">{{$sub->subcategory_name}}</div>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @else
                                <li class="nav-item px-2"><a class="nav-link" href="{{URL::asset('/collections/'.$slug)}}">{{$y}}</a></li>
                            @endif
                        @endforeach
                    <li class="nav-item px-2"><a class="nav-link" href="#">About Us</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="body my-4">
        @yield('content')
        @csrf
    </div>

    <footer>
        <div class="container-xsl">
            <div class="footer pt-5">
                <div class="top-footer mb-5">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <p class="p_footer">Explore</p>
                            <p>Search</p>
                            <p>About Us</p>
                            <p>Return Policy</p>
                            <p>Shipping Policy</p>
                            <p>Terms of Service</p>
                            <p>Privacy Policy</p>
                            <p>Affiliate Register Page</p>
                        </div>
                        <div class="col-12 col-md-8">
                            <p class="p_footer">Connect</p>
                            <p>Join our mailing list for updates</p>
                            <div class="connect_email">
                                <div class="input-group mt-3">
                                    <input type="email" class="form-control" placeholder="Enter Email Address" style="height: 50px;">
                                    <button class="btn">Join</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-5">
                <div class="bot-footer pb-3 mt-5">
                    <div class="footer_payment d-flex justify-content-between">
                        <p>Copyright © 2021 <a href="/" class="text-decoration-none text-dark">Paul Rose</a></p>
                        <div class="payment_logo d-flex">
                            <div class="logo_payment icon_amex" title="American Express"></div>
                            <div class="logo_payment icon_apple" title="Apple Pay"></div>
                            <div class="logo_payment icon_dinersclub" title="Diners Club"></div>
                            <div class="logo_payment icon_discover" title="Discover"></div>
                            <div class="logo_payment icon_elo" title="Elo"></div>
                            <div class="logo_payment icon_googlepay" title="Google Pay"></div>
                            <div class="logo_payment icon_jcb" title="JCB"></div>
                            <div class="logo_payment icon_master" title="Mastercard"></div>
                            <div class="logo_payment icon_paypal" title="PayPal"></div>
                            <div class="logo_payment icon_shopify" title="Shop Pay"></div>
                            <div class="logo_payment icon_venmo" title="Venmo"></div>
                            <div class="logo_payment icon_visa" title="Visa"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<!-- Scripts -->
    <script src="{{asset('jquery/dist/jquery.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{URL::asset('owlcarousel/owl.carousel.min.js')}}"></script>  
    <script src="{{URL::asset('owlcarousel/owl.carousel.js')}}"></script>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{asset('js/lightslider.js')}}"></script> 
    <script src="{{asset('js/lightgallery-all.min.js')}}"></script> 
    <script src="{{asset('js/prettify.js')}}"></script> 

    <!-- Scripts -->

<!-- Js -->
@yield('script')
<script> 
    $(document).ready(function(){ //show Ô tìm kiếm
        var searchForm = $('#form_searchnox');
        $(".btn_searchbox").click(function(){
            if(searchForm.hasClass("fadeOut")){ 
                searchForm.removeClass(["fadeOut","animate-hide"]).addClass(["fadeIn","animate-show"])
            }else if(searchForm.hasClass("fadeIn")){ 
                searchForm.removeClass(["fadeIn","animate-show"]).addClass(["fadeOut","animate-hide"]) 
            }
        }); 
    });//show Ô tìm kiếm

    //Tìm kiếm
        $('#searchbox').keyup(function() {
            var keyword = $(this).val();
            var _token = $('input[name="_token"]').val();
        
            if(keyword != ''){
                $.ajax({
                    url: '{{url('/search-item')}}',
                    data:{ keyword: keyword,_token:_token},
                    type: 'POST',
                    success: function(data){
                        $('#show_item_search').fadeIn();
                        $('#show_item_search').html(data);
                    }
                })
            }else{
                $('#show_item_search').fadeOut();
            }
            $('.btn_searchbox').click(function() {
                if($('#form_searchnox').hasClass('fadeOut')){
                    $('#searchbox').val('');
                    $('#show_item_search').fadeOut();
                }
            })
            $('#searchbox').blur(function() {
                $('#show_item_search').fadeOut();
            })

        })
    //Tìm kiếm

    $(document).ready(function(){ // slider hình ảnh
        $('.owl_carousel_cosmetics').owlCarousel({ 
            items:4,
            loop:true,
            margin:10,
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:true
        });
    });
    
    $(document).ready(function(){
        $('.owl_carousel_insfavor').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            dots: false,
            responsive:{ 
                0:{
                    items:1
                }, 
                600:{ 
                    items:2
                },
                1000:{ 
                    items:4
                }
            }
        });
        var owlNav = $('.owl-nav');
        if(owlNav.hasClass('disabled')){
            $(owlNav).css("display", "flex").addClass('btn_prev');
        } 
    });// slider hình ảnh

    $(document).ready(function(){ // thay đổi kích thước div theo chiều rộng của web
        $(window).resize(function(){ 
            var b = $('.navbar_sticky');
            var x = $('body').css("width"); 
            var a = x.slice(0,-2); 
            var y = Number(a) + 17;
            if(y <= 990){ 
                $("header").addClass('sticky-top'); 
                b.appendTo( $("header") );
            }else if( ($("header").hasClass('sticky-top')) && (y > 990) ){
                $("header").removeClass('sticky-top').after(b);
            } 
        });
    });// thay đổi kích thước div theo chiều rộng của web

$(document).ready(function(){ // show subcate menu khi màn hình thu nhỏ
    $('.collapse_menu').click(function(){
        var x = $(this).attr('href').slice(17);
        var i = $('#IconShow'+x+'');

        i.toggleClass('rotate-up');
        if(i.hasClass('rotate-up')){
            i.removeClass('rotate-down');
        }else{
            i.addClass('rotate-down');
        }
    });// show subcate menu khi màn hình thu nhỏ
})

    var details_price = $('.details_price').text(); //hiển thị giá tiền
    var details_prices = parseFloat(details_price/100).toFixed(2);
    $('.details_price').text('$'+details_prices);//hiển thị giá tiền


    load_cart(); 
    $('.btn_add_my_cart').click(function() { //btn Thêm sản phẩm giỏ hàng
        var pro_id = $(this).data('pro_id');
        var pro_qty = $('#btn_quantity_pro_modal_'+pro_id+' input[name="product_quantity"]').val();
        var _token = $('input[name="_token"]').val();
        
        $.ajax({
            url: '{{url('/add-my-cart')}}',
            method: 'post',
            data: {pro_id:pro_id,pro_qty:pro_qty,_token:_token},
            success: function(response){
                swal('Thêm sản phẩm vào giỏ hàng thành công');
                load_cart();
                RenderCart(response);
                $('#btn_quantity_pro_modal_'+pro_id+' input[name="product_quantity"]').val(1);
            }
        });
    })//btn Thêm sản phẩm giỏ hàng

    $('#my_cart').on('click','.item-close i', function(){ //btn xóa sản phẩm giỏ hàng
        var pro_id = $(this).data('id');
        var pro_name = $(this).data('pro_name');
        var _token = $('input[name="_token"]').val();

        $.ajax({
            url: '{{url('/del-my-cart')}}',
            method: 'post',
            data: {pro_id:pro_id,_token:_token},
            success: function(response){
                swal('Xóa sản phẩm '+pro_name+' trong giỏ hàng thành công');
                load_cart();
                RenderCart(response);
            }
        })
    })//btn xóa sản phẩm giỏ hàng

    function load_cart(){ //load giỏ hàng
        var _token = $('input[name="_token"]').val();

        $.ajax({
            url: '{{url('/load-my-cart')}}',
            method: 'post',
            data: {_token:_token},
            success: function(response){
                $('#my_cart').html(response);
                RenderCart(response);
            }
        })
    }//load giỏ hàng

    function RenderCart(data){ //load số lượng sản phẩm trong giỏ hàng
        const qty = $('input[name="quantity_product_cart"]').val();
        if(qty>0){
            $('.item_bag_cart').empty();
            $('.item_bag_cart').append(qty);
        }
    }//load số lượng sản phẩm trong giỏ hàng

    
    //button điều chỉnh số lượng sản phẩm trong modal
    $('input[name="product_quantity"]').change(function(){//khi nhấn vào input tự nhập số lượng
        var myQty = $(this).val();
        if(myQty == ''){
            $(this).val(1);
        }
    }); //khi nhấn vào input tự nhập số lượng

    function removeQuantity(id) { // giảm số lượng sản phẩm khi thêm giỏ hàng
        var qty_re = $('#product_quantity_cart_modal_'+id+'').val();
        if(qty_re>1){
            qty_re--;
            $('#product_quantity_cart_modal_'+id+'').val(qty_re);
        }
    }// giảm số lượng sản phẩm khi thêm giỏ hàng
    
    function addQuantity(id) { // thêm số lượng sản phẩm khi thêm giỏ hàng
        var qty_ad = $('#product_quantity_cart_modal_'+id+'').val();
        if(qty_ad<99){
            qty_ad++;
            $('#product_quantity_cart_modal_'+id+'').val(qty_ad);
        }else{
            swal('Vượt quá số lượng cho phép');
        }
    }// thêm số lượng sản phẩm khi thêm giỏ hàng
    
    function OpenDetailsModal(id) { //show modal xem nhanh sản phẩm
        if($('#sliderGalleryModal_'+id+' img').length>=2){
            $('#sliderGalleryModal_'+id+'').lightSlider({
                item:1,
                vertical:true,
                prevHtml:'<i class="icofont-rounded-up"></i>',
                nextHtml:'<i class="icofont-rounded-down"></i>',
                pager: false,
                addClass:'form_gallery_modal',
            });  
        }else{
            $('#sliderGalleryModal_'+id+'').lightSlider({
                item:1,
                vertical:true,
                controls:false,
                pager: false,
                addClass:'form_gallery_modal',
            });  
        }
    }//show modal xem nhanh sản phẩm

</script>

</body>
</html>