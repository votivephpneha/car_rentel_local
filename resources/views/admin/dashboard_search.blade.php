

          <div class="col-lg-4 col-6">

            <!-- small box -->

            <div class="small-box bg-warning">
              <?php
                  
                  $business_data = DB::table("users")->whereBetween('created_at',[$from_date.'%', $to_date.'%'])->where("user_type","business_user")->get();

              ?>
              <div class="inner">

                <h3>{{count($business_data)}}</h3>



                <p>Business List(Total)</p>

              </div>

              <div class="icon">

                <i class="ion ion-person-add"></i>

              </div>

              <a href="{{ url('/admin/business_management') }}/{{ $from_date }}/{{ $to_date }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

            </div>

          </div>

          <!-- ./col -->
          <div class="col-lg-4 col-6">

            <!-- small box -->

            <div class="small-box bg-warning">

              <div class="inner">
                <?php
                  $business_data_active = DB::table("users")->whereBetween('created_at',[$from_date.'%', $to_date.'%'])->where("status","1")->where("user_type","business_user")->get();

              ?>

                <h3>{{count($business_data_active)}}</h3>



                <p>Business List(Active)</p>

              </div>

              <div class="icon">

                <i class="ion ion-person-add"></i>

              </div>

              <a href="{{ url('/admin/business_management/Active') }}/{{ $from_date }}/{{ $to_date }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

            </div>

          </div>

          <!-- ./col -->
          <!-- ./col -->
          <div class="col-lg-4 col-6">

            <!-- small box -->

            <div class="small-box bg-warning">

              <div class="inner">
                <?php
                  $business_data_inactive = DB::table("users")->whereBetween('created_at',[$from_date.'%', $to_date.'%'])->where("status","0")->where("user_type","business_user")->get();

              ?>

                <h3>{{count($business_data_inactive)}}</h3>



                <p>Business List(Inactive)</p>

              </div>

              <div class="icon">

                <i class="ion ion-person-add"></i>

              </div>

              <a href="{{ url('/admin/business_management/Inactive') }}/{{ $from_date }}/{{ $to_date }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

            </div>

          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">

            <!-- small box -->

            <div class="small-box bg-warning">

              <div class="inner">
                <?php
                  $booking_data = DB::table("booking_management")->whereBetween('created_at',[$from_date.'%', $to_date.'%'])->get();

              ?>

                <h3>{{count($booking_data)}}</h3>



                <p>Booking(Total)</p>

              </div>

              <div class="icon">

                <i class="ion ion-person-add"></i>

              </div>

              <a href="{{ url('/admin/booking_management') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

            </div>

          </div>
          <div class="col-lg-4 col-6">

            <!-- small box -->

            <div class="small-box bg-warning">

              <div class="inner">
                <?php
                  $booking_data_accepted = DB::table("booking_management")->whereBetween('created_at',[$from_date.'%', $to_date.'%'])->where("booking_status","3")->get();

                ?>

                <h3>{{count($booking_data_accepted)}}</h3>



                <p>Booking(Accepted)</p>

              </div>

              <div class="icon">

                <i class="ion ion-person-add"></i>

              </div>

              <a href="{{ url('/admin/booking_management/Accepted') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

            </div>

          </div>
          <div class="col-lg-4 col-6">

            <!-- small box -->

            <div class="small-box bg-warning">

              <div class="inner">
                <?php
                  $booking_data_rejected = DB::table("booking_management")->whereBetween('created_at',[$from_date.'%', $to_date.'%'])->where("booking_status","4")->get();

                ?>

                <h3>{{count($booking_data_rejected)}}</h3>



                <p>Booking(Rejected)</p>

              </div>

              <div class="icon">

                <i class="ion ion-person-add"></i>

              </div>

              <a href="{{ url('/admin/payment_transaction') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

            </div>

          </div>
          <div class="col-lg-4 col-6">

            <!-- small box -->

            <div class="small-box bg-warning">

              <div class="inner">
                <?php
                  $payment_transaction_data = DB::table("payment_transaction")->whereBetween('created_at',[$from_date.'%', $to_date.'%'])->get();

                ?>

                <h3>{{count($payment_transaction_data)}}</h3>



                <p>Payment Transaction(Total)</p>

              </div>

              <div class="icon">

                <i class="ion ion-person-add"></i>

              </div>

              <a href="{{ url('/admin/payment_transaction') }}/{{ $from_date }}/{{ $to_date }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

            </div>

          </div>
          <div class="col-lg-4 col-6">

            <!-- small box -->

            <div class="small-box bg-warning">

              <div class="inner">
                <?php
                  $payment_transaction_completed = DB::table("payment_transaction")->whereBetween('created_at',[$from_date.'%', $to_date.'%'])->where("payment_status","1")->get();

                ?>

                <h3>{{count($payment_transaction_completed)}}</h3>



                <p>Payment Transaction(Completed)</p>

              </div>

              <div class="icon">

                <i class="ion ion-person-add"></i>

              </div>

              <a href="{{ url('/admin/payment_transaction/Completed') }}/{{ $from_date }}/{{ $to_date }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

            </div>

          </div>
          <div class="col-lg-4 col-6">

            <!-- small box -->

            <div class="small-box bg-warning">

              <div class="inner">
                <?php
                  $payment_transaction_pending = DB::table("payment_transaction")->whereBetween('created_at',[$from_date.'%', $to_date.'%'])->where("payment_status","0")->get();

                ?>

                <h3>{{count($payment_transaction_pending)}}</h3>



                <p>Payment Transaction(Pending)</p>

              </div>

              <div class="icon">

                <i class="ion ion-person-add"></i>

              </div>

              <a href="{{ url('/admin/payment_transaction/Pending') }}/{{ $from_date }}/{{ $to_date }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

            </div>

          </div>
