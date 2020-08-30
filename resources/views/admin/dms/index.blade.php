@extends('layout.app')
@section('content')
@section('pageTitle', 'Dms')



    <div class="row">
        <div class="col-12" style="margin-top: -40px;">
        <a href="#" data-toggle="modal" data-typeid="" data-target=".add_modal"
                       class="btn btn-info btn-sm openaddmodal" data-id="" style="float: right; ">
                        <i class="fa fa-plus"></i> Add New
                    </a>
                </div>

        <div class="col-12">
           
                 <div class="card-body" style="padding: 10px 15px;margin-bottom: 5px;">
                    <div class="col-lg-12">
                        <div class="form-group row " style="margin-bottom: 0px;">
                        <form method="post" style="display: contents;"  action="{{route('admin.dms.downloadpdf')}}">
                                {{ csrf_field() }}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><b>Status: </b>
                                    </label>
                                    <select class="form-control fssai" id="fssai" name="fssai">
                                        <option value="">Select FSSAI</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><b>Veg Non-Veg: </b>
                                    </label>
                                    <select class="form-control veg_non_veg" id="veg_non_veg" name="veg_non_veg">
                                        <option value="">Select Type</option>
                                        <option value="veg">Veg</option>
                                        <option value="non_veg">Non Veg</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><b>GST: </b>
                                    </label>
                                    <select class="form-control gst_no" id="gst_no" name="gst_no">
                                        <option value="">Select Type</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" style="padding-left: 0px;">
                                <button type="button" class="btn btn-success  waves-effect waves-light searchdata"  style="margin-top:18px;"><i class="fa fa-search"></i> Search  <span
                                        class="spinner"></span></button>
                                <a href="{{ route('admin.users.index') }}"  class="btn btn-danger waves-effect waves-light" style="margin-top: 18px;"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</a>
                            </div>
                            <div class="col-md-6" >
                                     
                                    

                                     <button type="submit"  name="submittype" class="btn btn-outline-primary mr-1 mb-1 waves-effect waves-light pdfsubmit" value="pdf" > <i class="fa fa-download" aria-hidden="true"></i> Pdf <i class="fa fa-file-pdf-o"></i> <span class="spinner"></span></button>

                                     <button type="submit"  name="submittype" class="btn btn-outline-primary mr-1 mb-1 waves-effect waves-light pdfsubmit" value="excel" > <i class="fa fa-download" aria-hidden="true"></i> Excel <i class="fa fa-file-excel-o"></i><span class="spinner"></span></button>


                                     
                                    <a href="#" data-toggle="modal" data-typeid="" data-target=".import_excel"
                                         class="btn btn-outline-primary mr-1 mb-1 waves-effect waves-light openimportmodal" data-id="" >
                                        <i class="fa fa-upload" aria-hidden="true"></i> Import </i> Excel <i class="fa fa-file-excel-o"></i>
                                    </a>
                                     
                            </div>
                             </form>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
          
                <div class="card-body" style="margin-top: 10px;">
                    <!-- /.card-header -->
                    
                    <div class="table-responsive">
                        <table  id="employee"class="table zero-configuration">
                   
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Mobile No.</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Description</th>
                            <th>Veg Non-Veg</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                    <!-- /.card-body -->
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.col -->
        </div>

    </div>
<!--/. container-fluid -->
<div class="modal fade add_modal" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 5px 15px;">
                <h5 class="modal-title">DMS Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body addholidaybody">
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade import_excel" >
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header" style="padding: 5px 15px;">
            <h5 class="modal-title">{{ __('Import Excel') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form  autocorrect="off" action="{{ route('admin.dms.importexcel') }}" autocomplete="off" method="post" class="form-horizontal form-bordered importexcel">
               {{ csrf_field() }}
               <input type="hidden" class="buttontype" value="verify" name="buttontype">
               <input type="hidden" class="is_verified" name="is_verified" value="0">
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label></label>
                        <a class="link-unstyled" download="" href="{{ URL::asset('public/company/employee/sample.xlsx') }}" title="">
                        <i class="fa fa-cloud-download pr10"></i> {{ __('Sample Xls') }}</a>
                     </div>
                     <div class="alert alert-warning" style="color: #4c4c4c!important;" role="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <b style="color: red;">Download the sample xls</b> file. Read first row instruction and add the information as per instruction. There are two row of sample data for instruction you can remove it and add real data. 
                      <br>
                      <br>
                     Once you fill the xls file <b style="color: red;">Upload with Browse</b> and  <b style="color: red;">Click on Verify XLS</b> button. If you've no error then <b style="color: red;">submit</b> it.</div>
                     <div class="form-group">
                        <label for="customFile"> {{ __('Select File') }} <span class="text-danger">*</span></label> 
                        <div class="custom-file">
                           <input type="file" class="custom-file-input" name="file" required="" id="customFile">
                           <label class="custom-file-label" for="customFile">
                           {{ __('Import Excel File') }}
                           </label>

                        </div>
                     </div>
                  </div>
                   <div class="col-md-12">
                     <div class="form-group">
                        <button type="submit" class="btn btn-success  verifyxls pull-left" value="verify" name="submittype"> Verify XLS <i class="fa fa-check"></i><span class="spinner"></span></button>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group tableload">
                        
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <button type="submit" class="btn btn-primary  submitbutton pull-right"> {{ __('Submit') }} <span class="subspinner"></span></button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>


@push('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">



    <script>
        $(function () {
          $('.verifyxls').on('click',function(){
            $('.buttontype').val('verify');
          });
          $('.submitbutton').on('click',function(){
            $('.buttontype').val('submit');
          });
          $('.openimportmodal').on('click',function(){
            $('.tableload').html('');
            $('.is_verified').val('0');
          })
          
            /* datatable */
            $("#employee").DataTable({
                "responsive": true,
                "autoWidth": false,
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: {
                    'url': "{{ route('admin.dms.getall') }}",
                    'type': 'POST',
                    'data': function (d) {
                        d._token = "{{ csrf_token() }}";
                        d.fssai = $("#fssai").val();
                        d.gst_no = $("#gst_no").val();
                        d.veg_non_veg = $("#veg_non_veg").val();
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', "orderable": false},
                    {data: 'name'},
                    {data: 'mobile_no'},
                    {data: 'email'},
                    {data: 'address'},
                    {data: 'description'},
                    {data: 'veg_non_veg'},
                    {data: 'action', orderable: false},
                ]
            });
            /*filter*/
            $('.searchdata').click(function () {
                event.preventDefault();
                $("#employee").DataTable().ajax.reload()
            })
        });
        $('body').on('submit', '.importexcel', function (e) {
          var buttontype = $('.buttontype').val();
          var is_verified = $('.is_verified').val();

          e.preventDefault();
          
          $.ajax({
              url: $(this).attr('action'),
              data: new FormData(this),
              type: 'POST',
              contentType: false,
              cache: false,
              processData: false,
              beforeSend: function () {
                if(buttontype == 'verify'){
                  $('.spinner').html('<i class="fa fa-spinner fa-spin"></i>')
                }else{
                  $('.subspinner').html('<i class="fa fa-spinner fa-spin"></i>')
                }
              },
              success: function (data) {


                  $('.spinner').html('')
                  $('.subspinner').html('')
                  if(data.status == 201){
                    if(data.verify == 1){
                      $('.tableload').html(data.html);
                      $('.is_verified').val('1');
                    }
                    if(data.verify == 0){

                      $('.tableload').html(data.html);
                    }
                  }
                  if (data.status == 400) {
                      toastr.error(data.msg)
                  }
                  if (data.status == 200) {
                      
                      $('.import_excel').modal('hide');
                      $('.importexcel')[0].reset()
                      $('#employee').DataTable().ajax.reload();
                      toastr.success(data.msg)
                  }
              },
          });
        });

        $('body').on('click','.openaddmodal',function(){
            var id = $(this).data('id');
            $.ajax({
                url: '{{ route("admin.dms.viewdetail") }}',
                type: 'POST',
                data:{id:id},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (data) {
                    
                   $('.addholidaybody').html(data);
                },
                error: function () {
                    toastr.error('Something went wrong!', 'Oh No!');

                }
            });

        });

    </script>
@endpush
@endsection
