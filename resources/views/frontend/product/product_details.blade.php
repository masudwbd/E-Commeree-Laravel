@extends('layouts.app')
@section('content')
@include('layouts.frontend_partial.collapse_nav')


    <style type="text/css">
        .checked {
            color: orange;
        }
    </style>

    @php
        $review_5 = App\Models\Review::where('product_id', $product->id)
            ->where('rating', 5)
            ->count();
        $review_4 = App\Models\Review::where('product_id', $product->id)
            ->where('rating', 4)
            ->count();
        $review_3 = App\Models\Review::where('product_id', $product->id)
            ->where('rating', 3)
            ->count();
        $review_2 = App\Models\Review::where('product_id', $product->id)
            ->where('rating', 2)
            ->count();
        $review_1 = App\Models\Review::where('product_id', $product->id)
            ->where('rating', 1)
            ->count();
        
        $sum_rating = App\Models\Review::where('product_id', $product->id)->sum('rating');
        $count_rating = App\Models\Review::where('product_id', $product->id)->count('rating');
        $images = json_decode($product->images, true);
        $colors = explode(',', $product->color, true);
        $sizes = explode(',', $product->size, true);

        @endphp

    @php

    @endphp
    <!-- Single Product -->
    <div class="single_product" style="padding-bottom: 20px">
        <div class="container">
            <div class="row">
                <!-- Images -->
                <div class="col-lg-2">
                    <ul class="image_list">
                        @foreach ($images as $key => $image)
                            <li data-image="{{ asset('backend/files/products/' . $image) }}"><img
                                    src="{{ asset('backend/files/products/' . $image) }}" alt=""></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Selected Image --> 
                <div class="col-lg-3">
                    <div class="image_selected"><img src="{{ asset($product->thumbnail) }}" alt=""></div>
                </div>

                <!-- Description -->
                <div class="col-lg-3">
                    <div class="product_description">
                        <div class="product_category">{{ $category->category_name }} > {{ $subcategory->subcategory_name }}
                        </div>
                        <div class="product_name">{{ $product->name }}</div>
                        <div class="product_brand">Brand : {{ $brand->brand_name }}</div>
                        <div class="rating_r rating_r_4 product_rating my-2">
                            @if ($sum_rating != null)
                                @if (intval($sum_rating / $count_rating) == 5)
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                @elseif(intval($sum_rating / $count_rating) >= 4 && intval($sum_rating / 5) < $count_rating)
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star "></span>
                                @elseif(intval($sum_rating / $count_rating) >= 3 && intval($sum_rating / 5) < $count_rating)
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                @elseif(intval($sum_rating / $count_rating) >= 2 && intval($sum_rating / 5) < $count_rating)
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                @else
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                @endif
                            @endif
                        </div>
                        @php
                            $setting = DB::table('settings')->first();
                        @endphp
                        @if ($product->discount_price == null)
                            <div class="" style="margin-top: 35px;">Price:
                                {{ $setting->currency }}{{ $product->selling_price }}</div>
                        @else
                            <div class="">
                                Price: <del class="text-danger">{{ $setting->currency }}{{ $product->selling_price }}</del
                                    class="text-danger">
                                {{ $setting->currency }}{{ $product->discount_price }}</div>
                        @endif
                        <div class="order_info d-flex flex-row" style="margin-top:20px">
                            <form action="{{ route('add.to.cart.quickview') }}" method="post" id="add_to_cart_form">
                                @csrf
                                <div class="clearfix" style="z-index: 1000;">
                                    {{-- product size  --}}
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    @if ($product->discount_price)
                                    <input type="hidden" name="price" value="{{ $product->discount_price }}">
                                    @else
                                        <input type="hidden" name="price" value="{{ $product->selling_price }}">
                                    @endif
                                    <div class="form-group">
                                        <div class="row">
                                            @isset($sizes)
                                                <div class="col-lg-6">
                                                    <label>Pick Size: </label>
                                                    <select class="custom-select form-control-sm" name="size"
                                                        style="min-width: 120px;">
                                                        @foreach ($sizes as $size)
                                                            <option value="{{ $size }}">{{ $size }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endisset

                                            @isset($colors)
                                                <div class="col-lg-6">
                                                    <label>Pick Color: </label>
                                                    <select class="custom-select form-control-sm" name="color"
                                                        style="min-width: 120px;">
                                                        @foreach ($colors as $row)
                                                        <option value="{{ $row }}">{{ $row }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endisset
                                        </div>
                                    </div>
                                    <br>
                                    <!-- Product Quantity -->
                                    <div class="product_quantity clearfix">
                                        <span>Quantity: </span>
                                        <input id="quantity_input" name="qty" type="text" pattern="[0-9]*" value="1">
                                        <div class="quantity_buttons">
                                            <div id="quantity_inc_button" class="quantity_inc quantity_control"><i
                                                    class="fas fa-chevron-up"></i></div>
                                            <div id="quantity_dec_button" class="quantity_dec quantity_control"><i
                                                    class="fas fa-chevron-down"></i></div>
                                        </div>
                                    </div>

                                    <!-- Product Color -->
                                    <ul class="product_color">
                                        <li>
                                            <span>Color: </span>
                                            <div class="color_mark_container">
                                                <div id="selected_color" class="color_mark"></div>
                                            </div>
                                            <div class="color_dropdown_button"><i class="fas fa-chevron-down"></i></div>

                                            <ul class="color_list">
                                                <li>
                                                    <div class="color_mark" style="background: #999999;"></div>
                                                </li>
                                                <li>
                                                    <div class="color_mark" style="background: #b19c83;"></div>
                                                </li>
                                                <li>
                                                    <div class="color_mark" style="background: #000000;"></div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>

                                </div>
                                <div class="button_container">
                                    <div class="input-group-prepend">
                                        @if(Auth::user())
                                            @if ($product->stock_quantity < 1)
                                                <button class="btn btn-outline-danger" disabled="">Stock Out</button>
                                            @else
                                                <button class="btn btn-outline-info" type="submit"> <span
                                                    class="loading d-none">....</span> Add to cart</button>
                                            @endif
                                            <a href="{{ route('add.wishlist', $product->id) }}"
                                                class="btn btn-outline-primary" type="button">Add to wishlist</a>
                                        @else
                                        <h5 class="bg-dark text-light p-2">Please Login To Add Product To Cart</h5>
                                        @endif
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3" style="border-left:2px solid gray">
                    <div class="pickup_point" style="border-bottom:2px solid gray">
                        <h4>Pickup Point of this porduct</h4>
                        <h5 style="color:red">{{ $pickup_point->pickup_point_name }}</h5>
                    </div>
                    <div class="home_delivery pt-4" style="border-bottom:2px solid gray">
                        <h4>Home Delivery : </h4>
                        <h5 style="color:red">4-8 days after the order placing</h5>
                        <h5 style="color:red">Cash On Delivery Available</h5>
                    </div>
                    <div class="product_return pt-4" style="border-bottom:2px solid gray">
                        <h4>Home Delivery : </h4>
                        <h5 style="color:red">7 days return guarranty</h5>
                        <h5 style="color:red">Warrenty not available</h5>
                    </div>
                    @isset($product->video)
                        <div class="product_video pt-4">
                            <h4>Product Video</h4>
                            <iframe width="350" height="215" src="{{ $product->video }}">
                            </iframe>
                        </div>
                    @endisset

                </div>
                <div class="col-lg-1">
                    {!! $shareButtons2 !!}
                </div>
            </div>
        </div>
    </div>

    <div class="product-review-section py-5">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h4>Rating & Reviews of {{ $product->name }}</h4>
                </div>
                <div class="card-body">
                    <div class="row pb-4">
                        <div class="col-lg-6">
                           <div class="row">
                                <div class="col-6">
                                    <h4>Average Review Of {{$product->name}}</h4>
                                    <div>
                                        @if ($sum_rating != null)
                                            @if (intval($sum_rating / $count_rating) == 5)
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                            @elseif(intval($sum_rating / $count_rating) >= 4 && intval($sum_rating / 5) < $count_rating)
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star "></span>
                                            @elseif(intval($sum_rating / $count_rating) >= 3 && intval($sum_rating / 5) < $count_rating)
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                            @elseif(intval($sum_rating / $count_rating) >= 2 && intval($sum_rating / 5) < $count_rating)
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                            @else
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    Total Review Of This Product:<br>
                                    <div>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span> Total {{ $review_5 }} </span>
                                    </div>

                                    <div>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star "></span>
                                        <span> Total {{ $review_4 }} </span>
                                    </div>

                                    <div>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        <span> Total {{ $review_3 }} </span>
                                    </div>

                                    <div>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        <span> Total {{ $review_2 }} </span>
                                    </div>

                                    <div>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        <span> Total {{ $review_1 }} </span>
                                    </div>

                                </div>
                           </div>
                        </div>
                        <div class="col-6">
                            <form action="{{ route('review.store') }}">
                                @if (Auth::user())
                                    <div class="form-group">
                                        <label for="review">Write Your Review</label>
                                        <textarea name="review" class="form-control" id="" cols="30" rows="4"></textarea>
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    </div>
                                    <div class="form-group">
                                        <select name="rating" class="form-control" style="min-width:150px;margin-left:0px">
                                            <option selected disabled>Select Rating</option>
                                            <option value="1">1 Start</option>
                                            <option value="2">2 Start</option>
                                            <option value="3">3 Start</option>
                                            <option value="4">4 Start</option>
                                            <option value="5">5 Start</option>
                                        </select>
                                    </div>
                                    <input class="btn btn-success" type="submit" value="sumbit your reveiew">
                                @else
                                    <small>You have to be logged in to leave a review</small>
                                @endif
                            </form>
                        </div>
                    </div>
                    <hr>
                    <h4>Rating & Reviews of {{ $product->name }}</h4>
                    @foreach($reviews as $row)
                    @php
                    $user = DB::table('users')->where('id', $row->user_id)->first();
                    @endphp
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="card-header">
                                {{$user->name}}
                            </div>
                            <div class="card-body">
                                {{$row->review}}
                                @if($row->rating==5)
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                @elseif($row->rating==4)
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                @elseif($row->rating==3)
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                @elseif($row->rating==2)
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                @elseif($row->rating==1)
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
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
                        <h3 class="viewed_title">Related Products</h3>
                        <div class="viewed_nav_container">
                            <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                            <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                        </div>
                    </div>

                    <div class="viewed_slider_container">

                        <!-- Recently Viewed Slider -->

                        <div class="owl-carousel owl-theme viewed_slider">

                            <!-- Recently Viewed Item -->
                            @foreach ($related_products as $row)
                                <div class="owl-item">
                                    <a href="{{ route('frontend.product_details', $row->slug) }}">
                                        <div
                                            class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                            <div class="viewed_image"><img src="{{ asset($row->thumbnail) }}"
                                                    alt=""></div>
                                            <div class="viewed_content text-center">
                                                @if ($product->discount_price == null)
                                                    <div class="" style="margin-top: 35px;">Price:
                                                        {{ $setting->currency }}{{ $product->selling_price }}</div>
                                                @else
                                                    <div class="">
                                                        Price: <del
                                                            class="text-danger">{{ $setting->currency }}{{ $product->selling_price }}</del
                                                            class="text-danger">
                                                        {{ $setting->currency }}{{ $product->discount_price }}</div>
                                                @endif
                                                <div class="viewed_name"><a
                                                        href="{{ route('frontend.product_details', $row->slug) }}">{{ substr($row->name, 0, 40) }}</a>
                                                </div>
                                            </div>
                                            <ul class="item_marks">
                                                <li class="item_mark item_discount">new</li>
                                            </ul>
                                        </div>
                                    </a>
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

                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="images/brands_1.jpg" alt=""></div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="images/brands_2.jpg" alt=""></div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="images/brands_3.jpg" alt=""></div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="images/brands_4.jpg" alt=""></div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="images/brands_5.jpg" alt=""></div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="images/brands_6.jpg" alt=""></div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="images/brands_7.jpg" alt=""></div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="images/brands_8.jpg" alt=""></div>
                            </div>

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
                    <div
                        class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                        <div class="newsletter_title_container">
                            <div class="newsletter_icon"><img src="images/send.png" alt=""></div>
                            <div class="newsletter_title">Sign up for Newsletter</div>
                            <div class="newsletter_text">
                                <p>...and receive %20 coupon for first shopping.</p>
                            </div>
                        </div>
                        <div class="newsletter_content clearfix">
                            <form action="#" class="newsletter_form">
                                <input type="email" class="newsletter_input" required="required"
                                    placeholder="Enter your email address">
                                <button class="newsletter_button">Subscribe</button>
                            </form>
                            <div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('js/share.js') }}"></script>
<script type="text/javascript">
    //store coupon ajax call
    $('#add_to_cart_form').submit(function(e){
      e.preventDefault();
      $('.loading').removeClass('d-none');
      var url = $(this).attr('action');
      var request =$(this).serialize();
      $.ajax({
        url:url,
        type:'post',
        async:false,
        data:request,
        success:function(data){
          toastr.success(data);
          $('#add_to_cart_form')[0].reset();
          $('.loading').addClass('d-none');
          cart();
        }
      });
    });
  </script> 



@endsection
