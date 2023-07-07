@extends('admin.layout.layout')



@section('title', 'Pages')



@section('current_page_css')

@endsection



@section('current_page_js')

<script type="text/javascript">
 // Start pages

$("#homeUpdateAdmin_form").validate({
  debug: false,
  rules: {
    button_name: {
        required: true,
    },
 
    banner_content: {
      required: true,
    },

  },
  submitHandler: function (form) {
    var site_url = $("#baseUrl").val();
    var formData = $(form).serialize();
    $(form).ajaxSubmit({
      type: 'POST',
      url: site_url + '/admin/update_home',
      data: formData,
      success: function (response) {
        // console.log(response);
        if (response.status == 'success') {
          // $("#register_form")[0].reset();
          success_noti(response.msg);
          // setTimeout(function(){window.location.reload()},1000);
          setTimeout(function(){window.location.href=site_url+"/admin/home_management"},1000);
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

@endsection



@section('content')



  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Home</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>

              <li class="breadcrumb-item active">Home Page Manage</li>

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

            <h3 class="card-title">Home Content</h3>

          </div>


          <!-- /.card-header -->

          <div class="card-body">

              <form  method="POST" id="homeUpdateAdmin_form">

                <input type="hidden" name="_token" id="csrf-token" value="{{csrf_token()}}" />

                <input type="hidden" name="user_id" id="user_id" value="{{(!empty($page_info->id) ? $page_info->id : '')}}" />

                
                <div class="row">

                  <div class="col-md-4">

                    <div class="form-group">

                  <label>Home Logo</label>

                  <input type="file" class="form-control" name="home_logo" id="home_logo" accept="image/*" value="">

                  <input type="hidden" name="logo_img_old" value="{{(!empty($page_info->home_logo) ? $page_info->home_logo : '')}}">

                    </div>

                  </div>


                  <div class="col-md-4">

                    <div class="form-group">

                    <label>Banner Content 1</label>

                    <input type="text" class="form-control" name="banner_content" id="banner_content"  value="{{(!empty($page_info->banner_content) ? $page_info->banner_content : '')}}">

                    </div>

                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                    <label>Banner Content 2</label>

                    <input type="text" class="form-control" name="banner_content2" id="banner_content2"  value="{{(!empty($page_info->banner_content2) ? $page_info->banner_content2 : '')}}">

                    </div>

                  </div>


              <div class="col-md-6">

                    <div class="form-group">

                      <label>Change Button Name</label>

                      <input type="text" class="form-control" name="button_name" id="button_name"  value="{{(!empty($page_info->button_name) ? $page_info->button_name : '')}}">

                    </div>

                  </div>


                  <div class="col-md-6">

                    <div class="form-group">

                      <label>Change Button Link</label>

                      <input type="text" class="form-control" name="button_link" id="button_link"  value="{{(!empty($page_info->button_link) ? $page_info->button_link : '')}}">

                    </div>

                  </div>


                  <div class="col-md-12">

                    <div class="form-group">

                      <label>Home Footer Content</label>

                      <input type="text" class="form-control" name="footer_content" id="footer_content" value="{{(!empty($page_info->footer_content) ? $page_info->footer_content : '')}}">

                    </div>

                  </div>

                 
                   <div class="col-md-6">

                    <div class="form-group">

                      <label>Social Discord Link</label>

                      <input type="text" class="form-control" name="discord_link" id="discord_link" value="{{(!empty($page_info->discord_link) ? $page_info->discord_link : '')}}">

                    </div>

                  </div>
                  
                   <div class="col-md-6">

                    <div class="form-group">

                      <label>Social Twitter Link</label>

                      <input type="text" class="form-control" name="twitter_link" id="twitter_link"value="{{(!empty($page_info->twitter_link) ? $page_info->twitter_link : '')}}">

                    </div>

                  </div> 

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>Footer Copyright Text</label>

                      <input type="text" class="form-control" name="footer_copy" id="footer_copy"value="{{(!empty($page_info->footer_copy) ? $page_info->footer_copy : '')}}">

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