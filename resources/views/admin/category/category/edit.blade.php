<form action="{{route('category.update')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="category_name">Category Name</label>
        <input type="text" value="{{$data->category_name}}" class="form-control" id="e_category_name" name="category_name"
            placeholder="Enter Category Name">
        <input type="file" name="icon" id="">
        <input type="hidden" value="{{$data->id}}" name="id">
        <input type="hidden" value="{{$data->icon}}" name="old_icon" id="">
        <small id="" class="form-text text-muted">This is your main category</small>
    </div>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
