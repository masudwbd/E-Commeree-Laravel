<!DOCTYPE html>
@extends('layouts.app')
@section('content')
@include('layouts.frontend_partial.main_navbar')
@php
    $settings = DB::table('settings')->first();   
@endphp


<div class="checkout-page">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-8">
                <div class="cart_container card p-1">
                    <div class="cart_title text-center my-2" style="font-size:24px;font-weight:500">Billing Address</div>
                    
                      <form action="{{route('order.place')}}" method="post" id="order-place">
                          @csrf
                        <div class="row p-4">
                          <div class="form-group col-lg-6">
                            <label>Customer Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" name="c_name" required="" >
                          </div>
                          <div class="form-group col-lg-6">
                            <label>Customer Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ Auth::user()->phone }}" name="c_phone" required="" >
                          </div>
                          <div class="form-group col-lg-6">
                            <label> Country <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="c_country" required="" >
                          </div>
                          <div class="form-group col-lg-6">
                            <label>Shipping Address <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" name="c_address" required="" >
                          </div>
                          
                          <div class="form-group col-lg-6">
                            <label>Email Address</label>
                            <input type="text" class="form-control" name="c_email" >
                          </div>
                          <div class="form-group col-lg-6">
                            <label>Zip Code</label>
                            <input type="text" class="form-control" name="c_zipcode" required="">
                          </div>
                          <div class="form-group col-lg-6">
                            <label>City Name</label>
                            <input type="text" class="form-control" name="c_city" required="">
                          </div>
                          <div class="form-group col-lg-6">
                            <label>Extra Phone</label>
                            <input type="text" class="form-control" name="c_extra_phone" required="" >
                          </div>
                            <br>
                                 <div class="form-group col-lg-4">
                                   <label>Paypal</label>
                                   <input type="radio"  name="payment_type" value="Paypal">
                                 </div>
                                 <div class="form-group col-lg-4">
                                   <label>Bkash/Rocket/Nagad </label>
                                   <input type="radio"  name="payment_type" checked="" value="Aamarpay" >
                                 </div>
                                 <div class="form-group col-lg-4">
                                   <label>Hand Cash</label>
                                   <input type="radio"  name="payment_type" value="Hand Cash" >
                                 </div>
                                 
                        </div>
                        <div class="form-group pl-2">
                              <button type="submit" class="btn btn-info p-2">Order Place</button>
                        </div>

                        <span class="visually-hidden pl-2 d-none progress">Progressing.....</span>

                      </form>
                            

                    <!-- Order Total -->
                    
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">

                        @if(Session::has('coupon'))
                        <p>Subtotal: {{Cart::subtotal()}}</p>
                        <p>Coupon: {{Session::get('coupon')['name']}} <a href="{{route('coupon.remove')}}" style="font-size:18px"> X</a> </p>  
                        <p>Tax: 00000</p>
                        <p>Shipping: 00000</p>
                        <hr>
                        <h3>Total: {{Session::get('coupon')['discount_total']}}</h3>
                        @else
                        <p>Subtotal: {{Cart::subtotal()}}</p>
                        <p>Coupon: No Coupon Applied</p>  
                        <p>Tax: 00000</p>
                        <p>Shipping: 00000</p>
                        <hr>
                        <h3>Total:  {{$settings->currency}}{{Cart::total()}}</h3>
                        @endif
                        <hr>

                        @if(!Session::has('coupon'))
                        <form action="{{route('coupon.apply')}}" method="post">
							@csrf
							  <div class="form-group">
								<label>Coupon Apply</label>
								<input type="text" class="form-control" name="coupon_code" required="" placeholder="Coupon Code" autocomplete="off">
							  </div>
							  <div class="form-group">
							  	<button type="submit" class="btn btn-info">Apply Coupon</button>
							  </div>	
						</form>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</script> 


@endsection