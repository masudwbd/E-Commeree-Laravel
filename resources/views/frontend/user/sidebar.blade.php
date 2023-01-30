<div class="card">
    <div class="card-header">Welcome , {{ Auth::user()->name }}</div>
    <div class="card-body">
        @php 
        $user = DB::table('users')->where('id', Auth::id())->first();
        @endphp
        @if($user->image==Null)
        <div class="profile-picture text-center">
            <img class="card-img-top" src="https://thumbs.dreamstime.com/b/businessman-icon-vector-male-avatar-profile-image-profile-businessman-icon-vector-male-avatar-profile-image-182095609.jpg">
            <a href="" class="text-dark " data-toggle="modal" data-target="#addprofileModal">Add Your Own Picture</a>
        </div>
        @else
            <div class="profile-picture text-center">
                <img class="card-img-top rounded-circle" src="{{asset($user->image)}}">
            </div>
            <div class="text-center mt-4">
                <a href="" class="text-dark" data-toggle="modal" data-target="#updateprofileModal">Update Your Profile Picture</a>
            </div>
        @endif
         <ul class="list-group list-group-flush mt-4">
            <a href="{{ route('user.dashboard') }}" class="text-muted"> <li class="list-group-item"><i class="fas fa-home"></i> Dashboard</li></a>
            <a href="{{ route('frontend.wishlist') }}" class="text-muted"> <li class="list-group-item"> <i class="far fa-heart"></i> Wishlist</li></a>
            <a href="{{ route('user.orderlist') }}" class="text-muted"> <li class="list-group-item"> <i class="fas fa-file-alt"></i>  My Order</li></a>
            
            <a href="{{route('user.settings')}}" class="text-muted"> <li class="list-group-item"><i class="fas fa-edit"></i>Setting</li> </a>
            <a href="{{route('user.open_ticket')}}" class="text-muted"> <li class="list-group-item"> <i class="fab fa-telegram-plane"></i> Open Ticket</li> </a>
            <a href="" class="text-muted"> <li class="list-group-item"> <i class="fas fa-sign-out-alt"></i> Logout</li> </a>
           </ul>
     
    </div>
</div>


<div class="modal fade" id="addprofileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('user.image.add')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" class="form-control" name="profile_picture" id="">
                    <input type="hidden" name="id" value="{{Auth::id()}}">
                </div>
                <input type="submit" class="form-control" value="Submit">
            </form>
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="updateprofileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('user.image.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" class="form-control" name="profile_picture" id="">
                    <input type="hidden" value="{{$user->image}}" name="old_profile_picture" id="">
                    <input type="hidden" name="id" value="{{Auth::id()}}">
                </div>
                <input type="submit" class="form-control" value="Submit">
            </form>
        </div>
      </div>
    </div>
  </div>


