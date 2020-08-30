<form id="email-form" class="formsubmittrack" method="post" action="{{ route('user.storetwo') }}">
   <h3 class="heading">How can we contact you?</h3>
   <input type="hidden" name="token" value="{{ $token }}">
   <input type="email" class="text-field w-input"  name="email" value="@if(!empty($tokendata)){{ $tokendata->email ?? '' }}@endif" placeholder="Email ID" required>
   <div class="div-block-2">
      <select id="Country-Code" name="country_code" data-name="Country Code" class="select-field w-select">
         @foreach(countryarray() as $country)
         <option value="{{ $country['code'] }}" 
         @if(!empty($tokendata) && !empty($tokendata->country_code)) 

            @if($country['code'] == $tokendata->country_code) 
            selected 
            @endif 
         @else 
            @if($country['code'] == '91') selected 
            @endif
         @endif>+{{ $country['code'] }} ({{ $country['name'] }})</option>
         @endforeach
      </select>
      <input type="text" class="text-field w-input mobile_no" value="@if(!empty($tokendata)){{ $tokendata->mobile_no ?? '' }}@endif" name="mobile_no" placeholder="Mobile Number">
   </div>
   <div class="div-block-2">
      <input type="text" class="text-field w-input" value="@if(!empty($tokendata)){{ $tokendata->std_code ?? '' }}@endif" name="std_code" placeholder="STD code" maxlength="5" id="STD-code">
      <input type="text" class="text-field w-input" value="@if(!empty($tokendata)){{ $tokendata->landline_no ?? '' }}@endif" name="landline_no" placeholder="Landline Number" id="STD-code">
   </div>
  <input type="tel" class="text-field special w-input whatsapp_number" value="@if(!empty($tokendata)){{ $tokendata->whatsapp_number ?? '' }}@endif"  name="whatsapp_number"  placeholder="WhatsApp number" >
   <label class="w-checkbox checkbox-field-2">
      <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox-2" style="    border-color: #f4bb05;
    background-color: #f4bb05; "></div>
      <input type="checkbox" id="checkbox" class="valuecheck" name="checkbox" data-name="Checkbox"  style="opacity:0;position:absolute;z-index:-1"><span class="checkbox-label w-form-label">WhatsApp number is the same as Mobile Number</span>
   </label>
   <div class="div-next"><a class="submit-button w-button previousclick" data-planid="{{ $token }}" data-type="previous" data-pageid="1" style="background: #ffbb05; color: #000; "><i style="margin-top: 3px;" class="fa fa-angle-double-left"></i>&nbsp;Back&nbsp;<span class="spinnerprevious"></span></a>

      <button type="submit"  class="submit-button w-button" style="background: #ffbb05; color: #000; "> Next step&nbsp; <i style="margin-top: 3px;" class="fa fa-angle-double-right"></i>&nbsp;<span class="spinner"> </span></button></div>
</form>