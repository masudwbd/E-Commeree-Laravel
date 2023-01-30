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
                        <a href="{{ route('user.review') }}" style="float:right;"><i class="fas fa-pencil-alt"></i> Write a review</a>
                    </div>
                   
                    <div class="card-body">
                        <h3 class="mt-5">Recent Orders</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>OrderId</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Payment Type</th>
                                    <th>Status</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $item)
                                <tr>
                                    <td>{{$item->order_id}}</td>
                                    <td>{{$item->date}}</td>
                                    @if($item->after_discount)
                                    <td>{{$item->after_discount}}</td>
                                    @else
                                    <td>{{$item->total}}</td>
                                    @endif
                                    <td>{{$item->payment_type}}</td>
                                    @if($item->status==0)
                                    <td class="badge badge-warning">Order Pending</td>
                                    @elseif($item->status==1)
                                    <td class="badge badge-info">Order Recieved</td>
                                    @elseif($item->status==2)
                                    <td class="badge badge-primary">Order Shipped</td>
                                    @elseif($item->status==3)
                                    <td class="badge badge-success">Order Done</td>
                                    @elseif($item->status==4)
                                    <td class="badge badge-dark">Order Shipped</td>
                                    @elseif($item->status==5)
                                    <td class="badge badge-danger">Order Cancel</td>
                                    @endif
                                    <td>
                                        <a href="{{route('order.details.show', $item->id)}}" class="btn btn-sm btn-info edit"  style="margin-top: -10px" > <i class="fas fa-eye "></i></a>
                                        </a>
                                    </td>
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