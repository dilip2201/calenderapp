<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TempTokens;

class GenerateurlController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.generate.index');
    }

    public function newtoken(Request $request)
    {

        try {
            $random = random_strings(8);

            $tt = new TempTokens;
            $tt->random = $random;
            $tt->save();
            
            $arr = array("status" => 200, 'random'=>encrypt($random));
        } catch (\Illuminate\Database\QueryException $ex) {

            $msg = $ex->getMessage();
            if (isset($ex->errorInfo[2])) {
                $msg = $ex->errorInfo[2];
            }

            $arr = array("status" => 400, "msg" => $msg, "result" => array());
        } catch (Exception $ex) {

            $msg = $ex->getMessage();
            if (isset($ex->errorInfo[2])) {
                $msg = $ex->errorInfo[2];
            }
            $arr = array("status" => 400, "msg" => $msg, "result" => array());
        }
        return \Response::json($arr);
    }

    

}
