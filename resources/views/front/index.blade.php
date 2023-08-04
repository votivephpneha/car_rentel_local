@extends('front.layout.layout')
@section('title', 'Home')

@section('current_page_css')
@endsection

@section('current_page_js')
<script type="text/javascript">
  $(".search_btn").click(function(){
    var pickup_location = $(".pickup_location").val();
    var drop_off_location = $(".drop_off_location").val();
    var pickup_date = $(".pickup_date").val();
    var drop_off_date = $(".drop_off_date").val();

    if(pickup_location == ""){
      
      $(".pickup_location_error").text("This field is required");
    }else{
      if(drop_off_location == ""){
        
        $(".dropoff_location_error").text("This field is required");
      }else{
        if(pickup_date == ""){
          
          $(".pickup_date_error").text("This field is required");
        }else{
          if(drop_off_date == ""){
            $(".dropoff_date_error").text("This field is required");
          }else{
            window.location.href = "{{ url('car_list') }}";
          }
        }
      }
    }
    
  });
  $(".pickup_location").keyup(function(){
    var address_value = $(".pickup_location").val();

    $.ajax({
      type: "GET",
      url: "{{ url('/get_address') }}",
      data: {address_value:address_value},
      cache: false,
      success: function(data){
        console.log("data",data);
        $(".address_div select").html(data);
      }
    });
  });

  $(".drop_off_location").keyup(function(){
    var address_value = $(".drop_off_location").val();

    $.ajax({
      type: "GET",
      url: "{{ url('/get_dropoff_address') }}",
      data: {address_value:address_value},
      cache: false,
      success: function(data){
        console.log("data",data);
        $(".address_div_dropoff").html(data);
      }
    });
  });

  function getAddress(address_id){
    var address_value1 = $(".address-"+address_id).text();

    $(".pickup_location").val(address_value);
  }

  function getDropoffAddress(address_id){
    var address_value2 = $(".address-"+address_id).text();

    $(".drop_off_location").val(address_value);
  }
  
</script>
@endsection

@section('content')
<!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100 filter">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 d-block mx-auto">
<div class="item-search-tabs">
    <div class="item-search-menu">
        <ul class="nav" role="tablist">
        <li class=""> <a class="active" data-bs-toggle="tab" href="#tab1" aria-selected="true" role="tab">CAR</a> </li>
        </ul>
        </div>

        <div class="tab-content index-search-select"> 
			<div class="tab-pane active show" id="tab1" role="tabpanel"> 
				<div class="search-background"> 
          <form method="post" action="{{ url('car_list') }}">
            @csrf
  					<div class="form row no-gutters"> 
  						<div class="form-group col-xl-2 col-lg-2 col-md-12 mb-0 location"> 
  							<div class="form-group mb-0"> 
  								<label>{{ __('messages.pickup_location') }}</label>
  								<input class="form-control border pickup_location" name="pickup_location" placeholder="Choose Location" type="text" required="">
                  <div class="address_div">
                    
                  </div>
                  <div class="pickup_location_error search_box_error"></div> 
  							</div> 
  						</div> 
  						<div class="form-group col-xl-2 col-lg-2 col-md-12 mb-0 location">
  							<div class="form-group mb-0"> 
  								<label>{{ __('messages.dropoff_location') }}</label>
  								<input class="form-control border drop_off_location" name="drop_off_location" placeholder="Choose Location" type="text" required="">
                  <div class="address_div_dropoff">
                    
                  </div>  
                  <div class="dropoff_location_error search_box_error">
                        
                  </div> 
  							</div> 
  						</div>
  						<div class="form-group col-xl-2 col-lg-2 col-md-12 mb-0 location">
  							<div class="form-group mb-0"> 
  								<label>{{ __('messages.pickup_date') }}</label>
  								<input class="form-control border pickup_date" name="pickup_date" placeholder="Choose Pickup Date" type="text" id="pickup_date" required="" autocomplete="off"><div class="pickup_date_error search_box_error"></div> 
  							</div>
  						</div>
              <!-- <div class="form-group col-xl-2 col-lg-2 col-md-12 mb-0 location">
                <div class="form-group mb-0"> 
                  <label>Pickup Time</label>
                  <input class="form-control border pickup_time" name="pickup_time" placeholder="Choose Pickup Time" type="text" id="pickup_time" required="" autocomplete="off"><div class="pickup_time_error search_box_error"></div> 
                </div>
              </div> -->
  						<div class="form-group col-xl-2 col-lg-2 col-md-12 mb-0 location">
  							<div class="form-group mb-0"> 
  								<label>{{ __('messages.dropoff_date') }}</label>
  								<input class="form-control border drop_off_date" name="drop_off_date" placeholder="Choose Drop Off Date" type="text" id="drop_off_date" required="" autocomplete="off"><div class="dropoff_date_error search_box_error"></div> 
  							</div>
  						</div>
              <!-- <div class="form-group col-xl-2 col-lg-2 col-md-12 mb-0 location">
                <div class="form-group mb-0"> 
                  <label>Drop Off Time</label>
                  <input class="form-control border drop_off_time" name="drop_off_time" placeholder="Choose Drop Off Time" type="text" id="drop_off_time" required="" autocomplete="off"><div class="dropoff_date_error search_box_error"></div> 
                </div>
              </div> -->
  						
  						<div class="form-group col-xl-2 col-lg-2 col-md-12 mb-0 btn--book"> 
                <button type="submit" name="search_btn" class="search_btn">{{ __('messages.book_btn') }}<i class="bi bi-arrow-right"></i></button>
  							<!-- <a class="btn btn-block btn-orange search_btn fs-14" href="javascript:void(0);"> BOOK <i class="bi bi-arrow-right"></i></a> --> 
  						</div> 
  					</div> 
          </form>
				</div> 
			</div>      
		</div>
	<!--<div class="header-txt-sml">
		<p>We collaborate with over 800 rental companies to guarantee the best prices on the market and
		at the same time defend the rights of those who rent a car
		</p>
	</div>-->
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
                        <h2 class="text-white mt-0">{{ __('messages.brand_section_heading') }}</h2>      
                    </div>
        </div>
        <div class="row">
          <div class="owl-carousel category_slides owl-theme">
            @foreach($brands as $brand)
            @if($brand->status == 1)
            <div class="item">
        <div class="thumbnail-item">
          <a href="#"><img src="{{ url('public/uploads/logos') }}/{{ $brand->image }}"></a>
        </div>
            </div>
            @endif
            @endforeach
            
          </div>
        </div>
        <div class="row icon_box">
      <div class="col-lg-4 col-sm-6 icon-left">
        <div class="feat_icon">
          <div class="img-feat">
            <img src="{{ url('/public/uploads/landing') }}/{{ $landing->image_one }}">
          </div>
          <div class="desc--feat">
            <h4>{{ __('messages.brand_heading_one') }}</h4>
            <p>{{ __('messages.brand_content_one') }}</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 icon-left">
        <div class="feat_icon">
          <div class="img-feat">
            <img src="{{ url('/public/uploads/landing') }}/{{ $landing->image_two }}">
          </div>
          <div class="desc--feat">
            <h4>{{ __('messages.brand_heading_two') }}</h4>
            <p>{{ __('messages.brand_content_two') }}</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 icon-left">
        <div class="feat_icon">
          <div class="img-feat">
            <img src="{{ url('/public/uploads/landing') }}/{{ $landing->image_three }}">
          </div>
          <div class="desc--feat">
            <h4>{{ __('messages.brand_heading_three') }}</h4>
            <p>{{ __('messages.brand_content_three') }}</p>
          </div>
        </div>
      </div>
    </div>
        
            </div>
        </section>
        <!-- Listing-->
        <section class="page-section grid-lists" id="list-grid">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center mt-0">{!! __('messages.best_deal_heading') !!}</h2>
        <p class="text-center sub-txt">{{ __('messages.best_deal_content') }}</p>
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
                  <div class="list-subheading">64 <i class="fa fa-eur"></i> <span>/ {{ __('messages.Day') }}</span></div>
                </div>
              </div>
              <div class="row features_list">
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="feat-set">4 {{ __('messages.Seater') }}</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-gear"></i>
                  </div>
                  <div class="feat-set">{{ __('messages.Manual') }}</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-speedometer2"></i>
                  </div>
                  <div class="feat-set">{{ __('messages.KM') }}</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-three-dots"></i>
                  </div>
                  <div class="feat-set">{{ __('messages.More') }}</div>
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
                  <div class="list-subheading">64 <i class="fa fa-eur"></i> <span>/ {{ __('messages.Day') }}</span></div>
                </div>
              </div>
              <div class="row features_list">
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="feat-set">4 {{ __('messages.Seater') }}</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-gear"></i>
                  </div>
                  <div class="feat-set">{{ __('messages.Manual') }}</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-speedometer2"></i>
                  </div>
                  <div class="feat-set">{{ __('messages.KM') }}</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-three-dots"></i>
                  </div>
                  <div class="feat-set">{{ __('messages.More') }}</div>
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
                  <div class="list-subheading">64 <i class="fa fa-eur"></i> <span>/ {{ __('messages.Day') }}</span></div>
                </div>
              </div>
              <div class="row features_list">
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="feat-set">4 {{ __('messages.Seater') }}</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-gear"></i>
                  </div>
                  <div class="feat-set">{{ __('messages.Manual') }}</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-speedometer2"></i>
                  </div>
                  <div class="feat-set">{{ __('messages.KM') }}</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-three-dots"></i>
                  </div>
                  <div class="feat-set">{{ __('messages.More') }}</div>
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
                  <div class="list-subheading">64 <i class="fa fa-eur"></i> <span>/ {{ __('messages.Day') }}</span></div>
                </div>
              </div>
              <div class="row features_list">
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="feat-set">4 {{ __('messages.Seater') }}</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-gear"></i>
                  </div>
                  <div class="feat-set">{{ __('messages.Manual') }}</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-speedometer2"></i>
                  </div>
                  <div class="feat-set">{{ __('messages.KM') }}</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-three-dots"></i>
                  </div>
                  <div class="feat-set">{{ __('messages.More') }}</div>
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
                  <div class="list-subheading">64 <i class="fa fa-eur"></i> <span>/ {{ __('messages.Day') }}</span></div>
                </div>
              </div>
              <div class="row features_list">
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="feat-set">4 {{ __('messages.Seater') }}</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-gear"></i>
                  </div>
                  <div class="feat-set">{{ __('messages.Manual') }}</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-speedometer2"></i>
                  </div>
                  <div class="feat-set">{{ __('messages.KM') }}</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-three-dots"></i>
                  </div>
                  <div class="feat-set">{{ __('messages.More') }}</div>
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
                  <div class="list-subheading">64<i class="fa fa-eur"></i> <span>/ {{ __('messages.Day') }}</span></div>
                </div>
              </div>
              <div class="row features_list">
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="feat-set">4 {{ __('messages.Seater') }}</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-gear"></i>
                  </div>
                  <div class="feat-set">{{ __('messages.Manual') }}</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-speedometer2"></i>
                  </div>
                  <div class="feat-set">{{ __('messages.KM') }}</div>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <div class="icon-set">
                    <i class="bi bi-three-dots"></i>
                  </div>
                  <div class="feat-set">{{ __('messages.More') }}</div>
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
                <h2 class="text-center mt-0">{!! __('messages.choose_us_heading') !!}</span></h2> 
                <div class="row gx-4 gx-lg-5 row-wcu">
                    <div class="col-lg-7 col-sm-7 mb-4">
                        <img src="{{ url('public/assets/img/choose-us-img.png') }}">
                    </div>       
          <div class="col-lg-5 col-sm-5 mb-4">
                        {!! __('messages.choose_us_content') !!}
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
            <div class="overlay">{{ __('messages.location_one') }}</div>
                    </div>       
          <div class="col-xs-12 col-md-6 img-box-loc">
                        <img src="{{ url('public/assets/img/Firenze.png') }}">
            <div class="overlay">{{ __('messages.location_two') }}</div>
                    </div>
          <div class="col-xs-12 col-md-6 img-box-loc">
                        <img src="{{ url('public/assets/img/torino.png') }}">
            <div class="overlay">{{ __('messages.location_three') }}</div>
                    </div>       
          <div class="col-xs-12 col-md-6 img-box-loc">
                        <img src="{{ url('public/assets/img/tirana.png') }}">
            <div class="overlay">{{ __('messages.location_four') }}</div>
                    </div>          
                </div>
            </div>
        </section>
    
    <!-- Our Team-->
        <section class="page-section team-block" id="team">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center mt-0">{!! __('messages.meet_team') !!}</h2> 
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
                <h2 class="mb-4">{{ __('messages.work_heading') }}</h2>
        <p>{{ __('messages.work_content') }}</p>
                <a class="btn btn-light btn-xl cta-btn" href="#">{{ __('messages.contact') }} <i class="bi bi-arrow-right"></i></a>
            </div>
        </section>
        @endsection