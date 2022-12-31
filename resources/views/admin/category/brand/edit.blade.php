<form action="{{route('brand.update')}}" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="category_name">Brand Name</label>
            <input type="text" class="form-control" id="subcategory_name" name="brand_name"
            placeholder="Enter Category Name" value="{{ $data->brand_name }}">
        </div>
        <input type="hidden" name="id" value="{{$data->id}}">
        <div class="form-group">
            <label for="category_name">Brand Logo</label>
            <input type="file" class="dropify form-control" id="input-file-now" name="brand_logo"
            placeholder="Enter Brand Category">
        </div>
        <input type="hidden" name="old_logo" value="{{$data->brand_logo}}">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
