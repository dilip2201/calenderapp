<form id="email-form" method="post" class="formsubmittrack" action="{{ route('user.storeone') }}" name="email-form">
	<input type="hidden" name="token" value="{{ $token }}">
 <h3 class="heading">Hey! What&#x27;s your name?</h3>
 
 <input type="text" class="text-field w-input" maxlength="256" name="first_name" data-name="Name" placeholder="First name" id="name" required value="@if(!empty($tokendata)){{ $tokendata->first_name ?? '' }}@endif">
 
 <input type="text" class="text-field w-input" maxlength="256" value="@if(!empty($tokendata)){{ $tokendata->middle_name ?? '' }}@endif" name="middle_name" placeholder="Middle name">
 
 <input type="text" class="text-field w-input" value="@if(!empty($tokendata)){{ $tokendata->last_name ?? '' }}@endif"  maxlength="256" name="last_name" placeholder="Last Name" >

 <input type="date" class="text-field w-input" value="@if(!empty($tokendata)){{ $tokendata->dob ?? '' }}@endif" maxlength="256" name="dob"  placeholder="Date of birth" name="last_name">
 
 <select  name="gender"  class="select-field w-select">
    <option value="">Male or Female?</option>
    <option value="male" @if(!empty($tokendata) && $tokendata->gender == 'male') selected @endif>Male</option>
    <option value="female"  @if(!empty($tokendata) && $tokendata->gender == 'female') selected @endif>Female</option>
 </select>

 <div class="div-next first-div">
 	<button type="submit"  class="submit-button w-button" style="background: #ffbb05; color: #000; "> Next step&nbsp; <i style="margin-top: 3px;" class="fa fa-angle-double-right"></i>&nbsp;<span class="spinner"> </span></button>
 </div>
</form>