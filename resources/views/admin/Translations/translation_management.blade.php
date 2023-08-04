
@extends('admin.layout.layout')



@section('title', 'User - Profile')



@section('current_page_css')
<style>

.tabs-nav {
    list-style: none;
    margin: 0;
    padding: 0;
}
.tabs-nav li:first-child a {
    border-right: 0;
    -moz-border-radius-topleft: 6px;
    -webkit-border-top-left-radius: 6px;
    border-top-left-radius: 6px;
}
.tabs-nav .tab-active a {
    background: hsl(0, 100%, 100%);
    border-bottom-color: hsla(0, 0%, 0%, 0);
    color: hsl(85, 54%, 51%);
    cursor: default;
}
.tabs-nav a {
    background: hsl(120, 11%, 96%);
    border: 1px solid hsl(210, 6%, 79%);
    color: hsl(215, 6%, 57%);
    display: block;
    font-size: 11px;
    font-weight: bold;
    
    line-height: 44px;
    text-align: center;
    text-transform: uppercase;
    
}
.tabs-nav li {
    float: left;
}
.tabs-stage {
    border: 1px solid hsl(210, 6%, 79%);
    -webkit-border-radius: 0 0 6px 6px;
    -moz-border-radius: 0 0 6px 6px;
    -ms-border-radius: 0 0 6px 6px;
    -o-border-radius: 0 0 6px 6px;
    border-radius: 0 0 6px 6px;
    border-top: 0;
    clear: both;
    margin-bottom: 20px;
    position: relative;
    top: -1px;
    
}
.tabs-stage p {
    margin: 0;
    padding: 20px;
    color: hsl(0, 0%, 33%);
}
</style>
@endsection



@section('current_page_js')

<script type="text/javascript">
 // Start pages

$("#updateTranslations").validate({
  debug: false,
  
  submitHandler: function (form) {
    var site_url = $("#baseUrl").val();
    // alert(site_url);
    var formData = $(form).serialize();
    $(form).ajaxSubmit({
      type: 'POST',
      url: site_url + '/admin/update_translations',
      data: formData,
      success: function (response) {
        console.log(response);
        if (response.status == 'success') {
          // $("#register_form")[0].reset();
          // success_noti(response.msg);
          // setTimeout(function(){window.location.reload()},1000);
          success_noti(response.msg);
          //setTimeout(function(){window.location.href=site_url+"/admin/car_management"},1000);
        } else {
          error_noti(response.msg);
        }

      }
    });
    // event.preventDefault();
  }
});
$("#updateTranslationsTwo").validate({
  debug: false,
  
  submitHandler: function (form) {
    var site_url = $("#baseUrl").val();
    // alert(site_url);
    var formData = $(form).serialize();
    $(form).ajaxSubmit({
      type: 'POST',
      url: site_url + '/admin/update_translationsTwo',
      data: formData,
      success: function (response) {
        console.log(response);
        if (response.status == 'success') {
          // $("#register_form")[0].reset();
          // success_noti(response.msg);
          // setTimeout(function(){window.location.reload()},1000);
          success_noti(response.msg);
          //setTimeout(function(){window.location.href=site_url+"/admin/car_management"},1000);
        } else {
          error_noti(response.msg);
        }

      }
    });
    // event.preventDefault();
  }
});
$("#updateCarTranslations").validate({
  debug: false,
  
  submitHandler: function (form) {
    var site_url = $("#baseUrl").val();
    // alert(site_url);
    var formData = $(form).serialize();
    $(form).ajaxSubmit({
      type: 'POST',
      url: site_url + '/admin/update_car_translations',
      data: formData,
      success: function (response) {
        console.log(response);
        if (response.status == 'success') {
          // $("#register_form")[0].reset();
          // success_noti(response.msg);
          // setTimeout(function(){window.location.reload()},1000);
          success_noti(response.msg);
          //setTimeout(function(){window.location.href=site_url+"/admin/car_management"},1000);
        } else {
          error_noti(response.msg);
        }

      }
    });
    // event.preventDefault();
  }
});
$('.tabs-nav a').on('click', function (event) {
    event.preventDefault();
    
    $('.tab-active').removeClass('tab-active');
    $(this).parent().addClass('tab-active');
    $('.tabs-stage .form_tab').hide();
    $($(this).attr('href')).show();
});

$('.tabs-nav a:first').trigger('click'); // Default
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

            <h1>Translation Management</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>

              <li class="breadcrumb-item active">Translation Management</li>

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
              <ul class="tabs-nav">
                  <li class=""><a href="#tab-1" rel="nofollow">Basic Texts</a>
                  </li>
                  <li class="tab-active"><a href="#tab-2" rel="nofollow">Booking Texts</a>
                  </li>
                  <li class="tab-active"><a href="#tab-3" rel="nofollow">Car Management</a>
                  </li>
              </ul>
              <div class="tabs-stage">
              <div id="tab-1" class="form_tab" style="display: none;">
              <form  method="POST" enctype="multipart/form-data" id="updateTranslations">

                @csrf
                <table class="table table-bordered table-striped">
                  <tbody>
                    <tr>
                      <th>English Text</th>
                      <th>Italian Text</th>
                    </tr>
                  </tbody>
                </table>
                <div class="card-header" style="width: 100%; margin-bottom: 20px;"><h3 class="card-title">Menus</h3></div> 
                <table class="table table-bordered table-striped">
                  
                  <tbody>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="Menu1_en" id="home" value="{{ $texts->Menu1_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="Menu1_it" id="home" value="{{ $texts->Menu1_it }}">

                        </div>
                      </td>
                      
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="Menu2_en" id="home" value="{{ $texts->Menu2_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="Menu2_it" id="home" value="{{ $texts->Menu2_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="Menu3_en" id="home" value="{{ $texts->Menu3_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="Menu3_it" id="home" value="{{ $texts->Menu3_it }}">

                        </div>
                      </td>
                      
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="call_now_en" id="home" value="{{ $texts->call_now_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="call_now_it" id="home" value="{{ $texts->call_now_it }}">

                        </div>
                      </td>
                      
                    </tr>
                  </tbody>
                </table>
                <div class="card-header" style="width: 100%; margin-bottom: 20px;"><h3 class="card-title">Home Banner</h3></div> 
                <table class="table table-bordered table-striped">
                  
                  <tbody>
                    
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="pickup_location_en" id="home" value="{{ $texts->pickup_location_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="pickup_location_it" id="home" value="{{ $texts->pickup_location_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="dropoff_location_en" id="home" value="{{ $texts->dropoff_location_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="dropoff_location_it" id="home" value="{{ $texts->dropoff_location_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="pickup_date_en" id="home" value="{{ $texts->pickup_date_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="pickup_date_it" id="home" value="{{ $texts->pickup_date_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="dropoff_date_en" id="home" value="{{ $texts->dropoff_date_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="dropoff_date_it" id="home" value="{{ $texts->dropoff_date_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="book_btn_en" id="home" value="{{ $texts->book_btn_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="book_btn_it" id="home" value="{{ $texts->book_btn_it }}">

                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="card-header" style="width: 100%; margin-bottom: 20px;"><h3 class="card-title">Brand Section</h3></div> 
                <table class="table table-bordered table-striped">
                  
                  <tbody>
                    
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="brand_section_heading_en" id="home" value="{{ $texts->brand_section_heading_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="brand_section_heading_it" id="home" value="{{ $texts->brand_section_heading_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="brand_heading_one_en" id="home" value="{{ $texts->best_deal_heading_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="brand_heading_one_it" id="home" value="{{ $texts->best_deal_heading_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="brand_heading_two_en" id="home" value="{{ $texts->best_deal_content_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="brand_heading_two_it" id="home" value="{{ $texts->best_deal_content_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="brand_heading_three_en" id="home" value="{{ $texts->best_deal_content_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="brand_heading_three_it" id="home" value="{{ $texts->best_deal_content_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="brand_content_one_en" id="home" value="{{ $texts->best_deal_content_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="brand_content_one_it" id="home" value="{{ $texts->best_deal_content_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="brand_content_two_en" id="home" value="{{ $texts->best_deal_content_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="brand_content_two_it" id="home" value="{{ $texts->best_deal_content_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="brand_content_three_en" id="home" value="{{ $texts->best_deal_content_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="brand_content_three_it" id="home" value="{{ $texts->best_deal_content_it }}">

                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="card-header" style="width: 100%; margin-bottom: 20px;"><h3 class="card-title">Best Deal Section</h3></div>
                <table class="table table-bordered table-striped">
                  
                  <tbody>
                    
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="best_deal_heading_en" id="home" value="{{ $texts->best_deal_heading_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="best_deal_heading_it" id="home" value="{{ $texts->best_deal_heading_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="best_deal_content_en" id="home" value="{{ $texts->best_deal_content_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="best_deal_content_it" id="home" value="{{ $texts->best_deal_content_it }}">

                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table> 
                <div class="card-header" style="width: 100%; margin-bottom: 20px;"><h3 class="card-title">Car Management texts</h3></div>
                <table class="table table-bordered table-striped">
                  
                  <tbody>
                    
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="Day_en" id="home" value="{{ $texts->Day_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="Day_it" id="home" value="{{ $texts->Day_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="Seater_en" id="home" value="{{ $texts->Seater_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="Seater_it" id="home" value="{{ $texts->Seater_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="Manual_en" id="home" value="{{ $texts->Manual_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="Manual_it" id="home" value="{{ $texts->Manual_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="KM_en" id="home" value="{{ $texts->KM_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="KM_it" id="home" value="{{ $texts->KM_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="More_en" id="home" value="{{ $texts->More_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="More_it" id="home" value="{{ $texts->More_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="book_now_en" id="home" value="{{ $texts->book_now_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="book_now_it" id="home" value="{{ $texts->book_now_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="vehicle_type_head_en" id="home" value="{{ $texts->vehicle_type_head_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="vehicle_type_head_it" id="home" value="{{ $texts->vehicle_type_head_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="vehicle_category_head_en" id="home" value="{{ $texts->vehicle_category_head_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="vehicle_category_head_it" id="home" value="{{ $texts->vehicle_category_head_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="total_en" id="home" value="{{ $texts->total_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="total_it" id="home" value="{{ $texts->total_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="automatic_en" id="home" value="{{ $texts->automatic_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="automatic_it" id="home" value="{{ $texts->automatic_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="manual_en" id="home" value="{{ $texts->manual_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="manual_it" id="home" value="{{ $texts->manual_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="change_date_en" id="home" value="{{ $texts->change_date_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="change_date_it" id="home" value="{{ $texts->change_date_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="search_popup_en" id="home" value="{{ $texts->search_popup_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="search_popup_it" id="home" value="{{ $texts->search_popup_it }}">

                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table> 
                <div class="card-header" style="width: 100%; margin-bottom: 20px;"><h3 class="card-title">Why choose us</h3></div>
                <table class="table table-bordered table-striped">
                  
                  <tbody>
                    
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="choose_us_heading_en" id="home" value="{{ $texts->best_deal_heading_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="choose_us_heading_it" id="home" value="{{ $texts->best_deal_heading_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                          <textarea class="form-control" name="choose_us_content_en" id="home" rows="10">{{ $texts->choose_us_content_en }}</textarea>
                          <!-- <input type="text" class="form-control" name="choose_us_content_en" id="home" value="{{ $texts->best_deal_content_en }}"> -->

                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <textarea class="form-control" name="choose_us_content_it" id="home" rows="10">{{ $texts->choose_us_content_it }}</textarea>
                          <!-- <input type="text" class="form-control" name="choose_us_content_it" id="home" value="{{ $texts->best_deal_content_it }}"> -->

                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table> 
                <div class="card-header" style="width: 100%; margin-bottom: 20px;"><h3 class="card-title">Locations</h3></div>
                <table class="table table-bordered table-striped">
                  
                  <tbody>
                    
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="location_one_en" id="home" value="{{ $texts->location_one_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="location_one_it" id="home" value="{{ $texts->location_one_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="location_two_en" id="home" value="{{ $texts->location_two_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="location_two_it" id="home" value="{{ $texts->location_two_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="location_three_en" id="home" value="{{ $texts->location_three_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="location_three_it" id="home" value="{{ $texts->location_three_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="location_four_en" id="home" value="{{ $texts->location_four_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="location_four_it" id="home" value="{{ $texts->location_four_it }}">

                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table> 
                <div class="card-header" style="width: 100%; margin-bottom: 20px;"><h3 class="card-title">Meet the team</h3></div>
                <table class="table table-bordered table-striped">
                  
                  <tbody>
                    
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="meet_team_en" id="home" value="{{ $texts->meet_team_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="meet_team_it" id="home" value="{{ $texts->meet_team_it }}">

                        </div>
                      </td>
                    </tr>
                    
                  </tbody>
                </table> 
                <div class="card-header" style="width: 100%; margin-bottom: 20px;"><h3 class="card-title">Footer Featured Makes</h3></div>
                <table class="table table-bordered table-striped">
                  
                  <tbody>
                    
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="cat_one_en" id="home" value="{{ $texts->cat_one_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="cat_one_it" id="home" value="{{ $texts->cat_one_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="cat_two_en" id="home" value="{{ $texts->cat_two_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="cat_two_it" id="home" value="{{ $texts->cat_two_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="cat_three_en" id="home" value="{{ $texts->cat_three_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="cat_three_it" id="home" value="{{ $texts->cat_three_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="cat_four_en" id="home" value="{{ $texts->cat_four_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="cat_four_it" id="home" value="{{ $texts->cat_four_it }}">

                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table> 
                <div class="card-header" style="width: 100%; margin-bottom: 20px;"><h3 class="card-title">Footer Texts</h3></div>
                <table class="table table-bordered table-striped">
                  
                  <tbody>
                    
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="footer_heading_one_en" id="home" value="{{ $texts->footer_heading_one_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="footer_heading_one_it" id="home" value="{{ $texts->footer_heading_one_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="footer_content_en" id="home" value="{{ $texts->footer_content_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="footer_content_it" id="home" value="{{ $texts->footer_content_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="footer_heading_two_en" id="home" value="{{ $texts->footer_heading_two_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="footer_heading_two_it" id="home" value="{{ $texts->footer_heading_two_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="footer_heading_three_en" id="home" value="{{ $texts->footer_heading_three_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="footer_heading_three_it" id="home" value="{{ $texts->footer_heading_three_it }}">

                        </div>
                      </td>
                    </tr>
                     <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="footer_heading_four_en" id="home" value="{{ $texts->footer_heading_four_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="footer_heading_four_it" id="home" value="{{ $texts->footer_heading_four_it }}">

                        </div>
                      </td>
                    </tr>
                     <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="copyright_en" id="home" value="{{ $texts->copyright_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="copyright_it" id="home" value="{{ $texts->copyright_it }}">

                        </div>
                      </td>
                    </tr>

                  </tbody>
                </table> 
                <div class="card-header" style="width: 100%; margin-bottom: 20px;"><h3 class="card-title">Manage Booking Popup</h3></div>
                <table class="table table-bordered table-striped">
                  
                  <tbody>
                    
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="popup_heading_en" id="home" value="{{ $texts->popup_heading_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="popup_heading_it" id="home" value="{{ $texts->popup_heading_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="popup_content_en" id="home" value="{{ $texts->popup_content_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="popup_content_it" id="home" value="{{ $texts->popup_content_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="booking_no_en" id="home" value="{{ $texts->booking_no_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="booking_no_it" id="home" value="{{ $texts->booking_no_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="email_en" id="home" value="{{ $texts->email_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="email_it" id="home" value="{{ $texts->email_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="submit_btn_en" id="home" value="{{ $texts->submit_btn_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="submit_btn_it" id="home" value="{{ $texts->submit_btn_it }}">

                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table> 
                

                <div class="row">


                  <div class="col-12">

                  <button class="btn btn-primary btn-dark float-right" name="submit" type="submit">Submit</button>

                  </div>

                </div>

              </form>
            </div>
            <div id="tab-2" class="form_tab" style="display: block;">
            <form enctype="multipart/form-data" id="updateTranslationsTwo">
              <div class="card-header" style="width: 100%; margin-bottom: 20px;"><h3 class="card-title">Booking Page</h3></div>
                @csrf
                <table class="table table-bordered table-striped">
                  <tbody>
                    <tr>
                      <th>English Text</th>
                      <th>Italian Text</th>
                    </tr>
                  </tbody>
                </table>
                <table class="table table-bordered table-striped">
                  
                  <tbody>
                    
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_heading_en" id="home" value="{{ $texts_booking->driver_heading_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_heading_it" id="home" value="{{ $texts_booking->driver_heading_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_sub_heading_en" id="home" value="{{ $texts_booking->driver_sub_heading_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_sub_heading_it" id="home" value="{{ $texts_booking->driver_sub_heading_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_email_en" id="home" value="{{ $texts_booking->driver_email_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_email_it" id="home" value="{{ $texts_booking->driver_email_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_title_en" id="home" value="{{ $texts_booking->driver_title_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_title_it" id="home" value="{{ $texts_booking->driver_title_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_fname_en" id="home" value="{{ $texts_booking->driver_fname_en }}">

                        </div>
                      </td>
                       
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_fname_it" id="home" value="{{ $texts_booking->driver_fname_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_lname_en" id="home" value="{{ $texts_booking->driver_lname_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_lname_it" id="home" value="{{ $texts_booking->driver_lname_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_contact_en" id="home" value="{{ $texts_booking->driver_contact_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_contact_it" id="home" value="{{ $texts_booking->driver_contact_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_country_en" id="home" value="{{ $texts_booking->driver_country_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_country_it" id="home" value="{{ $texts_booking->driver_country_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_flight_en" id="home" value="{{ $texts_booking->driver_flight_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_flight_it" id="home" value="{{ $texts_booking->driver_flight_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_notes_en" id="home" value="{{ $texts_booking->driver_notes_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_notes_it" id="home" value="{{ $texts_booking->driver_notes_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_submit_btn_en" id="home" value="{{ $texts_booking->driver_submit_btn_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_submit_btn_it" id="home" value="{{ $texts_booking->driver_submit_btn_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_email_field_en" id="home" value="{{ $texts_booking->driver_email_field_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_email_field_it" id="home" value="{{ $texts_booking->driver_email_field_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_contact_field_en" id="home" value="{{ $texts_booking->driver_contact_field_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_contact_field_it" id="home" value="{{ $texts_booking->driver_contact_field_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_flight_field_en" id="home" value="{{ $texts_booking->driver_flight_field_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_flight_field_it" id="home" value="{{ $texts_booking->driver_flight_field_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_title_one_en" id="home" value="{{ $texts_booking->driver_title_one_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_title_one_it" id="home" value="{{ $texts_booking->driver_title_two_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_title_two_en" id="home" value="{{ $texts_booking->driver_title_two_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_title_two_it" id="home" value="{{ $texts_booking->driver_title_two_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_select_option_en" id="home" value="{{ $texts_booking->driver_select_option_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_select_option_it" id="home" value="{{ $texts_booking->driver_select_option_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_required_field_en" id="home" value="{{ $texts_booking->driver_required_field_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_required_field_it" id="home" value="{{ $texts_booking->driver_required_field_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_valid_no_en" id="home" value="{{ $texts_booking->driver_valid_no_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_valid_no_it" id="home" value="{{ $texts_booking->driver_valid_no_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_valid_email_en" id="home" value="{{ $texts_booking->driver_valid_email_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_valid_email_it" id="home" value="{{ $texts_booking->driver_valid_email_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_image_text_en" id="home" value="{{ $texts_booking->driver_image_text_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="driver_image_text_it" id="home" value="{{ $texts_booking->driver_image_text_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                          <textarea class="form-control" name="driver_image_text_en" id="home" rows="5">{{ $texts_booking->driver_image_text_en }}</textarea>
                          

                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <textarea class="form-control" name="driver_image_text_it" id="home" rows="5">{{ $texts_booking->driver_image_text_it }}</textarea>
                          

                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table> 
                <div class="card-header" style="width: 100%; margin-bottom: 20px;"><h3 class="card-title">Payment Page</h3></div>
                <table class="table table-bordered table-striped">
                  
                  <tbody>
                    
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="payment_method_en" id="home" value="{{ $texts_booking->payment_method_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="payment_method_it" id="home" value="{{ $texts_booking->payment_method_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="paytext_en" id="home" value="{{ $texts_booking->paytext_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="paytext_it" id="home" value="{{ $texts_booking->paytext_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="payment_btn_en" id="home" value="{{ $texts_booking->payment_btn_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="payment_btn_it" id="home" value="{{ $texts_booking->payment_btn_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="rentel_days_en" id="home" value="{{ $texts_booking->rentel_days_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="rentel_days_it" id="home" value="{{ $texts_booking->rentel_days_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                          <textarea class="form-control" name="payment_details_en" id="home" rows="5">{{ $texts_booking->payment_details_en }}</textarea>
                          

                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <textarea class="form-control" name="payment_details_it" id="home" rows="5">{{ $texts_booking->payment_details_it }}</textarea>
                          

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="price_detail_en" id="home" value="{{ $texts_booking->price_detail_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="price_detail_it" id="home" value="{{ $texts_booking->price_detail_it }}">

                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table> 
                <div class="card-header" style="width: 100%; margin-bottom: 20px;"><h3 class="card-title">Thank You Page</h3></div>
                <table class="table table-bordered table-striped">
                  
                  <tbody>
                    
                    <tr>
                      <td>
                        <div class="form-group">
                          <textarea class="form-control" name="thankyoucontent_en" id="home" rows="5">{{ $texts_booking->payment_details_en }}</textarea>
                          

                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <textarea class="form-control" name="thankyoucontent_it" id="home" rows="5">{{ $texts_booking->payment_details_it }}</textarea>
                          

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="thankyoubtn_en" id="home" value="{{ $texts->best_deal_content_en }}">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="thankyoubtn_it" id="home" value="{{ $texts->best_deal_content_it }}">

                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table> 
                <div class="row">


                  <div class="col-12">

                  <button class="btn btn-primary btn-dark float-right" name="submit" type="submit">Submit</button>

                  </div>

                </div>
            </form>
            </div>
            <div id="tab-3" class="form_tab" style="display: none;">
              <form method="POST" enctype="multipart/form-data" id="updateCarTranslations" novalidate="novalidate">
                @csrf
                <table class="table table-bordered table-striped">
                  <tbody>
                    <tr>
                      <th>English Text</th>
                      <th>Italian Text</th>
                    </tr>
                  </tbody>
                </table>
                <div class="card-header" style="width: 100%; margin-bottom: 20px;"><h3 class="card-title">Car Details</h3></div>
                <table class="table table-bordered table-striped">
                  
                  <tbody>
                    @foreach($car_data as $c_data)
                    <tr>
                      <td>
                        <div class="form-group">
                          <input type="hidden" name="car_id[]" value="{{ $c_data->id }}">
                          <input type="text" class="form-control" name="car_name_en" id="home" value="{{ $c_data->title }}" disabled="">

                        </div>
                      </td>
                      <td>
                        <div class="form-group">

                          <input type="text" class="form-control" name="car_name_it[]" id="home" value="{{ $c_data->title_it }}">

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                          <textarea class="form-control" name="car_description_en" id="home" rows="5" disabled="">{{ $c_data->car_description }}</textarea>
                          

                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <textarea class="form-control" name="car_description_it[]" id="home" rows="5">{{ $c_data->car_description_it }}</textarea>
                          

                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table> 
                <div class="row">


                  <div class="col-12">

                  <button class="btn btn-primary btn-dark float-right" name="submit" type="submit">Submit</button>

                  </div>

                </div>
              </form>
            </div>
            </div>


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