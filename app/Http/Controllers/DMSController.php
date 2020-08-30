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
       
        return view('admin.dms.index');
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
                  $name = '';
                  if(!empty($q->first_name)){
                     $name.= " ".$q->first_name.' ';
                  }
                  if(!empty($q->middle_name)){
                     $name.= " ".$q->middle_name.' ';
                  }
                  if(!empty($q->last_name)){
                     $name.= " ".$q->last_name;
                  }
                return $name;
            })
            ->addColumn('mobile_no', function ($q) {
                  $c_code = '';
                  if(!empty($q->country_code)){
                     $c_code.= " ".$q->country_code.' ';
                  }
                  if(!empty($q->mobile_no)){
                     $c_code.= " ".$q->mobile_no;
                  }
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
        
        $dmses = $dmses->get();
        
        if($request->submittype == 'pdf') {
           $pdf = PDF::loadview('admin.dms.dmspdf',compact('dmses'));
           return $pdf->download('works.pdf');
        }else if ($request->submittype == 'excel'){

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('A1', 'Name');
            $sheet->getColumnDimension('A')->setAutoSize(true);

            $sheet->setCellValue('B1', 'Mobile No.');
            $sheet->getColumnDimension('B')->setAutoSize(true);

            $sheet->setCellValue('C1', 'Email');
            $sheet->getColumnDimension('C')->setAutoSize(true);

            $sheet->setCellValue('D1', 'Address');
            $sheet->getColumnDimension('C')->setAutoSize(true);

            $sheet->setCellValue('E1', 'Description');
            $sheet->getColumnDimension('C')->setAutoSize(true);

            $sheet->setCellValue('F1', 'Veg Non_Veg');
            $sheet->getColumnDimension('C')->setAutoSize(true);

   


            $sheet->freezePaneByColumnAndRow(1, 2);
            if (!empty($dmses)) {
                $i = 2;
                foreach ($dmses as $user) {

                  $address = '';
                  if(!empty($user->address_1)){
                     $address.= " ".$user->address_1.',';
                  }
                  if(!empty($user->address_2)){
                     $address.= " ".$user->address_1.',';
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

                  $name = '';
                  if(!empty($user->first_name)){
                     $name.= " ".$user->first_name.',';
                  }
                  if(!empty($user->middle_name)){
                     $name.= " ".$user->middle_name.',';
                  }
                  if(!empty($user->last_name)){
                     $name.= " ".$user->last_name.',';
                  }

                  $c_code = '';
                  if(!empty($user->country_code)){
                     $c_code.= " ".$user->country_code.',';
                  }
                  if(!empty($user->mobile_no)){
                     $c_code.= " ".$user->mobile_no.',';
                  }

                    $sheet->setCellValue('A' . $i, $name);
                    $sheet->setCellValue('B' . $i, $c_code);
                    $sheet->setCellValue('C' . $i,$user->email ?? '');
                    $sheet->setCellValue('D' . $i, $address);
                    $sheet->setCellValue('E' . $i, $user->description ?? '');
                    $sheet->setCellValue('F' . $i, $user->veg_non_veg ?? '');
          
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
        $extension = '';
        if(!empty($request->file)){
            $extension = $request->file->getClientOriginalExtension();
        }

        $validator = Validator::make(
          [
              'file'      => $request->file,
              'extension' => $extension,
          ],
          [
              'file'          => 'required',
              'extension'      => 'required|in:doc,csv,xlsx,xls,docx,ppt,odt,ods,odp',
          ]
        );
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
