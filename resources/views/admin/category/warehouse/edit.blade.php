<form action="{{route('warehouse.update')}}" method="POST" id="add-form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="category_name">Warehouse Name</label>
            <input type="text" class="form-control" name="warehouse_name" required="" value="{{$warehouse->warehouse_name}}">
        </div>
        <input type="hidden" name="id" value="{{$warehouse->id}}">
        <div class="form-group">
            <label for="category_name">Warehouse Address</label>
            <input type="text" class="form-control" name="warehouse_address" required="" value="{{$warehouse->warehouse_address}}">
        </div>
        <div class="form-group">
            <label for="category_name">Warehouse Number</label>
            <input type="text" class="form-control" name="warehouse_phone" required="" value="{{$warehouse->warehouse_phone}}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
