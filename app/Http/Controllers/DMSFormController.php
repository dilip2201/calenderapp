<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TempTokens;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
class DMSFormController extends Controller
{

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($token)
    {
    	
        TempTokens::where('created_at', '<=', Carbon::now()->subDay())->delete();
    	$value = 0;
        try {
            $value = decrypt($token);
        } catch (DecryptException $e) {
            $value = 0;
        }
        
        if($value == 0){
            $msg = "Your token is invalid. Please contact with admin for new URL.";
            return view('user.error',compact('msg'));
        }
        return view('user.index');
    }
    
}
