<form method="post" action="{{ route('user.storesix') }}"  class="form formsubmittracklastpage">
            <h3 class="heading">Our last few questions!</h3>
            <input type="hidden" name="token" value="{{ $token }}">
            <select id="field" name="fssai" class="select-field w-select">
            	<option value="">Do you have FFSAI?</option>
            	<option value="yes" @if(!empty($tokendata) && $tokendata->fssai == 'yes') selected @endif>Yes</option>
            	<option value="No" @if(!empty($tokendata) && $tokendata->fssai == 'no') selected @endif>No</option>
            </select>
            
            <select id="field-2" name="gst_no"  class="select-field w-select">
            	<option value="">Do you have GST no?</option>
            	<option value="yes" @if(!empty($tokendata) && $tokendata->gst_no == 'yes') selected @endif>Yes</option>
            	<option value="No" @if(!empty($tokendata) && $tokendata->gst_no == 'no') selected @endif>No</option>
            </select>
              <input type="text" class="text-field w-input" name="brand_name" value="@if(!empty($tokendata)){{ $tokendata->brand_name ?? '' }}@endif"  placeholder="Brand name" id="Brand-2">

              <label class="w-checkbox checkbox-field">
                  <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox @if(!empty($tokendata) && $tokendata->veg_non_veg == 'veg') w--redirected-checked @endif"></div>

                  <input type="checkbox" id="Veggie" name="veg_non_veg" data-name="Veggie" style="opacity:0;position:absolute;z-index:-1" value="1" @if(!empty($tokendata) && $tokendata->veg_non_veg == 'veg') checked @endif><span for="Veggie" class="radio-button-label w-form-label">I&#x27;m veggie friendly!</span></label>


            <div class="div-next">
      <a class="submit-button w-button previousclick" data-planid="{{ $token }}" data-type="previous" data-pageid="5" style="background: #ffbb05; color: #000; ">
      <i style="margin-top: 3px;" class="fa fa-angle-double-left"></i>&nbsp;Back&nbsp;<span class="spinnerprevious"></span>
      </a>
      
      <button type="submit"  class="submit-button w-button" style="background: #ffbb05; color: #000; "> Submit <span class="spinner"> </span></button>
   </div>
          </form>