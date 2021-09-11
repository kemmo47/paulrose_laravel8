<table class="table_my_cart">
    <thead>
        <tr>
            <th>image</th>
            <th>product name</th>
            <th>price</th>
            <th>quantity</th>
            <th>total</th>
            <th>delete</th>
            <th>edit</th>
        </tr>
    </thead>
    <tbody>
        <?php $kc=-1; ?>
        @foreach(Session::get('Cart')->products as $pro_cart)
            <?php $kc++; $slug_pro_name = Str::slug($pro_cart['productinfo']->category->category_name);?>
            <tr class="tr_ajax_list_my_cart">
                <td width="100px">
                    <a href="{{URL::asset('/collections/'.$slug_pro_name.'/product/'.$pro_cart['productinfo']->product_slug)}}">
                        <img src="{{asset('/uploads/gallery/'.$pro_cart['productinfo']->onegallery->gallery_image)}}" alt="">
                    </a>
                </td>
                <td>
                    <a href="{{URL::asset('/collections/'.$slug_pro_name.'/product/'.$pro_cart['productinfo']->product_slug)}}">
                        <p>{{$pro_cart['productinfo']->product_name}}</p>
                    </a>
                </td>
                <td id="pro_price_list_cart_{{$kc}}">{{$pro_cart['productinfo']->product_price}}</td>
                <td id="pro_qty_list_cart_{{$kc}}">
                    <div class="form_change_quantity_cart">
                        <button class="btn_remove_qty_item" id="remove_qty_list_{{$pro_cart['productinfo']->product_id}}">-</button>
                        <input type="number" step="1" min="1" max="" id="product_quantity_cart_{{$pro_cart['productinfo']->product_id}}" name="product_quantity_cart" 
                            value="{{$pro_cart['qty']}}" oninput="validity.valid||(value='');">
                        <button class="btn_add_qty_item" id="add_qty_list_{{$pro_cart['productinfo']->product_id}}">+</button>
                    </div>
                </td>
                <td id="pro_total_price_list_cart_{{$kc}}"></td>
                <td class="item_close_details">
                    <i class="icofont-ui-close" data-id="{{$pro_cart['productinfo']->product_id}}" data-pro_name="{{$pro_cart['productinfo']->product_name}}" title="xóa"></i>
                </td>
                <td>
                    <i class="icofont-edit" onclick="EditMyCart({{$pro_cart['productinfo']->product_id}})" title="Sửa"></i>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


<script type="text/javascript">
    var tr_ajax_list_my_cart = $('.tr_ajax_list_my_cart');
    for(kc=0; kc<tr_ajax_list_my_cart.length; kc++) {//hiển thị giá tiền từng sản phẩm
        var giaTienTungSp = $('#pro_price_list_cart_'+kc+'').text();
        var show_giaTienTungSp = parseFloat(giaTienTungSp/100).toFixed(2);
        $('#pro_price_list_cart_'+kc+'').text('$'+show_giaTienTungSp);//hiển thị giá tiền từng sản phẩm

        var soLuongTungSp = $('#pro_qty_list_cart_'+kc+' input[name="product_quantity_cart"]').val();//hiển thị tổng giá tiền từng sản phẩm
        var tongTienTungSp = parseFloat(giaTienTungSp*soLuongTungSp/100).toFixed(2);
        $('#pro_total_price_list_cart_'+kc+'').text('$'+tongTienTungSp);//hiển thị tổng giá tiền từng sản phẩm
    }//hiển thị giá tiền

    //button điều chỉnh số lượng sản phẩm
    $('input[name="product_quantity_cart"]').change(function(){//khi nhấn vào input tự nhập số lượng
        var myQty = $(this).val();
        if(myQty == ''){
            $(this).val(0);
        }
    }); //khi nhấn vào input tự nhập số lượng

    $('.btn_remove_qty_item').click(function() { //btn giảm số lượng
        var kc = $(this).attr('id');
        var id_kc = kc.slice(16);
        var qty = $('#product_quantity_cart_'+id_kc+'').val();
        if(qty>1){
            qty--;
            $('#product_quantity_cart_'+id_kc+'').val(qty);
        }
    })//btn giảm số lượng

    $('.btn_add_qty_item').click(function() {//btn tăng số lượng
        var kc = $(this).attr('id');
        var id_kc = kc.slice(13);
        var qty = $('#product_quantity_cart_'+id_kc+'').val();
        if(qty<99){
            qty++;
            $('#product_quantity_cart_'+id_kc+'').val(qty);
        }else{
            swal('Vượt quá số lượng cho phép');
        }
    })//btn tăng số lượng

</script>
