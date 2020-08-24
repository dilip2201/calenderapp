
@extends('layout.app')

@section('content')
@section('pageTitle', 'Profile')
            <div class="content-body">
                <!-- account setting page start -->
                <section id="page-account-settings">
                    <div class="row">
                        <!-- left menu section -->
                        <div class="col-md-3 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75 active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                        <i class="feather icon-globe mr-50 font-medium-3"></i>
                                        General
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                        <i class="feather icon-lock mr-50 font-medium-3"></i>
                                        Change Password
                                    </a>
                                </li>
                               
                            </ul>
                        </div>
                        <!-- right content section -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                      
                                                <form action=" {{ route('admin.profileupdate') }}" class="formsubmit"
                                                method="post" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                    <div class="row">
                                                      
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-name"><b> First Name </b><span
                                                style="color: red;">*</span></b></label>
                                                                    <input type="text" class="form-control" name="name" id="account-name" placeholder="Name"  required="" 
                                                                    value="{{ auth()->user()->name ? auth()->user()->name : '-'  }}" data-validation-required-message="This name field is required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-e-mail"><b>Last Name</b><span
                                                style="color: red;">*</span></label>
                                                                    <input type="last_name" name="last_name" class="form-control" id="account-e-mail" placeholder="Email" value="{{ auth()->user()->last_name ? auth()->user()->last_name : '-'  }}"  required="" data-validation-required-message="This email field is required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-e-mail"><b>E-mail </b><span
                                                style="color: red;">*</span></label>
                                                                    <input type="email" name="email" class="form-control" id="account-e-mail" placeholder="Email" value="{{ auth()->user()->email ? auth()->user()->email : '-'  }}"  required="" data-validation-required-message="This email field is required">
                                                                </div>
                                                            </div>
                                                        </div>

                                                         @if(auth()->user()->image)
                                                            <?php $img = auth()->user()->image; ?>
                                                            @else
                                                            <?php $img = 'default.png'; ?>
                                                            @endif
                                                <div class="col-6">
                                                    <div class="media">
                                                    <a href="javascript: void(0);">
                                                        <img src="{{ URL::asset('public/company/employee/'.$img) }}" class="rounded mr-75 image_preview logo_image" alt="profile image" height="64" width="64">
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

                                                        
                                                        
                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Save changes <span class="spinner"></span> </button>

                                                          
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade " id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                                 <form class="form-some-up form-block passwordformsubmit" role="form"
                                                    action="{{ route('admin.changepassword') }}" method="post">
                                                     <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-old-password"> <b>Current Password </b> <span
                                                style="color: red;">*</span></label>
                                                                    <input type="password" name="current_password" class="form-control" id="account-old-password" required="" placeholder="Old Password" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-new-password"> <b>New Password </b> <span
                                                style="color: red;">*</span></label>
                                                                    <input type="password"  name="new_password"  id="account-new-password" class="form-control" placeholder="New Password" required="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-retype-new-password"> <b>Confirm
                                                                        Password </b> <span
                                                style="color: red;">*</span></label>
                                                                    <input type="password"  name="password_confirmation" class="form-control" required="" id="account-retype-new-password" data-validation-match-match="password" placeholder="New Password">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Save changes  <span class="spinner"></span> </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                          
                                         
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- account setting page end -->

            </div>

<script src="https://jqueryvalidation.org/files/lib/jquery.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script>
    function readURL(input, classes) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('.' + classes).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$('body').on('change', '.logo_image', function() {
    readURL(this, 'image_preview');
});
/*Update Profile*/
$('body').on('submit', '.formsubmit', function(e) {
    e.preventDefault();
    $.ajax({
        url: $(this).attr('action'),
        data: new FormData(this),
        type: 'POST',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.spinner').html('<i class="fa fa-spinner fa-spin"></i>')
        },
        success: function(data) {
            
            if (data.status == 400) {
                $('.spinner').html('');
                toastr.error(data.msg)
            }
            if (data.status == 200) {

                $('.spinner').html('');
                toastr.success(data.msg)
            }
        },
    });
});
$(".formsubmit").validate({
    rules: {
        name : {
            required:true,
            maxlength: 20,
        },
        email:{
            required:true,
            maxlength: 20,
        },
    }

});
$(".passwordformsubmit").validate({
    rules : {
                new_password : {
                    minlength : 8
                },
                password_confirmation : {
                    minlength : 8,
                    equalTo : "#account-new-password"
                }
    }
});
    /*change password*/
$('body').on('submit', '.passwordformsubmit', function(e) {
    e.preventDefault();
    $.ajax({
        url: $(this).attr('action'),
        data: new FormData(this),
        type: 'POST',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.spinner').html('<i class="fa fa-spinner fa-spin"></i>')
        },
        success: function(data) {
            
            if (data.status == 400) {
                $('.spinner').html('');
                toastr.error(data.msg)

            }
            if (data.status == 200) {
                $('.spinner').html('');
                $(".passwordformsubmit")[0].reset();
                toastr.success(data.msg)
            }
        },
    });
});
</script>
@endsection
