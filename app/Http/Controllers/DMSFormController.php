<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TempTokens;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Validator;
use App\DMS;

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
    	$value = 'invalid';
        try {
            $value = decrypt($token);
        } catch (DecryptException $e) {
            $value = 'invalid';
        }
        
        if($value == 'invalid'){
            $msg = "Your token is invalid. Please contact to admin for new URL.";
            return view('user.error',compact('msg'));
        }

        $token = TempTokens::where('random',$value)->first();
        if(!empty($token)){
            $token = $value;
            return view('user.index',compact('token'));
        }else{
            $msg = "Your token has been expired. Please contact to admin for new URL.";
            return view('user.error',compact('msg'));
        }
        
    }

    public function alreadysubmitted(){
        $msg = "You've already submitted the form.";
        return view('user.error',compact('msg'));
    }

    public function storeone(Request $request) {
        $rules = [
            'first_name' => 'required',
           
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "msg" => $validator->errors()->first(), "result" => array());
        } else {

            
            try {

                $token = $request->token;

                $tokendata = TempTokens::where('random',$token)->first();
                if(!empty($tokendata)){
                    $td = TempTokens::find($tokendata->id);
                    $td->first_name = $request->first_name;
                    $td->middle_name = $request->middle_name;
                    $td->last_name = $request->last_name;
                    $td->dob = $request->dob;
                    $td->gender = $request->gender;
                    $td->step = 2;
                    $td->save();
                    $msg = 'Success';
                    $arr = array("status" => 200, "msg" => $msg);
                }else{
                    $msg = "Your token has been expired. Please contact to admin for new URL.";
                    return view('user.error',compact('msg'));
                }                
            } catch (\Illuminate\Database\QueryException $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2])) :
                    $msg = $ex->errorInfo[2];
                endif;

                $arr = array("status" => 400, "msg" => $msg, "result" => array());
            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2])) :
                    $msg = $ex->errorInfo[2];
                endif;

                $arr = array("status" => 400, "msg" => $msg, "result" => array());
            }
        }

        return \Response::json($arr);
    }

    public function storetwo(Request $request) {
        $rules = [
            'email' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "msg" => $validator->errors()->first(), "result" => array());
        } else {

            
            try {

                $token = $request->token;
                $tokendata = TempTokens::where('random',$token)->first();
                if(!empty($tokendata)){
                    $td = TempTokens::find($tokendata->id);
                    $td->email = $request->email;
                    $td->country_code = $request->country_code;
                    $td->mobile_no = $request->mobile_no;
                    $td->std_code = $request->std_code;
                    $td->landline_no = $request->landline_no;
                    $td->whatsapp_number = $request->whatsapp_number;
                    $td->step = 3;
                    $td->save();
                    $msg = 'Success';
                    $arr = array("status" => 200, "msg" => $msg);
                }else{
                    $msg = "Your token has been expired. Please contact to admin for new URL.";
                    return view('user.error',compact('msg'));
                }

                
            } catch (\Illuminate\Database\QueryException $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2])) :
                    $msg = $ex->errorInfo[2];
                endif;

                $arr = array("status" => 400, "msg" => $msg, "result" => array());
            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2])) :
                    $msg = $ex->errorInfo[2];
                endif;

                $arr = array("status" => 400, "msg" => $msg, "result" => array());
            }
        }

        return \Response::json($arr);
    }

    public function storethree(Request $request) {
        $rules = [
            'fb_link' => 'nullable',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "msg" => $validator->errors()->first(), "result" => array());
        } else {

            
            try {

                $token = $request->token;
                $tokendata = TempTokens::where('random',$token)->first();
                if(!empty($tokendata)){
                    $td = TempTokens::find($tokendata->id);
                    $td->fb_link = $request->fb_link;
                    $td->insta_link = $request->insta_link;
                    $td->youtube_link = $request->youtube_link;
                    $td->twitter_link = $request->twitter_link;
                    $td->step = 4;
                    $td->save();
                    $msg = 'Success';
                    $arr = array("status" => 200, "msg" => $msg);
                }else{
                    $msg = "Your token has been expired. Please contact to admin for new URL.";
                    return view('user.error',compact('msg'));
                }                
            } catch (\Illuminate\Database\QueryException $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2])) :
                    $msg = $ex->errorInfo[2];
                endif;

                $arr = array("status" => 400, "msg" => $msg, "result" => array());
            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2])) :
                    $msg = $ex->errorInfo[2];
                endif;

                $arr = array("status" => 400, "msg" => $msg, "result" => array());
            }
        }

        return \Response::json($arr);
    }

    public function pincode(Request $request) {
        
        try {

            $pincode = $request->pincode;
            $get_data = callAPI('GET', 'https://api.worldpostallocations.com/pincode?postalcode='.$pincode.'&countrycode=IN', false);
            $response = json_decode($get_data, true);
            $arr = array('status'=>401);
            if(!empty($response) && $response['status'] == 1){
                if(!empty($response['result'])){
                    $result = $response['result'];
                    if(!empty($result)){
                        $final = $result[0];

                        $arr = array('status'=>200,'data'=>array('postalLocation'=>$final['postalLocation'],'district'=>$final['district'],'state'=>$final['state'],'country'=>'India'));
                    }
                } 
            }
            
        } catch (\Illuminate\Database\QueryException $ex) {
            $msg = $ex->getMessage();
            if (isset($ex->errorInfo[2])) :
                $msg = $ex->errorInfo[2];
            endif;

            $arr = array("status" => 400, "msg" => $msg, "result" => array());
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            if (isset($ex->errorInfo[2])) :
                $msg = $ex->errorInfo[2];
            endif;

            $arr = array("status" => 400, "msg" => $msg, "result" => array());
        }
        

        return \Response::json($arr);
    }
    
    public function storefour(Request $request) {
        $rules = [
            'address_1' => 'nullable',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "msg" => $validator->errors()->first(), "result" => array());
        } else {

            
            try {

                $token = $request->token;
                $tokendata = TempTokens::where('random',$token)->first();
                if(!empty($tokendata)){
                    $td = TempTokens::find($tokendata->id);
                    $td->address_1 = $request->address_1;
                    $td->address_2 = $request->address_2;
                    $td->address_3 = $request->address_3;
                    $td->pincode = $request->pincode;
                    $td->area = $request->area;
                    $td->city = $request->city;
                    $td->state = $request->state;
                    $td->country = $request->country;
                    $td->step = 5;
                    $td->save();
                    $msg = 'Success';
                    $arr = array("status" => 200, "msg" => $msg);
                }else{
                    $msg = "Your token has been expired. Please contact to admin for new URL.";
                    return view('user.error',compact('msg'));
                }                
            } catch (\Illuminate\Database\QueryException $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2])) :
                    $msg = $ex->errorInfo[2];
                endif;

                $arr = array("status" => 400, "msg" => $msg, "result" => array());
            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2])) :
                    $msg = $ex->errorInfo[2];
                endif;

                $arr = array("status" => 400, "msg" => $msg, "result" => array());
            }
        }

        return \Response::json($arr);
    }

    public function storesix(Request $request) {
        $rules = [
            'brand_name' => 'nullable',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "msg" => $validator->errors()->first(), "result" => array());
        } else {

            
            try {

                $token = $request->token;
                $tokendata = TempTokens::where('random',$token)->first();
                if(!empty($tokendata)){
                    $td = TempTokens::find($tokendata->id);
                    $td->brand_name = $request->brand_name;
                    $td->words_describe = $request->words_describe;
                    $td->product_best_at = $request->product_best_at;
                    if($request->veg_non_veg == '1'){
                        $td->veg_non_veg = 'veg';
                    }else{
                        $td->veg_non_veg = 'non_veg';
                    }
                    $td->step = 7;
                    $td->save();
                    $msg = 'Success';
                    $arr = array("status" => 200, "msg" => $msg);
                }else{
                    $msg = "Your token has been expired. Please contact to admin for new URL.";
                    return view('user.error',compact('msg'));
                }                
            } catch (\Illuminate\Database\QueryException $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2])) :
                    $msg = $ex->errorInfo[2];
                endif;

                $arr = array("status" => 400, "msg" => $msg, "result" => array());
            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2])) :
                    $msg = $ex->errorInfo[2];
                endif;

                $arr = array("status" => 400, "msg" => $msg, "result" => array());
            }
        }

        return \Response::json($arr);
    }

    public function storeseven(Request $request) {
        $rules = [
            'fssai' => 'nullable',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "msg" => $validator->errors()->first(), "result" => array());
        } else {

            
            try {

                $token = $request->token;
                $tokendata = TempTokens::where('random',$token)->first();
                if(!empty($tokendata)){

                    
                    $td = TempTokens::find($tokendata->id);
                    $td->fssai = $request->fssai;
                    $td->fssai_no = $request->fssai_no;
                    $td->gst_no = $request->gst_no;
                    $td->gst_number = $request->gst_number;
                    $td->step = 8;
                    $td->save();


                    $dms = new DMS;
                    $dms->first_name = $td->first_name;
                    $dms->middle_name = $td->middle_name;
                    $dms->first_name = $td->first_name;
                    $dms->last_name = $td->last_name;
                    $dms->dob = $td->dob;
                    $dms->gender = $td->gender;
                    $dms->country_code = $td->country_code;
                    $dms->mobile_no = $td->mobile_no;
                    $dms->std_code = $td->std_code;
                    $dms->landline_no = $td->landline_no;
                    $dms->email = $td->email;
                    $dms->whatsapp_number = $td->whatsapp_number;

                    $dms->fb_link = $td->fb_link;
                    $dms->insta_link = $td->insta_link;
                    $dms->youtube_link = $td->youtube_link;
                    $dms->twitter_link = $td->twitter_link;
                    $dms->address_1 = $td->address_1;
                    $dms->address_2 = $td->address_2;
                    $dms->address_3 = $td->address_3;
                    $dms->pincode = $td->pincode;
                    $dms->area = $td->area;
                    $dms->city = $td->city;
                    $dms->state = $td->state;
                    $dms->country = $td->country;
                    $dms->category_1 = $td->category_1;
                    $dms->category_2 = $td->category_2;
                    $dms->description = $td->description;
                    $dms->brand_name = $td->brand_name;
                    $dms->words_describe = $td->words_describe;
                    $dms->product_best_at = $td->product_best_at;
                    $dms->veg_non_veg = $td->veg_non_veg;
                    $dms->fssai = $td->fssai;
                    $dms->fssai_no = $td->fssai_no;
                    $dms->gst_no = $td->gst_no;
                    $dms->gst_number = $td->gst_number;
                    $dms->save();

                    $msg = 'Success';
                    $arr = array("status" => 200, "msg" => $msg);
                }else{
                    $msg = "Your token has been expired. Please contact to admin for new URL.";
                    return view('user.error',compact('msg'));
                }                
            } catch (\Illuminate\Database\QueryException $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2])) :
                    $msg = $ex->errorInfo[2];
                endif;

                $arr = array("status" => 400, "msg" => $msg, "result" => array());
            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2])) :
                    $msg = $ex->errorInfo[2];
                endif;

                $arr = array("status" => 400, "msg" => $msg, "result" => array());
            }
        }

        return \Response::json($arr);
    }
    
    public function storefive(Request $request) {
        $rules = [
            'category_1' => 'nullable',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "msg" => $validator->errors()->first(), "result" => array());
        } else {

            
            try {

                $token = $request->token;
                $tokendata = TempTokens::where('random',$token)->first();
                if(!empty($tokendata)){
                    $td = TempTokens::find($tokendata->id);
                    $td->category_1 = $request->category_1;
                    $td->category_2 = $request->category_2;
                    $td->description = $request->description;
                    $td->step = 6;
                    $td->save();
                    $msg = 'Success';
                    $arr = array("status" => 200, "msg" => $msg);
                }else{
                    $msg = "Your token has been expired. Please contact to admin for new URL.";
                    return view('user.error',compact('msg'));
                }                
            } catch (\Illuminate\Database\QueryException $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2])) :
                    $msg = $ex->errorInfo[2];
                endif;

                $arr = array("status" => 400, "msg" => $msg, "result" => array());
            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2])) :
                    $msg = $ex->errorInfo[2];
                endif;

                $arr = array("status" => 400, "msg" => $msg, "result" => array());
            }
        }

        return \Response::json($arr);
    }

   
    public function stepload(Request $request)
    {
        $tokendata = TempTokens::where('random',$request->token)->first();
        if(!empty($tokendata)){
            $step = $tokendata->step;
            $token = $tokendata->random;
            if($step == 1){
                $html = view('user.step1',compact('token','tokendata'))->render();
                return array("status" => 200, "html" => $html);
            }
            if($step == 2){
                $html = view('user.step2',compact('token','tokendata'))->render();
                return array("status" => 200, "html" => $html);
            }
            if($step == 3){
                $html = view('user.step3',compact('token','tokendata'))->render();
                return array("status" => 200, "html" => $html);
            }
            if($step == 4){
                $html = view('user.step4',compact('token','tokendata'))->render();
                return array("status" => 200, "html" => $html);
            }
            if($step == 5){
                $html = view('user.step5',compact('token','tokendata'))->render();
                return array("status" => 200, "html" => $html);
            }
            if($step == 6){
                $html = view('user.step6',compact('token','tokendata'))->render();
                return array("status" => 200, "html" => $html);
            }
            if($step == 7){
                $html = view('user.step7',compact('token','tokendata'))->render();
                return array("status" => 200, "html" => $html);
            }
            if($step == 8){
                if($tokendata->final_submit == '1'){
                    return array("status" => 201);
                }
                $td = TempTokens::find($tokendata->id);
                $td->final_submit = '1';
                $td->save();
                return array("status" => 202);
            }

        }else{
            return array("status" => 400);
        }
    }
    
    
    public function success(){
        return view('user.success');
    }
    public function gotopreviouspage(Request $request) {

        $token = $request->planid;
        try {
            $msg = 'Success';
            $tokendata = TempTokens::where('random',$token)->first();
            $tokendata->step = $request->pageid;
            $tokendata->save();
            $arr = array("status" => 200, "msg" => $msg);
        } catch (\Illuminate\Database\QueryException $ex) {
            $msg = $ex->getMessage();
            if (isset($ex->errorInfo[2])) :
                $msg = $ex->errorInfo[2];
            endif;

            $arr = array("status" => 400, "msg" => $msg, "result" => array());
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            if (isset($ex->errorInfo[2])) :
                $msg = $ex->errorInfo[2];
            endif;

            $arr = array("status" => 400, "msg" => $msg, "result" => array());
        }
        return \Response::json($arr);
    }
}
