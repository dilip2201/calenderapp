<form  autocorrect="off" action="{{ route('admin.users.store') }}" autocomplete="off" method="post" class="form-horizontal form-bordered formsubmit">
    {{ csrf_field() }}

    @if(isset($user) && !empty($user->id) )
        <input type="hidden" name="userid" value="{{ encrypt($user->id) }}">
    @endif
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control " name="name"
                       placeholder="Name"
                       value="@if(!empty($user)){{ $user->name }}@endif" required="" maxlength="30">
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" name="lastname"
                       placeholder="Last Name"
                       value="@if(!empty($user)){{ $user->last_name }}@endif" required="" maxlength="30">
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control " name="email"
                       placeholder="Email"
                       value="@if(!empty($user)){{ $user->email }}@endif" required="">
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label>Role</label>
               <select class="form-control" name="role">
                   <option value="super_admin" @if(!empty($user) && $user->role == 'super_admin') selected @endif>Super Admin</option>
                   <option value="user" @if(!empty($user) && $user->role == 'user') selected @endif>User</option>
                   <option value="operator" @if(!empty($user) && $user->role == 'operator') selected @endif>Operator</option>
               </select>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control " minlength="6" name="password"
                       placeholder="password"
                       value="" @if(empty($user)) required @endif>
            </div>
        </div>
        <input id="password-confirm" type="password" placeholder="Confirm Password"
                    name="asaspassword_confirmation" autocomplete="new-password" style="display: none;">
  <!--         <div class="col-md-6">
              <div class="form-group">
                  
                  <label>Profile Image</label>
                  <input type="file" name="image" accept="image/*"
                      class="form-control logo_image" style="padding: 3px;" 
                      placeholder="Profile image">
              </div>
          </div> -->
          @php $image = url('public/company/employee/default.png'); @endphp

          @if(!empty($user) && file_exists(public_path().'/company/employee/'.$user->image) && !empty($user->image))
               @php $image = url('public/company/employee/'.$user->image);  @endphp
          @endif
                                                       <div class="col-6">
                                                    <div class="media">
                                                    <a href="javascript: void(0);">
                                                        <img src="{{$image }}" class="rounded mr-75 image_preview logo_image" alt="profile image" height="64" width="64">
                                                    </a>
                                                    <div class="media-body mt-75">
                                                        <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                            <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer waves-effect waves-light " for="account-upload">Upload new photo</label>
                                                            <input type="file" name="image" class="logo_image" id="account-upload" hidden="">
                                                        </div>
                                                        <p class="text-muted ml-75 mt-50"><small>Allowed JPG, GIF or PNG. Max
                                                                size of
                                                                800kB</small></p>
                                                    </div>
                                                </div>
                                            </div>
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary  submitbutton pull-right"> Submit <span class="spinner"></span></button>
            </div>
        </div>
    </div>
</form>