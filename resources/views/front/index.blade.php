@extends('Front.layout.layout')
@section('title', 'Home')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
<!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100 d-flex filter">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 d-block mx-auto">
<div class="item-search-tabs">
    <div class="item-search-menu">
        <ul class="nav" role="tablist">
        <li class=""> <a class="active" data-bs-toggle="tab" href="#tab1" aria-selected="true" role="tab">AUTO</a> </li>
<li> <a data-bs-toggle="tab" href="#tab2" aria-selected="false" role="tab" class="" tabindex="-1">VANS</a> </li>
        </ul>
        </div>

        <div class="tab-content index-search-select"> <div class="tab-pane active show" id="tab1" role="tabpanel"> <div class="search-background"> <div class="form row no-gutters"> <div class="form-group col-xl-2 col-lg-2 col-md-12 mb-0 location"> <div class="form-group mb-0"> 
    <label>Pickup Location</label>
    <input class="form-control border" placeholder="Choose Location" type="text"> <span><i class="fa fa-crosshairs  location-gps me-1"></i></span> </div> </div>    <div class="form-group col-xl-2 col-lg-2 col-md-12 mb-0 location"> <div class="form-group mb-0"> 
    <label>Drop Off Location</label>
    <input class="form-control border" placeholder="Choose Location" type="text"> <span><i class="fa fa-crosshairs  location-gps me-1"></i></span> </div> </div><div class="form-group col-xl-2 col-lg-2 col-md-12 mb-0 location"> <div class="form-group mb-0"> 
    <label>Pickup Date</label>
    <input class="form-control border" placeholder="Choose Location" type="text" id="pickup_date"> <span><i class="fa fa-crosshairs  location-gps me-1"></i></span> </div> </div><div class="form-group col-xl-2 col-lg-2 col-md-12 mb-0 location"> <div class="form-group mb-0"> 
    <label>Drop Off Date</label>
    <input class="form-control border" placeholder="Choose Location" type="text" id="drop_off_date"> <span><i class="fa fa-crosshairs  location-gps me-1"></i></span> </div> </div><div class="form-group col-xl-2 col-lg-2 col-md-12 mb-0 location"> <div class="form-group mb-0"> 
    <label>Category</label>
    <input class="form-control border" placeholder="Choose Location" type="text"> <span><i class="fa fa-crosshairs  location-gps me-1"></i></span> </div> </div><div class="form-group col-xl-2 col-lg-2 col-md-12 mb-0"> <a class="btn btn-block btn-orange search_btn fs-14" href="javascript:void(0);"> Search <i class="bi bi-arrow-right"></i></a> </div> </div> </div> </div> <div class="tab-pane" id="tab2" role="tabpanel"> <div class="search-background"> <div class="form row no-gutters"> <div class="form-group col-xl-2 col-lg-2 col-md-12 mb-0 location"> <div class="form-group mb-0"> 
    <label>Pickup Location</label>
    <input class="form-control border" placeholder="Choose Location" type="text"> <span><i class="fa fa-crosshairs  location-gps me-1"></i></span> </div> </div>    <div class="form-group col-xl-2 col-lg-2 col-md-12 mb-0 location"> <div class="form-group mb-0"> 
    <label>Drop Off Location</label>
    <input class="form-control border" placeholder="Choose Location" type="text"> <span><i class="fa fa-crosshairs  location-gps me-1"></i></span> </div> </div><div class="form-group col-xl-2 col-lg-2 col-md-12 mb-0 location"> <div class="form-group mb-0"> 
    <label>Pickup Date</label>
    <input class="form-control border" placeholder="Choose Location" type="text"> <span><i class="fa fa-crosshairs  location-gps me-1"></i></span> </div> </div><div class="form-group col-xl-2 col-lg-2 col-md-12 mb-0 location"> <div class="form-group mb-0"> 
    <label>Drop Off Date</label>
    <input class="form-control border" placeholder="Choose Location" type="text"> <span><i class="fa fa-crosshairs  location-gps me-1"></i></span> </div> </div><div class="form-group col-xl-2 col-lg-2 col-md-12 mb-0 location"> <div class="form-group mb-0"> 
    <label>Category</label>
    <input class="form-control border" placeholder="Choose Location" type="text"> <span><i class="fa fa-crosshairs  location-gps me-1"></i></span> </div> </div><div class="form-group col-xl-2 col-lg-2 col-md-12 mb-0"> <a class="btn btn-block btn-orange search_btn fs-14" href="javascript:void(0);"> Search <i class="bi bi-arrow-right"></i></a> </div> </div> </div> </div>     </div>
  <div class="header-txt-sml">
<p>We collaborate with over 800 rental companies to guarantee the best prices on the market and
 at the same time defend the rights of those who rent a car
</p>
</div>
</div>



</div>
                    
                </div>
            </div>
        </header>
        <!-- Category-->
        <section class="page-section category-block" id="category">
            <div class="container px-4 px-lg-5">
                <div class="row head_rgt">
                    <div class="col-lg-12">
                        <h2 class="text-white mt-0">Browse by <span class="acc-span">Make</span></h2>      
                    </div>
        </div>
        <div class="row">
          <div class="owl-carousel owl-theme">
            <div class="item">
        <div class="thumbnail-item">
          <a href="#"><img src="{{ url('public/assets/img/cat1.png') }}"></a>
        </div>
        <div class="thumbnail-desc">
          <h4>Coupe</h4>
        </div>
            </div>
            <div class="item">
        <div class="thumbnail-item">
          <a href="#"><img src="{{ url('public/assets/img/cat2.png') }}"></a>
        </div>
        <div class="thumbnail-desc">
          <h4>Sedan</h4>
        </div>
            </div>
            <div class="item">
        <div class="thumbnail-item">
          <a href="#"><img src="{{ url('public/assets/img/cat3.png') }}"></a>
        </div>
        <div class="thumbnail-desc">
          <h4>SUV</h4>
        </div>
            </div>
            <div class="item">
        <div class="thumbnail-item">
          <a href="#"><img src="{{ url('public/assets/img/cat4.png') }}"></a>
        </div>
        <div class="thumbnail-desc">
          <h4>Luxury Cars</h4>
        </div>
            </div>
            <div class="item">
        <div class="thumbnail-item">
          <a href="#"><img src="{{ url('public/assets/img/cat1.png') }}"></a>
        </div>
        <div class="thumbnail-desc">
          <h4>Coupe</h4>
        </div>
            </div>
            <div class="item">
        <div class="thumbnail-item">
          <a href="#"><img src="{{ url('public/assets/img/cat2.png') }}"></a>
        </div>
        <div class="thumbnail-desc">
          <h4>Sedan</h4>
        </div>
            </div>
            <div class="item">
        <div class="thumbnail-item">
          <a href="#"><img src="{{ url('public/assets/img/cat3.png') }}"></a>
        </div>
        <div class="thumbnail-desc">
          <h4>SUV</h4>
        </div>
            </div>
            <div class="item">
        <div class="thumbnail-item">
          <a href="#"><img src="{{ url('public/assets/img/cat4.png') }}"></a>
        </div>
        <div class="thumbnail-desc">
          <h4>Luxury Cars</h4>
        </div>
            </div>
          </div>
        </div>
        
        
            </div>
        </section>
        <!-- Listing-->
        <section class="page-section grid-lists" id="list-grid">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center mt-0">Find the <span class="acc-span">Best Deals</span> For You</h2>
        <p class="text-center sub-txt">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <div class="row gx-4 gx-lg-5 grid-inner-list">
                    <div class="col-lg-4 col-sm-6 mb-4 single_list">
                        <div class="list-item">
                            <a class="list-link">
                                <img class="img-fluid" src="{{ url('public/assets/img/car1.png') }}" alt="...">
                            </a>
                            <div class="list-caption">
              <div class="row">
                <div class="col-lg-6 col-sm-6">
                  <div class="list-caption-heading">BMW 3 Series</div>
                </div>
                <div class="col-lg-6 col-sm-6">                            
                  <div class="list-subheading">$64 <span>Per Day</span></div>
                </div>
              </div>
              <div class="row features_list">
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="feat-set">4 Seater</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-gear"></i>
                  </div>
                  <div class="feat-set">Manual</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-speedometer2"></i>
                  </div>
                  <div class="feat-set">Unlimited KM</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-three-dots"></i>
                  </div>
                  <div class="feat-set">More</div>
                </div>
              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 single_list">
                        <div class="list-item">
                            <a class="list-link">
                                <img class="img-fluid" src="{{ url('public/assets/img/car2.png') }}" alt="...">
                            </a>
                            <div class="list-caption">
              <div class="row">
                <div class="col-lg-6 col-sm-6">
                  <div class="list-caption-heading">BMW 3 Series</div>
                </div>
                <div class="col-lg-6 col-sm-6">                            
                  <div class="list-subheading">$64 <span>Per Day</span></div>
                </div>
              </div>
              <div class="row features_list">
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="feat-set">4 Seater</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-gear"></i>
                  </div>
                  <div class="feat-set">Manual</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-speedometer2"></i>
                  </div>
                  <div class="feat-set">Unlimited KM</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-three-dots"></i>
                  </div>
                  <div class="feat-set">More</div>
                </div>
              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 single_list">
                        <div class="list-item">
                            <a class="list-link">
                                <img class="img-fluid" src="{{ url('public/assets/img/car3.png') }}" alt="...">
                            </a>
                            <div class="list-caption">
              <div class="row">
                <div class="col-lg-6 col-sm-6">
                  <div class="list-caption-heading">BMW 3 Series</div>
                </div>
                <div class="col-lg-6 col-sm-6">                            
                  <div class="list-subheading">$64 <span>Per Day</span></div>
                </div>
              </div>
              <div class="row features_list">
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="feat-set">4 Seater</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-gear"></i>
                  </div>
                  <div class="feat-set">Manual</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-speedometer2"></i>
                  </div>
                  <div class="feat-set">Unlimited KM</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-three-dots"></i>
                  </div>
                  <div class="feat-set">More</div>
                </div>
              </div>
                            </div>
                        </div>
                    </div>
          <div class="col-lg-4 col-sm-6 mb-4 single_list">
                        <div class="list-item">
                            <a class="list-link">
                                <img class="img-fluid" src="{{ url('public/assets/img/car4.png') }}" alt="...">
                            </a>
                            <div class="list-caption">
              <div class="row">
                <div class="col-lg-6 col-sm-6">
                  <div class="list-caption-heading">BMW 3 Series</div>
                </div>
                <div class="col-lg-6 col-sm-6">                            
                  <div class="list-subheading">$64 <span>Per Day</span></div>
                </div>
              </div>
              <div class="row features_list">
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="feat-set">4 Seater</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-gear"></i>
                  </div>
                  <div class="feat-set">Manual</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-speedometer2"></i>
                  </div>
                  <div class="feat-set">Unlimited KM</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-three-dots"></i>
                  </div>
                  <div class="feat-set">More</div>
                </div>
              </div>
                            </div>
                        </div>
                    </div>
          <div class="col-lg-4 col-sm-6 mb-4 single_list">
                        <div class="list-item">
                            <a class="list-link">
                                <img class="img-fluid" src="{{ url('public/assets/img/car5.png') }}" alt="...">
                            </a>
                            <div class="list-caption">
              <div class="row">
                <div class="col-lg-6 col-sm-6">
                  <div class="list-caption-heading">BMW 3 Series</div>
                </div>
                <div class="col-lg-6 col-sm-6">                            
                  <div class="list-subheading">$64 <span>Per Day</span></div>
                </div>
              </div>
              <div class="row features_list">
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="feat-set">4 Seater</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-gear"></i>
                  </div>
                  <div class="feat-set">Manual</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-speedometer2"></i>
                  </div>
                  <div class="feat-set">Unlimited KM</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-three-dots"></i>
                  </div>
                  <div class="feat-set">More</div>
                </div>
              </div>
                            </div>
                        </div>
                    </div>
          <div class="col-lg-4 col-sm-6 mb-4 single_list">
                        <div class="list-item">
                            <a class="list-link">
                                <img class="img-fluid" src="{{ url('public/assets/img/car6.png') }}" alt="...">
                            </a>
                            <div class="list-caption">
              <div class="row">
                <div class="col-lg-6 col-sm-6">
                  <div class="list-caption-heading">BMW 3 Series</div>
                </div>
                <div class="col-lg-6 col-sm-6">                            
                  <div class="list-subheading">$64 <span>Per Day</span></div>
                </div>
              </div>
              <div class="row features_list">
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="feat-set">4 Seater</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-gear"></i>
                  </div>
                  <div class="feat-set">Manual</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-speedometer2"></i>
                  </div>
                  <div class="feat-set">Unlimited KM</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-three-dots"></i>
                  </div>
                  <div class="feat-set">More</div>
                </div>
              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
    <!-- Why Choose Us-->
        <section class="page-section wcu-block" id="wcu">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center mt-0">Why <span class="acc-span">Choose Us</span></h2> 
                <div class="row gx-4 gx-lg-5 row-wcu">
                    <div class="col-lg-7 col-sm-7 mb-4">
                        <img src="{{ url('public/assets/img/video.png') }}">
                    </div>       
          <div class="col-lg-5 col-sm-5 mb-4">
                        <h4>We make sure that your every trip is comfortable</h4>
            <p>Proin gravida nibh around velit auctor aliquet . Aenean solicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. This is an audio site with a nibh vulputate cursus.</p>
            <div class="d-flex">
              <div class="iconleft">
                <i class="bi bi-gear"></i>
              </div>
              <div class="cont-rgt">
                <p class="fas fa-chess-rook">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
              </div>
            </div>
            <div class="d-flex">
              <div class="iconleft">
                <i class="bi bi-gear"></i>
              </div>
              <div class="cont-rgt">
                <p class="fas fa-chess-rook">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
              </div>
            </div>
                    </div> 
          
                </div>
            </div>
        </section>
    
    <!-- Locations-->
        <section class="location-block" id="map">
            <div class="container-fluid">
                <div class="row g-3">
                    <div class="col-xs-12 col-md-6 img-box-loc">
                        <img src="{{ url('public/assets/img/milano.png') }}">
            <div class="overlay">Milano</div>
                    </div>       
          <div class="col-xs-12 col-md-6 img-box-loc">
                        <img src="{{ url('public/assets/img/firenze.png') }}">
            <div class="overlay">Firenze</div>
                    </div>
          <div class="col-xs-12 col-md-6 img-box-loc">
                        <img src="{{ url('public/assets/img/torino.png') }}">
            <div class="overlay">Torino</div>
                    </div>       
          <div class="col-xs-12 col-md-6 img-box-loc">
                        <img src="{{ url('public/assets/img/tirana.png') }}">
            <div class="overlay">Tirana</div>
                    </div>          
                </div>
            </div>
        </section>
    
    <!-- Our Team-->
        <section class="page-section team-block" id="team">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center mt-0">Meet <span class="acc-span">The Team</span></h2> 
                <div class="row gx-4 gx-lg-5 row-team">
                   <?php $i=1; foreach ($ourteams as $key => $value) { ?>
                    <div class="col-lg-3 col-sm-3 mb-4">
                        <img src="{{ asset('public/uploads/team')}}/{{$value->page_content}}">
            <div class="team-desc">
              <h4>{{$value->page_title}}</h4>
              <p>{{$value->sub_title}}</p>
            </div>
                    </div>       
                    <?php $i++; } ?>
             
                </div>
            </div>
        </section>
        
        <!-- Call to action-->
        <section class="page-section cta">
            <div class="container px-4 px-lg-5 text-center">
                <h2 class="mb-4">Do You Have Something To Sell?</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <a class="btn btn-light btn-xl cta-btn" href="#">Contact Us <i class="bi bi-arrow-right"></i></a>
            </div>
        </section>
        @endsection