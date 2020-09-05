<style type="text/css">
   .toast-error {
    background-color: #BD362F!important;
}
</style>

<form id="email-form" method="post" class="formsubmittrack" action="{{ route('user.storeone') }}" name="email-form">
   <input type="hidden" name="token" value="{{ $token }}">
   <h3 class="heading">Hey! What&#x27;s your name?</h3>
   <input type="text" class="text-field w-input" maxlength="256" name="first_name" data-name="Name" placeholder="First name" id="name" required value="@if(!empty($tokendata)){{ $tokendata->first_name ?? '' }}@endif">
   <input type="text" class="text-field w-input" maxlength="256" value="@if(!empty($tokendata)){{ $tokendata->middle_name ?? '' }}@endif" name="middle_name" placeholder="Middle name">
   <input type="text" class="text-field w-input" value="@if(!empty($tokendata)){{ $tokendata->last_name ?? '' }}@endif"  maxlength="256" name="last_name" placeholder="Last Name" >
   <input type="date" class="text-field w-input" value="@if(!empty($tokendata)){{ $tokendata->dob ?? '' }}@endif" maxlength="256" name="dob"  placeholder="Date of birth" name="last_name">
   <select  name="gender"  class="select-field w-select">
      <option value="">Select gender</option>
      <option value="male" @if(!empty($tokendata) && $tokendata->gender == 'male') selected @endif>Male</option>
      <option value="female"  @if(!empty($tokendata) && $tokendata->gender == 'female') selected @endif>Female</option>
      <option value="other"  @if(!empty($tokendata) && $tokendata->gender == 'other') selected @endif>Other</option>
   </select>
   @php $image = url('public/company/employee/default.png'); @endphp
   @if(!empty($tokendata) && file_exists(public_path().'/company/employee/'.$tokendata->image) && !empty($tokendata->image))
   @php $image = url('public/company/employee/'.$tokendata->image);  @endphp
   @endif
   <div class="media">
      <a href="javascript: void(0);">
      <img src="{{$image }}" class="rounded mr-75 image_preview logo_image" alt="profile image" height="64" width="64">
      </a>
      <div class="media-body mt-75">
         <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
            <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer waves-effect waves-light" for="account-upload" style="    color: #000;
    background-color: #f4bb05;
    border-color: #f4bb05;">Upload a Display Picture</label>
            <input type="file" name="image" class="logo_image" id="account-upload" hidden="">
         </div>
         <p class="text-muted ml-75 mt-50"><small>Allowed JPEG,JPG,PNG. </small>
         </p>
      </div>
   </div>
   <div class="div-next first-div">
      <button type="submit"  class="submit-button w-button" style="background: #ffbb05; color: #000; "> Next step&nbsp; <i style="margin-top: 3px;" class="fa fa-angle-double-right"></i>&nbsp;<span class="spinner"> </span></button>
   </div>
</form>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/app-assets/vendors/css/vendors.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/app-assets/css/bootstrap.min.css') }}">
<script type="text/javascript">
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
</script>