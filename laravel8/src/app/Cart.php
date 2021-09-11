<?php 
    namespace App;
    class Cart{
        public $products = null;
        public $totalPrice = 0;
        public $totalQty = 0;

        public function __construct($cart){
            if($cart){
                $this->products = $cart->products;
                $this->totalPrice = $cart->totalPrice;
                $this->totalQty = $cart->totalQty;
            }
        }

        public function AddCart($product, $id, $pro_qty){
            $newProduct = ['qty'=>0, 'price'=>$product->product_price, 'productinfo'=>$product];
            if($this->products){
                if(array_key_exists($id, $this->products)){
                    $newProduct = $this->products[$id];
                }
            }
            $newProduct['qty'] += $pro_qty;
            $newProduct['price'] = $newProduct['qty'] * $product->product_price;
            $this->products[$id] = $newProduct;
            $this->totalPrice += $product->product_price * $pro_qty;
            $this->totalQty += $pro_qty;
        }

        public function DeleteCart($id){
            $this->totalQty -= $this->products[$id]['qty'];
            $this->totalPrice -= $this->products[$id]['price'];
            unset($this->products[$id]);
        }

        public function UpdateCart($id,$qty){
            $this->totalQty -= $this->products[$id]['qty'];
            $this->totalPrice -= $this->products[$id]['price'];

            $this->products[$id]['qty'] = $qty;
            $this->products[$id]['price'] = $qty * $this->products[$id]['productinfo']->product_price;

            $this->totalQty += $this->products[$id]['qty'];
            $this->totalPrice += $this->products[$id]['price'];
        }

    }
?>