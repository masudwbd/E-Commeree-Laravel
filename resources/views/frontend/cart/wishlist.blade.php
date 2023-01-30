<!DOCTYPE html>
@extends('layouts.app')
@section('content')
@include('layouts.frontend_partial.collapse_nav')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/cart_responsive.css">
	<!-- Cart -->

	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 mx-auto">
					<div class="cart_container">
						<div class="cart_title mb-4">Wishlist</div>
                        @foreach($wishlist as $item)
                        @php
                        $product = DB::table('products')->where('id', $item->id)->first();
                        @endphp
							<div class="cart_items mt-0">
								<ul class="cart_list">
									<li class="cart_item clearfix">
										<div class="cart_item_image"><img src="{{asset($item->thumbnail)}}" alt=""></div>
										<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
											<div class="item_name">
												<div class="item_name" style="font-size: 18px">{{$item->name }}</div>
											</div>
											<div class="cart_item_total cart_info_col">
												<div class="" style="font-size: 18px">{{$item->date }}</div>
											</div>
											
											<div class="action">
												<div class="" style="font-size: 18px;color:red"> <a href="{{route('wishlist.product.remove', $item->id)}}" class="remove_product">x</a></div>
											</div>
											<div class="details">
												<a class="btn btn-success" href="{{route('frontend.product_details', $item->slug)}}">See Product Details</a>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</a>

                        @endforeach
					</div>
				</div>
			</div>
		</div>
	</div>





<script src="{{ asset('frontend') }}/js/cart_custom.js"></script>



@endsection