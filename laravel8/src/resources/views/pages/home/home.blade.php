@extends('layouts.layout')
@section('title', 'Paul Rose Products') 
@section('content')
    <div class="container-xsl">
        <div class="background_newfallapparel text-center mb-5">
            <h2 class="text-light">New Fall Apparel</h2>
            <button class="btn btn-dark">Shop now</button>
        </div>
        <div class="mt-5 mb-1 text-center">
            <div class="text_present py-4">
                <p><h4>Bringing Beauty and Elegance from the World to your door!</h4></p>
                <h5>A Chic Boutique that offers Vegan and Cruelty-free Make-up and elegant looks to make you feel confident to conquer it all.</h5>
            </div>
        </div>
        <div class="naturally_vegan_makeup_present my-5">
            <div class="row">
                <div class="col-12 col-md-4 text_naturally_present">
                    <h5 class="mb-3">Naturally Vegan Make-up</h5>
                    <h6>
                        But what does that mean for you? It means all of our products, other than our adhesive lash liner,
                        contain no parabens or sulfates, and are free from phthalates, GMOs and SLS. Each ingredient used 
                        comes from ethical sources, so every product you purchase helps make the world a better place. And 
                        every item is certified 100% cruelty-free, so you can be assured that it has never been tested on 
                        animals.
                    </h6>
                </div>
                <div class="col-12 col-md-4">
                    <div class="img_new_lipstick_shades"></div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="img_lipstick"></div>
                </div>
            </div>
        </div>

        <div class="paul_rose_vegan_cosmetics pt-4 my-4 text-center">
            <h5 class="mb-4">Paul Rose Vegan Cosmetics</h5>
            <div class="owl-carousel owl_carousel_cosmetics owl-theme">
                <div class="item">
                    <div class="category-cosmetics text-center">
                        <div class="category_cosmetics_img">
                            <img class="mb-2" src="https://cdn.shopify.com/s/files/1/0536/8623/9393/products/eyeshadow-97ACB5_9647cee2-283c-4685-9dc6-82fae560bdca_720x.png?v=1627665740" alt="">
                            <button class="btn btn-dark quick_view">QUICK VIEW</button>
                        </div>
                        <a href="" class="text-dark text-decoration-none"><span>Afternoon Blues eyeshadow</span></a>
                        <span><p>$15.00</p></span>
                    </div>
                </div>
                <div class="item">
                    <div class="category-cosmetics text-center">
                        <div class="category_cosmetics_img">
                            <img class="mb-2" src="https://cdn.shopify.com/s/files/1/0536/8623/9393/products/eye-cream-F7C052_720x.png?v=1619268965" alt="">
                            <button class="btn btn-dark quick_view">QUICK VIEW</button>
                        </div>
                        <a href="" class="text-dark text-decoration-none"><span>All natural and Vegan Anti-aging Eye Cream</span></a>
                        <span><p>$35.00</p></span>
                    </div>
                </div>
                <div class="item">
                    <div class="category-cosmetics text-center">
                        <div class="category_cosmetics_img">
                            <img class="mb-2" src="https://cdn.shopify.com/s/files/1/0536/8623/9393/products/day-cream-F7C052_720x.png?v=1619111406" alt="">
                            <button class="btn btn-dark quick_view">QUICK VIEW</button>
                        </div>
                        <a href="" class="text-dark text-decoration-none"><span>All natural Vegan Anti-aging Day Cream</span></a>
                        <span><p>$40.00</p></span>
                    </div>
                </div>
                <div class="item">
                    <div class="category-cosmetics text-center">
                        <div class="category_cosmetics_img">
                            <img class="mb-2" src="https://cdn.shopify.com/s/files/1/0536/8623/9393/products/concealer-F2CEAB_5ec5a385-e8ab-4ff4-8d11-00c18eeaeb8f_720x.png?v=1621194652" alt="">
                            <button class="btn btn-dark quick_view">QUICK VIEW</button>
                        </div>
                        <a href="" class="text-dark text-decoration-none"><span>All natural Vegan Concealer</span></a>
                        <span><p>$20.00</p></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="instagram_favorites pt-4 mt-4 text-center">
            <h5 class="mb-4">Instagram Favorites</h5>
            <div class="owl-carousel owl_carousel_insfavor owl-theme">
                <div class="item">
                    <div class="category-cosmetics text-center">
                        <div class="category_cosmetics_img">
                            <img class="mb-2" src="https://cdn.shopify.com/s/files/1/0536/8623/9393/products/b0c0d06ed0ed4760b5111111fe99c66d_720x.jpg?v=1629129801" alt="">
                            <button class="btn btn-dark quick_view">QUICK VIEW</button>
                        </div>
                        <a href="" class="text-dark text-decoration-none"><span>Plus Size Side Drawstring Top</span></a>
                        <span><p>$39.99</p></span>
                    </div>
                </div>
                <div class="item">
                    <div class="category-cosmetics text-center">
                        <div class="category_cosmetics_img">
                            <img class="mb-2" src="https://cdn.shopify.com/s/files/1/0536/8623/9393/products/173830797cd14e969ec28ba63fba9fb4_720x.jpg?v=1629129536" alt="">
                            <button class="btn btn-dark quick_view">QUICK VIEW</button>
                        </div>
                        <a href="" class="text-dark text-decoration-none"><span>Floral Print Wrap Tie Dress</span></a>
                        <span><p>$35.99</p></span>
                    </div>
                </div>
                <div class="item">
                    <div class="category-cosmetics text-center">
                        <div class="category_cosmetics_img">
                            <img class="mb-2" src="https://cdn.shopify.com/s/files/1/0536/8623/9393/products/6d8ff86fdec64202b26aeec736942021_720x.jpg?v=1629128820" alt="">
                            <button class="btn btn-dark quick_view">QUICK VIEW</button>
                        </div>
                        <a href="" class="text-dark text-decoration-none"><span>Solid Button Blazer & Straight Leg Pants Set</span></a>
                        <span><p>$45.99</p></span>
                    </div>
                </div>
                <div class="item">
                    <div class="category-cosmetics text-center">
                        <div class="category_cosmetics_img">
                            <img class="mb-2" src="https://cdn.shopify.com/s/files/1/0536/8623/9393/products/95f1df697d014473b9fbdf682aa54f28_720x.jpg?v=1629128333" alt="">
                            <button class="btn btn-dark quick_view">QUICK VIEW</button>
                        </div>
                        <a href="" class="text-dark text-decoration-none"><span>Color Block Drop Shoulder Sweater</span></a>
                        <span><p>$39.00</p></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="our_collections my-5">
            <h5 class="mb-4 text-center">Our Collections</h5>
            <div class="row">
                <div class="col-12 col-md-4 text-center">
                    <div class="img-hover-zoom">
                        <img src="https://cdn.shopify.com/s/files/1/0536/8623/9393/files/Cosmetics_540x.png?v=1627490063" alt="">
                    </div>
                    <h6 class="my-3"><p>Natural Beauty Products</p></h6>
                    <p>Shop our vegan, paraben-free, cruelty-free, gluten-free make-up line. We care about your skin and what it takes to keep you feeling beautiful.</p>
                    <button class="btn btn-secondary">Shop Now</button>
                </div>
                <div class="col-12 col-md-4 text-center">
                    <div class="img-hover-zoom">
                        <img src="https://cdn.shopify.com/s/files/1/0536/8623/9393/files/jewelry_540x.png?v=1627490099" alt="">
                    </div>
                    <h6 class="my-3"><p>Vintage Jewelry</p></h6>
                    <p>We have an eclectic Jewelry collection ranging from one of a kinds to chic and modern. A perfect addition to your daily wardrobe and accessories.</p>
                    <button class="btn btn-secondary">Get Glam</button>
                </div>
                <div class="col-12 col-md-4 text-center">
                    <div class="img-hover-zoom">
                        <img src="https://cdn.shopify.com/s/files/1/0536/8623/9393/files/manicure_540x.png?v=1627490600" alt="">
                    </div>
                    <h6 class="my-3"><p>Re-usable Manicure</p></h6>
                    <p>Have you ever found a nail color or pattern that you are absolute obsessed with? With these re-usable manicures you can have that instant favorite look anytime!</p>
                    <button class="btn btn-secondary">Shop Now</button>
                </div>
            </div>
        </div>

    </div>


@endsection


