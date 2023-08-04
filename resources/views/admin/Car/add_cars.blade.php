@extends('admin.layout.layout')



@section('title', 'User - Profile')



@section('current_page_css')

@endsection



@section('current_page_js')

<script type="text/javascript">
 // Start pages

$("#addCarsForm").validate({
  debug: false,
  rules: {
    title: {
        required: true,
    },
    sub_title: {
      required: true,
    },
    image: {
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
      url: site_url + '/admin/submit_cars',
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

            <h1>Add Cars</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>

              <li class="breadcrumb-item active">Add Cars</li>

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

            <h3 class="card-title">Add Cars</h3>


          </div> -->



          <!-- /.card-header -->

          <div class="card-body">

              <form  method="POST" enctype="multipart/form-data" id="addCarsForm">

                @csrf

                <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>Title</label>

                      <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title">

                    </div>

                  </div>

                  <div class="col-md-6">

                  <div class="form-group">

                  <label>Vehicle Type</label>
                  <select class="form-control" name="vehicle_type" id="vehicle_type">
                    <option value="">Select</option>
                    <option value="Automatic">Automatic</option>
                    <option value="Manual">Manual</option>
                    
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
                    <option value="{{ $cat_list->cat_name }}">{{ $cat_list->cat_name }}</option>
                    @endforeach
                  </select>
                 

                  </div>

                  </div>

                  <div class="col-md-6">

                  <div class="form-group">

                  <label>Image</label>
            
                 <input type="file" class="form-control" name="image" id="image">

                  </div>

                  </div>
                  <!-- <div class="col-md-6">

                  <div class="form-group">

                  <label>No of day</label>
            
                 <select class="form-control" name="no_of_day" id="no_of_day" onchange="changePrice(this.value)">
                    <option value="">Select</option>
                    <option value="1 Day">1 Day</option>
                    <option value="3+ Day">3+ Day</option>
                    <option value="7+ Day">7+ Day</option>
                    <option value="30+ Day">30+ Day</option>
                  </select>
                  <input type="hidden" class="form-control" name="days_1" id="days-1">
                 <input type="hidden" class="form-control" name="days_3" id="days-3">
                 <input type="hidden" class="form-control" name="days_7" id="days-7">
                 <input type="hidden" class="form-control" name="days_30" id="days-30">
                  </div>

                  </div> -->
                  <div class="col-md-6">

                  <div class="form-group">

                  <label>No of seats</label>
            
                 <input type="text" class="form-control" name="no_of_seats" id="no_of_seats">

                  </div>

                  </div>

                  <div class="col-md-6">

                  <div class="form-group">

                  <label>No of Kilometer</label>
                  <select class="form-control" name="no_of_km" id="no_of_km">
                    <option value="">Select</option>
                    <option>Unlimited</option>
                  </select>
                 

                  </div>

                  </div>
                  <div class="col-md-6">

                  <div class="form-group">

                  <label>Car Description</label>
                  <textarea class="form-control" name="car_description" id="car_description"></textarea>
                 

                  </div>

                  </div>
                  <!-- <div class="col-md-6">

                  <div class="form-group">

                  <label class="price_day">Price</label>
            
                 <input type="text" class="form-control price_div" name="price_1" id="price_1">
                 <input type="text" class="form-control price_div" name="price_3" id="price_3" style="display: none">
                 <input type="text" class="form-control price_div" name="price_7" id="price_7" style="display: none">
                 <input type="text" class="form-control price_div" name="price_30" id="price_30" style="display: none">

                  </div>

                  </div> -->

                  <!-- <div class="col-md-6">

                  <div class="form-group">

                  <label>Total Price</label>
            
                 <input type="text" class="form-control" name="total_price" id="total_price">

                  </div>

                  </div> -->
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
                            <input type="text" name="price[]" class="price form-control">
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <span>3+ Day</span>
                          </td>
                          <td>
                            <input type="text" name="price[]" class="price form-control">
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <span>7+ Day</span>
                          </td>
                          <td>
                            <input type="text" name="price[]" class="price form-control">
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <span>30+ Day</span>
                          </td>
                          <td>
                            <input type="text" name="price[]" class="price form-control">
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