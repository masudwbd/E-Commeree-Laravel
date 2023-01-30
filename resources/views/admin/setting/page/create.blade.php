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
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">Add New Page</li>
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
                    <div class="password_change_form col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add New Page</h3>
                            </div>
                            <form role="form" action="{{route('page.store')}}" method="Post">
                              @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Page Position</label>
                                        <select class="form-control" name="page_position" id="">
                                            <option value="1">link1</option>
                                            <option value="2">link2</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Page Name</label>
                                        <input type="text" class="form-control"  name="page_name" placeholder="Enter page name">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Page title</label>
                                        <input class="form-control" type="text" name="page_title" placeholder="Enter page title">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Page description</label>
                                        <textarea class="form-control textarea" rows="4" name="page_description"></textarea>
                                        <small>This data will be showed in your web page!</small>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
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

