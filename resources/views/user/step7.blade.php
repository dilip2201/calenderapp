<form method="post" action="{{ route('user.storeseven') }}"  class="form formsubmittrack">
            <h3 class="heading">Our last two questions!</h3>
            <input type="hidden" name="token" value="{{ $token }}">
            <select id="field" name="fssai" class="select-field w-select">
            	<option value="">Do you have FFSAI?</option>
            	<option value="yes" @if(!empty($tokendata) && $tokendata->fssai == 'yes') selected @endif>Yes</option>
            	<option value="No" @if(!empty($tokendata) && $tokendata->fssai == 'no') selected @endif>No</option>
            </select>
            <input type="text" class="text-field w-input"  name="fssai_no" value="@if(!empty($tokendata)){{ $tokendata->fssai_no ?? '' }}@endif" placeholder="If yes, please provide us the number" id="GST-N-2">
            <select id="field-2" name="gst_no"  class="select-field w-select">
            	<option value="">Do you have GST no?</option>
            	<option value="yes" @if(!empty($tokendata) && $tokendata->gst_no == 'yes') selected @endif>Yes</option>
            	<option value="No" @if(!empty($tokendata) && $tokendata->gst_no == 'no') selected @endif>No</option>
            </select>
            <input type="text" class="text-field w-input"  value="@if(!empty($tokendata)){{ $tokendata->gst_number ?? '' }}@endif"  name="gst_number" placeholder="If yes, please provide us the number" id="GST-N">
            <div class="div-next">
      <a class="submit-button w-button previousclick" data-planid="{{ $token }}" data-type="previous" data-pageid="6" style="background: #ffbb05; color: #000; ">
      <i style="margin-top: 3px;" class="fa fa-angle-double-left"></i>&nbsp;Back&nbsp;<span class="spinnerprevious"></span>
      </a>
      <button type="submit"  class="submit-button w-button" style="background: #ffbb05; color: #000; "> Next step&nbsp; <i style="margin-top: 3px;" class="fa fa-angle-double-right"></i>&nbsp;<span class="spinner"> </span></button>
   </div>
          </form>