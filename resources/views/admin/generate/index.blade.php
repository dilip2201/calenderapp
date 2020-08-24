@extends('layout.app')
@section('content')
@section('pageTitle', 'Dms')

<div class="row">
    <div class="col-12 p-0">
        <div class="col-lg-12">
            <div class="alert alert-warning" style="color: #4c4c4c!important;" role="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Click on generate button to generate URL. Once you generate the URL, this will be valid for 24 hours. User can add his data with generated URL for 24 hours. </div>
            <button type="button" class="btn btn-primary mr-1 mb-1 waves-effect waves-light generateurl">Generate <i class="fa fa-refresh"></i></button>
        </div>
            <!-- /.card -->
        <!-- /.col -->
    </div>

</div>

@push('script')
<script type="text/javascript">
    $(function () {
       
    })
</script>
@endpush
@endsection
