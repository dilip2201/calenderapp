<form id="email-form" name="email-form" method="post" action="{{ route('user.storethree') }}" class="form formsubmittrack">
	<input type="hidden" name="token" value="{{ $token }}">
   <h3 class="heading">Do you have social media?</h3>
   <input type="text" class="text-field w-input"  value="@if(!empty($tokendata)){{ $tokendata->fb_link ?? '' }}@endif"   name="fb_link"  placeholder="Facebook Link" id="Facebook">
   <input type="text" class="text-field w-input" value="@if(!empty($tokendata)){{ $tokendata->insta_link ?? '' }}@endif"  name="insta_link"  placeholder="Instagram Link" >
   <input type="text" class="text-field w-input" value="@if(!empty($tokendata)){{ $tokendata->youtube_link ?? '' }}@endif"  name="youtube_link" placeholder="YouTube Link" id="Youtube">
   <input type="text" class="text-field w-input" value="@if(!empty($tokendata)){{ $tokendata->twitter_link ?? '' }}@endif" name="twitter_link" data-name="Other social media" placeholder="Other social media links">
  <div class="div-next"><a class="submit-button w-button previousclick" data-planid="{{ $token }}" data-type="previous" data-pageid="2" style="background: #ffbb05; color: #000; "><i style="margin-top: 3px;" class="fa fa-angle-double-left"></i>&nbsp;Back&nbsp;<span class="spinnerprevious"></span></a>
	<button type="submit"  class="submit-button w-button" style="background: #ffbb05; color: #000; "> Next step&nbsp; <i style="margin-top: 3px;" class="fa fa-angle-double-right"></i>&nbsp;<span class="spinner"> </span></button></div>
</form>