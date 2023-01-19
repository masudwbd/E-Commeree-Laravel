@php
    $category = DB::table('categories')
        ->where('id', $product->category_id)
        ->first();
    $subcategory = DB::table('subcategories')
        ->where('id', $product->subcategory_id)
        ->first();
    $brand = DB::table('brands')
        ->where('id', $product->brand_id)
        ->first();
    $settings = DB::table('settings')->first();
    $color = explode(',', $product->color);
    $sizes = explode(',', $product->size);
@endphp

<div class="modal-product">
    <div class="row">
        <div class="col-lg-5">
            <img src="{{ asset($product->thumbnail) }}" style="height:350px;width:300px" alt="">
        </div>
        <div class="col-lg-7">
            <div class="product-details">
                <form action="{{ route('add.to.cart.quickview') }}" method="post" id="add_to_cart_form">
                    @csrf
                    <h2 class="name">{{ $product->name }}</h2>
                    <h4 class="category py-2">{{ $category->category_name }}>{{ $subcategory->subcategory_name }}</h4>
                    <h4>Brand: {{ $brand->brand_name }}</h4>
                    <div class="product_price discount" style="margin-left: -10px;margin-top:0px">
                        @if ($product->discount_price)
                            <span>{{ $settings->currency }}{{ $product->discount_price }}</span>
                            <del>{{ $settings->currency }}{{ $product->selling_price }}</del>
                        @else
                            <div>{{ $product->discount_price }}</div>
                        @endif
                    </div>
                    <div class="stock">
                        @if ($product->stock_quantity > 0)
                            <button class="badge badge-success" disabled="">Stock Available</button>
                        @else
                            <button class="badge badge-danger" disabled="">Stock Out</button>
                        @endif
                    </div>
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    @if ($product->discount_price)
                        <input type="hidden" name="price" value="{{ $product->discount_price }}">
                    @else
                        <input type="hidden" name="price" value="{{ $product->selling_price }}">
                    @endif
                    {{-- product size  --}}
                    @isset($product->size)
                        <div class="form-group mt-2">
                            <label>Pick Size: </label>
                            <select class="custom-select form-control-sm" name="size" style="min-width: 120px;">
                                @foreach ($sizes as $size)
                                    <option value="{{ $size }}">{{ $size }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endisset
    
                    @isset($product->color)
                        <div class="form-group" style="margin-bottom: 5px">
                            <label>Pick Color: </label>
                            <select class="custom-select form-control-sm" name="color" style="min-width: 120px;">
                                @foreach ($color as $row)
                                    <option value="{{ $row }}">{{ $row }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endisset
                    <!-- Product Quantity -->
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" name="qty" value="1" style="width: 50%">
                    </div>
                    <div>
                        @if (Auth::user())
                            @if ($product->stock_quantity < 1)
                                <button class="btn btn-outline-danger" disabled="">Stock Out</button>
                            @else
                                <button class="btn btn-outline-info submit-btn" type="submit"> <span
                                        class="loading d-none">....</span>
                                    Add to cart</button>
                            @endif
                            <a href="{{ route('add.wishlist', $product->id) }}" class="btn btn-outline-primary"
                                type="button">Add to wishlist</a>
                        @else
                            <h5 class="bg-dark text-light p-2">Please Login To Add Product To Cart</h5>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
