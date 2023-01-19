<form action="{{ route('campaign.update') }}" method="POST" enctype="multipart/form-data" id="add_form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="category_name">Campaign Title</label>
            <input type="text" class="form-control" value="{{$campaign->title}}" id="campaign_title" name="campaign_title"
                placeholder="Enter Coupon Code">
                <input type="hidden" value="{{$campaign->id}}" name="id">
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="category_name">Start Date</label>
                    <input type="date" class="form-control"  value="{{$campaign->start_date}}"  id="start_date" name="start_date"
                        placeholder="Enter Coupon Code">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="category_name">End Date</label>
                    <input type="date" class="form-control"  value="{{$campaign->end_date}}"  id="end_date" name="end_date"
                        placeholder="Enter Coupon Code">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control" id="status">
                        @if($campaign->status==1)
                        <option value="1" selected>Active</option>
                        <option value="0">InActive</option>
                        @else 
                        <option value="1">Active</option>
                        <option value="0" selected>InActive</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Discount(%)</label>
                    <input type="number" value="{{$campaign->discount}}" class="form-control" id="discount" name="discount"
                    placeholder="Enter Coupon Code"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="category_name">Campaign Image</label>
            <input type="file" class="dropify form-control" name="new_image">
            <input type="hidden" value="{{$campaign->image}}" name="old_image">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"><span class="d-none loader"><i
        class="fas fa-spinner d-none"></i>Loading... </span><span
        class="submit_btn">Submit</span></button>
    </div>
</form>