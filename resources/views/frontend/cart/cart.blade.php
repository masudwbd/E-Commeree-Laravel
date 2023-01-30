<!DOCTYPE html>
@extends('layouts.app')
@section('content')
@include('layouts.frontend_partial.main_navbar')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/cart_responsive.css">
	<!-- Cart -->

	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="cart_container">
						<div class="cart_title mb-4">Shopping Cart</div>
                        @foreach($content as $item)
                        @php
                        $product = DB::table('products')->where('id', $item->id)->first();
                        $colors = explode(',', $product->color);
                        $sizes = explode(',', $product->size);
                        $settings = DB::table('settings')->first()
                        @endphp
						<div class="cart_items mt-0">
							<ul class="cart_list">
								<li class="cart_item clearfix">
									<div class="cart_item_image"><img src="{{asset($item->options->thumbnail)}}" alt=""></div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="item_name">
											<div class="item_name" style="font-size: 18px">{{ substr($item->name, 0, 10) }}</div>
										</div>
                                        @if($product->size!=null)
                                        <div class="item-size">
                                            <select class="form-control size"  data-id="{{$item->rowId}}" style="min-width: 100px" name="size" id="">
                                                @foreach($sizes as $size)
                                                <option value="{{$size}}" @if($item->options->size==$size) selected @endif>{{$size}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @else

                                        @endif
                                        @if($product->color!=null)
                                        <div class="item-color">
                                            <select class="form-control color" style="min-width: 100px" data-id="{{$item->rowId}}" name="color" id="">
                                                @foreach($colors as $color)
                                                <option class="" value="{{$color}}"@if($item->options->color==$color) selected @endif >{{$color}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @else

                                        @endif
										<div class="cart_item_quantity cart_info_col">
											<div class="" style="font-size: 18px">
												<input type="number" class="form-control qty" data-id="{{$item->rowId}}" name="qty" value="{{$item->qty}}">
											</div>
										</div>
										<div class="cart_item_price cart_info_col">
											<div class="" style="font-size: 18px">{{$settings->currency}}{{$item->price}}x{{$item->qty}}</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="" style="font-size: 18px">{{$settings->currency}}{{$item->qty * $item->price}}</div>
										</div>
										<div class="action">
											<div class="" style="font-size: 18px;color:red"> 
												<a href="" data-id="{{$item->rowId}}" class="remove_product">x</a>
											</div>
										</div>
									</div>
								</li>
							</ul>
						</div>
                        @endforeach
						@php 
							$settings = DB::table('settings')->first();
						@endphp
						<!-- Order Total -->
						<div class="order_total">
							<div class="order_total_content text-md-right">
								<div class="order_total_title">Order Total:</div>
								<div class="order_total_amount">{{$settings->currency}}{{Cart::total()}}</div>
							</div>
						</div>

						<div class="cart_buttons">
							<a class="btn btn-danger p-2" href="{{route('cart.destroy')}}" >Empty Cart</a>
							<a class="btn btn-info p-2" href="{{route('checkout')}}" >Proceed To Checkout</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>





<script src="{{ asset('frontend') }}/js/cart_custom.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    //delete cart product ajax call
    $('body').on('click','.remove_product', function(){
        let id = $(this).data('id');
		$.ajax({
        url:"{{ url('cartproduct/remove/') }}/" + id,
        type:'get',
        async:false,
        success:function(data){
			toastr.success(data);
			location.reload();
        }
      });
    })

	//quantity cart product ajax call
    $('body').on('blur','.qty', function(){
        let qty = $(this).val();
		let rowId = $(this).data('id');
		$.ajax({
			url:"{{ url('cartproduct/updateqty/') }}/"+rowId+"/"+qty,
			type:'get',
			async:false,
			success:function(data){
				toastr.success(data);
				location.reload();
			}
      });
    })

	//color size product ajax call
    $('body').on('change','.size', function(){
        let size = $(this).val();
		let rowId = $(this).data('id');
		$.ajax({
			url:"{{ url('cartproduct/updatesize/') }}/"+rowId+"/"+size,
			type:'get',
			async:false,
			success:function(data){
				toastr.success(data);
				location.reload();
			}
      });
    })

	//color cart product ajax call
    $('body').on('change','.color', function(){
        let color = $(this).val();
		let rowId = $(this).data('id');
		$.ajax({
			url:"{{ url('cartproduct/updatecolor/') }}/"+rowId+"/"+color,
			type:'get',
			async:false,
			success:function(data){
				toastr.success(data);
				location.reload();
			}
      });
    })

</script> 


@endsection