@extends('layouts.app')
@section('content')
@include('layouts.frontend_partial.main_navbar')

<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/shop_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/shop_responsive.css">

@php
    $setting = DB::table('settings')->first();
@endphp

<div class="super_container">

	<!-- Shop -->

	<div class="shop">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">

					<!-- Shop Sidebar -->
					<div class="shop_sidebar">
						<div class="sidebar_section">
                            @php    
                                $categories = DB::table('categories')->get();
                            @endphp
							<div class="sidebar_title">Categories</div>
							<ul class="sidebar_categories">
                                @foreach($categories as $row)
								<li><a href="{{route('categorywise_product' , $row->id)}}">{{$row->category_name}}</a></li>
                                @endforeach
							</ul>
						</div>
						<div class="sidebar_section filter_by_section">
							<div class="sidebar_title">Filter By</div>
							<div class="sidebar_subtitle">Price</div>
							<div class="filter_price">
								<div id="slider-range" class="slider_range"></div>
								<p>Range: </p>
								<p><input type="text" id="amount" class="amount" readonly style="border:0; font-weight:bold;"></p>
							</div>
						</div>
						<div class="sidebar_section">
							<div class="sidebar_subtitle color_subtitle">Color</div>
							<ul class="colors_list">
								<li class="color"><a href="#" style="background: #b19c83;"></a></li>
								<li class="color"><a href="#" style="background: #000000;"></a></li>
								<li class="color"><a href="#" style="background: #999999;"></a></li>
								<li class="color"><a href="#" style="background: #0e8ce4;"></a></li>
								<li class="color"><a href="#" style="background: #df3b3b;"></a></li>
								<li class="color"><a href="#" style="background: #ffffff; border: solid 1px #e1e1e1;"></a></li>
							</ul>
						</div>
						<div class="sidebar_section">
							<div class="sidebar_subtitle brands_subtitle">Brands</div>
							<ul class="brands_list">
								<li class="brand"><a href="#">Apple</a></li>
								<li class="brand"><a href="#">Beoplay</a></li>
								<li class="brand"><a href="#">Google</a></li>
								<li class="brand"><a href="#">Meizu</a></li>
								<li class="brand"><a href="#">OnePlus</a></li>
								<li class="brand"><a href="#">Samsung</a></li>
								<li class="brand"><a href="#">Sony</a></li>
								<li class="brand"><a href="#">Xiaomi</a></li>
							</ul>
						</div>
					</div>

				</div>

				<div class="col-lg-9">
                    <div class="product_grid row">
                        <div class="product_grid_border"></div>
                        @foreach($products as $row)
                            <div class="product_item is_new col-lg-2">
                                <div class="product_border"></div>
                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset($row->thumbnail) }}" alt=""></div>
                                <div class="product_content">
                                    @if($row->discount_price==NULL)
                                     <div class="product_price">{{ $setting->currency }}{{ $row->selling_price }}</div>
                                    @else
                                     <div class="product_price">{{ $setting->currency }}{{ $row->discount_price }}<span>{{ $setting->currency }}{{ $row->selling_price }}</span></div>
                                    @endif
                                    <div class="product_name"><div><a style="font-size: 18px" href="{{ route('frontend.product_details',$row->slug) }}" tabindex="0">{{ $row->name }}</a></div></div>
                                </div>
                                <a href="{{ route('add.wishlist',$row->id) }}">
                                  <div class="product_fav"><i class="fas fa-heart"></i></div>
                                </a>
                                <ul class="product_marks">
                                    <li class="product_mark product_new quick_view" id="{{ $row->id }}" data-toggle="modal" data-target="#quickviewmodal"><i style="margin-top: 12px" class="fas fa-eye"></i></li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                    <div class="shop_page_nav d-flex flex-row">
                        <ul class="page_nav d-flex flex-row">
                            {{$products->links()}}
                        </ul>
                    </div>
				</div>
			</div>
		</div>
	</div>

	<!-- Recently Viewed -->

    <div class="viewed">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="viewed_title_container">
                        <h3 class="viewed_title">Recently Viewed</h3>
                        <div class="viewed_nav_container">
                            <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                            <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                        </div>
                    </div>

                    <div class="viewed_slider_container">

                        <!-- Recently Viewed Slider -->

                        <div class="owl-carousel owl-theme viewed_slider">
                            @foreach ($suggeted_products as $row)
                                <!-- Recently Viewed Item -->
                                <div class="owl-item">
                                    <div
                                        class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <div class="viewed_image"><img src="{{ asset($row->thumbnail) }}"
                                                alt=""></div>
                                        <div class="viewed_content text-center">
                                            <div class="product_price discount" style="margin-top: 10px">
                                                @if ($row->discount_price)
                                                    <span style="font-size:18px">{{ $setting->currency }}{{ $row->discount_price }}</span>
                                                    <del>{{ $setting->currency }}{{ $row->selling_price }}</del>
                                                @else
                                                    <div>{{ $setting->currency }}{{ $row->discount_price }}</div>
                                                @endif
                                            </div>
                                            <div class="viewed_name"><a
                                                    href="#">{{ substr($row->name, 0, 10) }}</a></div>
                                        </div>
                                        <ul class="item_marks">
                                            <li class="item_mark item_discount">-25%</li>
                                            <li class="item_mark item_new">new</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<!-- Brands -->
    <div class="brands">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="brands_slider_container">
                        <!-- Brands Slider -->
                        <div class="owl-carousel owl-theme brands_slider">
                            @foreach ($brands as $row)
                                <div class="owl-item">
                                    <div class="brands_item d-flex flex-column justify-content-center"><img
                                            src="{{ asset($row->brand_logo) }}" alt=""></div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Brands Slider Navigation -->
                        <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- Newsletter -->

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
						<div class="newsletter_title_container">
							<div class="newsletter_icon"><img src="images/send.png" alt=""></div>
							<div class="newsletter_title">Sign up for Newsletter</div>
							<div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
						</div>
						<div class="newsletter_content clearfix">
							<form action="#" class="newsletter_form">
								<input type="email" class="newsletter_input" required="required" placeholder="Enter your email address">
								<button class="newsletter_button">Subscribe</button>
							</form>
							<div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

     {{-- Quick View Modal --}}
     <div class="modal fade" class="" id="quickviewmodal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
         <div class="modal-dialog modal-lg modal-dialog-center">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body" id="quickviewmodel">

                 </div>
             </div>
         </div>
     </div>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <script>
         $(document).on('click', '.quick_view', function() {
             var id = $(this).attr('id');
             $.ajax({
                 url: "{{ url('/product-quick-view') }}/" + id,
                 type: 'get',
                 success: function(data) {
                     $("#quickviewmodel").html(data);
                 }
             })
         });
     </script>

<script src="{{ asset('frontend') }}/js/shop_custom.js"></script>

@endsection