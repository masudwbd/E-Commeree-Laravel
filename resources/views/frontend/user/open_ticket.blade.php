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
                   
                    <div class="card-body">
                        <h3 class="mt-5">Recent Orders</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Service</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $item)
                                <tr>
                                    <td>{{$item->subject}}</td>
                                    <td>{{$item->service}}</td>
                                    <td>{{$item->priority}}</td>
                                    @if($item->status==0)
                                        <td class="badge badge-info">Pending</td>
                                    @elseif($item->status==1)
                                        <td class="badge badge-success">Replied</td>
                                    @elseif($item->status==2)
                                        <td class="badge badge-danger">Closed</td>
                                    @endif
                                    <td>
                                        <a href="{{route('user.ticket.show', $item->id)}}" class="btn btn-sm btn-info edit"  style="margin-top: -10px" > <i class="fas fa-eye"></i></a>
                                        <a href="{{route('user.ticket.delete', $item->id)}}" class="btn btn-sm btn-danger" id="delete" style="margin-top: -10px"> <i class="fas fa-trash"></i>
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