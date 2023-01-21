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
                            <div class="p-4">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-header bg-primary">
                                                <h5>Aamarpay Gateway</h5>
                                            </div>
                                            <div class="card-body">
                                                <form action="{{route('aamarpay.payment.gateway')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="">Store Id </label>
                                                        <input type="text" name="store_id" class="form-control" value="{{$aamarpay->store_id}}" id="">
                                                        <input type="hidden" name="id" class="form-control" value="{{$aamarpay->id}}" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Signature Id </label>
                                                        <input type="text" name="signature_id" class="form-control" value="{{$aamarpay->signature_id}}" id="">
                                                    </div>
                                                    <div class="form-group ml-4">
                                                        <input type="checkbox" name="status" value="1" @if($aamarpay->status==1) checked @endif id="" class="form-check-input" aria-describedby="helpId">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Live Server
                                                        </label>
                                                        <small>(If checkbox are not checked it working for sandbox only)</small>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="submit">
                                                            <input type="submit" class="btn btn-info" value="Update">
                                                        </div>
                                                        <a href="" class="btn btn-danger">Close</a>
                                                    </div>
                                                    
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-header bg-primary">
                                                <h5>Surjopay Gateway</h5>
                                            </div>
                                            <div class="card-body">
                                                <form action="{{route('surjopay.payment.gateway')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="">Store Id </label>
                                                        <input type="text" name="store_id" class="form-control" value="{{$surjopay->store_id}}" id="">
                                                        <input type="hidden" name="id" value="{{$surjopay->id}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Signature Id </label>
                                                        <input type="text" name="signature_id" class="form-control" value="{{$surjopay->signature_id}}" id="">
                                                    </div>
                                                    <div class="form-group ml-4">
                                                        <input type="checkbox" name="status" value="1" @if($surjopay->status==1) checked @endif id="" class="form-check-input" aria-describedby="helpId">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Live Server
                                                        </label>
                                                        <small>(If checkbox are not checked it working for sandbox only)</small>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="submit">
                                                            <input type="submit" class="btn btn-info" value="Update">
                                                        </div>
                                                        <a href="" class="btn btn-danger">Close</a>
                                                    </div>
                                                    
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-header bg-primary">
                                                <h5>SSL Commerz</h5>
                                            </div>
                                            <div class="card-body">
                                                <form action="{{route('ssl.payment.gateway')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="">Store Id </label>
                                                        <input type="text" name="store_id" class="form-control" value="{{$ssl->store_id}}" id="">
                                                        <input type="hidden" name="id" value="{{$ssl->id}}" id="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Signature Id </label>
                                                        <input type="text" name="signature_id" class="form-control" value="{{$ssl->signature_id}}" id="">
                                                    </div>
                                                    <div class="form-group ml-4">
                                                        <input type="checkbox" name="status" value="1" @if($ssl->status==1) checked @endif id="" class="form-check-input" aria-describedby="helpId">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Live Server
                                                        </label>
                                                        <small>(If checkbox are not checked it working for sandbox only)</small>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="submit">
                                                            <input type="submit" class="btn btn-info" value="Update">
                                                        </div>
                                                        <a href="" class="btn btn-danger">Close</a>
                                                    </div>
                                                    
                                                </form>
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
