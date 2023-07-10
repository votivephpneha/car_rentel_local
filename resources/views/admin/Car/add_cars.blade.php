@extends('admin.layout.layout')



@section('title', 'User - Profile')



@section('current_page_css')

@endsection



@section('current_page_js')

<script type="text/javascript">
 // Start pages

$("#pageAdmin_form").validate({
  debug: false,
  rules: {
    pagetitle: {
        required: true,
    },
    content: {
      required: true,
    },

  },
  submitHandler: function (form) {
    var site_url = $("#baseUrl").val();
    // alert(site_url);
    var formData = $(form).serialize();
    $(form).ajaxSubmit({
      type: 'POST',
      url: site_url + '/admin/add_team_action',
      data: formData,
      success: function (response) {
        console.log(response);
        if (response.status == 'success') {
          // $("#register_form")[0].reset();
          // success_noti(response.msg);
          // setTimeout(function(){window.location.reload()},1000);
          setTimeout(function(){window.location.href=site_url+"/admin/content_management"},1000);
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

            <h1>Add Categories</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>

              <li class="breadcrumb-item active">Add Categories</li>

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

          <div class="card-header">

            <h3 class="card-title">Categories Form</h3>


          </div>



          <!-- /.card-header -->

          <div class="card-body">

              <form  method="POST" action="{{url('admin/submit_cars')}}" enctype="multipart/form-data">

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

                  <label>Sub Title</label>
            
                 <input type="text" class="form-control" name="sub_title" id="sub_title">

                  </div>

                  </div>

                  <div class="col-md-6">

                  <div class="form-group">

                  <label>Image</label>
            
                 <input type="file" class="form-control" name="image" id="image">

                  </div>

                  </div>
                  <div class="col-md-6">

                  <div class="form-group">

                  <label>No of day</label>
            
                 <select class="form-control" name="no_of_day" id="no_of_day">
                    <option>Select</option>
                    <option>1 Day</option>
                    <option>3+ Day</option>
                    <option>7+ Day</option>
                    <option>30+ Day</option>
                  </select>
                  </div>

                  </div>
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
                    <option>Select</option>
                    <option>Unlimited</option>
                  </select>
                 

                  </div>

                  </div>
                  <div class="col-md-6">

                  <div class="form-group">

                  <label>Price</label>
            
                 <input type="text" class="form-control" name="price" id="price">

                  </div>

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