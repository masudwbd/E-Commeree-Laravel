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
                            <div class="row px-3">
                                <div class="form-group col-3">
                                    <label>Payment Type</label>
                                    <select class="form-control payment_submitable" name="payment" id="payment">
                                        <option  value="Aamarpay" selected>All</option>
                                        <option value="Hand Cash">Hand Cash</option>
                                        <option value="Aamarpay">Aamarpay</option>
                                        <option value="Paypal">Paypal</option>  
                                    </select>
                                </div>
                                <div class="form-group col-3">
                                    <label>Status</label>
                                    <select class="form-control submitable" name="status" id="status">
                                        <option selected>All</option>
                                            <option value="0">Pending</option>
                                            <option value="1">Recieved</option>
                                            <option value="2">Shipped</option>
                                            <option value="3">Completed</option>
                                            <option value="4">Return</option>
                                            <option value="5">Canceled</option>
                                    </select>
                                </div>

                                <div class="form-group col-3">
                                    <label>Date</label>
                                    <input type="date" name="date" id="date" class="form-control date_input">
                                </div>

                                <div class="col-3">
                                    <button class="btn btn-info  float-right print">Print</button>
                                </div>
                            </div> 
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="" class="table table-bordered table-striped ytable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Subtotal</th>
                                            <th>Total</th>
                                            <th>Payment Type</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Change Status</th>
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


    <div class="modal fade" id="statusmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
           <div id="modal_body">
              
           </div> 
          </div>
        </div>
      </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script>
        $(function products() {
            table = $('.ytable').DataTable({
                "processing": true,
                "serverSide": true,
                "searching": true,
                "ajax": {
                    "url": "{{ route('orders.index') }}",
                    "data": function(e) {
                        e.status = $("#status").val();
                        e.date = $("#date").val();
                        e.payment_type = $("#payment").val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'c_name',
                        name: 'c_name'
                    },
                    {
                        data: 'c_phone',
                        name: 'c_phone'
                    },
                    {
                        data: 'c_email',
                        name: 'c_email'
                    },
                    {
                        data: 'subtotal',
                        name: 'subtotal'
                    },
                    {
                        data: 'total',
                        name: 'total'
                    },
                    {
                        data: 'payment_type',
                        name: 'payment_type'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'status',
                        name: 'status'
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

    $(document).on('change', '.payment_submitable', function() {
        $('.ytable').DataTable().ajax.reload();
    });
    $(document).on('blur', '.date_input', function() {
        $('.ytable').DataTable().ajax.reload();
    });
    $(document).on('change', '.submitable', function() {
        $('.ytable').DataTable().ajax.reload();
    });

   
$('.print').on('click', function (e) {
    e.preventDefault();
    $.ajax({
        url:"{{ route('report.order.print') }}",
        type:'get',
        data: {status : $('#status').val(), date: $('#date').val() , payment_type: $('#payment').val()},
        success:function(data){
            $(data).printThis({
                debug: false,                   
                importCSS: true,                
                importStyle: true,                               
                removeInline: false, 
                printDelay: 500,
                header : null,   
                footer : null,
            });
        }
    });
});
</script>
@endsection
