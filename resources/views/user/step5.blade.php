<form method="post" action="{{ route('user.storefive') }}"  class="form formsubmittrack">
   <h3 class="heading">Tell us, what do you like to cook?</h3>
   <input type="hidden" name="token" value="{{ $token }}">
   <select id="field" name="category_1" class="select-field w-select">
      <option value="">Category...</option>
      <option value="one" @if(!empty($tokendata) && $tokendata->category_1 == 'one') selected @endif>one</option>
      <option value="two" @if(!empty($tokendata) && $tokendata->category_1 == 'two') selected @endif>two</option>
      
   </select>
   <select id="Subcategory" name="category_2"  class="select-field w-select">
       <option value="">Subcategory</option>
      <option value="one" @if(!empty($tokendata) && $tokendata->category_2 == 'one') selected @endif>one</option>
      <option value="two" @if(!empty($tokendata) && $tokendata->category_2 == 'two') selected @endif>two</option>
   </select>
   <textarea rows="3" name="description" class="text-field description w-input" placeholder="Description">@if(!empty($tokendata)){{ $tokendata->description ?? '' }}@endif</textarea>
   <div class="div-next">
      <a class="submit-button w-button previousclick" data-planid="{{ $token }}" data-type="previous" data-pageid="4" style="background: #ffbb05; color: #000; ">
      <i style="margin-top: 3px;" class="fa fa-angle-double-left"></i>&nbsp;Back&nbsp;<span class="spinnerprevious"></span>
      </a>
      <button type="submit"  class="submit-button w-button" style="background: #ffbb05; color: #000; "> Next step&nbsp; <i style="margin-top: 3px;" class="fa fa-angle-double-right"></i>&nbsp;<span class="spinner"> </span></button>
   </div>
</form>