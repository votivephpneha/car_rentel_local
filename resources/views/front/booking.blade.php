@extends('front.layout.layout')
@section('title', 'Home')

@section('current_page_css')
<style type="text/css">
	.error{
		color:red;
	}
</style>
@endsection

@section('current_page_js')
@endsection

@section('content')
<!-- Form Overview-->
		<section class="page-section title-banner">
            <div class="container px-4 px-lg-5">
                <div class="row head_rgt">
                    <div class="col-lg-12">
                        <h2 class="text-white mt-0 mb-0"></h2>
                    </div>
                </div>         
            </div>
 		</section>
        <section class="page-section book-form">
            <div class="container">
                <div class="row info-det gx-4 gx-lg-5"> 
					<div class="row">
					<h4>{{ __('messages.driver_heading') }}</h4>
					<p>{{ __('messages.driver_sub_heading') }}</p>
					</div>
					<div class="row alt_box_form">
					<div class="col-lg-6 col-sm-6 form_col mx-auto">
						<form method="post" action="{{ url('submit_booking') }}" name="bookingForm">
						@csrf	
						<div class="booking-form">
							<div class="form-outline mb-3">
								<label class="form-label">{{ __('messages.driver_email') }}</label>
								<input type="hidden" name="car_id" value="{{ $car_id }}"/>
								<input type="email" name="email_address" class="form-control" />
								<span>So we can send the confirmation email and voucher</span>
							</div>
						<div class="form-outline mb-3">
							<label class="form-label">{{ __('messages.driver_title') }}</label>
								<select class="select" name="title">
								<option value="">Select your option</option>
									<option value="1">{{ __('messages.driver_title_one') }}</option>
									<option value="2">{{ __('messages.driver_title_two') }}</option>
								</select>
						</div>
						<div class="form-outline mb-3">
							<label class="form-label">{{ __('messages.driver_fname') }}</label>
							<input type="text" class="form-control" name="first_name">
						</div>
						<div class="form-outline mb-3">
							<label class="form-label">{{ __('messages.driver_lname') }}</label>
							<input type="text" class="form-control" name="last_name">
						</div>
						<div class="form-outline mb-3">
							<label class="form-label">{{ __('messages.driver_contact') }}</label>							
							<input id="phone" name="phone" type="tel" placeholder="Phone Number" class="form-control" maxlength="10" />
							<span>So we can call if any problems come up</span>
						</div>
						<div class="form-outline mb-3">
							<label class="form-label">{{ __('messages.driver_country') }}</label>		
							
							<select id='country_select' name='country'> 
								<option>{{ __('messages.driver_select_option') }}</option>
								<?php
									foreach ($countries_list as $country) {
										?>
										<option value="<?php echo $country->name; ?>"><?php echo $country->name; ?></option>
										<?php
										
									}
								?>
								
							</select>
						</div>

						<div class="form-outline mb-3">
							<label class="form-label">{{ __('messages.driver_flight') }}</label>							
							<input type="number" class="form-control" name="flight_no">
							<span>Just in case the flight is delayed</span>
						</div>
						<div class="form-outline mb-3">
							<label class="form-label">{{ __('messages.driver_notes') }}</label>					
							<textarea class="form-control" name="customer_notes"></textarea>
							
						</div>
						<div class="form-outline btn-submit">
						<button type="submit" class="btn btn-primary">{{ __('messages.driver_submit_btn') }}</button>
						</div>
                </div>
                </form>	
				</div>
				
				<div class="col-lg-6 col-sm-6 rgt_col_form">
					<div class="drive_details_cont">
						{!! __('messages.driver_image_text') !!}
						
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