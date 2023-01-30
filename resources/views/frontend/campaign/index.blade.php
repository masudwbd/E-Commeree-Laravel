@extends('layouts.app')
@section('content')
@include('layouts.frontend_partial.main_navbar')

<div class="campaign_products">
    <div class="container">

        <div class="mt-5">
            @foreach($campaign_products as $item)
            <div class="card">
                <div class="card-header">{{$item->name}}</div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="product-image">
                            <img src="{{asset($item->thumbnail)}}" style="height: 50px; width:50px" alt="">
                        </div>
                        <div class="product-code">
                            <p>Code: {{$item->code}}</p>
                        </div>
                        <div class="product-price">
                            <p>Price: {{$item->price}}</p>
                        </div>
                        <div class="details">
                            <div class="details">
                                <a class="btn btn-success" href="{{route('campaign.product.details', $item->slug)}}">See Product Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>


        {{-- <div class="shop_content">
            <div class="shop_bar clearfix">
                <div class="shop_product_count"><span>{{ count($campaign_products) }}</span> products found</div>
                <div class="shop_sorting">
                    <span>Sort by:</span>
                    <ul>
                        <li>
                            <span class="sorting_text">highest rated<i class="fas fa-chevron-down"></i></span>
                            <ul>
                                <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
                                <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name</li>
                                <li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>price</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="product_grid row">
                <div class="product_grid_border"></div>
                @php
                    $setting = DB::table('settings')->first()
                @endphp
                @foreach($campaign_products as $row)
                    <div class="product_item is_new col-lg-2">
                        <div class="product_border"></div>
                        <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset($row->thumbnail)}}" alt=""></div>
                        <div class="product_content pt-2">
                            <div class="product_price">{{ $setting->currency }}{{ $row->price }}</div>
                            <div class="product_name"><div><a href="{{ route('campaign.product.details',$row->slug) }}" tabindex="0">{{ $row->name }}</a></div></div>
                        </div>
                        <a href="{{ route('add.wishlist',$row->product_id) }}">
                          <div class="product_fav"><i class="fas fa-heart"></i></div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Shop Page Navigation -->

            <div class="shop_page_nav d-flex flex-row">
                <ul class="page_nav d-flex flex-row">
                    {{ $campaign_products->links() }}
                </ul>
            </div>

        </div>

     --}}
    </div>
</div>




@endsection