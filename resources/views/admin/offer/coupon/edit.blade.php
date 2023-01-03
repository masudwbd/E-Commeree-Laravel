<form action="{{route('coupon.update')}}" method="POST" id="edit_form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="category_name">Coupon Code</label>
            <input type="text" class="form-control" id="coupon_code" value="{{$data->coupon_code}}" name="coupon_code"
                placeholder="Enter Coupon Code">
            <input type="hidden" value="{{$data->id}}" name="id">
        </div>
        <div class="form-group">
            <label for="category_name">Coupon Type</label>
            <select type="text" class="form-control" id="coupon_type" name="coupon_type" value="{{$data->type}}">
                <option value="1">Fixed</option>
                <option value="2">Percantage</option>
            </select>
        </div>
        <div class="form-group">
            <label for="category_name">Amount</label>
            <input type="text" class="form-control" value="{{$data->coupon_amount}}" id="amount" name="coupon_amount"
                placeholder="Enter Amount">
        </div>
        <div class="form-group">
            <label for="category_name">Valid Date</label>
            <input type="date" class="form-control" id="valid_date" value="{{$data->valid_date}}" name="valid_date"
                placeholder="Enter Amount">
        </div>
        <div class="form-group">
            <label for="category_name">Status</label>
            <select type="text" class="form-control" value="{{$data->status}}" id="coupon_type" name="status" >
                <option value="1">Active</option>
                <option value="2">Inactive</option>
            </select>
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