<form action="{{route('blog.category.update')}}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="category_name">Blog Category Name</label>
            <input type="text" class="form-control" value="{{$category->category_name}}"  name="category_name"
                placeholder="Enter Brand Category">

            <input type="hidden" name="id" value="{{$category->id}}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>