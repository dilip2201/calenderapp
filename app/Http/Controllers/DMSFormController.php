<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DMSFormController extends Controller
{

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($token)
    {
    	
    	decrypt($token);
        return view('user.index');
    }
    
}
