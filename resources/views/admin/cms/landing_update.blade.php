@extends('admin.layout.layout')



@section('title', 'Pages')



@section('current_page_css')

@endsection



@section('current_page_js')

<script type="text/javascript">
 // Start pages

$("#landingUpdateAdmin_form").validate({
  debug: false,
  rules: {
    button_name: {
        required: true,
    },
 
    banner_content: {
      required: true,
    },

  },
  submitHandler: function (form) { alert('Test123');
    var site_url = $("#baseUrl").val();
    var formData = $(form).serialize();
    $(form).ajaxSubmit({
      type: 'POST',
      url: site_url + '/admin/update_landing',
      data: formData,
      success: function (response) {
        // console.log(response);
        if (response.status == 'success') {
          // $("#register_form")[0].reset();
          success_noti(response.msg);
          // setTimeout(function(){window.location.reload()},1000);
          setTimeout(function(){window.location.href=site_url+"/admin/landing_management"},1000);
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

            <h1>Home Landing</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home Landing</a></li>

              <li class="breadcrumb-item active">Home Landing Page Manage</li>

            </ol>

          </div>

        </div>

      </div><!-- /.container-fluid -->

    </section>

          @if(session()->has('message'))
           <div class="alert alert-success">
              {{ session()->get('message') }}
           </div>
           @endif

    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">

        
        <!-- SELECT2 EXAMPLE -->

        <div class="card card-default">

          <div class="card-header">

            <h3 class="card-title">Landing Page Content</h3>

          </div>


          <!-- /.card-header -->

          <div class="card-body">

              <form  method="POST" id="" action="{{url('admin/update_landing')}}" enctype="multipart/form-data">

                <input type="hidden" name="_token" id="csrf-token" value="{{csrf_token()}}" />

                <input type="hidden" name="user_id" id="user_id" value="{{(!empty($page_info->id) ? $page_info->id : '')}}" />

                
                <div class="row">

                  <div class="col-md-4">

                    <div class="form-group">

                  <label>Logo</label>

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


              <div class="col-md-4">

                    <div class="form-group">

                      <label>Logo Name</label>

                      <input type="text" class="form-control" name="logo_name" id="logo_name"  value="{{(!empty($page_info->logo_name) ? $page_info->logo_name : '')}}">

                    </div>

                  </div>
				  
				 <div class="col-md-4">

                    <div class="form-group">

                      <label>Change Button Name</label>

                      <input type="text" class="form-control" name="button_name" id="button_name"  value="{{(!empty($page_info->button_name) ? $page_info->button_name : '')}}">

                    </div>

                  </div>


                  <div class="col-md-4">

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

                      <label>Top Right Button Name</label>

                      <input type="text" class="form-control" name="top_button_name" id="top_button_name"value="{{(!empty($page_info->top_button_name) ? $page_info->top_button_name : '')}}">

                    </div>

                  </div>  

                   <div class="col-md-6">

                    <div class="form-group">

                      <label>Top Right Button Link</label>

                      <input type="text" class="form-control" name="top_button_link" id="top_button_link"value="{{(!empty($page_info->top_button_link) ? $page_info->top_button_link : '')}}">

                    </div>

                  </div> 
        
          <div class="card-header" style="width: 100%; margin-bottom: 20px;"><h3 class="card-title">OUR DISCORD</h3></div> 

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>Title-1</label>

                      <input type="text" class="form-control" name="discord_title1" id="discord_title1"value="{{(!empty($page_info->discord_title1) ? $page_info->discord_title1 : '')}}">

                    </div>

                  </div> 

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>Title-2</label>

                      <input type="text" class="form-control" name="discord_title2" id="discord_title2"value="{{(!empty($page_info->discord_title2) ? $page_info->discord_title2 : '')}}">

                    </div>

                  </div> 

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>Button Name</label>

                      <input type="text" class="form-control" name="discord_button_name" id="discord_button_name"value="{{(!empty($page_info->discord_button_name) ? $page_info->discord_button_name : '')}}">

                    </div>

                  </div> 

                    <div class="col-md-6">

                    <div class="form-group">

                      <label>Button Link</label>

                      <input type="text" class="form-control" name="discord_button_link" id="discord_button_link"value="{{(!empty($page_info->discord_button_link) ? $page_info->discord_button_link : '')}}">

                    </div>

                  </div> 


          <div class="card-header" style="width: 100%; margin-bottom: 20px;"><h3 class="card-title">LATEST NEWS</h3></div> 

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>Title-1</label>

                      <input type="text" class="form-control" name="news_title1" id="news_title1"value="{{(!empty($page_info->news_title1) ? $page_info->news_title1 : '')}}">

                    </div>

                  </div> 

                <div class="col-md-6">

                    <div class="form-group">

                      <label>Title-2</label>

                      <input type="text" class="form-control" name="news_title2" id="news_title2"value="{{(!empty($page_info->news_title2) ? $page_info->news_title2 : '')}}">

                    </div>

                  </div> 

            <div class="card-header" style="width: 100%; margin-bottom: 20px;"><h3 class="card-title">INGOS WE’VE WORKED WITH</h3></div> 

                  <div class="col-md-4">

                    <div class="form-group">

                  <label>Logo-1</label>

                  <input type="file" class="form-control" name="ingos_logo1" id="ingos_logo1" accept="image/*" value="">

                  <input type="hidden" name="ingos_logo1_old" value="{{(!empty($page_info->ingos_logo1) ? $page_info->ingos_logo1 : '')}}">

                    </div>

                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                  <label>Logo-2</label>

                  <input type="file" class="form-control" name="ingos_logo2" id="ingos_logo2" accept="image/*" value="">

                  <input type="hidden" name="ingos_logo2_old" value="{{(!empty($page_info->ingos_logo2) ? $page_info->ingos_logo2 : '')}}">

                    </div>

                  </div>

                  <div class="col-md-4">

                  <div class="form-group">

                  <label>Logo-3</label>

                  <input type="file" class="form-control" name="ingos_logo3" id="ingos_logo3" accept="image/*" value="">

                  <input type="hidden" name="ingos_logo3_old" value="{{(!empty($page_info->ingos_logo3) ? $page_info->ingos_logo3 : '')}}">

                    </div>

                  </div> 

                                    <div class="col-md-4">

                    <div class="form-group">

                  <label>Logo-4</label>

                  <input type="file" class="form-control" name="ingos_logo4" id="ingos_logo4" accept="image/*" value="">

                  <input type="hidden" name="ingos_logo4_old" value="{{(!empty($page_info->ingos_logo4) ? $page_info->ingos_logo4 : '')}}">

                    </div>

                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                  <label>Logo-5</label>

                  <input type="file" class="form-control" name="ingos_logo5" id="ingos_logo5" accept="image/*" value="">

                  <input type="hidden" name="ingos_logo5_old" value="{{(!empty($page_info->ingos_logo5) ? $page_info->ingos_logo5 : '')}}">

                    </div>

                  </div>

                  <div class="col-md-4">

                  <div class="form-group">

                  <label>Logo-6</label>

                  <input type="file" class="form-control" name="ingos_logo6" id="ingos_logo6" accept="image/*" value="">

                  <input type="hidden" name="ingos_logo6_old" value="{{(!empty($page_info->ingos_logo6) ? $page_info->ingos_logo6 : '')}}">

                    </div>

                  </div>                  
                  <div class="card-header" style="width: 100%; margin-bottom: 20px;"><h3 class="card-title">Brand Section Content</h3></div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Image One</label>
                      <input type="hidden" name="image_one_old" value="{{(!empty($page_info->image_one) ? $page_info->image_one : '')}}">
                      <input type="file" class="form-control" name="image_one" id="image_one" accept="image/*">
                    </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Image Two</label>
                      <input type="hidden" name="image_two_old" value="{{(!empty($page_info->image_two) ? $page_info->image_two : '')}}">
                      <input type="file" class="form-control" name="image_two" id="image_two" accept="image/*">
                    </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Image Three</label>
                      <input type="hidden" name="image_three_old" value="{{(!empty($page_info->image_three) ? $page_info->image_three : '')}}">
                      <input type="file" class="form-control" name="image_three" id="image_three" accept="image/*">
                    </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Heading One(English)</label>
                      <input type="text" class="form-control" name="heading_one" id="heading_one" accept="image/*" value="{{(!empty($page_info->heading_one) ? $page_info->heading_one : '')}}">
                    </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Heading Two(English)</label>
                      <input type="text" class="form-control" name="heading_two" id="heading_two" accept="image/*" value="{{(!empty($page_info->heading_one) ? $page_info->heading_two : '')}}">
                    </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Heading Three(English)</label>
                      <input type="text" class="form-control" name="heading_three" id="heading_three" accept="image/*" value="{{(!empty($page_info->heading_two) ? $page_info->heading_two : '')}}">
                    </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Content One(English)</label>
                      <input type="text" class="form-control" name="content_one" id="content_one" accept="image/*" value="{{(!empty($page_info->content_one) ? $page_info->content_one : '')}}">
                    </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Content Two(English)</label>
                      <input type="text" class="form-control" name="content_two" id="content_two" accept="image/*" value="{{(!empty($page_info->content_two) ? $page_info->content_two : '')}}">
                    </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Content Three(English)</label>
                      <input type="text" class="form-control" name="content_three" id="content_three" accept="image/*" value="{{(!empty($page_info->content_three) ? $page_info->content_three : '')}}">
                    </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Heading One(Italian)</label>
                      <input type="text" class="form-control" name="heading_one_it" id="heading_one_it" accept="image/*" value="{{(!empty($page_info->heading_one_it) ? $page_info->heading_one_it : '')}}">
                    </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Heading Two(Italian)</label>
                      <input type="text" class="form-control" name="heading_two_it" id="heading_two_it" accept="image/*" value="{{(!empty($page_info->heading_two_it) ? $page_info->heading_two_it : '')}}">
                    </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Heading Three(Italian)</label>
                      <input type="text" class="form-control" name="heading_three_it" id="heading_three_it" accept="image/*" value="{{(!empty($page_info->heading_three_it) ? $page_info->heading_three_it : '')}}">
                    </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Content One(Italian)</label>
                      <input type="text" class="form-control" name="content_one_it" id="content_one_it" accept="image/*" value="{{(!empty($page_info->content_one_it) ? $page_info->content_one_it : '')}}">
                    </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Content Two(Italian)</label>
                      <input type="text" class="form-control" name="content_two_it" id="content_two_it" accept="image/*" value="{{(!empty($page_info->content_two_it) ? $page_info->content_two_it : '')}}">
                    </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Content Three(Italian)</label>
                      <input type="text" class="form-control" name="content_three_it" id="content_three_it" accept="image/*" value="{{(!empty($page_info->content_three_it) ? $page_info->content_three_it : '')}}">
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