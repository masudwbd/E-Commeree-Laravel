<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/bootstrap4/bootstrap.min.css">
<link href="{{ asset('frontend') }}/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/plugins/slick-1.8.0/slick.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/responsive.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_responsive.css">
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/toastr/toastr.css">


</head>

<body>
@php 
	$settings = DB::table('settings')->first();
@endphp
<div class="super_container">
	
	<!-- Header -->
	
	<header class="header">

		<!-- Top Bar -->

		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col d-flex flex-row">
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('frontend') }}/images/phone.png" alt=""></div>{{$settings->phone_one}}</div>
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('frontend') }}/images/mail.png" alt=""></div><a href="mailto:fastsales@gmail.com">{{$settings->main_email}}</a></div>
						<div class="top_bar_content ml-auto">
							<div class="top_bar_menu">
								<ul class="standard_dropdown top_bar_dropdown">
									@if(Auth::user())
									<li>
										<a href="#">Language<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li><a href="#">English</a></li>
										</ul>
									</li>
									
									<li>
										<a href="#">Currency<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li><a href="{{route('frontend.currency.taka')}}">Taka (৳)</a></li>
											<li><a href="{{route('frontend.currency.dollar')}}">Dollar ($)</a></li>
										</ul>
									</li>
									<li>
										<a href="#">{{Auth::user()->name}}<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li><a href="{{route('user.dashboard')}}">Profile</a></li>
											<li><a href="{{route('user.settings')}}">Settings</a></li>
											<li><a href="#">Order List</a></li>
											<li><a href="{{route('logout')}}">Logout</a></li>
										</ul>
									</li>
									@else
									<li>
										<a href="#">Login<i class="fas fa-chevron-down"></i></a>
										<ul style="width:300px; padding:10px">
											<form action="{{ route('login') }}" method="post">
												@csrf
												<div class="form-group">
													<label for="email address">Email Address</label>
													<input type="email" name="email" class="form-control">
												</div>
												<div class="form-group">
													<label for="password">Password</label>
													<input type="password" name="password" class="form-control">
												</div>
												<div class="form-group">
													<input type="submit" class="btn btn-info">
												</div>
												<a href="{{route('social.oauth', 'google')}}">Google</a>
											</form>
										</ul>
									</li>
									<li>
									<a href="{{route('register')}}">Register</a>
									</li>
									@endif

									@guest

									@else

									@endguest
								</ul>
							</div>
							{{-- <div class="top_bar_user">
								<div class="user_icon"><img src="{{ asset('frontend') }}/images/user.svg" alt=""></div>
								<div><a href="#">Register</a></div>
								<div><a href="#">Sign in</a></div>
							</div> --}}
						</div>
					</div>
				</div>
			</div>		
		</div>

		<!-- Header Main -->

		<div class="header_main">
			<div class="container">
				<div class="row">

					<!-- Logo -->
					<div class="col-lg-2 col-sm-3 col-3 order-1">
						<div class="logo_container">
							<div class="logo"><a href="{{route('frontend.index')}}"><img src="{{asset($settings->logo)}}" style="height: 150px" alt=""></a></div>
						</div>
					</div>

					<!-- Search -->
					<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
						<div class="header_search">
							<div class="header_search_content">
								<div class="header_search_form_container">
									<form action="{{route('frontend.search')}}" class="header_search_form clearfix">
										<input type="search" name="search" required="required" class="header_search_input" placeholder="Search for products...">
										<div class="custom_dropdown">
											<div class="custom_dropdown_list">
												<span class="custom_dropdown_placeholder clc">All Categories</span>
												<ul class="custom_list clc">

												</ul>
											</div>
										</div>
										<button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{ asset('frontend') }}/images/search.png" alt=""></button>
									</form>
								</div>
							</div>
						</div>
					</div>

					<!-- Wishlist -->
					<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
						<a href="{{route('frontend.wishlist')}}">
							<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
								<div class="wishlist d-flex flex-row align-items-center justify-content-end">
									<div class="wishlist_icon"><img src="{{ asset('frontend') }}/images/heart.png" alt=""></div>
									<div class="wishlist_content">
										<div class="wishlist_text"><a href="{{route('frontend.wishlist')}}">Wishlist</a></div>
										@php
										$wishlist_product = DB::table('wishlist')->where('user_id', Auth::id())->count()
										@endphp
										<div class="wishlist_count">{{$wishlist_product}}</div>
									</div>
								</div>
						</a>
								<!-- Cart -->
								<a href="{{route('my.cart')}}">
									<div class="cart">
										@php
										$settings = DB::table('settings')->first();
										@endphp
										<div class="cart_container d-flex flex-row align-items-center justify-content-end">
											<div class="cart_icon">
												<img src="{{ asset('frontend') }}/images/cart.png" alt="">
												<div class="cart_count"><span class="count_cart">{{Cart::count()}}</span></div>
											</div>
											<div class="cart_content">
												<div class="cart_text"><a href="{{route('my.cart')}}">Cart</a></div>
												<div class="cart_price price_cart">{{$settings->currency}}{{Cart::total()}}</div>
											</div>
										</div>
									</div>
								</a>
							</div>
					</div>
				</div>
			</div>
		</div>
		
	@yield('navbar')
 
	</header>
	
    @yield('content')

	<!-- Footer -->

	<footer class="footer">
		<div class="container">
			<div class="row">

				<div class="col-lg-4 footer_col text-center">
					<div class="footer_column footer_contact">
						<div class="logo_container">
							<div class="logo"><a href="#">OneTech</a></div>
						</div>
						<div class="footer_title">Got Question? Call Us 24/7</div>
						<div class="footer_phone">{{$settings->phone_one}}</div>
						<div class="footer_phone">{{$settings->phone_two}}</div>
						<div class="footer_contact_text">
							<p>{{$settings->address}}</p>
						</div>
						<div class="footer_social">
							<ul>
								<li><a href="{{$settings->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="{{$settings->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
								<li><a href="{{$settings->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>
								<li><a href="{{$settings->main_email}}" target="_blank"><i class="fab fa-google"></i></a></li>
								<li><a href="{{$settings->linkdin}}" target="_blank"><i class="fab fa-linkdin"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

				@php
					$footer_categories = DB::table('categories')->orderBy('id', 'ASC')->take(5)->get()
				@endphp

				<div class="col-lg-4 text-center">
					<div class="footer_column">
						<div class="footer_title">Find it Fast</div>
						<ul class="footer_list">
							@foreach ($footer_categories as $item)
								<li><a href="#">{{$item->category_name}}</a></li>
							@endforeach

						</ul>
					</div>
				</div>

				<div class="col-lg-4 text-center">
					<div class="footer_column">
						<div class="footer_title">Customer Care</div>
						<ul class="footer_list">
							<li><a href="#">My Account</a></li>
							<li><a href="#">Order Tracking</a></li>
							<li><a href="#">Wish List</a></li>
							<li><a href="#">Customer Services</a></li>
							<li><a href="#">Returns / Exchange</a></li>
							<li><a href="#">FAQs</a></li>
							<li><a href="#">Product Support</a></li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</footer>

	<!-- Copyright -->

	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col">
					
					<div class="copyright_container">
						<div class="copyright_content text-center mt-4">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Team17</a>
		</div>
								<div class="logos ml-sm-auto">
							<ul class="logos_list">
								<li><a href="#"><img src="images/logos_1.png" alt=""></a></li>
								<li><a href="#"><img src="images/logos_2.png" alt=""></a></li>
								<li><a href="#"><img src="images/logos_3.png" alt=""></a></li>
								<li><a href="#"><img src="images/logos_4.png" alt=""></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('frontend') }}/js/jquery-3.3.1.min.js"></script>
<script src="{{ asset('frontend') }}/styles/bootstrap4/popper.js"></script>
<script src="{{ asset('frontend') }}/styles/bootstrap4/bootstrap.min.js"></script>
<script src="{{ asset('frontend') }}/plugins/greensock/TweenMax.min.js"></script>
<script src="{{ asset('frontend') }}/plugins/greensock/TimelineMax.min.js"></script>
<script src="{{ asset('frontend') }}/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="{{ asset('frontend') }}/plugins/greensock/animation.gsap.min.js"></script>
<script src="{{ asset('frontend') }}/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="{{ asset('frontend') }}/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="{{ asset('frontend') }}/plugins/slick-1.8.0/slick.js"></script>
<script src="{{ asset('frontend') }}/plugins/easing/easing.js"></script>
<script src="{{ asset('frontend') }}/js/custom.js"></script>
<script src="{{ asset('frontend') }}/js/product_custom.js"></script>
<script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"></script>
<script type="text/javascript" charset="utf-8">

	function cart(){
		$.ajax({
            type:'get',
            url:'{{ route('all.cart') }}', 
            dataType: 'json',
            success:function(data){
               $('.cart_qty').empty();
               $('.cart_total').empty();
               $('.cart_qty').append(data.cart_qty);
               $('.cart_total').append(data.cart_total);
            }
        });
	}

    $(document).ready(function(event) {
		cart();
    });
    
 </script>

<script>
	@if (Session::has('message'))

		var type = "{{ Session::get('alert-type', 'info') }}"
		switch (type) {
			case 'info':
				toastr.info("{{ Session::get('message') }}");
				break;

			case 'success':
				toastr.success("{{ Session::get('message') }}");
				break;

			case 'warning':
				toastr.warning("{{ Session::get('message') }}");
				break;

			case 'error':
				toastr.error("{{ Session::get('message') }}");
				break;
		}
	@endif
</script>

</body>

</html>