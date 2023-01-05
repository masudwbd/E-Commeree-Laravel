<form action="{{route('pickup_point.update')}}" method="POST" id="edit_form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="category_name">Pickup Point Name</label>
            <input type="text" class="form-control" id="pickup_point_name" value="{{$data->pickup_point_name}}" name="pickup_point_name"
             placeholder="Enter Coupon Code">
            <input type="hidden" name="id"  value="{{$data->id}}">
        </div>
        <div class="form-group">
            <label for="category_name">Pickup Point Address</label>
            <input type="text" class="form-control" id="pickup_point_name"  value="{{$data->pickup_point_address}}" name="pickup_point_address"
                placeholder="Enter Coupon Code">
        </div>
        <div class="form-group">
            <label for="category_name">Pickup Point Phone</label>
            <input type="text" class="form-control" id="pickup_point_name" value="{{$data->pickup_point_phone}}"  name="pickup_point_phone"
                placeholder="Enter Amount">
        </div>
        <div class="form-group">
            <label for="category_name">Pickup Point Phone Two</label>
            <input type="text" class="form-control" id="pickup_point_name" value="{{$data->pickup_point_phone_two}}" name="pickup_point_phone_two"
                placeholder="Enter Amount">
        </div>
    </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<script>
    $('#edit_form').submit(function(e){
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
            $('#edit_form')[0].reset();
            $('#editModal').modal('hide'));
            table.ajax.reload();
        }
    });
});

</script>