@extends('layout.app')
@section('content')
@section('pageTitle', 'Dms')

<div class="row">
    <div class="col-12 p-0">
        <div class="col-lg-12">
            <div class="alert alert-warning" style="color: #4c4c4c!important;" role="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Click on generate button to generate URL. Once you generate the URL, this will be valid for 24 hours. User can add his data with generated URL for 24 hours. </div>
            <button type="button" class="btn btn-primary mr-1 mb-1 waves-effect waves-light generateurl">Generate <span class="refreshtoken"><i class="fa fa-refresh"></i></span></button>
        </div>
            <!-- /.card -->
        <!-- /.col -->
    </div>
    <div class="col-12 p-0 generatedvalue" style="display: none;"> 
        <div class="col-lg-12">
            <div class="form-group row " style="margin-bottom: 0px;">
                <div class="col-md-12">
                    <div class="form-group">
                        <label><b>URL: </b>
                        </label>
                        <textarea  class="form-control random" id="myInput"  readonly="">
                        </textarea>
                    </div>
                </div>
              
            </div>
            <button type="button" class="btn btn-primary waves-effect waves-light"  onclick="myFunction()" data-toggle="tooltip" title="Copy to clipboard!"><i class="fa fa-copy"></i> Copy URL</button>
        </div>
           
    </div>
</div>

@push('script')
<script type="text/javascript">
    function myFunction() {
          var copyText = document.getElementById("myInput");
          copyText.select();
          copyText.setSelectionRange(0, 99999)
          document.execCommand("copy");
        }
    $(function () {
        $('body').on('click', '.generateurl', function () {
            $.ajax({
                url: "{{ route('admin.generateurl.newtoken')}}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                beforeSend: function () {
                    $('.refreshtoken').html('<i class="fa fa-refresh fa-spin"></i>');
                },
                success: function (data) {
                    $('.refreshtoken').html('<i class="fa fa-refresh"></i>');
                    var url = "{{ url('/user/data/')}}"
                    $('.generatedvalue').css('display','block');
                    $('.random').text(url+'/'+data.random);
                },
            });
        });
    })
</script>
@endpush
@endsection
