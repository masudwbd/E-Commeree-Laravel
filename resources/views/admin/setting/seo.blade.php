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
                            <form role="form" action="{{route('seo.setting.update', $data->id)}}" method="Post">
                              @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Meta Title</label>
                                        <input type="text" value="{{$data->meta_title}}" class="form-control" name="meta_title"
                                        placeholder="Enter meta title">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Meta Author</label>
                                        <input type="text" value="{{$data->meta_author}}" class="form-control" name="meta_author"
                                        placeholder="Enter meta author">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Meta Tag</label>
                                        <input type="text" value="{{$data->meta_tag}}" class="form-control" name="meta_tag"
                                        placeholder="Enter meta tag">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Meta Description</label>
                                        <textarea type="text" value="{{$data->meta_description}}" class="form-control" name="meta_description"
                                        placeholder="Enter meta description"></textarea>
                                    </div>

                                    <br>
                                    <strong class="text-center text-success">--Other Options--</strong>
                                    <br>
                                    <br>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Google Verification</label>
                                        <input type="text" value="{{$data->google_verification}}" class="form-control" name="google_verification"
                                        placeholder="Enter google verification">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Alexa Verification</label>
                                        <input type="text" value="{{$data->alexa_verification}}" class="form-control" name="alexa_verification"
                                        placeholder="Enter Alexa Verification">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Google Analytics</label>
                                        <input type="text" value="{{$data->google_analytics}}" class="form-control" name="google_analytics"
                                        placeholder="Enter Google Analytics">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Google Adsense</label>
                                        <input type="text" value="{{$data->google_adsense}}" class="form-control" name="google_adsense"
                                        placeholder="Enter Google Adsense">
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
