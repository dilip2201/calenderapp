
<html>
   <head>
      <style>
         /**
         Set the margins of the page to 0, so the footer and the header
         can be of the full height and width !
         **/
         @page {
         margin: 0cm 0cm;
         }
         table, th, td {
         border: 1px solid black;
         border-collapse: collapse;
         /*font-weight: 100;*/
         font-size: 12px;
         }
         th, td {
         padding: 5px;
         text-align: left;
         /*font-weight: 100;*/
         font-size: 12px;
         }
         .termsandcondition p{
         margin:0px;
         }
         /** Define now the real margins of every page in the PDF **/
         body {
         font-family: Arial, sans-serif;
         margin-top: 50px;
         margin-left: 10px;
         margin-right: 10px;
         margin-bottom: 110px;
         }
         /** Define the header rules **/
         header {
         position: fixed;
         text-align: right;
         height: 100px;
         padding-top: 25px;
         padding-right: 50px;
         }
         /** Define the footer rules **/
         footer {
         position: fixed;
         bottom: 10px;
         left: 15px;
         right: 15px;
         height: 115px;
         }
         .toppart{
         width: 100%;
         display: block;
         margin-top: 15px;
         font-size: 14px;
         }
         .toppartwithoutmargin{
         width: 100%;
         display: block;
         font-size: 14px;
         }
         .fontbold{
         font-weight: 600;
         }
         .servicespart{
         background: #eee;
         margin-top: 10px;
         font-size: 14px;
         padding: 4px;
         }
         main{
         padding-left: 30px;
         padding-right: 30px;
         }
         .colorblue{
         color: #00add8;
         border-bottom: 1px solid #00add8;
         }
         .assementdescription{
         font-style: italic;
         font-size: 14px;
         }
         .blackunderline{
         color: #000;
         border-bottom: 1px solid #000;
         font-weight: 600;
         }
         .termsandcondition{
         font-size: 12px;
         }
         * {
         box-sizing: border-box;
         }
         .column {
         float: left;
         width: 30.33%;
         padding: 10px;
         height: 150px; /* Should be removed. Only for demonstration */
         }
         /* Clear floats after the columns */
         .row:after {
         content: "";
         display: table;
         clear: both;
         }
      </style>
   </head>
   <body>

      <main>
               <table class="table table-bordered" style="width: 100%;">
                  <thead>
                     <tr>
                        <th><h3><b>Name</b></h3></th>
                        <th><h3><b>Date Of Birth</b></h3></th>
                        <th><h3><b>Gender</b></h3></th>
                        <th><h3><b>Whatsapp Number</b></h3></th>
                         <th><h3><b>Mobile No.</b></h3></th>
                          <th><h3><b>Email</b></h3></th>
                           <th><h3><b>Address</b></h3></th>
                        <th><h3><b>Description</b></h3></th>
                        <th><h3><b>Veg Non-Veg</b></h3></th>

                     </tr>
                  </thead>
                  <tbody>

                  @if(!empty($dmses))
                  @foreach($dmses as $user)
                  @php

                  $address = '';
                  if(!empty($user->address_1)){
                     $address.= " ".$user->address_1.',';
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


                  $name = '';
                  if(!empty($user->first_name)){
                     $name.= $user->first_name.' ';
                  }
                  if(!empty($user->middle_name)){
                     $name.= $user->middle_name.' ';
                  }
                  if(!empty($user->last_name)){
                     $name.= $user->last_name;
                  }


                   $c_code= $user->country_code.$user->mobile_no;
                  @endphp
                  <tr>
                     <td>{{ $name }}</td>
                     <td>{{ date('d M Y',strtotime($user->dob)) }}</td>
                     <td>{{ ucfirst($user->gender) }} </td>
                     <td>{{ $user->whatsapp_number }} </td>

                     <td>{{ $c_code }} </td>
                     <td>{{ $user->email ?? '' }}</td>
                     <td>{{ $address }}</td>
                     <td>{{ $user->description ?? '' }}</td>
                     <td>{{ $user->veg_non_veg ?? '' }}</td>
                  </tr>
                  @endforeach
                  @endif
                  </tbody>
               </table>
      

      </main>
   </body>
</html>