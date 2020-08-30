<!DOCTYPE html>

<html data-wf-page="5f3daf7623551f82d9830c5d" data-wf-site="5f3daf7623551fcc27830c5c">
   <head>
      <meta charset="utf-8">
      <title>Form Foodism</title>
      <meta content="width=device-width, initial-scale=1" name="viewport">
      <meta content="Webflow" name="generator">

      <link href="{{ URL::asset('public/steps/css/normalize.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ URL::asset('public/steps/css/webflow.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ URL::asset('public/steps/css/formfoodism.webflow.css') }} " rel="stylesheet" type="text/css">
      
      <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
      <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">
      <link href="images/webclip.png" rel="apple-touch-icon">
   </head>
   <body> 
      <div class="section" style="background-size: contain; background-image: url('{{ url("public/app-assets/images/pages/vuexy-login-bg.png") }}') ">
         <div class="div-block" style="min-height: 30px!important; text-align: center; font-size: 20px;">
            {{ $msg }}
         </div>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="{{ URL::asset('public/steps/js/webflow.js') }}" type="text/javascript"></script>
      <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
   </body>
</html>