<form action="{{route('user.roles.update')}}" method="POST">
    @csrf
    <div class="form-group">
        <select class="form-control" name="user_role" id="">
            <option @if($user->role=='admin') selected="" @endif value="admin" >Admin</option>
            <option 
                @if($user->role=='admin') disabled="" @endif 
                @if($user->role=='editor') selected="" @endif value="editor"  value="editor">
                Editor
            </option>
            <option 
                @if($user->role=='admin') disabled="" @endif 
                @if($user->role=='blogger') selected="" @endif value="blogger" >
                Blogger
            </option>
        </select>
        <input type="hidden" name="id" value="{{$user->id}}">
    </div>
    <input type="submit" value="Update">
</form>