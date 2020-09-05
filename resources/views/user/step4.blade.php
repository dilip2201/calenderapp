 <form id="email-form" method="post" action="{{ route('user.storefour') }}" class="form formsubmittrack">
            <h3 class="heading">What&#x27;s your address?</h3>
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="text" class="text-field w-input"  name="address_1" value="@if(!empty($tokendata)){{ $tokendata->address_1 ?? '' }}@endif" placeholder="Street/Avenue" id="Address">
            <div class="div-block-3">
            	<input type="text" class="text-field w-input" name="address_2" value="@if(!empty($tokendata)){{ $tokendata->address_2 ?? '' }}@endif"  name="address_2" placeholder="Apartment / No" id="Address-4">
            	<input type="text" class="text-field w-input" value="@if(!empty($tokendata)){{ $tokendata->address_3 ?? '' }}@endif"  name="address_3" placeholder="Extra indications" id="Address-3">
            </div>
            <div class="div-block-3">
            	<div class="new" style="position: relative;">
                  <input type="text" class="text-field w-input pincode" value="@if(!empty($tokendata)){{ $tokendata->pincode ?? '' }}@endif" name="pincode" placeholder="Pin Code">
                  <span class="spinnerload" style="position: absolute;
    top: 10px;
    right: 10px;">
                  </div>
            	<input type="text" class="text-field w-input area"  value="@if(!empty($tokendata)){{ $tokendata->area ?? '' }}@endif" name="area" placeholder="Area" >
            </div>
            <input type="text" class="text-field w-input city" value="@if(!empty($tokendata)){{ $tokendata->city ?? '' }}@endif"  name="city" placeholder="City" >
            <input type="text" class="text-field w-input state" value="@if(!empty($tokendata)){{ $tokendata->state ?? '' }}@endif" name="state" placeholder="State" >
            <input type="text" class="text-field w-input country" value="@if(!empty($tokendata)){{ $tokendata->country ?? '' }}@endif" name="country" data-name="Country" placeholder="Country">
            <div class="div-next"><a class="submit-button w-button previousclick" data-planid="{{ $token }}" data-type="previous" data-pageid="2" style="background: #ffbb05; color: #000; "><i style="margin-top: 3px;" class="fa fa-angle-double-left"></i>&nbsp;Back&nbsp;<span class="spinnerprevious"></span></a>
	<button type="submit"  class="submit-button w-button" style="background: #ffbb05; color: #000; "> Next step&nbsp; <i style="margin-top: 3px;" class="fa fa-angle-double-right"></i>&nbsp;<span class="spinner"> </span></button></div>
          </form>