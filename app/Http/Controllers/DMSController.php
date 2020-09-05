<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Validator;
use App\DMS;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PDF;
class DMSController extends Controller
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
       
        $pincodes = \DB::table('dms')->distinct('pincode')->select('pincode')->get();
        
        return view('admin.dms.index',compact('pincodes'));
    }

    /**
     * Get all the users
     * @param Request $request
     * @return mixed
     */
    public function getall(Request $request)
    {

        $dms = DMS::orderby('id', 'desc');
        if (isset($request->fssai) && !empty($request->fssai)) {
            $dms = $dms->where('fssai',$request->fssai);
        }
        if (isset($request->veg_non_veg) && !empty($request->veg_non_veg)) {
            $dms = $dms->where('veg_non_veg',$request->veg_non_veg);
        }
        if (isset($request->gst_no) && !empty($request->gst_no)) {
            $dms = $dms->where('gst_no',$request->gst_no);
        } 
        if (isset($request->pincodevalud) && !empty($request->pincodevalud) && $request->pincodevalud != 'no_pin') {
            $dms = $dms->where('pincode',$request->pincodevalud);
        } 
        if (!empty($request->pincodevalud) && $request->pincodevalud == 'no_pin') {
            $dms = $dms->whereNull('pincode');
        } 
        $dms = $dms->get();
        return DataTables::of($dms)
            ->addColumn('action', function ($q) {
                $id = encrypt($q->id);
                $return = '<a title="Edit"  data-id="'.$id.'"   data-toggle="modal" data-target=".add_modal" class="openaddmodal" href="javascript:void(0)"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                /*if($q->role != 'super_admin'){
                 $return .= ' <a class="btn btn-danger btn-sm delete_record" data-id="'.$q->id.'" href="javascript:void(0)"> <i class="fas fa-trash"></i> Delete</a>';
                }*/
                return $return;
            })

            
            ->addColumn('name', function ($q) {
                $name = $q->first_name.' '.$q->middle_name.' '.$q->last_name;
                return $name;
            })
            ->addColumn('mobile_no', function ($q) {
                  $c_code = '+'.$q->country_code.$q->mobile_no;
                return $c_code;
            })
            ->addColumn('email', function ($q) {
                return $q->email;
            })
            ->addColumn('address', function ($q) {
                  $address = '';
                  if(!empty($q->address_1)){
                     $address.= " ".$q->address_1.',';
                  }
                  if(!empty($q->address_2)){
                     $address.= " ".$q->address_2.',';
                  }
                  if(!empty($q->address_2)){
                     $address.= " ".$q->address_3.',';
                  }
                  if(!empty($q->area)){
                     $address.= " ".$q->area.',';
                  }
                  if(!empty($q->city)){
                     $address.= " ".$q->city.',';
                  }
                  if(!empty($q->state)){
                     $address.= " ".$q->state.',';
                  }
                  if(!empty($q->country)){
                     $address.= " ".$q->country.',';
                  }
                  if(!empty($q->area)){
                     $address.= " ".$q->area;
                  }
                  if(!empty($q->pincode)){
                     $address.= "-".$q->pincode;
                  }
                return $address;
            })
            ->addColumn('description', function ($q) {
                return $q->description;
            })
            ->addColumn('veg_non_veg', function ($q) {
                return $q->veg_non_veg;
            })
            ->addColumn('fssai', function ($q) {
                return ucfirst($q->fssai);
            })
             ->addColumn('gst', function ($q) {
                return ucfirst($q->gst_no);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewdetail(Request $request){
        $id = decrypt($request->id);
        $dms = DMS::where('id',$id)->first();
        return view('admin.dms.show',compact('dms'));
    }


    public function destroy($id)
    {
        //
    }
    public function downloadpdf(Request $request)
    {

        $dmses = DMS::orderby('id', 'desc');
        if (isset($request->fssai) && !empty($request->fssai)) {
            $dmses = $dmses->where('fssai',$request->fssai);
        }
        if (isset($request->veg_non_veg) && !empty($request->veg_non_veg)) {
            $dmses = $dmses->where('veg_non_veg',$request->veg_non_veg);
        }
        if (isset($request->gst_no) && !empty($request->gst_no)) {
            $dmses = $dmses->where('gst_no',$request->gst_no);
        } 
        if (isset($request->pincodevalud) && !empty($request->pincodevalud) && $request->pincodevalud != 'no_pin') {
            $dmses = $dmses->where('pincode',$request->pincodevalud);
        } 
        if (!empty($request->pincodevalud) && $request->pincodevalud == 'no_pin') {
            $dmses = $dmses->whereNull('pincode');
        } 
        $dmses = $dmses->get();
        
        if($request->submittype == 'pdf') {
           $pdf = PDF::loadview('admin.dms.dmspdf',compact('dmses'));
           return $pdf->download('works.pdf');
        }else if ($request->submittype == 'excel'){

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('A1', 'First Name');
            $sheet->getColumnDimension('A')->setAutoSize(true);

            $sheet->setCellValue('B1', 'Middle Name');
            $sheet->getColumnDimension('B')->setAutoSize(true);

            $sheet->setCellValue('C1', 'Last Name');
            $sheet->getColumnDimension('C')->setAutoSize(true);

            $sheet->setCellValue('D1', 'Date of Birth');
            $sheet->getColumnDimension('D')->setAutoSize(true);

            $sheet->setCellValue('E1', 'Gender');
            $sheet->getColumnDimension('E')->setAutoSize(true);

            $sheet->setCellValue('F1', 'Email ID');
            $sheet->getColumnDimension('F')->setAutoSize(true);

            $sheet->setCellValue('G1', 'Country Code');
            $sheet->getColumnDimension('G')->setAutoSize(true);

            $sheet->setCellValue('H1', 'Mobile No');
            $sheet->getColumnDimension('H')->setAutoSize(true);

            $sheet->setCellValue('I1', 'STD Code');
            $sheet->getColumnDimension('I')->setAutoSize(true);


            $sheet->setCellValue('J1', 'Landline No.');
            $sheet->getColumnDimension('J')->setAutoSize(true);

            $sheet->setCellValue('K1', 'Whatsapp Number');
            $sheet->getColumnDimension('K')->setAutoSize(true);
            $sheet->setCellValue('L1', 'FB Link');
            $sheet->getColumnDimension('L')->setAutoSize(true);
            $sheet->setCellValue('M1', 'Insta Link');
            $sheet->getColumnDimension('M')->setAutoSize(true);
            $sheet->setCellValue('N1', 'Youtube Link');
            $sheet->getColumnDimension('N')->setAutoSize(true);
            $sheet->setCellValue('O1', 'Other social media links');
            $sheet->getColumnDimension('O')->setAutoSize(true);


            $sheet->setCellValue('P1', 'Street/Avenue');
            $sheet->getColumnDimension('P')->setAutoSize(true);
            $sheet->setCellValue('Q1', 'Apartment / No');
            $sheet->getColumnDimension('Q')->setAutoSize(true);
            $sheet->setCellValue('R1', 'Extra indications');
            $sheet->getColumnDimension('R')->setAutoSize(true);
            $sheet->setCellValue('S1', 'Pincode');
            $sheet->getColumnDimension('S')->setAutoSize(true);

            $sheet->setCellValue('T1', 'Area');
            $sheet->getColumnDimension('T')->setAutoSize(true);
            $sheet->setCellValue('U1', 'City');
            $sheet->getColumnDimension('U')->setAutoSize(true);
            $sheet->setCellValue('V1', 'State');
            $sheet->getColumnDimension('BV')->setAutoSize(true);
            $sheet->setCellValue('W1', 'Country');
            $sheet->getColumnDimension('W')->setAutoSize(true);
            $sheet->setCellValue('X1', 'Category');
            $sheet->getColumnDimension('X')->setAutoSize(true);
            $sheet->setCellValue('Y1', 'Subcategories');
            $sheet->getColumnDimension('Y')->setAutoSize(true);
            $sheet->setCellValue('Z1', 'Description');
            $sheet->getColumnDimension('Z')->setAutoSize(true);
            $sheet->setCellValue('AA1', 'Brand Name');
            $sheet->getColumnDimension('AA')->setAutoSize(true);

            $sheet->setCellValue('AB1', '5 words best describes you');
            $sheet->getColumnDimension('AB')->setAutoSize(true);

            $sheet->setCellValue('AC1', '10 Products you are best at');
            $sheet->getColumnDimension('AC')->setAutoSize(true);

            $sheet->setCellValue('AD1', 'Are Veg or Non-Veg?');
            $sheet->getColumnDimension('AD')->setAutoSize(true);

            $sheet->setCellValue('AE1', 'Do you have FSSAI?');
            $sheet->getColumnDimension('AE')->setAutoSize(true);

            $sheet->setCellValue('AF1', 'If yes, please provide us the number? (FSSAI)');
            $sheet->getColumnDimension('AF')->setAutoSize(true);

            $sheet->setCellValue('AG1', 'Do you have GST No.?');
            $sheet->getColumnDimension('AG')->setAutoSize(true);

            $sheet->setCellValue('AH1', 'If yes, please provide us the number? (GST)');
            $sheet->getColumnDimension('AH')->setAutoSize(true);


   


            $sheet->freezePaneByColumnAndRow(1, 2);
            if (!empty($dmses)) {
                $i = 2;
                foreach ($dmses as $user) {

                  $address = '';
                  if(!empty($user->address_1)){
                     $address.= $user->address_1.',';
                  }
                  if(!empty($user->address_2)){
                     $address.= " ".$user->address_2.',';
                  }
                  if(!empty($user->address_2)){
                     $address.= " ".$user->address_3.',';
                  }
                  if(!empty($user->area)){
                     $address.= " ".$user->area.',';
                  }
                  if(!empty($user->city)){
                     $address.= " ".$user->city.',';
                  }
                  if(!empty($user->state)){
                     $address.= " ".$user->state.',';
                  }
                  if(!empty($user->country)){
                     $address.= " ".$user->country.',';
                  }
                  if(!empty($user->area)){
                     $address.= " ".$user->area.',';
                  }
                  if(!empty($user->pincode)){
                     $address.= " ".$user->pincode.',';
                  }
                  $address = rtrim($address, ',');
                 

                  $c_code= $user->country_code.$user->mobile_no;
                  
                  $sheet->setCellValue('A' . $i, $user->first_name);
                  $sheet->setCellValue('B' . $i, $user->middle_name);
                  $sheet->setCellValue('C' . $i, $user->last_name);
                  $sheet->setCellValue('D' . $i, $user->dob);
                  $sheet->setCellValue('E' . $i, $user->gender);
                  $sheet->setCellValue('F' . $i, $user->email);
                  $sheet->setCellValue('G' . $i, $user->country_code);
                  $sheet->setCellValue('H' . $i, $user->mobile_no);
                  $sheet->setCellValue('I' . $i, $user->std_code);
                  $sheet->setCellValue('J' . $i, $user->landline_no);
                  $sheet->setCellValue('K' . $i, $user->whatsapp_number);
                  $sheet->setCellValue('L' . $i, $user->fb_link);
                  $sheet->setCellValue('M' . $i, $user->insta_link);
                  $sheet->setCellValue('N' . $i, $user->youtube_link);
                  $sheet->setCellValue('O' . $i, $user->twitter_link);
                  $sheet->setCellValue('P' . $i, $user->address_1);
                  $sheet->setCellValue('Q' . $i, $user->address_2);
                  $sheet->setCellValue('R' . $i, $user->address_3);
                  $sheet->setCellValue('S' . $i, $user->pincode);
                  $sheet->setCellValue('T' . $i, $user->area);
                  $sheet->setCellValue('U' . $i, $user->city);
                  $sheet->setCellValue('V' . $i, $user->state);
                  $sheet->setCellValue('W' . $i, $user->country);
                  $sheet->setCellValue('X' . $i, $user->category_1);
                  $sheet->setCellValue('Y' . $i, $user->category_2);
                  $sheet->setCellValue('Z' . $i, $user->description);
                  $sheet->setCellValue('AA' . $i, $user->brand_name);
                  $sheet->setCellValue('AB' . $i, $user->words_describe);
                  $sheet->setCellValue('AC' . $i, $user->product_best_at);
                  $sheet->setCellValue('AD' . $i, $user->veg_non_veg);
                  $sheet->setCellValue('AE' . $i, $user->fssai);
                  $sheet->setCellValue('AF' . $i, $user->fssai_no);
                  $sheet->setCellValue('AG' . $i, $user->gst_no);
                  $sheet->setCellValue('AH' . $i, $user->gst_number);
                 

                  
          
                    $i++;
                }
            }

            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="works.xlsx"');
            $writer->save("php://output");

        }
    
    }


    

    public function importexcel(Request $request)
    {
        if($request->buttontype == 'verify'){
          $extension = '';
          if(!empty($request->file)) {
              $extension = $request->file->getClientOriginalExtension();
          }

          $validator = Validator::make(['file'=>$request->file,'extension'=>$extension],['file'=>'required','extension'      => 'required|in:doc,csv,xlsx,xls,docx,ppt,odt,ods,odp']);
          if ($validator->fails()) {
              $arr = array("status" => 400, "msg" => $validator->errors()->first(), "result" => array());
          } else {
            try {
                    
                  if($extension == 'xlsx') {
                      $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                  } else {
                      $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                  }
                  // file path
                  $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                  $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                  
                  // array Count
                  $arrayCount = count($allDataInSheet);
                  $errors = array();
                  for ($i = 1; $i <= $arrayCount; $i ++) {
                    if($i > 1){

                        $first_name =  $allDataInSheet[$i]['A'];
                        if(empty($first_name)){
                          $errors[$i][] = array('type'=>"First Name",'error'=>"First Name field is required.");
                        }else{
                          if(strlen($first_name) > 50){
                              $errors[$i][] = array('type'=>"First Name",'error'=>"Add no more than 50 char.");
                          }
                        }

                        $middle_name =  $allDataInSheet[$i]['B'];
                        if(!empty($middle_name) &&  strlen($middle_name) > 50) {
                           $errors[$i][] = array('type'=>"Middle Name",'error'=>"Add no more than 50 char.");
                        }
                        $last_name =  $allDataInSheet[$i]['C'];
                        
                        if(!empty($last_name) &&  strlen($last_name) > 50) {
                           $errors[$i][] = array('type'=>"Last Name",'error'=>"Add no more than 50 char.");
                        }
                        $dob =  $allDataInSheet[$i]['D'];
                       
                        $gender =  $allDataInSheet[$i]['E'];
                        if(!empty($gender) &&  !in_array($gender, array('male','female'))) {
                           $errors[$i][] = array('type'=>"Gender",'error'=>"Gender should be male or female");
                        }

                        $email =  $allDataInSheet[$i]['F'];

                        if(!empty($email) &&  !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                           $errors[$i][] = array('type'=>"Email",'error'=>"Invalid email format");
                        }


                        $country_code =  $allDataInSheet[$i]['G'];
                        $mobile_no =  $allDataInSheet[$i]['H'];

                        if($country_code == '91' && !empty($mobile_no) && strlen($mobile_no) > 10) {
                           $errors[$i][] = array('type'=>"Mobile No",'error'=>"Add no more than 10 digit if country code is India.");
                        }

                        if(!empty($mobile_no)){
                          if(!is_numeric($mobile_no)) {
                              $errors[$i][] = array('type'=>"Mobile No",'error'=>"Mobile No should be numeric.");  
                            }
                        }

                        $std_code =  $allDataInSheet[$i]['I'];
                        if(!empty($std_code)) {
                            if(strlen($std_code) > 5){
                                $errors[$i][] = array('type'=>"STD code",'error'=>"Add no more than 5 numeric value.");   
                            }
                            if(!is_numeric($std_code)) {
                              $errors[$i][] = array('type'=>"STD code",'error'=>"STD code should be numeric.");  
                            }
                           
                        }
                        


                        $landline_no =  $allDataInSheet[$i]['J'];

                        if(!empty($landline_no)) {
                            if(strlen($landline_no) > 10){
                                $errors[$i][] = array('type'=>"Landline No.",'error'=>"Add no more than 10 numeric value.");   
                            }
                            if(!is_numeric($landline_no)) {
                              $errors[$i][] = array('type'=>"Landline No.",'error'=>"Landline No. should be numeric.");  
                            }
                           
                        }


                        $whatsapp_number =  $allDataInSheet[$i]['K'];
                        if(!empty($whatsapp_number)) {
                            if($country_code == '91' && strlen($whatsapp_number) > 10){
                                $errors[$i][] = array('type'=>"Whatsapp Number",'error'=>"Add no more than 10 digit if country code is India.");   
                            }
                            if(!is_numeric($whatsapp_number)) {
                              $errors[$i][] = array('type'=>"Whatsapp Number",'error'=>"Whatsapp Number should be numeric.");  
                            }
                           
                        }


                        $fb_link =  $allDataInSheet[$i]['L'];
                        if(!empty($fb_link) && !preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$fb_link)) {
                          $errors[$i][] = array('type'=>"FB Link",'error'=>"Invalid FB Link URL");  
                        }
                        $insta_link =  $allDataInSheet[$i]['M'];
                        if(!empty($insta_link) && !preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$insta_link)) {
                          $errors[$i][] = array('type'=>"Insta Link",'error'=>"Invalid Insta Link URL");  
                        }
                        $youtube_link =  $allDataInSheet[$i]['N'];
                        if(!empty($youtube_link) && !preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$youtube_link)) {
                          $errors[$i][] = array('type'=>"Youtube Link",'error'=>"Invalid Youtube Link URL");  
                        }
                        $twitter_link =  $allDataInSheet[$i]['O'];
                        if(!empty($twitter_link) && !preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$twitter_link)) {
                          $errors[$i][] = array('type'=>"Other Social Media",'error'=>"Invalid Other Social Media URL");  
                        }

                        $address_1 =  $allDataInSheet[$i]['P'];

                        if(!empty($address_1) &&  strlen($address_1) > 100) {
                           $errors[$i][] = array('type'=>"Street/Avenue",'error'=>"Add no more than 100 char.");
                        }
                        $address_2 =  $allDataInSheet[$i]['Q'];
                        if(!empty($address_2) &&  strlen($address_2) > 100) {
                           $errors[$i][] = array('type'=>"Apartment / No",'error'=>"Add no more than 100 char.");
                        }
                        $address_3 =  $allDataInSheet[$i]['R'];
                        if(!empty($address_3) &&  strlen($address_3) > 100) {
                           $errors[$i][] = array('type'=>"Extra indications",'error'=>"Add no more than 100 char.");
                        }

                        $pincode =  $allDataInSheet[$i]['S'];

                        if(!empty($pincode)) {
                            if(strlen($pincode) > 6){
                                $errors[$i][] = array('type'=>"Pincode",'error'=>"Add no more than 6 digit.");   
                            }
                            if(!is_numeric($pincode)) {
                              $errors[$i][] = array('type'=>"Pincode",'error'=>"Pincode should be numeric.");  
                            }
                        }

                        $area =  $allDataInSheet[$i]['T'];
                        $city =  $allDataInSheet[$i]['U'];
                        $state =  $allDataInSheet[$i]['V'];
                        $country =  $allDataInSheet[$i]['W'];


                        $category_1 =  $allDataInSheet[$i]['X'];
                        $category_2 =  $allDataInSheet[$i]['Y'];
                        $description =  $allDataInSheet[$i]['Z'];
                        if(!empty($description) && strlen($mobile_no) > 200) {
                           $errors[$i][] = array('type'=>"Description",'error'=>"Add no more than 200 char.");
                        }


                        $brand_name =  $allDataInSheet[$i]['AA'];

                        $words_describe =  $allDataInSheet[$i]['AB'];
                        $product_best_at =  $allDataInSheet[$i]['AC'];
                        $veg_non_veg =  $allDataInSheet[$i]['AD'];
                        if(!empty($veg_non_veg) &&  !in_array($veg_non_veg, array('Veg','Non-Veg'))) {
                           $errors[$i][] = array('type'=>"Are Veg or Non-Veg?",'error'=>"Are Veg or Non-Veg? should be Veg or Non-Veg");
                        }

                       

                        $fssai =  $allDataInSheet[$i]['AE'];
                         if(!empty($fssai) &&  !in_array($fssai, array('yes','no'))) {
                           $errors[$i][] = array('type'=>"FSSAI",'error'=>"FSSAI should be yes or no");
                        }

                        $fssaino =  $allDataInSheet[$i]['AF'];
                        $gst_no =  $allDataInSheet[$i]['AG'];
                         if(!empty($gst_no) &&  !in_array($gst_no, array('yes','no'))) {
                           $errors[$i][] = array('type'=>"GST No",'error'=>"GST No should be yes or no");
                        }
                        $gst_number =  $allDataInSheet[$i]['AH'];
                    }
                    

                  }
                  $verify = 1;
                  $return = '';

                 

                  if(!empty($errors)){
                    $verify = 0;

                    foreach ($errors as $key => $errorarray) {
                      $return .= '<table style="width:100%; margin-top:15px;">';
                      $return .= '<tr>
                        <td style="border:1px solid #000" colspan="2"><b style="color:red;">Validate Row #'.$key.'</b></td>
                      </tr>';
                       $return .= '<tr>
                        <th style="border:1px solid #000; color:#000; text-align:center;" >Field</th>
                        <th style="border:1px solid #000; color:#000; text-align:center;">Error</th></tr>';
                     
                      foreach ($errorarray as $finalerror) {
                        $return .= '<tr>
                        <td style="border:1px solid #000">'.$finalerror['type'].'</td>
                        <td style="border:1px solid #000">'.$finalerror['error'].'</td></tr>';
                       
                      }
                       $return .=  '</table>';
                    }
                    


                  }else{
                    $return .= '<div class="alert alert-success" style="color: #4c4c4c!important; margin-top:15px;" role="alert"><i class="fa fa-check" aria-hidden="true"></i>You\'ve no error in XLS file you can submit it now.</div>';
                  }
                  $msg = "Data inserted Successfully.";
                  $arr = array("status" => 201, "verify" => $verify, "html" => $return);
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
        }else{
          /******************************* Form Submit start *********************/
          if($request->is_verified == '0'){
             $arr = array("status" => 400, "msg" => "Please verify XLS and resolve the validations to submit your data.", "result" => array());
             return \Response::json($arr);
          }
          $extension = '';
          if(!empty($request->file)) {
              $extension = $request->file->getClientOriginalExtension();
          }

          $validator = Validator::make(['file'=>$request->file,'extension'=>$extension],['file'=>'required','extension'      => 'required|in:doc,csv,xlsx,xls,docx,ppt,odt,ods,odp']);
          if ($validator->fails()) {
              $arr = array("status" => 400, "msg" => $validator->errors()->first(), "result" => array());
          } else {
             
              try {
                    
                  if($extension == 'xlsx') {
                      $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                  } else {
                      $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                  }
                  // file path
                  $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                  $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                  
                  // array Count
                  $arrayCount = count($allDataInSheet);
                  
                  for ($i = 1; $i <= $arrayCount; $i ++) {
                    if($i > 1){
                      
                      
                        $first_name =  $allDataInSheet[$i]['A'];
                        $middle_name =  $allDataInSheet[$i]['B'];
                        $last_name =  $allDataInSheet[$i]['C'];
                        $dob =  $allDataInSheet[$i]['D'];
                        $gender =  $allDataInSheet[$i]['E'];
                        $email =  $allDataInSheet[$i]['F'];

                        $country_code =  $allDataInSheet[$i]['G'];
                        $mobile_no =  $allDataInSheet[$i]['H'];
                        $std_code =  $allDataInSheet[$i]['I'];
                        $landline_no =  $allDataInSheet[$i]['J'];
                        $whatsapp_number =  $allDataInSheet[$i]['K'];
                        $fb_link =  $allDataInSheet[$i]['L'];
                        $insta_link =  $allDataInSheet[$i]['M'];
                        $youtube_link =  $allDataInSheet[$i]['N'];
                        $twitter_link =  $allDataInSheet[$i]['O'];

                        $address_1 =  $allDataInSheet[$i]['P'];
                        $address_2 =  $allDataInSheet[$i]['Q'];
                        $address_3 =  $allDataInSheet[$i]['R'];
                        $pincode =  $allDataInSheet[$i]['S'];
                        $area =  $allDataInSheet[$i]['T'];
                        $city =  $allDataInSheet[$i]['U'];
                        $state =  $allDataInSheet[$i]['V'];
                        $country =  $allDataInSheet[$i]['W'];

                        $category_1 =  $allDataInSheet[$i]['X'];
                        $category_2 =  $allDataInSheet[$i]['Y'];
                        $description =  $allDataInSheet[$i]['Z'];

                        $brand_name =  $allDataInSheet[$i]['AA'];

                        $words_describe =  $allDataInSheet[$i]['AB'];
                        $product_best_at =  $allDataInSheet[$i]['AC'];
                        $veg_non_veg =  $allDataInSheet[$i]['AD'];
                        $fssai =  $allDataInSheet[$i]['AE'];
                        $fssaino =  $allDataInSheet[$i]['AF'];
                        $gst_no =  $allDataInSheet[$i]['AG'];
                        $gst_number =  $allDataInSheet[$i]['AH'];
                        

                        $user = new DMS;
                        $user->first_name = $first_name;
                        $user->middle_name = $middle_name;
                        $user->last_name = $last_name;
                        $user->dob = date('Y-m-d',strtotime($dob));
                        $user->gender = $gender;

                        $user->country_code = $country_code;
                        $user->mobile_no = $mobile_no;
                        $user->std_code = $std_code;
                        $user->landline_no = $landline_no;
                        $user->email = $email;
                        $user->whatsapp_number = $whatsapp_number;
                        $user->fb_link = $fb_link;
                        $user->insta_link = $insta_link;
                        $user->youtube_link = $youtube_link;  
                        $user->twitter_link = $twitter_link;  
                        $user->address_1 = $address_1;
                        $user->address_2 = $address_2;
                        $user->address_3 = $address_3;
                        $user->pincode = $pincode;
                        $user->area = $area;
                        $user->city = $city;
                        $user->state = $state;
                        $user->country = $country;
                        $user->category_1 = $category_1;
                        $user->category_2 = $category_2;
                        $user->description = $description;

                        
                        $user->brand_name = $brand_name;

                        $user->words_describe = $words_describe;
                        $user->product_best_at = $product_best_at;
                        $user->veg_non_veg = $veg_non_veg;
                        $user->fssai = $fssai;
                        $user->fssai_no = $fssaino;
                        
                        $user->gst_no = $gst_no;
                        $user->gst_number = $gst_number;
                        $user->data_source = $request->data_source;
                        $user->data_source_description = $request->data_source_description;
                        $user->save();

                      
                      
                    }
                    

                  }
                  $msg = "Data inserted Successfully.";
                  $arr = array("status" => 200, "msg" => $msg, "result" => array());
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
          /******************************* Form Submit edn *********************/
        }
    }
    public function getErrors()
    {
        return $this->errors;
    }

    public function rules(): array
    {
        return [
           
        ];
    }

    public function validationMessages()
    {
        return [
               
        ];
    }
}
