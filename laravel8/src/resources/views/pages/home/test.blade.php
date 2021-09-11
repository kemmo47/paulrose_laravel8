@extends('layouts.layout')
@section('title', 'test') 
@section('content')
<div class="container-xsl">
	<div class="my-3 text-center">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mt-5 mb-4">
				<li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
				<i class="icofont-curved-right"></i>
				<li class="breadcrumb-item active" aria-current="page">Search: "all"</li>
			</ol>
		</nav>
		<h2 class="mb-5">Search our store</h2>
	</div>
	<div class="search_continue">
		<div class="searched_keywords">
			Your search for "all" revealed the following:
		</div>
		<div class="search_input_box">
			<input type="search" name="searchbox" class="form-control-search" placeholder="Search">
		</div>
	</div>
	<div id="load_search_products">
		@csrf
		<input type="hidden" name="keywords_show_pro" value="all">

		<div class="container_show_pro_search">
			<div class="product_item_search">
				<div class="product_item" id="product_item_0">
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
				</div>
			</div>
			<div class="product_item_search">

			</div>
			<div class="product_item_search">

			</div>
			<div class="product_item_search">

			</div>
		</div>

	</div>
</div>
@section('script')

@endsection
@endsection