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
                            <li class="breadcrumb-item active">Password Change</li>
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
                            <form role="form" action="{{route('smtp.setting.update', $data->id)}}" method="Post">
                              @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mail Mailer</label>
                                        <input type="text" value="{{$data->mailer}}" class="form-control" name="mailer"
                                        placeholder="Enter mailer">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mail Host</label>
                                        <input type="text" value="{{$data->host}}" class="form-control" name="host"
                                        placeholder="Enter host">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mail Port</label>
                                        <input type="text" value="{{$data->port}}" class="form-control" name="port"
                                        placeholder="Enter port">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mail Username</label>
                                        <input type="text" value="{{$data->user_name}}" class="form-control" name="user_name"
                                        placeholder="Enter user_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mail Password</label>
                                        <input type="text" value="{{$data->password}}" class="form-control" name="password"
                                        placeholder="Enter mail password">
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
