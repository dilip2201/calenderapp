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

        
        $dms = $dms->get();
        return DataTables::of($dms)
            ->addColumn('action', function ($q) {
                $id = encrypt($q->id);
                $return = '<a title="Edit"  data-id="'.$id.'"   data-toggle="modal" data-target=".add_modal" class="btn btn-info btn-sm" href="javascript:void(0)"><i class="feather icon-edit"></i></a>';
                /*if($q->role != 'super_admin'){
                 $return .= ' <a class="btn btn-danger btn-sm delete_record" data-id="'.$q->id.'" href="javascript:void(0)"> <i class="fas fa-trash"></i> Delete</a>';
                }*/
                return $return;
            })

            
            ->addColumn('name', function ($q) {
                return ucfirst($q->first_name).' '.ucfirst($q->last_name);
            })
            ->addColumn('role', function ($q) {
                return ucwords(str_replace('_', ' ', $q->role));
            })
            ->addColumn('email', function ($q) {
                return $q->email;
            })
            ->addColumn('mobile_no', function ($q) {
                return $q->mobile_no;
            })
            ->addIndexColumn()
            ->rawColumns(['action'])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
        public function downloadpdf(Request $request)
    {

        $dmses = DMS::orderby('id', 'desc');
    
        
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

   


            $sheet->freezePaneByColumnAndRow(1, 2);
            if (!empty($dmses)) {
                $i = 2;
                foreach ($dmses as $user) {

                     $sheet->setCellValue('A' . $i, $user->first_name );
                    $sheet->setCellValue('B' . $i, $user->middle_name);
                    $sheet->setCellValue('C' . $i, $user->last_name);
          
                    $i++;
                }
            }

            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="works.xlsx"');
            $writer->save("php://output");

        }
    
    }
}
