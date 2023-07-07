<!DOCTYPE html>
<html lang="en">

<head>

 <title>Snow Globe Cities</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
     <!-- CSRF Token -->
 <meta name="csrf-token" content="{{ csrf_token() }}">  

  <link rel="stylesheet" href="{{ asset('resources/assets/snow/css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/snow/css/font-awesome.css')}}">
  <link rel="stylesheet" href="{{ asset('resources/assets/snow/css/master.css')}}"> 

  <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/snow/css/owl.carousel.css')}}">

  <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/snow/css/owl.theme.css')}}">
  
  <link rel="icon" href="{{ asset('resources/assets/snow/images/favicon.png')}}" type="image/x-icon"/>
 <link href="{{ asset('resources/assets/snow/fonts/NeuePlak-ExtendedBlack.ttf')}}" rel="stylesheet" type="text/css"/>

 <link href="{{ asset('resources/assets/snow/fonts/integralcf-heavy.ttf')}}" rel="stylesheet" type="text/css"/>

<link rel="icon" href="{{ asset('resources/assets/snow/images/favicon-b.png')}}" type="image/x-icon"/>

 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">
  
 <link href="{{ asset('resources/css/notification-custom.css') }}" rel="stylesheet" /> 

@yield('current_page_css')


<style type="text/css">
  @font-face {
  font-family: 'Neue Plak' 'integralcf-heavy';
  src: url('fonts/NeuePlak-ExtendedBlack.ttf'); 
  src: url('fonts/integralcf-heavy.ttf');
  src: url('fonts/NeuePlak-ExtendedBlack.ttf'), 
       url('fonts/NeuePlak-ExtendedBlack.ttf'), 
}
@font-face {
    font-family: integralcf-heavy;
    src: url('resources/assets/snow/fonts/integralcf-heavy.ttf') format('woff');
}
 body {
  font-size: 14px;
  font-weight: normal;
  width: 100%;
  background:#fff;
  font-family: 'NeuePlak-ExtendedBlack', 'integralcf-heavy', sans-serif;
  background:url('resources/assets/snow/images/landing-bg.svg');
  background-repeat: no-repeat;
  background-size: cover;
  background-position-y: 86% !important;
}
body:before {
    position: inherit;
    content: inherit;
    width: 100%;
    height: 100%;
    z-index: -1050;
    bottom: 0 !important;
    /* -webkit-backdrop-filter: blur(2px) contrast(60%); */
    background: rgb(255 255 255 / 0%);
    backdrop-filter: inherit;
    -webkit-backdrop-filter: inherit;
}

@media screen and (max-width: 767px) {

body {
    font-size: 14px;    
    width: 100%;
    background: #fff;
    background: url('resources/assets/snow/images/landing-bg.svg');
    background-size: cover;
   
}

</style>

</head>

<body>
 
      <!-- Navbar Header -->


 @yield('content')


 @yield('current_page_js')

      <!-- ./wrapper -->

<script src="{{ asset('resources/assets/snow/js/jquery.min.js')}}"></script>
<script src="{{ asset('resources/assets/snow/js/popper.min.js')}}"></script>
<script src="{{ asset('resources/assets/snow/js/bootstrap.min.js')}}"></script>
<!-- 
<script type="text/javascript" src="js/wow.min.js"></script> 
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
 -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.19/jquery.touchSwipe.min.js"></script>

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
 <script src="{{ asset('resources/js/notification-custom-script.js') }}"></script>

<script>

$(document).ready(function () {

  $(".carousel").carousel({
    interval: false,
    pause: true,
    touch: true
  });

  $(".carousel .carousel-inner").swipe({
    swipeLeft: function (event, direction, distance, duration, fingerCount) {
      this.parent().carousel("next");
    },
    swipeRight: function () {
      this.parent().carousel("prev");
    },
    threshold: 0,
    tap: function (event, target) {
      window.location = $(this).find(".carousel-item.active a").attr("href");
    },
    excludedElements: "label, button, input, select, textarea, .noSwipe"
  });

  $(".carousel .carousel-control-prev").on("click", function () {
    $(".carousel").carousel("prev");
  });

  $(".carousel .carousel-control-next").on("click", function () {
    $(".carousel").carousel("next");
  });

});

</script>



 <script type="text/javascript">
   
   function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('fa fa-plus fa fa-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);
 </script>

<script type="text/javascript">
  
  $(window).scroll(function() {
    if ($(this).scrollTop() > 250){  
        $('header').addClass("sticky");
    }
    else{
        $('header').removeClass("sticky");
    }
});
</script>


<script>
  jQuery(document).ready(function(){
    jQuery(".mobile-menu").click(function(){
      jQuery(".menu").slideToggle();
    });
  });
   wow = new WOW(
     {
       animateClass: 'animated',
       offset: 100
     }
   );
   wow.init();
</script>



   </body>

</html>