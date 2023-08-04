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
.logo-center strong{
  font-weight:500;
} 

</style>

@endsection

@section('current_page_js')


</script>


@endsection

@section('content')

<div class="main_wrapper">




<!---------------//splash screen//-------------------->

<div class="desktop-view">

  

    <div class="container" style="padding-top: 150px;height:auto;">
<div class="logo-center" style="padding-left:22px;padding-right:22px;text-align: justify;">
  <h2 class="text-center">{{ $page_content->page_title }}</h2>
{!! $page_content->page_content !!}

</div>
 </div>



  </div>
</div>
</div>
<!-- End #main -->

@endsection