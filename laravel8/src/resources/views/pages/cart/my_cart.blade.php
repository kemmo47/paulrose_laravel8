@if(Session::has('Cart') != null)
    <div class="show_item_my_cart">
        <table>
            <tbody>
                <?php $i=-1; ?>
                @foreach(Session::get('Cart')->products as $pro)
                <?php $i++; $slug_pro_name = Str::slug($pro['productinfo']->category->category_name); ?>
                    <tr class="item-body">
                        <td class="item-pic">
                            <a href="{{URL::asset('/collections/'.$slug_pro_name.'/product/'.$pro['productinfo']->product_slug)}}">
                                <img src="{{asset('/uploads/gallery/'.$pro['productinfo']->onegallery->gallery_image)}}" alt="{{$slug_pro_name}}">
                            </a>
                        </td>
                        <td class="item-text">
                            <div class="product_my_cart">
                                <div class="ajax_cart_item_price">
                                    <div class="pro_cart_price_{{$i}}">
                                        <span id="product_my_cart_price_{{$i}}">{{$pro['productinfo']->product_price}}</span> 
                                        <i class="icofont-close"></i> 
                                        <span2>{{$pro['qty']}}</span2>
                                    </div>
                                    <span id="total_pro_price_{{$i}}"></span>
                                </div>
                                <div class="title_cart_product">
                                    <span class="my-1"></span>
                                </div>
                                <h6>
                                    <a href="{{URL::asset('/collections/'.$slug_pro_name.'/product/'.$pro['productinfo']->product_slug)}}">
                                        {{$pro['productinfo']->product_name}}
                                    </a>
                                </h6>
                            </div>
                        </td>
                        <td class="item-close">
                            <i class="icofont-ui-close" data-id="{{$pro['productinfo']->product_id}}" data-pro_name="{{$pro['productinfo']->product_name}}"></i>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <hr class="my-4">
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
    <div class="ajax_cart_final_details">
        <div class="subtotal_cart">
            <span>Subtotal</span>
            <span class="cart_sub_price">{{Session::get('Cart')->totalPrice}}</span>
        </div>
        <div class="shipping_cart">
            <span>Shipping</span>
            <span>Calculated at checkout</span>
        </div>
        <div class="discounts_cart"></div>
        <hr>
        <div class="total_my_cart">
            <span>Total</span>
            <span class="cart_sub_price"></span>
        </div>
    </div>

    <div class="ajax_cart_button">
        <a href="{{asset('/cart')}}" class="btn_ajax_cart btn_view_cart">View Cart</a>
        <a href="" class="btn_ajax_cart btn_check_out">Check Out</a>
    </div>

    <input type="hidden" name="quantity_product_cart" value="{{Session::get('Cart')->totalQty}}">
@else
    <p class="text-center">Chưa có sản phẩm nào trong giỏ hàng</p>
@endif

<script type="text/javascript">
    var pro_cart_price = $('.ajax_cart_item_price');
    for(i=0; i<pro_cart_price.length; i++) {
        var price = $('#product_my_cart_price_'+i+'').text(); //hiển thị giá tiền
        var show_price = parseFloat(price/100).toFixed(2);
        $('#product_my_cart_price_'+i+'').text('$'+show_price);//hiển thị giá tiền

        var qtyPrice = $('.pro_cart_price_'+i+' span2').text();
        var totalPrice = parseFloat(show_price * qtyPrice).toFixed(2);
        $('#total_pro_price_'+i+'').text('$'+totalPrice);
    }

    var sub_price = $('.cart_sub_price').text(); //hiển thị giá tiền
    var show_sub_price = parseFloat(sub_price/100).toFixed(2);
    $('.cart_sub_price').text('$'+show_sub_price);//hiển thị giá tiền
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.has_sub_menu').click(function() {
            $('.accordion-content').toggle(function() {
                $(".accordion-content").css({display: "none"});
            }, function () {
                $(".accordion-content").css({});
            });

            $('.has_sub_menu').toggleClass('close_note');
            if(!($('.has_sub_menu').hasClass('close_note'))){
                $('.has_sub_menu i').removeClass('icofont-ui-add').addClass('icofont-ui-remove');
            }else{
                $('.has_sub_menu i').removeClass('icofont-ui-remove').addClass('icofont-ui-add');
            }
        })
    })
</script>