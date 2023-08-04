@extends('front.layout.layout')
@section('title', 'Car List Page')

@section('current_page_css')
@endsection

@section('current_page_js')

@section('content')
<!-- Category-->
<section class="page-section title-banner">
    <div class="container px-4 px-lg-5">
        <div class="row head_rgt">
            <div class="col-lg-12">
                <h2 class="text-white mt-0 mb-0">Browse by <span class="acc-span">Make</span></h2>
            </div>
        </div>         
    </div>
</section>

<!-- Payments Overview-->
        <section class="page-section payments-block">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5">                  
          <div class="col-md-6 info-card">  
                
                <h4>{{ __('messages.payment_method') }}</h4>
                <div class="card">
                  <div class="" id="">
                    <div class="card">
                      <div class="card-header p-0">
                        <h2 class="mb-0">
                          <button class="btn btn-light btn-block text-left p-3 rounded-0" style="width: 100%;">
                            <div class="d-flex align-items-center justify-content-between">

                              <span class="pay01">{{ __('messages.paytext') }}</span>
                              <!-- <div class="icons">
                                <img src="https://i.imgur.com/2ISgYja.png" width="30">
                                <img src="https://i.imgur.com/W1vtnOV.png" width="30">
                                <img src="https://i.imgur.com/35tC99g.png" width="30">
                                <img src="https://i.imgur.com/2ISgYja.png" width="30">
                              </div> -->                            
                            </div>
                          </button>
                        </h2>
                      </div>

                      <div class="">
                        <div class="card-body payment-card-body">
                          <form method="post" action="{{ url('submit_payment') }}">
                            @csrf
                            <input type="hidden" name="email_address" class="form-control" value="<?php echo $get_user_data['email_address'] ?>" />
                            <input type="hidden" name="title" class="form-control" value="<?php echo $get_user_data['title'] ?>" />
                            <input type="hidden" name="first_name" class="form-control" value="<?php echo $get_user_data['first_name'] ?>" />
                            <input type="hidden" name="last_name" class="form-control" value="<?php echo $get_user_data['last_name'] ?>" />
                            <input type="hidden" id="contact_no" name="contact_no" class="form-control" value="<?php echo $get_user_data['contact_no'] ?>" />
                            <input type="hidden" name="country" class="form-control" value="<?php echo $get_user_data['country'] ?>" />
                            <input type="hidden" name="flight_no" class="form-control" value="<?php echo $get_user_data['flight_no'] ?>" />
                            <input type="hidden" name="customer_notes" class="form-control" value="<?php echo $get_user_data['customer_notes'] ?>" />
                            <input type="hidden" name="vehicle_id" class="form-control" value="{{ $car_data->id }}" />
                            <?php
                              $price_data = DB::table('car_price_days')->where('no_of_day','1 Day')->where('car_id',$car_data->id)->first();
                              $date_diff = $get_user_data['date_diff'];
                              $price = $date_diff * $price_data->price;
                            ?>
                            <input type="hidden" name="total_price" class="form-control" value="{{ $price }}" />

                            <div class="d-flex align-items-center justify-content-between">
                              <!-- <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                              <label class="form-check-label" for="flexRadioDefault1">Cash On Delivery</label>
                            </div> -->
                            <div class="pay_btn">
                              <div class="input">
                                <button type="submit" class="btn btn-primary btn-block paynow-btn">{{ __('messages.payment_btn') }}</button>    
                              </div> 
                            </div>
                            </div>
                          
                        </form>
                          <!-- <div class="field_cust">
                          <span class="font-weight-normal card-text">Cardholder's Name</span>
                          <div class="input">
                            <input type="text" class="form-control">    
                          </div> 
              </div>
              <div class="field_cust_numb">
                          <span class="font-weight-normal card-text">Card Number</span>
                          <div class="input">
                            <i class="bi bi-credit-card-2-front"></i>
                            <input type="text" class="form-control" placeholder="0000 0000 0000 0000">    
                          </div> 
              </div>
                          <div class="row mt-3 mb-3">

                            <div class="col-md-6">

                              <span class="font-weight-normal card-text">Expiry Date</span>
                              <div class="input">

                                <i class="bi bi-calendar-x"></i>
                                <input type="text" class="form-control" placeholder="MM/YY">
                                
                              </div> 
                              
                            </div>


                            <div class="col-md-6">

                              <span class="font-weight-normal card-text">CVC/CVV</span>
                              <div class="input">

                                <i class="bi bi-lock-fill"></i>
                                <input type="text" class="form-control" placeholder="000">
                                
                              </div> 
                              
                            </div>
                            

                          </div>

                          <span class="text-muted certificate-text"><i class="bi bi-lock-fill"></i> Your transaction is secured with ssl certificate</span>    

              <div class="pay_btn">
                          <div class="input">
                            <button class="btn btn-primary btn-block paynow-btn">Pay Now</button>    
                          </div> 
              </div> -->
                        </div>
                      </div>
                    </div>                   
                  </div>                  
                </div>
        <!-- <div class="or-sep">
          <h6 class="text-divider">
            <span>Or</span>
          </h6>
        </div> -->
        <!-- <div class="card cod">
                  <div class="" id="">
                    <div class="card">
                      <div class="card-header p-0">
                        <h2 class="mb-0">
                          <form method="post" action="{{ url('submit_payment') }}">
                          <button type="submit" class="btn btn-light btn-block text-left p-3 rounded-0" style="width: 100%;">

                            <div class="d-flex align-items-center justify-content-between">
                <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">Cash On Delivery</label>
                </div>
                            </div>
                          </button>
                        </form>
                        </h2>
                      </div>
                    </div>                   
                  </div>                  
                </div> -->
              </div>
        
        <div class="col-md-6 info-card_prod_info">
        <div class="card mb-4">
            <div class="list-card">
              <div class="summary-top">
                <div class="summary-card-imgs">
                  <img alt="img" class="cover-image" src="{{ url('public/uploads/cars') }}/{{ $car_data->image }}">
                </div>
                <div class="summary-carname">
                  <h4>{{ $car_data->title }}</h4>
                  <p><i class="bi bi-clock"></i> <?php echo $get_user_data['date_diff'] ?> {{ __('messages.rentel_days') }}</p>
                </div>
              </div>
              <div class="card col_01 border-0 mb-0"> 
                <div class="summary-body">
                  <div class="item-card">
                    <div class="item-card-desc mb-2 mt-1">
                      <div class="me-4 d-flex">
                        <div class="icn_desc"><i class="bi bi-geo-alt"></i> </div>
                        <div class="city_name"><h4><?php echo $get_user_data['pickup_location'] ?></h4><span><?php echo $get_user_data['pickup_date'] ?></span></div>
                      </div>
                      <div class="me-4 d-flex">
                        <div class="icn_desc"><i class="bi bi-geo-alt"></i> </div>
                        <div class="city_name"><h4><?php echo $get_user_data['drop_off_location'] ?></h4><span><?php echo $get_user_data['drop_off_date'] ?></span></div>
                      </div>
                    </div>
                    <ul class="summary-feat">
                      {!! __('messages.payment_details') !!}
                    </ul>
                  </div>
                </div>  
              </div>
              <div class="card summary_btm"> 
                <div class="card-body">
                  <div class="item-card-price">
                    <h4>{{ __('messages.total') }}</h4>
                    <p>{{ __('messages.price_detail') }}</p>
                  </div>
                  <div class="summary-tot-price">
                    <?php
                      $price_data = DB::table('car_price_days')->where('no_of_day','1 Day')->where('car_id',$car_data->id)->first();
                      $date_diff = $get_user_data['date_diff'];
                      $price = $date_diff * $price_data->price;
                    ?>
                    <h4>${{ $price }}</h4>
                  </div>
                </div>  
              </div>
            </div>
          </div>
        </div>
        
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