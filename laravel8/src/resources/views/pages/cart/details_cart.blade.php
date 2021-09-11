@extends('layouts.layout')
@section('title', $title) 
@section('content')
    <div class="container-xsl">
        <div class="breadcrumb_details">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
                        <i class="icofont-curved-right"></i>
                    <li class="breadcrumb-item active" aria-current="page">Your Shopping Cart</li>
                </ol>
            </nav>
        </div>
    
        <div class="cart_header_wrapper">
            <a href="{{asset('/collections/cosmetic?sort_by=price-ascending')}}">
                <i class="icofont-rounded-left"></i>Continue Shopping
            </a>
            <h3>Cart</h3>
            <p><span class="item_bag_cart">0</span> Item(s)</p>
        </div>
        @if(Session::has('Cart') != null)
            <div class="row">
                <div class="col-md-12">
                    <div class="list_all_my_cart" id="table_my_cart">
                        @csrf
                    </div>
                </div>
            </div>
            <div class="row show_checkout_my_cart">
                <div class="col-md-6">
                    <div class="ajax_cart_info_wrapper">
                        <div class="cart__accordion">
                            <li class="has_sub_menu close_note">
                                <a>Leave a note with your order</a>
                                <i class="icofont-ui-add"></i>
                            </li>
                            <ul class="accordion-content">
                                <textarea name="note_cart" id="note_cart" rows="5"></textarea>
                            </ul>
                        </div>
                        <div class="cart_free_ship">
                            <div class="cart-shipping-countdown">
                                <p>Your order qualifies for Free Domestic Shipping!</p>
                                <small>(Excludes International)</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="ajax_cart_final_details">
                        <div class="subtotal_cart">
                            <span>Subtotal</span>
                            <span class="price_sub_list_my_cart">{{Session::get('Cart')->totalPrice}}</span>
                        </div>
                        <div class="shipping_cart">
                            <span>Shipping</span>
                            <span>Calculated at checkout</span>
                        </div>
                        <div class="discounts_cart"></div>
                        <hr>
                        <div class="total_my_cart">
                            <span>Total</span>
                            <span class="price_total_list_my_cart"></span>
                        </div>
                    </div>
                    <div class="button_checkout_cart mt-3">
                        <a href="" class="btn">Check Out</a>
                    </div>
                </div>
            </div>
        @endif

    </div>

@section('script')
<script type="text/javascript">
    load_details_cart();
    function load_details_cart() { //Load show bảng chi tiết sản phẩm
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '{{url('/load-details-my-cart')}}',
            method: 'post',
            data: {_token:_token},
            success: function(data){
                $('#table_my_cart').html(data);
                RenderCart();
                load_price_cart();
            }
        })
    }//Load show bảng chi tiết sản phẩm

    function load_cart(){ //load giỏ hàng
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '{{url('/load-my-cart')}}',
            method: 'post',
            data: {_token:_token},
            success: function(data){
                $('#my_cart').html(data);
                RenderCart();
            }
        })
    }//load giỏ hàng

    function RenderCart(){ //load số lượng sản phẩm trong giỏ hàng model
        const qty = $('input[name="quantity_product_cart"]').val();
        if(qty>0){
            $('.item_bag_cart').empty();
            $('.item_bag_cart').append(qty);
        }
    }//load số lượng sản phẩm trong giỏ hàng model

    function load_price_cart() {//hiển thị tổng giá tiền trước khi checkout
        const list_sub_price = $('.price_sub_list_my_cart').text(); 
        if(list_sub_price.includes("$")){
            var countPrice = $('#table_my_cart .tr_ajax_list_my_cart');
            var subPrices = 0;
            for(h=0;h<countPrice.length;h++){ 
                var price_td = $('#pro_total_price_list_cart_'+h+'').text(); 
                var price_td_num = price_td.slice(1);
                subPrices += parseFloat(price_td_num);
            }
            $('.price_sub_list_my_cart').text('$'+subPrices);
            $('.price_total_list_my_cart').text('$'+subPrices);
        }else{
            const show_list_total_price = parseFloat(list_sub_price/100).toFixed(2);
            $('.price_sub_list_my_cart').text('$'+show_list_total_price);
            $('.price_total_list_my_cart').text('$'+show_list_total_price);
        }
    }//hiển thị tổng giá tiền trước khi checkout
    
    $('#table_my_cart').on('click','.item_close_details i',function() { //xóa sản phẩm trong chi tiết giỏ hàng
        var pro_id = $(this).data('id');
        var pro_name = $(this).data('pro_name');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '{{url('/del-my-cart')}}',
            method: 'post',
            data: {pro_id:pro_id,_token:_token},
            success: function(data){
                swal('Xóa sản phẩm '+pro_name+' trong giỏ hàng thành công');
                load_cart();
                load_details_cart();
            }
        })
    }) //xóa sản phẩm trong chi tiết giỏ hàng

    function EditMyCart(id) { //update số lượng sản phẩm trong giỏ hàng model
        var qty = $('#product_quantity_cart_'+id+'').val();
        var _token = $('input[name="_token"]').val();
        if(qty == ''){
            swal("Error!", "Số lượng muốn thay đổi không hợp lệ", "danger");
        }else{
            $.ajax({
                url: '{{url('/update-my-cart')}}',
                method: 'post',
                data: {id:id,qty:qty,_token:_token},
                success: function(data){
                    swal('Cập nhập số lượng sản phẩm thành công');
                    load_cart();
                    load_details_cart();
                }
            })
        }
    } //update số lượng sản phẩm trong giỏ hàng model

</script>
@endsection
@endsection