<form action="{{route('subcategory.update')}}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="category_name">Category Name</label>
            <select class="form-control" name="category_id" required>
                @foreach ($category as $row)
                    <option value="{{ $row->id }}" @if ($row->id==$data->category_id) selected="" @endif> {{ $row->category_name }} </option>
                @endforeach
            </select>
            <input type="hidden" name="id" value="{{$data->id}}">
        </div>
        <div class="form-group">
            <label for="category_name">Sub Category Name</label>
            <input type="text" class="form-control" id="subcategory_name" name="subcategory_name"
                placeholder="Enter Category Name" value="{{ $data->subcategory_name }}">
            <small id="" class="form-text text-muted">This is your sub category</small>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
