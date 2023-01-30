@extends('layouts.admin')

@section('admin_content')



    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Brand</h1>
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
                                <h3 class="card-title">All Brands List Here</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="" class="table table-bordered table-striped ytable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Title</th>
                                            <th>Slug</th>
                                            <th>Publish Date</th>
                                            <th>Tag</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <form id="deleted_form" action="" method="delete">
                                @csrf @method('DELETE')
                            </form>
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
    

    {{-- Category Modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('blog.store')}}"  method="POST"  enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @php
                         $blog_category = DB::table('blog_category')->get();   
                        @endphp

                        <div class="form-group">
                            <label for="category_name">Blog Category</label>
                            <select name="blog_category" class="form-control" id="">
                                @foreach ($blog_category as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category_name">Blog Name</label>
                            <input type="text" class="form-control"  name="blog_name"
                                placeholder="Enter Brand Category">
                        </div>
                        <div class="form-group">
                            <label for="category_name">Description</label>
                            <input type="text" class="form-control"  name="blog_description"
                                placeholder="Enter Brand Category">
                        </div>
                        <div class="form-group">
                            <label for="category_name">Tags</label>
                            <input type="text" class="form-control" value="{{ old('tags') }}"
                            data-role="tagsinput" name="tags" />
                        </div>
                        <div class="form-group">
                            <label for="category_name">Publish Date</label>
                            <input type="date" class="form-control" value="{{ old('date') }}" name="date" />
                        </div>
                        <div class="form-group">
                            <label for="category_name">Thumbnail</label>
                            <input type="file" class="form-control dropify"  name="thumbnail">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" class="" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_child_category">Edit Subcategory</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal-body">

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

    <script>
        $('.dropify').dropify();
    </script>
    <script>
        $(function childcategory() {
            var table = $('.ytable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('blog.index') }}",
                columns:[
                    {data: 'DT_RowIndex', name:'DT_RowIndex'},
                    {data: 'title', name:'title'},
                    {data: 'slug', name:'slug'},
                    {data: 'publish_date', name:'publish_date'},
                    {data: 'tag', name:'tag'},
                    {data: 'status', name:'status'},
                    {data: 'action', name:'action', orderable:true, searchable:true},
                ]
            });
        });


        $('body').on('click', '.edit', function() {
            let cat_id = $(this).data('id');
            $.get("blog/edit/" + cat_id, function(data) {
                $("#modal-body").html(data);
            });
        });




        //delete

        
        $(document).ready(function() {
            $(document).on('click', '#delete_blog', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                $('#deleted_form').attr('action', url);
                Swal.fire({
                        title: 'Are you want to delete?',
                        text: "",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $('#deleted_form').submit();
                        } else {
                            Swal('Your Data Is Safe!');
                        }
                    });
            });

            // Data passed here
            $('#deleted_form').submit(function(e) {
                e.preventDefault();
                var url = $(this).attr('action');
                var request = $(this).serialize();
                $.ajax({
                    url: url,
                    type: 'get',
                    async: false,
                    data: request,
                    success: function(data) {
                        toastr.error(data)
                        $('#deleted_form')[0].reset();
                        table.ajax.reload();
                    }
                });
            });
        });

    </script>
@endsection
