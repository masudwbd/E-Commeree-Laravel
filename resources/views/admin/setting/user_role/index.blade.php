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
                            <button class="btn btn-primary" data-toggle="modal" data-target="#categoryModal">+ Add
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
                                <h3 class="card-title">All Categories List Here</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>User Name</th>
                                            <th>User Email</th>
                                            <th>User Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admin_users as $key => $user)
                                            <tr class="text-center">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                @if($user->role == 'admin')
                                                <td  style="border-top:1px solid gray">Admin</td>
                                                @elseif($user->role == null)
                                                <td  style="border-top:1px solid gray">No Roll Given</td>
                                                @elseif($user->role == 'editor')
                                                <td style="border-top:1px solid gray">Editor</td>
                                                @elseif($user->role == 'blogger')
                                                <td  style="border-top:1px solid gray">Blogger</td>
                                                @endif
                                                <td style="border-left:1px solid gray">
                                                    <a href="#" class="btn btn-info edit" data-id="{{$user->id}}" data-toggle="modal" data-target="#editModal" id="edit"> <i class="fas fa-edit"></i> </a>
                                                    <a href="{{ route('category.delete',$user->id) }}" class="btn btn-danger"
                                                        id="delete"> <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
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



    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                       
                    </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script>
        $('body').on('click', '.edit', function() {
            let cat_id = $(this).data('id');
            $.get("roles/edit/" + cat_id, function(data) {
                $(".modal-body").html(data);
            });
        });
    </script>
@endsection
