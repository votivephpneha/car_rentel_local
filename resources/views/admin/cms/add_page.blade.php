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
      url: site_url + '/admin/add_page_action',
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

            <h1>Add Page</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>

              <li class="breadcrumb-item active">Add Page</li>

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

            <h3 class="card-title">Page Form</h3>

            <!-- <div class="card-tools">

              <button type="button" class="btn btn-tool" data-card-widget="collapse">

                <i class="fas fa-minus"></i>

              </button>

              <button type="button" class="btn btn-tool" data-card-widget="remove">

                <i class="fas fa-times"></i>

              </button>

            </div> -->

          </div>



          <!-- /.card-header -->

          <div class="card-body">

              <form  method="POST" action="{{url('admin/add_page_action')}}" enctype="multipart/form-data">

                @csrf

                <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>Title</label>

                      <input type="text" class="form-control" name="pagetitle" id="pagetitle" placeholder="Enter Title">

                    </div>

                  </div>

                  <!-- <div class="col-md-6">

                    <div class="form-group">

                      <label>Customer Last Name</label>

                      <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter Customer Last Name">

                    </div>

                  </div> -->



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>SubTitle</label>

                      <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="Enter Sub Title" autocomplete="">

                    </div>

                  </div>

                  <div class="col-md-12">

                    <div class="form-group">

                      <label>Content</label>
					  
					  <textarea id="summernote1" class=" ckeditor form-control" name="content"></textarea>

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