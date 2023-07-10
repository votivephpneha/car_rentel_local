@extends('admin.layout.layout')



@section('title', 'View Booking')



@section('current_page_css')

@endsection



@section('current_page_js')

@endsection



@section('content')



  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>View Booking</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>

              <li class="breadcrumb-item active">View Booking</li>

            </ol>

          </div>

        </div>

      </div><!-- /.container-fluid -->

    </section>



    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">

        

        <!-- SELECT2 EXAMPLE -->

        <div class="card card-default">




          <!-- /.card-header -->

          <div class="card-body">

            <div class="row">
              <div class="col-md-12">
                @if(Session::has('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ Session::get('success')}}</strong>
                </div>
                @endif
                <form action="{{ url('admin/change_booking_status') }}" method="post">
                  @csrf
                  <div class="row">
                    <div class="col-md-10">
                      <div class="form-group">
                        <input type="hidden" name="booking_id" value="{{ $booking_details->id }}">
                        <select name="booking_status" class="form-control">
                          <option>Change Status</option>
                          <option value="1">Pending</option>
                          <option value="2">Approved</option>
                          <option value="3">Completed</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <input type="submit" name="btn" value="submit" class="btn btn-primary">
                    </div>
                  </div>
                  
                  
                </form>
                
              </div>
              <div class="col-md-6">
                <div class="customer_content">
                  <h5>Booking Details</h5>
                  <table class="table table-bordered caption-top">
                    
                    <thead>
                      <tr>
                        <th>Booking ID</th>
                        <td>{{ $booking_details->booking_id }}</td>
                      </tr>
                      <tr>
                        <th>Booking Date</th>
                        <?php
                          $date=date_create($booking_details->created_at);

                        ?>
                        <td><?php echo date_format($date,"Y/m/d"); ?></td>
                      </tr>
                      <tr>
                        <th>Booking Status</th>

                        <td>
                          @if($booking_details->booking_status == "1")
                          Pending
                          @endif
                          @if($booking_details->booking_status == "2")
                          Approved
                          @endif
                          @if($booking_details->booking_status == "3")
                          Completed
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <th>Total Amount</th>

                        <td>
                          <?php
                            $price = $booking_details->total;
                            echo "$".number_format((float)$price, 2, '.', '');
                          ?>
                        </td>
                      </tr>
                    </thead>
                  </table>
                </div> 
              </div>
              <div class="col-md-6">
                <div class="payment_details">
                  <h5>Payment Details</h5>
                  <table class="table table-bordered caption-top">
                    
                    <thead>
                      <tr>
                        <th>Payment Methods</th>
                        <td>Visa</td>
                      </tr>
                      <tr>
                        <th>Payment Status</th>
                       
                        <td>Pending</td>
                      </tr>
                     
                    </thead>
                  </table>
                </div>
              </div>
              <div class="col-md-6">
                <div class="customer_content">
                  <h5>Customer Details</h5>
                  <table class="table table-bordered caption-top">
                    
                    <thead>
                      <tr>
                        <th>First Name</th>
                        <td>{{ $booking_details->customer_first_name }}</td>
                      </tr>
                      <tr>
                        <th>Last Name</th>
                        <td>{{ $booking_details->customer_last_name }}</td>
                      </tr>
                      <tr>
                        <th>Email</th>
                        <td>{{ $booking_details->customer_email }}</td>
                      </tr>
                      <tr>
                        <th>Phone No</th>
                        <td>{{ $booking_details->customer_phone_no }}</td>
                      </tr>
                      <tr>
                        <th>Country</th>
                        <td>{{ $booking_details->customer_country }}</td>
                      </tr>
                    </thead>
                  </table>
                </div> 
              </div>
              <div class="col-md-6">
                <div class="customer_content">
                  <h5>Driver Details</h5>
                  <table class="table table-bordered caption-top">
                    
                    <thead>
                      <tr>
                        <th>First Name</th>
                        <td>{{ $booking_details->driver_first_name }}</td>
                      </tr>
                      <tr>
                        <th>Last Name</th>
                        <td>{{ $booking_details->driver_last_name }}</td>
                      </tr>
                      <tr>
                        <th>Email</th>
                        <td>{{ $booking_details->driver_email_address }}</td>
                      </tr>
                      <tr>
                        <th>Phone No</th>
                        <td>{{ $booking_details->driver_contact_no }}</td>
                      </tr>
                      <tr>
                        <th>Country</th>
                        <td>{{ $booking_details->driver_country }}</td>
                      </tr>
                    </thead>
                  </table>
                </div> 
              </div>
              <div class="col-md-12">
                <h5>Billing Details</h5>
                <table class="table table-bordered caption-top">
                  
                  <thead>
                    <tr>
                      <th>Sno</th>
                      <th>Image</th>
                      <th>Category</th>
                      <th>From Date</th>
                      <th>To Date</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
             



            

          </div>

          <!-- /.card-body -->


        </div>

        <!-- /.card -->



      </div>

      <!-- /.container-fluid -->

    </section>

    <!-- /.content -->

  </div>

  <!-- /.content-wrapper -->



@endsection         