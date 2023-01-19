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
                    <div class="card-body">
                       <h4>Your Default Shipping Credentials.</h4><br>
                       <div>
                             <form action="{{route('user.ticket.store')}}" method="post" enctype="multipart/form-data">
                                 @csrf
                               <div class="form-group">
                                 <label for="exampleInputEmail1">Subject</label>
                                 <input type="text" class="form-control" name="subject" value="">
                               </div>
                               <div class="form-group">
                                <label for="service">service</label>
                                <select name="service" class="form-control" style="min-width:300px" id="">
                                    <option value="Technical">Technical</option>
                                    <option value="Payment">Payment</option>
                                    <option value="Affilate">Affilate</option>
                                    <option value="Return">Return</option>
                                    <option value="Refund">Refund</option>
                                </select>
                               </div>
                               <div class="form-group">
                                <label for="priority">Priority</label>
                                <select name="priority" class="form-control" style="min-width:300px" id="">
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                               </div>
                               <div class="form-group">
                                <label for="">message</label>
                                <textarea class="form-control" name="message"></textarea>
                               </div>
                               <div class="form-group">
                                <label for="">Image</label>
                                <input type="file" class="form-control" name="image"/>
                               </div>
                               <button type="submit" class="btn btn-primary">Submit Ticket</button>
                             </form>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection