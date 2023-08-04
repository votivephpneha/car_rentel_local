@extends('front.layout.layout')
@section('title', 'Car List Page')

@section('current_page_css')
@endsection

@section('current_page_js')

@section('content')
<!-- Category-->
<section class="page-section title-banner">
    <div class="container px-4 px-lg-5">
        <div class="row head_rgt">
            <div class="col-lg-12">
                <h2 class="text-white mt-0 mb-0">Thank You</h2>
            </div>
        </div>         
    </div>
</section>
        

<!-- Call to action-->
<section class="page-section thankyou">
    <div class="container px-4 px-lg-5">
        <div class="block-tq">
        {!! __('messages.thankyoucontent') !!}
        <div class="continue_btn">
            <a href="{{ url('/') }}">{{ __('messages.thankyoubtn') }}</a>
            
        </div>
        </div>
    </div>
</section>
@endsection