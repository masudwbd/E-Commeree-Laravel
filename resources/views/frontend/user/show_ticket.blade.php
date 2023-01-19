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
                        <div class="row">
                            <div class="col-lg-8">
                                <h3>Your Ticket Details</h3>
                                <h6>Subject: {{$ticket->subject}}</h6>
                                <h6>Service: {{$ticket->service}}</h6>
                                <h6>Priority: {{$ticket->priority}}</h6>
                                <h6>Message: {{$ticket->message}}</h6>
                            </div>
                            <div class="col-lg-4">
                                    <img  src="{{asset($ticket->image)}}" style="height: 150px;width:200px" alt="href="{{asset($ticket->image)}}"">
                            </div>
                        </div>

                   </div>
                </div>
                <div class="card mt-4" >
                    <div class="card-header">
                        <h4>All Reply Messages</h4>
                    </div>
                    <div class="card-body " style="overflow-y: scroll;height:300px">
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h6>name</h6>
                                </div>
                                <div class="card-body " style="overflow-y:scroll;height:300px">
                                    @foreach($replies as $reply)
                                    @php
                                        $user = DB::table('users')->where('id', $reply->user_id)->first()
                                    @endphp
                                    <div class="card mt-3">
                                        <div class="card-header" style="background-color: #fff;color:black">
                                            <h6>{{$user->name}}</h6>
                                        </div>
                                        <div class="card-body" style="background-color: #fff;color:black">
                                            <div class="reply " style="border-left:5px solid #007bff!important">
                                                <p class="ml-3">{{$reply->message}}</p>
                                                <p class="ml-3">Replied Date: {{$reply->date}}</p>
                                            </div>

                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection