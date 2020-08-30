<!DOCTYPE html>
<!--  This site was created in Webflow. http://www.webflow.com  -->
<!--  Last Published: Fri Aug 21 2020 16:51:14 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="5f3daf7623551f82d9830c5d" data-wf-site="5f3daf7623551fcc27830c5c">
   <head>
      <meta charset="utf-8">
      <title>Form Foodism</title>
      <meta content="width=device-width, initial-scale=1" name="viewport">
      <meta content="Webflow" name="generator">
      <link href="{{ URL::asset('public/steps/css/normalize.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ URL::asset('public/steps/css/webflow.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ URL::asset('public/steps/css/formfoodism.webflow.css') }}" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
      <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
      <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
      <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">
      <link href="images/webclip.png" rel="apple-touch-icon">
      <style type="text/css">
        label.error{
              color: red!important;
            font-size: 14px!important;
            margin-top: -10px!important;
            margin-left: 5px!important;
            font-weight: 100!important;
        }
      </style>
   </head>
   <body>
      <div class="section" style="background-size: contain; background-image: url('{{ url("public/app-assets/images/pages/vuexy-login-bg.png") }}') ">
         <div class="div-block">
            <div class="w-layout-grid grid">
               <div id="w-node-d54fb76ef8b2-d9830c5d" class="div-block-4"><img src="{{ URL::asset('public/steps/images/foodism-new-logo.png') }}" height="" alt="" class="image"></div>
               <div class="form-block w-form loaddashboard">
                  
               </div>
            </div>
         </div>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="{{ URL::asset('public/steps/js/webflow.js') }}" type="text/javascript"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
      <script type="text/javascript">
         function loadstepsplanday() {
            var token = "{{ $token }}";
            $.ajax({
                url: "{{ route('userstepload') }}",
                type: 'POST',
                data: {token: token},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                beforeSend: function () {
                    //$('.tripletexemployeespinner').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function (data) {
                  if (data.status == 400) {
                        location.reload();
                    }
                    if (data.status == 200) {
                        $('.loaddashboard').html(data.html);


  
                        $('.formsubmittrack').validate({
                          rules: {
                                first_name: {
                                    required: true,
                                    maxlength: 50
                                },
                                middle_name: {
                                    maxlength: 50
                                },
                                last_name: {
                                    required: true,
                                    maxlength: 50
                                },
                                dob: {
                                    required: true,
                                },
                                gender: {
                                    required: true,
                                },
                                email: {
                                    required: true,
                                    maxlength: 50,
                                    email:true
                                },
                                std_code: {
                                    maxlength: 5,
                                    number: true
                                },
                                landline_no: {
                                    maxlength: 10,
                                    number: true
                                },
                                fb_link:{
                                  url: true,
                                },
                                insta_link:{
                                  url: true,
                                },
                                youtube_link:{
                                  url: true,
                                },
                                twitter_link:{
                                  url: true,
                                },
                                address_1: {
                                    required: true,
                                    maxlength: 50
                                },
                                address_2:{
                                  maxlength: 50
                                },
                                address_3:{
                                  maxlength: 50
                                },
                                pincode:{
                                  number: true
                                },
                                description:{
                                  maxlength: 200
                                }
                            }
                        });
                    }
                     if (data.status == 202) {
                      var  url = "{{ url('success')}}"
                        window.location.href = url;
                    }
                    if (data.status == 201) {
                      var  url = "{{ url('alreadysubmitted')}}"
                        window.location.href = url;
                    }
                    //$('.tripletexemployeespinner').html('');
                    
                },
                error: function () {
                    toastr.error('Something went wrong!', 'Oh No!');
                }
            });
        }
        $(function () {

          $('body').on('click','.valuecheck',function(){
             if ($('.valuecheck').is(":checked")) { 
                       $('.whatsapp_number').val($('.mobile_no').val());
                    } else { 
                        $('.whatsapp_number').val('');
                    } 
          });
          $('body').on('submit', '.formsubmittrack', function (e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type: 'POST',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $('.spinner').html('<i class="fa fa-spinner fa-spin"></i>');
                    },
                    success: function (data) {
                        if (data.redirect == 1) {
                            window.location.href = "{{ url('integration/dashboard/active/plan/'.encrypt(1)) }}";
                        }
                        $('.pricesticky').css('display', 'none');
                        if (data.status == 400) {
                            $('.spinner').html('');
                            toastr.error(data.msg, 'Oh No!');
                        }
                        if (data.status == 200) {
                            loadstepsplanday();
                        }
                    },

                });
            });

            $('body').on('keyup','.pincode',function(){
              var pincode = $(this).val();

              if(pincode.length ==6 ){
                $.ajax({
                    url: "{{ route('user.pincode') }}",
                    data: {pincode: pincode},
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type: 'POST',
                    success: function (data) {
                        if (data.status == 200) {
                          
                            $('.area').val(data.data.postalLocation);
                            $('.city').val(data.data.district);
                            $('.state').val(data.data.state);
                            $('.country').val(data.data.country);
                        }
                    },
                });
              }
            })
            loadstepsplanday();
            $('body').on('click', '.previousclick', function () {
                var pageid = $(this).data('pageid');
                var planid = $(this).data('planid');
                var type = $(this).data('type');
                $.ajax({
                    url: "{{ route('gotopreviouspage') }}",
                    data: {pageid: pageid, planid: planid},
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type: 'POST',
                    beforeSend: function () {
                        if (type == 'previous') {
                            $('.spinnerprevious').html('<i class="fa fa-spinner fa-spin"></i>')
                        } else {
                            $('.spinnernext').html('<i class="fa fa-spinner fa-spin"></i>')
                        }
                    },
                    success: function (data) {
                        if (data.status == 400) {
                            $('.spinnerprevious').html('');
                            $('.spinnernext').html('')
                            toastr.error(data.msg, 'Oh No!');
                        }
                        if (data.status == 200) {
                            loadstepsplanday();
                        }
                    },
                });
            });

         });
      </script>
      
   </body>
</html>