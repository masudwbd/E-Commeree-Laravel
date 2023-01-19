@extends('layouts.app')
@section('content')
@include('layouts.frontend_partial.main_navbar')

<div class="user-profile mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                @include('frontend.user.sidebar')
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Dashboard') }}
                        <a href="{{ route('user.create_ticket') }}" style="float:right;"><i class="fas fa-pencil-alt"></i>Create Ticket</a>
                    </div>
                    <div class="pl-4 pt-4">
                        <h6>Name: {{$order->c_name}}</h6>
                        <h6>Phone: {{$order->c_phone}}</h6>
                        <h6>OrderId: {{$order->order_id}}</h6>

                        @if($order->status==0)
                            <h6>Status: <div class="badge badge-info">Order Pending</div> </h6>
                        @elseif($order->status==1)
                            <h6>Status: <div class="badge badge-info">Order Received</div> </h6>
                        @elseif($order->status==2)
                            <h6>Status: <div class="badge badge-info">Order Shipped</div> </h6>
                        @elseif($order->status==3)
                            <h6>Status: <div class="badge badge-info">Order Done</div> </h6>
                        @elseif($order->status==4)
                            <h6>Status: <div class="badge badge-info">Order Return</div> </h6>
                        @elseif($order->status==5)
                            <h6>Status: <div class="badge badge-info">Order Cancel</div> </h6>
                        @endif
                        <h6>Date: {{$order->date}}</h6>
                        <h6>SubTotal: {{$order->subtotal}} </h6>
                        @if($order->after_discount)
                            <h6>Total: {{$order->after_discount}} </h6>
                        @else
                            <h6>Total: {{$order->total}} </h6>
                        @endif
                    </div>
                    <div class="card-body">
                        <h3 class="mt-5">My Orders</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Product Name</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ordered_items as $key=>$item)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$item->product_name}}</td>
                                    <td>{{$item->color}}</td>
                                    <td>{{$item->size}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->single_price}}</td>
                                    <td>{{$item->subtotal_price}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection