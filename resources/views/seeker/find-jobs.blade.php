@extends('layouts.header-user.header')

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->
      
    @include('seeker.parts.header', ['chat_counts' => $chat_counts, 'profile' => $profile])

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ asset('images/hero_1.jpg') }});" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Find Jobs</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Find Jobs</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section" id="next-section">
      <div class="container">

        <style>

        body {
            background-color: #eeeeee;
        }

        .h7 {
            font-size: 0.8rem;
        }

        .gedf-wrapper {
            margin-top: 0.97rem;
        }

        @media (min-width: 992px) {
            .gedf-main {
                padding-left: 4rem;
                padding-right: 4rem;
            }
            .gedf-card {
                margin-bottom: 2.77rem;
            }
        }

        /**Reset Bootstrap*/
        .dropdown-toggle::after {
            content: none;
            display: none;
        }

        </style>

            <div class="container-fluid gedf-wrapper">
                <div class="row">

                    <div class="col-md-3">

                        <div class="card">
                            <div class="card-body">
                                @if (empty($seeker->image))
                                  <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                                @else
                                  <img class="rounded-circle" width="50" height="50" src="{{ $seeker->image }}" alt="">
                                @endif
                                
                                <div class="h5">{{ $seeker->full_name }}</div>
                                <div class="h7 text-muted">{{ $seeker->email_address }}</div>
                                <div class="h7">{{ $seeker->address }}</div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="h6 text-muted">Telephone Number</div>
                                    <div class="h5">{{ $seeker->telephone_number }}</div>
                                </li>
                                <li class="list-group-item">
                                    <div class="h6 text-muted">Mobile Number</div>
                                    <div class="h5">{{ $seeker->mobile_number }}</div>
                                </li>
                                <li class="list-group-item">Dream big!</li>
                            </ul>
                        </div>

                    </div>

                    <div class="col-md-6 gedf-main">

                        <div class="card gedf-card">

                            <div class="card-header">

                                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" id="jobs-tab" data-toggle="tab" href="#jobs" role="tab" aria-controls="jobs" aria-selected="true">Job Listing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="quicks-tab" data-toggle="tab" href="#quicks" role="tab" aria-controls="quicks" aria-selected="false">Quick Job Request</a>
                                    </li>
                                </ul>

                            </div>

                            <div class="card-body" style="padding:0px !important;">
                                <div class="tab-content" id="myTabContent">

                                    <div class="tab-pane fade show active" id="jobs" role="tabpanel" aria-labelledby="jobs-tab">
                                        
                                      @foreach ($regulars as $listing)
                                        <div class="card gedf-card">
                                          <div class="card-header">
                                              <div class="d-flex justify-content-between align-items-center">
                                                  <div class="d-flex justify-content-between align-items-center viewCom" style="cursor: hand;" id="{{ $listing }}" title="View company information">
                                                      <div class="mr-2" >
                                                          @if (!empty($listing->p_image))
                                                            <img class="rounded-circle" width="50" height="50" src="{{ $listing->p_image }}" alt="">
                                                          @else
                                                            <img class="rounded-circle" width="50" height="50" src="https://picsum.photos/50/50" alt="">
                                                          @endif
                                                      </div>
                                                      <div class="ml-2">
                                                          <div class="h5 m-0">{{ $listing->business_name }}</div>
                                                          <div class="h7 text-muted">{{ $listing->email_address }}</div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="card-body">
                                              <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i> {{ $listing->created_date }}</div>
                                              <a class="card-link viewJob" id="{{ $listing }}" href="#" title="View job information">
                                                  <h5 class="card-title">
                                                    {{ $listing->title }}
                                                  </h5>
                                              </a>
              
                                              <p class="card-text">
                                                @if (strlen(strip_tags($listing->details)) > 100)
                                                  {{ str_replace('&nbsp;', ' ', substr(strip_tags($listing->details),0,100))."..." }}
                                                @else
                                                  {{ str_replace('&nbsp;', ' ', strip_tags($listing->details)) }}
                                                @endif
                                              </p>

                                              <p class="card-text">
                                                <i class="fa fa-map-marker"></i> {{ $listing->barangay.' '.$listing->municipality.' '.$listing->postal }}
                                              </p>

                                              <p class="card-text">
                                                <i class="fa fa-users"></i> Slots Available : {{ $listing->slots }}
                                              </p>
                                              
                                              <div>
                                                <i class="fa fa-money" aria-hidden="true"></i>{{ ' Php. '.number_format($listing->min_offer, 2, '.', ',').' - Php. '.number_format($listing->max_offer, 2, '.', ',') }}
                                              </div>

                                              <br>
                                              <div class="row">
                                                {{-- <div class="col-6">
                                                  <a href="#" class="btn btn-block btn-light btn-sm"><span class="icon-heart-o mr-2 text-danger"></span>Save Job</a>
                                                </div> --}}
                                                <div class="col-12">
                                                  <a href="/apply/listing_job/{{ $listing->id }}" class="btn btn-block btn-primary btn-sm">Apply Now</a>
                                                </div>
                                              </div>

                                          </div>
                                          {{-- <div class="card-footer">
                                              <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
                                              <a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a>
                                              <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
                                          </div> --}}
                                        </div>
                                      @endforeach                                      

                                    </div>

                                    <div class="tab-pane fade" id="quicks" role="tabpanel" aria-labelledby="quicks-tab">

                                      @foreach ($quicks as $quick)
                                        <div class="card gedf-card">
                                          <div class="card-header">
                                              <div class="d-flex justify-content-between align-items-center">
                                                  <div class="d-flex justify-content-between align-items-center viewCom" style="cursor: hand;" id="{{ $quick }}" title="View company information">
                                                      <div class="mr-2">
                                                          @if (empty($quick->p_image))
                                                            <img class="rounded-circle" width="50" height="50" src="https://picsum.photos/50/50" alt="">
                                                          @else
                                                            <img class="rounded-circle" width="50" height="50" src="{{ $quick->p_image }}" alt="">
                                                          @endif
                                                      </div>
                                                      <div class="ml-2">
                                                        <div class="h5 m-0">{{ $quick->business_name }}</div>
                                                        <div class="h7 text-muted">{{ $quick->email_address }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i> {{ $quick->created_date }}</div>
                                            <a class="card-link viewJob" id="{{ $quick }}" href="#" title="View job information">
                                                <h5 class="card-title">
                                                  {{ $quick->title }}
                                                </h5>
                                            </a>
              
                                            <p class="card-text">
                                              {{ $quick->description }}
                                            </p>

                                            <h4 class="card-title">
                                              Request
                                            </h4>
                                              <p class="card-text">
                                                @if (strlen(strip_tags($quick->request)) > 150)
                                                {{ str_replace('&nbsp;', ' ', substr(strip_tags($quick->request),0,150))."..." }}
                                              @else
                                                {{ str_replace('&nbsp;', ' ', strip_tags($quick->request)) }}
                                              @endif
                                              </p>


                                              <p class="card-text">
                                                  <i class="fa fa-map-marker"></i> {{ $quick->location }}
                                                </p>

                                                <p class="card-text">
                                                  <i class="fa fa-calendar-o"></i> {{ $quick->event_date.' '.$quick->event_time }}
                                                </p>


                                                <br>
                                                <div class="row">
                                                  {{-- <div class="col-6">
                                                    <a href="#" class="btn btn-block btn-light btn-sm"><span class="icon-heart-o mr-2 text-danger"></span>Save Job</a>
                                                  </div> --}}
                                                  <div class="col-12">
                                                    <a href="/apply/quick_job/{{ $quick->id }}" class="btn btn-block btn-primary btn-sm">Apply Now</a>
                                                  </div>
                                                </div>
                                                
                                          </div>
                                          {{-- <div class="card-footer">
                                              <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
                                              <a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a>
                                              <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
                                          </div> --}}
                                        </div>
                                      @endforeach

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <div class="col-md-3">

                      @foreach ($providers as $provider)    
                        <div class="card gedf-card">
                          <div class="card">
                            @if (empty($provider->image))
                              <img class="card-img-top" src="{{ asset('images/default-job.png') }}" alt="Card image cap">
                            @else
                              <img class="card-img-top" src="{{ $provider->image }}" alt="Card image cap">
                            @endif
                            <div class="card-body">
                              <h5 class="card-title">{{ $provider->business_name }}</h5>
                              <p class="card-text">{{ $provider->business_type }}</p>
                              <button id="{{ $provider }}" class="btn btn-primary viewCom" title="View company information">View Profile</button>
                            </div>
                          </div>
                        </div>
                      @endforeach

                    </div>
                </div>
            </div>

      </div>
    </section>


    <div class="modal fade" id="viewRegularJobModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <section class="site-section" style="padding-top: 0; padding-bottom: 0;">
              <div class="container" style="padding-left: 0px;padding-right: 0px;">
                <div class="row align-items-center mb-5">
                  <div class="col-lg-10 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center">
                      <div class="border p-2 d-inline-block mr-3 rounded">
                        <img id="imageFe" src="" alt="Image" style="width: 100px;">
                      </div>
                      <div>
                        <h4 id="title"></h4>
                        <div>
                          <span class="ml-0 mr-2 mb-2"><span class="icon-briefcase mr-2"></span><span class="text-primary" id="tags"></span></span>
                          <span class="m-2"><span class="icon-room mr-2"></span><span class="text-primary" id="location"></span></span>
                          <span class="m-2"><span class="icon-clock-o mr-2"></span><span class="text-primary" id="emp_status"></span></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="row">
                      <div class="col-6">
                        {{-- <a href="#" class="btn btn-block btn-light btn-sm"><span class="icon-heart-o mr-2 text-danger"></span>Save Job</a> --}}
                      </div>
                      <div class="col-6">
                        {{-- <a href="#" class="btn btn-block btn-primary btn-sm">Apply Now</a> --}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="mb-5">
                      <figure class="mb-5">
                        <img id="imageBig" src="" alt="Image" class="img-fluid rounded">
                      </figure>
                      <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-align-left mr-3"></span>Job Description</h3>
                      <p id="description"></p>
                    </div>
        
                    <div class="row mb-5">
                      <div class="col-6">
                        {{-- <a href="#" class="btn btn-block btn-light btn-sm"><span class="icon-heart-o mr-2 text-danger"></span>Save Job</a> --}}
                      </div>
                      <div class="col-6">
                        {{-- <a href="#" class="btn btn-block btn-primary btn-sm">Apply Now</a> --}}
                      </div>
                    </div>
        
                  </div>
                  <div class="col-lg-6">
                    <div class="bg-light p-3 border rounded mb-4">
                      <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Job Summary</h3>
                      <ul class="list-unstyled pl-3 mb-0" style="padding-left: 0px !important;">
                        <li class="mb-2"><strong class="text-black">Published on:</strong> <span id="created_at"></span></li>
                        <li class="mb-2"><strong class="text-black">Vacancy:</strong> <span id="slots"></span></li>
                        <li class="mb-2"><strong class="text-black">Employment Status:</strong> <span id="status"></span></li>
                        <li class="mb-2"><strong class="text-black">Experience:</strong> <span id="experience"></span></li>
                        <li class="mb-2"><strong class="text-black">Job Location:</strong> <span id="location2"></span></li>
                        <li class="mb-2"><strong class="text-black">Salary:</strong> <span id="salary"></span></li>
                        <li class="mb-2"><strong class="text-black">Gender:</strong> <span id="gender"></span></li>
                        <li class="mb-2"><strong class="text-black">Application Deadline:</strong> <span id="deadline"></span></li>
                      </ul>
                    </div>
        
                    <div class="bg-light p-3 border rounded">
                      <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Social Media</h3>
                      <div class="px-3">
                        <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
                        <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
                        <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-instagram"></span></a>
                      </div>
                    </div>
        
                  </div>
                </div>
              </div>
            </section>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="viewQuickJobModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="viewCompanyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Company Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <style>
              .fa {
                color: #1b3d6c;
              }

              label .fa {
                padding-left: 5px;
                padding-right: 5px;
              }

              p span {
                padding-left: 15px;
              }
            </style>

            <fieldset style="padding: 10px;">

              <p for="">
                <i class="fa fa-2x fa-briefcase" aria-hidden="true"></i> <span id="business_name"></span>
              </p>

              <p for="">
                <i class="fa fa-2x fa-building" aria-hidden="true"></i> <span id="business_type"></span>
              </p>

              <p for="">
                <i class="fa fa-2x fa-envelope" aria-hidden="true"></i> <span id="email_address"></span>
              </p>

              <p for="">
                <i class="fa fa-2x fa-address-book" aria-hidden="true"></i> <span id="mailing_address"></span>
              </p>

              <p for="">
                <i class="fa fa-2x fa-phone" aria-hidden="true"></i> <span id="telephone_number"></span>
              </p>

              <p for="">
                <i class="fa fa-2x fa-mobile" aria-hidden="true"></i> <span id="mobile_number"></span>
              </p>

              <p for="">
                <i class="fa fa-2x fa-sitemap" aria-hidden="true"></i> <span id="affiliation"></span>
              </p>

              <hr>
              <p for="">Social Media Account</p>
              <hr>

              <a id="facebook" target="_blank" style="padding-left: 5x; padding-right: 5x;" for="">
                <i class="fa fa-3x fa-facebook-official" aria-hidden="true"></i>
              </a>

              <a id="twitter" target="_blank" style="padding-left: 5x; padding-right: 5x;" for="">
                <i class="fa fa-3x fa-twitter-square" aria-hidden="true"></i>
              </a>

              <a id="instagram" target="_blank" style="padding-left: 5x; padding-right: 5x;" for="">
                <i class="fa fa-3x fa-instagram" aria-hidden="true"></i>
              </a>

            </fieldset>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    @extends('layouts.site.footer')
  
</div>
  
    @extends('layouts.site.script')
   
    <script>
      $(document).ready(function() {
        $(".viewJob").click(function() {
          let listing = JSON.parse($(this).attr('id'));
          $("#viewRegularJobModal").modal('show');
          $("#viewRegularJobModal #title").text(listing.title);
          $("#viewRegularJobModal #description").text( listing.details.replace(/<\/?[^>]+(>|$)/g, "").replace("&nbsp;", " ").replace("&#39;", "'") );
          $("#viewRegularJobModal #location").text(listing.location);
          $("#viewRegularJobModal #tags").text(listing.tags);
          $("#viewRegularJobModal #created_at").text(listing.created_at);
          $("#viewRegularJobModal #slots").text(listing.slots);
          $("#viewRegularJobModal #location2").text(listing.location2);
          $("#viewRegularJobModal #salary").text(" Php. "+listing.min_offer+ " - Php. " +listing.max_offer);

          let experience = '';
          if (listing.experience == 1) {
            experience = 'No experience';
          } else if (listing.experience == 2) {
            experience = 'Fresh Graduate';
          } else if (listing.experience == 3) {
            experience = '1 year';
          } else if (listing.experience == 4) {
            experience = '2 to 3 years';
          }else if (listing.experience == 5) {
            experience = '3 to 5 years';
          }else if (listing.experience == 6) {
            experience = '5 to 10 years';
          }else if (listing.experience == 7) {
            experience = '10 years above';
          }

          let status = '';
          if (listing.employment_status == 1) {
            status = 'Part Time'
          } else {
            status = 'Full Time'
          }

          $("#viewRegularJobModal #status").text(status);
          $("#viewRegularJobModal #experience").text(experience);
          $("#viewRegularJobModal #emp_status").text(status);
          $("#viewRegularJobModal #dead_line").text(listing.event_date);
          

          if (!listing.p_image) {
            $("#viewRegularJobModal #imageFe").attr("src","/images/default-job.png");
          } else {
            let src = '/images/'+listing.p_image;
            $("#viewRegularJobModal #imageFe").attr("src",listing.p_image);
          }

          if (!listing.image) {
            $("#viewRegularJobModal #imageBig").attr("src","/images/default-job.png");
          } else {
            let src = '/images/'+listing.image;
            $("#viewRegularJobModal #imageBig").attr("src",listing.image);
          }

        });

        $(".viewCom").click(function() {
          let id = JSON.parse($(this).attr('id'));
          $('#viewCompanyModal').modal('show');
          $("#viewCompanyModal #business_name").text(id.business_name)
          $("#viewCompanyModal #business_type").text(id.business_type)
          $("#viewCompanyModal #email_address").text(id.email_address)
          $("#viewCompanyModal #mailing_address").text(id.mailing_address)
          $("#viewCompanyModal #telephone_number").text(id.telephone_number)
          $("#viewCompanyModal #mobile_number").text(id.mobile_number)
          $("#viewCompanyModal #facebook").attr('href', id.facebook)
          $("#viewCompanyModal #twitter").attr('href', id.twitter)
          $("#viewCompanyModal #instagram").attr('href', id.instagram)
          $("#viewCompanyModal #affiliation").text(id.affiliation)
        });

      });
    </script>

  </body>
</html>