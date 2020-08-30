<form method="post" action="{{ route('user.storesix') }}"  class="form formsubmittrack">
	<input type="hidden" name="token" value="{{ $token }}">
            <h3 class="heading">We want to know more about you!</h3>

            <input type="text" class="text-field w-input" name="brand_name" value="@if(!empty($tokendata)){{ $tokendata->brand_name ?? '' }}@endif"  placeholder="Brand name" id="Brand-2">


            <textarea rows="3" name="words_describe" class="text-field  w-input" placeholder="Five words that best describe you!">@if(!empty($tokendata)){{ $tokendata->words_describe ?? '' }}@endif</textarea>

            <textarea rows="3" name="product_best_at" class="text-field  w-input" placeholder="10 products you are best at!">@if(!empty($tokendata)){{ $tokendata->product_best_at ?? '' }}@endif</textarea>


            <label class="w-checkbox checkbox-field">
            	<div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox @if(!empty($tokendata) && $tokendata->veg_non_veg == 'veg') w--redirected-checked @endif"></div>

            	<input type="checkbox" id="Veggie" name="veg_non_veg" data-name="Veggie" style="opacity:0;position:absolute;z-index:-1" value="1" @if(!empty($tokendata) && $tokendata->veg_non_veg == 'veg') checked @endif><span for="Veggie" class="radio-button-label w-form-label">I&#x27;m veggie friendly!</span></label>
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
                           <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer waves-effect waves-light" for="account-upload">Upload a Display Picture</label>
                            <input type="file" name="image" class="logo_image" id="account-upload" hidden="">
                           
                       </div>
                       <p class="text-muted ml-75 mt-50"><small>Allowed JPG, GIF or PNG. Max
                               size of
                               800kB</small></p>
                  </div>
               </div>
      <div class="div-next">
      <a class="submit-button w-button previousclick" data-planid="{{ $token }}" data-type="previous" data-pageid="5" style="background: #ffbb05; color: #000; ">
      <i style="margin-top: 3px;" class="fa fa-angle-double-left"></i>&nbsp;Back&nbsp;<span class="spinnerprevious"></span>
      </a>
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
