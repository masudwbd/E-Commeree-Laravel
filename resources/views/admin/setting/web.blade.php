@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard v2</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <div class="password_change_form col-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Change Your Password</h3>
                            </div>
                            <form role="form" action="{{route('website.update', $data->id)}}" enctype="multipart/form-data" method="Post">
                              @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">currency</label>
                                        <select type="text" value="{{$data->currency}}" class="form-control" name="currency">
                                            <option value="৳" {{($data->currency=="৳") ? "selected" : ''}}>TAKA</option>
                                            <option value="$" {{($data->currency=="$")? "selected" : ''}} >USD</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone One</label>
                                        <input type="text" value="{{$data->phone_one}}" class="form-control" name="phone_one"
                                        placeholder="Enter Phone One">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone Two</label>
                                        <input type="text" value="{{$data->phone_two}}" class="form-control" name="phone_two"
                                        placeholder="Enter Phone Two">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Main Email</label>
                                        <input type="text" value="{{$data->main_email}}" class="form-control" name="main_email"
                                        placeholder="Enter Main Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Support Email</label>
                                        <input type="text" value="{{$data->support_email}}" class="form-control" name="support_email"
                                        placeholder="Enter Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Adress</label>
                                        <input type="address" value="{{$data->address}}" class="form-control" name="address"
                                        placeholder="Enter address">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Facebook</label>
                                        <input type="address" value="{{$data->facebook}}" class="form-control" name="facebook"
                                        placeholder="Enter Facebook">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Twitter</label>
                                        <input type="address" value="{{$data->twitter}}" class="form-control" name="twitter"
                                        placeholder="Enter Twitter">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Instagram</label>
                                        <input type="address" value="{{$data->instagram}}" class="form-control" name="instagram"
                                        placeholder="Enter Instagram">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Linkdin</label>
                                        <input type="address" value="{{$data->linkdin}}" class="form-control" name="linkdin"
                                        placeholder="Enter Linkdin">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Youtube</label>
                                        <input type="address" value="{{$data->youtube}}" class="form-control" name="youtube"
                                        placeholder="Enter Youtube">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Logo</label>
                                        <input type="file" name="logo">
                                        <input type="hidden" value="{{$data->logo}}"  name="old_logo">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Favicon</label>
                                        <input type="file" name="favicon">
                                        <input type="hidden" value="{{$data->logo}}"  name="old_favicon">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
