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
                                    <select class="form-control status" id="status" name="status">
                                        <option value="">Select Status</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><b>Role: </b>
                                    </label>
                                    <select class="form-control role" id="role" name="role">
                                        <option value="">Select Role</option>
                                        <option value="super_admin">Super Admin</option>
                                        <option value="user">User</option>
                                        <option value="operator">Operator</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" style="padding-left: 0px;">
                                <button type="button" class="btn btn-success  waves-effect waves-light searchdata"  style="margin-top:18px;"><i class="fa fa-search"></i> Search  <span
                                        class="spinner"></span></button>
                                <a href="{{ route('admin.users.index') }}"  class="btn btn-danger waves-effect waves-light" style="margin-top: 18px;"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</a>
                            </div>
                            <div class="col-md-6" style="padding-left: 0px;margin-top: 20px;margin-left: 10px">
                                     
                                     <button type="submit" name="submittype" class="btn btn-danger btn-sm pdfsubmit" style="padding: 6px 16px;cursor: pointer;background-color: DodgerBlue; border-color: DodgerBlue; " value="pdf" class="btn btn-danger btn-sm"> <i class="fa fa-download" aria-hidden="true"></i> Pdf <span class="spinner"></span>
                                     </button>
                                     <button type="submit" name="submittype" class="btn btn-danger btn-sm pdfsubmit" value="excel" style="padding: 6px 16px;cursor: pointer;background-color: DodgerBlue; border-color: DodgerBlue; "  class="btn btn-success btn-sm" ><i class="fa fa-download" aria-hidden="true"></i>  Excel <span
                                        class="spinner"></span>
                                    </button>
                                    <a href="#" data-toggle="modal" data-typeid="" data-target=".import_excel"
                                         class="btn btn-info btn-sm openimportmodal" data-id="" style="margin-left: 5px;">
                                        <i class="fa fa-upload" aria-hidden="true"></i> Import
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
                            <th>Role</th>
                            <th>Email</th>
                            <th>Mobile No.</th>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="padding: 5px 15px;">
                <h5 class="modal-title">Large Modal</h5>
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
   <div class="modal-dialog modal-sm">
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
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label></label>
                        <a class="link-unstyled" download="" href="{{ URL::asset('public/company/employee/sample.xlsx') }}" title="">
                        <i class="fa fa-cloud-download pr10"></i> {{ __('Sample Sheet') }}</a>
                     </div>
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
                        <button type="submit" class="btn btn-primary  submitbutton pull-right"> {{ __('Submit') }} <span class="spinner"></span></button>
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


<script src="https://jqueryvalidation.org/files/lib/jquery.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script>
        $(function () {
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
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', "orderable": false},
                    {data: 'name'},
                    {data: 'role'},
                    {data: 'email'},
                    {data: 'mobile_no'},
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
      e.preventDefault();
      $.ajax({
          url: $(this).attr('action'),
          data: new FormData(this),
          type: 'POST',
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function () {
              $('.spinner').html('<i class="fa fa-spinner fa-spin"></i>')
          },
          success: function (data) {
             
              if (data.status == 400) {
                  $('.spinner').html('');
                  toastr.error(data.msg)
              }
              if (data.status == 200) {
                  $('.spinner').html('');
                  $('.import_excel').modal('hide');
                  $('#employee').DataTable().ajax.reload();
                  toastr.success(data.msg)
              }
          },
      });
   });

    </script>

@endsection
