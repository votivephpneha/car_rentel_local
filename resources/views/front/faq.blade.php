@extends('front.layout.layout')
<!-- @section('title', 'User - Profile') -->
@section('current_page_css')

<style type="text/css">
 .pracin-text h3 {
    text-align: center;
    color: #FFF;
    font-size: 16pt;
    margin-bottom: 18.75px;
} 
</style>

@endsection

@section('current_page_js')

<script type="text/javascript">

  function addnews() {

    var nemail = $('#newsletter').val();

    var validemail = validEmail(nemail);

    if(nemail==''){  success_noti('Please enter email address'); return false;  }

    if(validemail){ 

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({

          type: 'POST',

          url: "{{url('/add_news_action')}}",

          data: {

            user_id: nemail,

            _token: CSRF_TOKEN

          },

          dataType: 'JSON',

          success: function(results) {

            //alert(results.msg);

            // console.log(results);

            success_noti(results.msg);

          }

        });

  }else{

     success_noti('Please enter valid email address');  

      }

  }

    function helpnotification() {

    var hemail = $('#hemail').val(); 
    var hmessage = $('#hmessage').val();

    var validemail = validEmail(hemail);

    if(hemail==''){  success_noti('Please enter email address'); return false;  }

    if(validemail){ 

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({

          type: 'POST',

          url: "{{url('/add_help_action')}}",

          data: {

            user_id: hemail,

            message: hmessage,

            _token: CSRF_TOKEN

          },

          dataType: 'JSON',

          success: function(results) {

            //alert(results.msg);

            // console.log(results);

            success_noti(results.msg);

          }

        });

       }else{

     success_noti('Please enter valid email address');  

      }   

  }

  function validEmail(email){
  const regex = /^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/;
  return regex.test(email);
}

</script>


@endsection

@section('content')

<div class="main_wrapper">

<?php $home_logo = $page_info->home_logo; ?>  

<!---------------splash screen-------------------->
<div class="media-for-both">
<div class="top-menu">
       
  <div class="col-md-12">
  <div class="top-menu-right-cgs">
  <a href="{{$page_info->discord_link}}" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="37.52" height="28.599" viewBox="0 0 37.52 28.599">
  <path id="Path_3919" data-name="Path 3919" d="M31.763,2.782A30.941,30.941,0,0,0,24.126.414.116.116,0,0,0,24,.472a21.552,21.552,0,0,0-.951,1.953,28.564,28.564,0,0,0-8.578,0A19.767,19.767,0,0,0,13.508.472a.12.12,0,0,0-.123-.058A30.855,30.855,0,0,0,5.748,2.782a.109.109,0,0,0-.05.043A31.666,31.666,0,0,0,.155,24.182a.129.129,0,0,0,.049.088,31.114,31.114,0,0,0,9.369,4.736.121.121,0,0,0,.132-.043,22.238,22.238,0,0,0,1.917-3.118.119.119,0,0,0-.065-.165,20.49,20.49,0,0,1-2.927-1.4.12.12,0,0,1-.012-.2c.2-.147.393-.3.581-.456a.116.116,0,0,1,.121-.016,22.189,22.189,0,0,0,18.856,0,.116.116,0,0,1,.123.015c.188.155.385.31.583.457a.12.12,0,0,1-.01.2,19.227,19.227,0,0,1-2.928,1.394.12.12,0,0,0-.064.167,24.969,24.969,0,0,0,1.915,3.116.119.119,0,0,0,.132.045,31.011,31.011,0,0,0,9.384-4.736.12.12,0,0,0,.049-.086A31.459,31.459,0,0,0,31.811,2.827.1.1,0,0,0,31.763,2.782ZM12.538,19.919a3.606,3.606,0,0,1-3.372-3.782,3.587,3.587,0,0,1,3.372-3.782,3.567,3.567,0,0,1,3.372,3.782A3.587,3.587,0,0,1,12.538,19.919Zm12.467,0a3.606,3.606,0,0,1-3.372-3.782,3.586,3.586,0,0,1,3.372-3.782,3.567,3.567,0,0,1,3.372,3.782A3.577,3.577,0,0,1,25.005,19.919Z" transform="translate(0 -0.412)" fill="#fff"/>
</svg><!--<img src="images/cm.svg">--></a>
  <a href="{{$page_info->twitter_link}}" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" id="Component_7_1" data-name="Component 7 – 1" width="35.208" height="28.557" viewBox="0 0 35.208 28.557">
  <path id="Path_2" data-name="Path 2" d="M49.149,30.557c13.3,0,20.538-10.954,20.538-20.538V9.042a15.9,15.9,0,0,0,3.521-3.716A16.237,16.237,0,0,1,69.1,6.5a7.61,7.61,0,0,0,3.13-3.912,17.941,17.941,0,0,1-4.5,1.76A6.985,6.985,0,0,0,62.45,2a7.349,7.349,0,0,0-7.237,7.237,3.813,3.813,0,0,0,.2,1.565A20.223,20.223,0,0,1,40.543,3.174a7.491,7.491,0,0,0-.978,3.716,7.771,7.771,0,0,0,3.13,6.064,6.594,6.594,0,0,1-3.325-.978h0a7.148,7.148,0,0,0,5.868,7.042,6.03,6.03,0,0,1-1.956.2,3.329,3.329,0,0,1-1.369-.2A7.41,7.41,0,0,0,48.758,24.1a14.768,14.768,0,0,1-9,3.13,5.415,5.415,0,0,1-1.76-.2,18.462,18.462,0,0,0,11.149,3.521" transform="translate(-38 -2)" fill="#fff" fill-rule="evenodd"/>
</svg> <!-- <img src="images/tweeter.svg">--></a>
                           
                       
            </div>

        </div>
    </div>


    <div class="flex-container">
<div class="logo-center text-center">
  <div class="">
<img src="{{ asset('public/uploads/')}}/{{$home_logo}}">
</div>
<p>{{$page_info->banner_content}}<br>{{$page_info->banner_content2}}</p>

<a href="{{$page_info->button_link}}" target="_blank" class="join-dis"> {{$page_info->button_name}}</a>
</div>
 </div>
  
   

  <div class="footer-sgc marquee">
    <div class="track" > 

<p>{{$page_info->footer_content}}</p> 

    </div>
</div>




</div>


<!---------------//splash screen//-------------------->

<div class="desktop-view">

    <header>
      <div class="container">
      <div class="row align-items-center">  
 <div class="col-md-6 snow-logo">
    <h3>  {{$landing->logo_name}}</h3>
     </div>
                 <div class="col-md-6 d-flex justify-content-end">
                    <div class="top-menu-right-cgs sgc-landing">
                             <a href="{{$landing->discord_link}}" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="37.52" height="21.4" viewBox="0 0 37.52 28.599">
  <path id="Path_3919" data-name="Path 3919" d="M31.763,2.782A30.941,30.941,0,0,0,24.126.414.116.116,0,0,0,24,.472a21.552,21.552,0,0,0-.951,1.953,28.564,28.564,0,0,0-8.578,0A19.767,19.767,0,0,0,13.508.472a.12.12,0,0,0-.123-.058A30.855,30.855,0,0,0,5.748,2.782a.109.109,0,0,0-.05.043A31.666,31.666,0,0,0,.155,24.182a.129.129,0,0,0,.049.088,31.114,31.114,0,0,0,9.369,4.736.121.121,0,0,0,.132-.043,22.238,22.238,0,0,0,1.917-3.118.119.119,0,0,0-.065-.165,20.49,20.49,0,0,1-2.927-1.4.12.12,0,0,1-.012-.2c.2-.147.393-.3.581-.456a.116.116,0,0,1,.121-.016,22.189,22.189,0,0,0,18.856,0,.116.116,0,0,1,.123.015c.188.155.385.31.583.457a.12.12,0,0,1-.01.2,19.227,19.227,0,0,1-2.928,1.394.12.12,0,0,0-.064.167,24.969,24.969,0,0,0,1.915,3.116.119.119,0,0,0,.132.045,31.011,31.011,0,0,0,9.384-4.736.12.12,0,0,0,.049-.086A31.459,31.459,0,0,0,31.811,2.827.1.1,0,0,0,31.763,2.782ZM12.538,19.919a3.606,3.606,0,0,1-3.372-3.782,3.587,3.587,0,0,1,3.372-3.782,3.567,3.567,0,0,1,3.372,3.782A3.587,3.587,0,0,1,12.538,19.919Zm12.467,0a3.606,3.606,0,0,1-3.372-3.782,3.586,3.586,0,0,1,3.372-3.782,3.567,3.567,0,0,1,3.372,3.782A3.577,3.577,0,0,1,25.005,19.919Z" transform="translate(0 -0.412)" fill="#fff"/>
</svg><!--<img src="images/cm.svg">--></a>
                              <a href="{{$landing->twitter_link}}" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" id="Component_7_1" data-name="Component 7 – 1" width="35.208" height="21.4" viewBox="0 0 35.208 28.557">
  <path id="Path_2" data-name="Path 2" d="M49.149,30.557c13.3,0,20.538-10.954,20.538-20.538V9.042a15.9,15.9,0,0,0,3.521-3.716A16.237,16.237,0,0,1,69.1,6.5a7.61,7.61,0,0,0,3.13-3.912,17.941,17.941,0,0,1-4.5,1.76A6.985,6.985,0,0,0,62.45,2a7.349,7.349,0,0,0-7.237,7.237,3.813,3.813,0,0,0,.2,1.565A20.223,20.223,0,0,1,40.543,3.174a7.491,7.491,0,0,0-.978,3.716,7.771,7.771,0,0,0,3.13,6.064,6.594,6.594,0,0,1-3.325-.978h0a7.148,7.148,0,0,0,5.868,7.042,6.03,6.03,0,0,1-1.956.2,3.329,3.329,0,0,1-1.369-.2A7.41,7.41,0,0,0,48.758,24.1a14.768,14.768,0,0,1-9,3.13,5.415,5.415,0,0,1-1.76-.2,18.462,18.462,0,0,0,11.149,3.521" transform="translate(-38 -2)" fill="#fff" fill-rule="evenodd"/>
</svg> <!-- <img src="images/tweeter.svg">--></a>

 <a href="{{$landing->top_button_link}}" target="_blank" class="world-btn">
{{$landing->top_button_name}}
  </a>
                           
                       
            </div>

        </div>
    </div>
</div>
</header>




<div class="container">

  <div class="row">
    



<div class="col-md-12">
  <div class="mission-team top-line">
<h2> FAQS</h2>
<p> YOU ASK, WE ANSWER</p>
</div>
<div class="demo-bar">
    
  <div class="panel-group mb-xd" id="accordion" role="tablist" aria-multiselectable="true">

   <?php $i=1;foreach($faqs as $key => $value){ ?>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading{{$i}}">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
                        <i class="more-less fa fa-plus"></i>
                       {{$value->page_title}}
                    </a>
                </h4> 

               
            </div>
              <div id="collapse{{$i}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$i}}">
                <div class="panel-body">
                      <?php echo $value->page_content; ?>
                </div>
            </div>
           
        </div>

      <?php $i++;} ?>

    </div><!-- panel-group -->   
</div><!-- container -->
</div></div></div>
<div class="foter-bg">
<div class="container">
<div class="row">
<div class="col-md-4">
<div class="help-bar">
<h4> HOW CAN WE HELP YOU?</h4>

<input type="email" name="hemail" id="hemail" placeholder="EMAIL ADDRESS" class="form-control">
<input type="text" name="hmessage" id="hmessage" placeholder="MESSAGE" class="form-control">

<button type="button" onclick="helpnotification()" class="sent-ftr">Send</button>
</div>

</div>

<div class="col-md-8">
  <div class="right-bars">
  <div class="footer-page">
  <ul> 
    <li><a href="{{url('/')}}">home </a> </li>
     <li><a href="{{url('/page/dashboard')}}">DASHBOARD </a> </li>
      <li><a href="{{url('/page/our-mission')}}">OUR MISSION </a> </li>
       <li><a href="{{url('/page/our-plan')}}">OUR PLAN </a> </li>
       <li><a href="{{url('/page/our-team')}}">OUR team </a> </li>
       <li><a href="{{url('/page/faqs')}}">FAQS </a> </li>
       <li><a href="{{url('/page/contact-us')}}">CONTACT US </a> </li>     
  </ul>
  <ul>
<li><a href="{{url('/page/donations')}}">DONATIONS </a> </li>
       <li><a href="{{url('/page/terms-condition')}}">TERMS & CONDITIONS </a> </li>
       <li><a href="{{url('/page/privacy-policy')}}">PRIVACY POLICY </a> </li>
       <li><a href="{{url('/page/whitepaper')}}">WHITEPAPER </a> </li>

     </ul>
</div>



</div>

</div>
</div>

</div>



</div>


<div class="botm-bar">
  <div class="container d-flex justify-content-between align-items-center" >
       <div class="copy-right">
        <p>{{$page_info->footer_copy}}</p>
      </div>


        <div class="d-right mt-2">
          <div class="fotr-icon">
 <a href="{{$landing->discord_link}}" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="30.52" height="22.599" viewBox="0 0 37.52 28.599">
  <path id="Path_3919" data-name="Path 3919" d="M31.763,2.782A30.941,30.941,0,0,0,24.126.414.116.116,0,0,0,24,.472a21.552,21.552,0,0,0-.951,1.953,28.564,28.564,0,0,0-8.578,0A19.767,19.767,0,0,0,13.508.472a.12.12,0,0,0-.123-.058A30.855,30.855,0,0,0,5.748,2.782a.109.109,0,0,0-.05.043A31.666,31.666,0,0,0,.155,24.182a.129.129,0,0,0,.049.088,31.114,31.114,0,0,0,9.369,4.736.121.121,0,0,0,.132-.043,22.238,22.238,0,0,0,1.917-3.118.119.119,0,0,0-.065-.165,20.49,20.49,0,0,1-2.927-1.4.12.12,0,0,1-.012-.2c.2-.147.393-.3.581-.456a.116.116,0,0,1,.121-.016,22.189,22.189,0,0,0,18.856,0,.116.116,0,0,1,.123.015c.188.155.385.31.583.457a.12.12,0,0,1-.01.2,19.227,19.227,0,0,1-2.928,1.394.12.12,0,0,0-.064.167,24.969,24.969,0,0,0,1.915,3.116.119.119,0,0,0,.132.045,31.011,31.011,0,0,0,9.384-4.736.12.12,0,0,0,.049-.086A31.459,31.459,0,0,0,31.811,2.827.1.1,0,0,0,31.763,2.782ZM12.538,19.919a3.606,3.606,0,0,1-3.372-3.782,3.587,3.587,0,0,1,3.372-3.782,3.567,3.567,0,0,1,3.372,3.782A3.587,3.587,0,0,1,12.538,19.919Zm12.467,0a3.606,3.606,0,0,1-3.372-3.782,3.586,3.586,0,0,1,3.372-3.782,3.567,3.567,0,0,1,3.372,3.782A3.577,3.577,0,0,1,25.005,19.919Z" transform="translate(0 -0.412)" fill="#fff"/>
</svg><!--<img src="images/cm.svg">--></a>
                              <a href="{{$landing->twitter_link}}" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" id="Component_7_1" data-name="Component 7 – 1" width="30.208" height="22.557" viewBox="0 0 35.208 28.557">
  <path id="Path_2" data-name="Path 2" d="M49.149,30.557c13.3,0,20.538-10.954,20.538-20.538V9.042a15.9,15.9,0,0,0,3.521-3.716A16.237,16.237,0,0,1,69.1,6.5a7.61,7.61,0,0,0,3.13-3.912,17.941,17.941,0,0,1-4.5,1.76A6.985,6.985,0,0,0,62.45,2a7.349,7.349,0,0,0-7.237,7.237,3.813,3.813,0,0,0,.2,1.565A20.223,20.223,0,0,1,40.543,3.174a7.491,7.491,0,0,0-.978,3.716,7.771,7.771,0,0,0,3.13,6.064,6.594,6.594,0,0,1-3.325-.978h0a7.148,7.148,0,0,0,5.868,7.042,6.03,6.03,0,0,1-1.956.2,3.329,3.329,0,0,1-1.369-.2A7.41,7.41,0,0,0,48.758,24.1a14.768,14.768,0,0,1-9,3.13,5.415,5.415,0,0,1-1.76-.2,18.462,18.462,0,0,0,11.149,3.521" transform="translate(-38 -2)" fill="#fff" fill-rule="evenodd"/>
</svg> <!-- <img src="images/tweeter.svg">--></a>
          </div>
      </div>



</div>
    </div>
  </div>
</div>
</div>
<!-- End #main -->

@endsection