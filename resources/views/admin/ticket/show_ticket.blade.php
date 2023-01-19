@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Child Category</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">+ Add
                                New</button>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Childcategories List Here</h3>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h3>Your Ticket Details</h3>
                                        <h6>Subject: {{ $ticket->subject }}</h6>
                                        <h6>Service: {{ $ticket->service }}</h6>
                                        <h6>Priority: {{ $ticket->priority }}</h6>
                                        <h6>Message: {{ $ticket->message }}</h6>
                                    </div>
                                    <div class="col-lg-4">
                                        <img src="{{ asset($ticket->image) }}" style="height: 150px;width:200px"
                                            alt="href="{{ asset($ticket->image) }}"">
                                    </div>
                                </div>
                            </div>
                            <div class="p-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-header bg-primary">
                                                <h5>Reply Text Message</h5>
                                            </div>
                                            <div class="card-body">
                                                <form action="{{route('ticket.reply')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="">Message <span
                                                                style="color:'red'">*</span></label>
                                                        <textarea name="message" class="form-control"></textarea>
                                                        <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Image <span
                                                                style="color:'red'">*</span></label>
                                                        <input type="file" name="image" class="form-control">
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="submit">
                                                            <input type="submit" class="btn btn-info" value="Reply Message">
                                                        </div>
                                                        <a href="{{route('admin.ticket.close', $ticket->id )}}" class="btn btn-danger">Close</a>
                                                    </div>
                                                    
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-header  bg-primary">
                                                <h5>All Reply Messages</h5>
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
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>
@endsection
