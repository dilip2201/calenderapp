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
            <div class="card card-info card-outline displaybl">
                <div class="card-body" style="padding: 10px 15px;">
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
                                     @if(Auth::user()->role == 'super_admin')
                                     <button type="submit" name="submittype" class="btn btn-danger btn-sm pdfsubmit" style="padding: 6px 16px;cursor: pointer;background-color: DodgerBlue; border-color: DodgerBlue; " value="pdf" class="btn btn-danger btn-sm"> <i class="fa fa-download" aria-hidden="true"></i> Pdf <span class="spinner"></span>
                                     </button>
                                     <button type="submit" name="submittype" class="btn btn-danger btn-sm pdfsubmit" value="excel" style="padding: 6px 16px;cursor: pointer;background-color: DodgerBlue; border-color: DodgerBlue; "  class="btn btn-success btn-sm" ><i class="fa fa-download" aria-hidden="true"></i>  Excel <span
                                        class="spinner"></span>
                                      </button>
                                      @endif
                            </div>
                             </form>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <div class="dt-buttons btn-group"><button data-toggle="modal" data-typeid="" data-target=".add_modal" class="btn btn-outline-primary openaddmodal" tabindex="0" aria-controls="DataTables_Table_0"><span><i class="feather icon-plus"></i> Add New</span></button> </div>
            <div class="card  card-outline">
               
                <div class="card-body">
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

    </script>

@endsection
