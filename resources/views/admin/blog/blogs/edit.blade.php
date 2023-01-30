<form action="{{route('blog.update')}}"  method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        @php
         $blog_category = DB::table('blog_category')->get()   
        @endphp

        <div class="form-group">
            <label for="category_name">Blog Category</label>
            <select name="blog_category" class="form-control" id="">
                @foreach ($blog_category as $category)
                    <option value="{{$category->id}}" @if ($category->id==$blog->blog_category_id) selected="" @endif >{{$category->category_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="category_name">Blog Title</label>
            <input type="text" class="form-control" value="{{$blog->title}}"  name="blog_name"
                placeholder="Enter Brand Category">
                <input type="hidden" name="id" value="{{$blog->id}}">
        </div>
        <div class="form-group">
            <label for="category_name">Description</label>
            <input type="text" class="form-control" value="{{$blog->description}}"  name="blog_description"
                placeholder="Enter Brand Category">
        </div>
        <div class="form-group">
            <label for="category_name">Publish Date</label>
            <input type="date" class="form-control" value="{{$blog->publish_date}}" name="date" />
        </div>
        <div class="form-group">
            <label for="category_name">Thumbnail</label>
            <input type="file" class="form-control dropify"  name="thumbnail">
            <input type="hidden" value="{{$blog->thumbnail}}" name="old_thumbnail">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>