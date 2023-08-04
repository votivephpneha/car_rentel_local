@extends('admin.layout.layout')



@section('title', 'User - Profile')



@section('current_page_css')

@endsection



@section('current_page_js')

<script type="text/javascript">
 // Start pages

$("#editCarsForm").validate({
  debug: false,
  rules: {
    title: {
        required: true,
    },
    sub_title: {
      required: true,
    },
    
    no_of_day: {
      required: true,
    },
    no_of_seats: {
      required: true,
    },
    no_of_km: {
      required: true,
    },
    price: {
      required: true,
    }

  },
  submitHandler: function (form) {
    var site_url = $("#baseUrl").val();
    // alert(site_url);
    var formData = $(form).serialize();
    $(form).ajaxSubmit({
      type: 'POST',
      url: site_url + '/admin/update_cars',
      data: formData,
      success: function (response) {
        console.log(response);
        if (response.status == 'success') {
          // $("#register_form")[0].reset();
          // success_noti(response.msg);
          // setTimeout(function(){window.location.reload()},1000);
          success_noti(response.msg);
          setTimeout(function(){window.location.href=site_url+"/admin/car_management"},1000);
        } else {
          error_noti(response.msg);
        }

      }
    });
    // event.preventDefault();
  }
});

// End pages 
</script>

<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
    image.onchange = evt => {
      const [file] = image.files
      if (file) {
        vehicle_img.src = URL.createObjectURL(file)
      }
    }
</script>

@endsection



@section('content')



  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Edit Cars</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>

              <li class="breadcrumb-item active">Edit Cars</li>

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

          <!-- <div class="card-header">

            <h3 class="card-title">Categories Form</h3>


          </div> -->



          <!-- /.card-header -->

          <div class="card-body">

              <form  method="POST" enctype="multipart/form-data" id="editCarsForm">

                @csrf

                <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>Title</label>
                      <input type="hidden" name="car_id" value="{{ $car_list->id }}">
                      <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" value="{{ $car_list->title }}">

                    </div>

                  </div>

                  <div class="col-md-6">

                  <div class="form-group">

                  <label>Vehicle Type</label>
                  <select class="form-control" name="vehicle_type" id="vehicle_type">
                    <option value="">Select</option>
                    <option @if($car_list->vehicle_type == "Automatic") selected @endif value="Automatic">Automatic</option>
                    <option @if($car_list->vehicle_type == "Manual") selected @endif value="Manual">Manual</option>
                    
                  </select>
                 <!-- <input type="text" class="form-control" name="vehicle_type" id="vehicle_type"> -->

                  </div>

                  </div>
                  <div class="col-md-6">

                  <div class="form-group">

                  <label>Vehicle Category</label>
                  
                  <select class="form-control" name="vehicle_category" id="vehicle_category">
                    <option value="">Select</option>
                    @foreach($category_list as $cat_list)
                    <option value="{{ $cat_list->cat_name }}" @if($cat_list->cat_name == $car_list->vehicle_category) selected @endif>{{ $cat_list->cat_name }}</option>
                    @endforeach
                  </select>
                 

                  </div>

                  </div>
                  <div class="col-md-6">

                  <div class="form-group">

                  <label>Image</label>
            
                 <input type="file" class="form-control" name="image" id="image">
                 <div class="car_image"><br>
                   <img src="{{ url('public/uploads/cars') }}/{{ $car_list->image }}" id="vehicle_img" style="width:100px">
                 </div>
                  </div>

                  </div>
                  
                  <div class="col-md-6">

                  <div class="form-group">

                  <label>No of seats</label>
            
                 <input type="text" class="form-control" name="no_of_seats" id="no_of_seats" value="{{ $car_list->no_of_seats }}">

                  </div>

                  </div>

                  <div class="col-md-6">

                  <div class="form-group">

                  <label>No of Kilometer</label>
                  <select class="form-control" name="no_of_km" id="no_of_km">
                    <option>Select</option>
                    <option <?php if($car_list->no_of_km == 'Unlimited'){ echo 'selected'; } ?>>Unlimited</option>
                  </select>
                 

                  </div>

                  </div>

                  <div class="col-md-6">

                  <div class="form-group">

                  <label>Car Description</label>
                  <textarea class="form-control" name="car_description" id="car_description">{{ $car_list->car_description }}</textarea>
                 

                  </div>

                  </div>
                  

                  <div class="col-md-12">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>No of day</th>
                          <th>Price</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <span>1 Day</span>
                          </td>
                          <td>
                            <?php
                              $price1 = DB::table('car_price_days')->where('car_id',$car_list->id)->where('no_of_day','1 Day')->first();

                              $price = $price1->price;
                              
                            ?>
                            
                            <input type="text" name="price[]" class="price form-control" value="<?php echo number_format((float)$price, 2, '.', ''); ?>">
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <span>3+ Day</span>
                          </td>
                          <td>
                            <?php
                              $price2 = DB::table('car_price_days')->where('car_id',$car_list->id)->where('no_of_day','3+ Day')->first();

                              $price = $price2->price;
                              
                            ?>
                            <input type="text" name="price[]" class="price form-control" value="<?php echo number_format((float)$price, 2, '.', ''); ?>">
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <span>7+ Day</span>
                          </td>
                          <td>
                            <?php
                              $price3 = DB::table('car_price_days')->where('car_id',$car_list->id)->where('no_of_day','7+ Day')->first();

                              $price = $price3->price;
                              
                            ?>
                            <input type="text" name="price[]" class="price form-control" value="<?php echo number_format((float)$price, 2, '.', ''); ?>">
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <span>30+ Day</span>
                          </td>
                          <td>
                            <?php
                              $price4 = DB::table('car_price_days')->where('car_id',$car_list->id)->where('no_of_day','30+ Day')->first();

                              $price = $price4->price;
                              
                            ?>
                            <input type="text" name="price[]" class="price form-control" value="<?php echo number_format((float)$price, 2, '.', ''); ?>">
                          </td>
                        </tr>
                      </tbody>
                      
                      
                    </table>
                  </div>
                  <div class="col-12">

                  <button class="btn btn-primary btn-dark float-right" name="submit" type="submit">Submit</button>

                  </div>

                </div>

              </form>



            <!-- /.row -->

          </div>

          <!-- /.card-body -->

          

          <div class="card-footer">

            <!-- Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about

            the plugin. -->

          </div>

        </div>

        <!-- /.card -->



      </div>

      <!-- /.container-fluid -->

    </section>

    <!-- /.content -->

  </div>

  <!-- /.content-wrapper -->



@endsection         