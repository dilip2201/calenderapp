<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600">
<div class="content-body">
                <!-- account setting page start -->
                <section id="page-account-settings">
                    <div class="row">
                        <!-- left menu section -->
                        <div class="col-md-3 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75 active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                        <i class="feather icon-globe mr-50 font-medium-3"></i>
                                        General Info
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                        <i class="feather icon-lock mr-50 font-medium-3"></i>
                                        Contact  Info
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75" id="account-pill-info" data-toggle="pill" href="#account-vertical-info" aria-expanded="false">
                                        <i class="feather icon-info mr-50 font-medium-3"></i>
                                        Social links
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75" id="account-pill-social" data-toggle="pill" href="#account-vertical-social" aria-expanded="false">
                                        <i class="feather icon-camera mr-50 font-medium-3"></i>
                                        Address Info
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75" id="account-pill-connections" data-toggle="pill" href="#account-vertical-connections" aria-expanded="false">
                                        <i class="feather icon-feather mr-50 font-medium-3"></i>
                                         Cook Info
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75" id="account-pill-notifications" data-toggle="pill" href="#account-vertical-notifications" aria-expanded="false">
                                        <i class="feather icon-message-circle mr-50 font-medium-3"></i>
                                        More Info
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- right content section -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                              <strong><i class="fa fa-book" aria-hidden="true"></i>&nbsp; First Name :  </strong> {{ $dms->first_name ?? '-' }} &nbsp;&nbsp;&nbsp;  
									          <br>
									          <hr>
									          <strong><i class="fa fa-book" aria-hidden="true"></i>&nbsp; Middle Name :  </strong>{{ $dms->middle_name ?? '-' }} &nbsp;&nbsp;&nbsp; 
									          <br>
									          <hr>
									          <strong><i class="fa fa-book" aria-hidden="true"></i>&nbsp; Last Name :  </strong>{{ $dms->last_name ?? '-' }} &nbsp;&nbsp;&nbsp; 
									          <br>
									          <hr>

                                           
                                            </div>
                                            <div class="tab-pane fade" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                               <strong><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp; Email ID :  </strong>{{ $dms->email ?? '-' }} &nbsp;&nbsp;&nbsp;  
									          <br>
									          <hr>
                                             
                  									          <strong><i class="fa fa-mobile" aria-hidden="true"></i>&nbsp; Mobile Number :  </strong>+{{ $dms->country_code.$dms->mobile_no }} &nbsp;&nbsp;&nbsp; 
                  									          <br>
                  									          <hr>
                                              
                  									          <strong><i class="fa fa-mobile" aria-hidden="true"></i>&nbsp; Std No. :  </strong>{{ $dms->std_code }} &nbsp;&nbsp;&nbsp; 
                  									          <br>
                  									          <hr>
                  									           <strong><i class="fa fa-mobile" aria-hidden="true"></i>&nbsp; Landline Number :  </strong>{{ $dms->landline_no ?? '-' }} &nbsp;&nbsp;&nbsp; 
                  									          <br>
                  									          <hr>
                  									           <strong><i class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp; WhatsApp-number :  </strong>{{ $dms->whatsapp_number ?? '-' }} &nbsp;&nbsp;&nbsp; 
                  									          <br>
                  									          <hr>
                                            </div>
                                            <div class="tab-pane fade show" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                                                 <strong><i class="fa fa-facebook-f" aria-hidden="true"></i>&nbsp; Facebook Link :  </strong>{{ $dms->fb_link ?? '-' }} &nbsp;&nbsp;&nbsp;  
									          <br>
									          <hr>
									          <strong><i class="fa fa-instagram" aria-hidden="true"></i>&nbsp; Instagram Link :  </strong>{{ $dms->insta_link ?? '-' }} &nbsp;&nbsp;&nbsp; 
									          <br>
									          <hr>
									          <strong><i class="fa fa-youtube" aria-hidden="true"></i>&nbsp; YouTube Link :  </strong>{{ $dms->youtube_link ?? '-' }} &nbsp;&nbsp;&nbsp; 
									          <br>
									          <hr>
                                               <strong><i class="fa fa-link" aria-hidden="true"></i>&nbsp; Other social media :  </strong>{{ $dms->twitter_link ?? '-' }} &nbsp;&nbsp;&nbsp; 
                                              <br>
                                              <hr>
                                            </div>
                                            <div class="tab-pane fade" id="account-vertical-social" role="tabpanel" aria-labelledby="account-pill-social" aria-expanded="false">
                                              <strong><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp; Street/Avenue :  </strong>{{ $dms->address_1 ?? '-' }} &nbsp;&nbsp;&nbsp;  
									          <br>
									          <hr>
									          <strong><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp; Apartment / No :  </strong>{{ $dms->address_2 ?? '-' }} &nbsp;&nbsp;&nbsp; 
									          <br>
									          <hr>
									          <strong><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp; Extra indications :  </strong>{{ $dms->address_3 ?? '-' }} &nbsp;&nbsp;&nbsp; 
									          <br>
									          <hr>
                                              <strong><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp; Pin Code :  </strong>{{ $dms->pincode ?? '-' }} &nbsp;&nbsp;&nbsp; 
                                              <br>
                                              <hr>
                                              <strong><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp; Area :  </strong>{{ $dms->area ?? '-' }} &nbsp;&nbsp;&nbsp; 
                                              <br>
                                              <hr>
                                              <strong><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp; City :  </strong>{{ $dms->city ?? '-' }} &nbsp;&nbsp;&nbsp; 
                                              <br>
                                              <hr>
                                              <strong><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp; State :  </strong>{{ $dms->state ?? '-' }} &nbsp;&nbsp;&nbsp; 
                                              <br>
                                              <hr>
                                              <strong><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp; Country :  </strong>{{ $dms->country ?? '-' }} &nbsp;&nbsp;&nbsp; 
                                              <br>
                                              <hr>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="account-vertical-connections" aria-labelledby="account-vertical-connections" aria-expanded="false">
                                              <strong><i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp; Category :  </strong>{{ $dms->category_1 ?? '-' }} &nbsp;&nbsp;&nbsp;  
                                              <br>
                                              <hr>
                                              <strong><i class="fa fa-tag" aria-hidden="true"></i>&nbsp; Sub-Category :  </strong>{{ $dms->category_2 ?? '-' }} &nbsp;&nbsp;&nbsp; 
                                              <br>
                                              <hr>
                                              <strong><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; Description :  </strong>{{ $dms->description ?? '-' }} &nbsp;&nbsp;&nbsp; 
                                              <br>
                                              <hr>

                                           
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="account-vertical-notifications" aria-labelledby="account-vertical-notifications" aria-expanded="false">
                                              <strong><i class="fa fa-book" aria-hidden="true"></i>&nbsp; Five words that best describe you! :  </strong>{{ $dms->words_describe ?? '-' }} &nbsp;&nbsp;&nbsp;  
                                              <br>
                                              <hr>
                                              <strong><i class="fa fa-book" aria-hidden="true"></i>&nbsp; 10 products you are best at! :  </strong>{{ $dms->product_best_at ?? '-' }} &nbsp;&nbsp;&nbsp; 
                                              <br>
                                              <hr>
                                              <strong><i class="fa fa-book" aria-hidden="true"></i>&nbsp; I'm veggie friendly! :  </strong>{{ $dms->veg_non_veg ?? '-' }} &nbsp;&nbsp;&nbsp; 
                                              <br>
                                              <hr>
                                            </div>
                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- account setting page end -->

            </div>