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
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="" class="table table-bordered table-striped ytable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Pickup Point Name</th>
                                            <th>Pickup Point Address</th>
                                            <th>Pickup Point Phone</th>
                                            <th>Pickup Point Phone Two</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                <form id="deleted_form" action="" method="post">
                                    @method('DELETE')
                                    @csrf
                                </form>
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

    {{-- Category Modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Pickup Point</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pickup_point.store') }}" method="POST" id="add_form">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category_name">Pickup Point Name</label>
                            <input type="text" class="form-control" id="coupon_code" name="pickup_point_name"
                                placeholder="Enter Coupon Code">
                        </div>
                        <div class="form-group">
                            <label for="category_name">Pickup Point Address</label>
                            <input type="text" class="form-control" id="coupon_code" name="pickup_point_address"
                                placeholder="Enter Coupon Code">
                        </div>
                        <div class="form-group">
                            <label for="category_name">Pickup Point Phone</label>
                            <input type="text" class="form-control" id="amount" name="pickup_point_phone"
                                placeholder="Enter Amount">
                        </div>
                        <div class="form-group">
                            <label for="category_name">Pickup Point Phone Two</label>
                            <input type="text" class="form-control" id="valid_date" name="pickup_point_phone_two"
                                placeholder="Enter Amount">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><span class="d-none loader"><i
                        class="fas fa-spinner d-none"></i>Loading... </span><span
                        class="submit_btn">Submit</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" class="" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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

    <script>
        $(function childcategory() {
            var table = $('.ytable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pickup_point.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'pickup_point_name',
                        name: 'pickup_point_name'
                    },
                    {
                        data: 'pickup_point_address',
                        name: 'pickup_point_address'
                    },
                    {
                        data: 'pickup_point_phone',
                        name: 'pickup_point_phone'
                    },
                    {
                        data: 'pickup_point_phone_two',
                        name: 'pickup_point_phone_two'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
        });



        $('body').on('click', '.edit', function() {
            let subcat_id = $(this).data('id');
            $.get("pickup_point/edit/" + subcat_id, function(data) {
                $("#modal-body").html(data);
            });
        });

        $('#add-form').on('submit', function() {
            $('.loader').removeClass('d-none');
            $('.submit_btn').addClass('d-none');
        });
    </script>


//insert Coupon
$('#add_form').submit(function(e){
    e.preventDefault();
    var link = $(this).attr('action');
    var request = $(this).serialize();
    $.ajax({
        url:link,
        type:post,
        async:false,
        data:request,
        succecss:function(data){
            toastr.success(data);
            $('#add_form')[0].reset();
            $('#addModal').modal('hide'));
            table.ajax.reload();
        }
    });
});



//delete coupon
    <script>
    $(document).ready(function(){
        $(document).on("click", "#deleted_form", function(e) {
            e.preventDefault();
            var link = $(this).attr("href");
            $('#deleted_form').attr('action', link );
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
                        $("#deleted_form").submit();
                    } else {
                        swal("Your File Is Safe!")
                    }
                });
        });

        //data passed through here
        $('#deleted_form').submit(function(e){
            e.preventDefault();
            var link = $(this).attr('action');
            var request = $(this).serialize();
            $.ajax({
                url:link,
                type:post,
                async:false,
                data:request,
                succecss:function(data){
                    $('#deleted_form')[0].reset();
                    table.ajax.reload();
                }
            });
        });
    })
    </script>
@endsection
