   <form method="post" action="{{ route('user.storefive') }}"  class="form formsubmittrack">
   <h3 class="heading">Tell us, who are you?</h3>
   <input type="hidden" name="token" value="{{ $token }}">
   <select id="field" name="category_1" class="select-field w-select">
      <option value="">Category...</option>
      <option value="1" @if(!empty($tokendata) && $tokendata->category_1 == '1') selected @endif>Foodie/Food lover</option>
      <option value="2" @if(!empty($tokendata) && $tokendata->category_1 == '2') selected @endif>Home Chef</option>
      <option value="3" @if(!empty($tokendata) && $tokendata->category_1 == '3') selected @endif>Food Blogger</option>
      <option value="4" @if(!empty($tokendata) && $tokendata->category_1 == '4') selected @endif>Recipe Publisher</option>
      <option value="5" @if(!empty($tokendata) && $tokendata->category_1 == '5') selected @endif>Food Professional</option>
      <option value="6" @if(!empty($tokendata) && $tokendata->category_1 == '6') selected @endif>Professional chef</option>
      
   </select>
   
   <textarea rows="3" name="description" class="text-field description w-input" placeholder="Description">@if(!empty($tokendata)){{ $tokendata->description ?? '' }}@endif</textarea>
   <div class="div-next">
      <a class="submit-button w-button previousclick" data-planid="{{ $token }}" data-type="previous" data-pageid="4" style="background: #ffbb05; color: #000; ">
      <i style="margin-top: 3px;" class="fa fa-angle-double-left"></i>&nbsp;Back&nbsp;<span class="spinnerprevious"></span>
      </a>
      <button type="submit"  class="submit-button w-button" style="background: #ffbb05; color: #000; "> Next step&nbsp; <i style="margin-top: 3px;" class="fa fa-angle-double-right"></i>&nbsp;<span class="spinner"> </span></button>
   </div>
</form>