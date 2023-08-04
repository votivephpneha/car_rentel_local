<script type="text/javascript">
  $(function() {
    $("form[name='bookingForm']").validate({
      rules: {
        email_address: {
            email:true,
            required: true,
        }

      },
      submitHandler: function (form) {
        form.submit();
      }
    });
  });
</script>
<!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container px-4 px-lg-5 logo-new">
                <?php $home_logo = $page_info->home_logo; ?>
                <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('public/uploads/')}}/{{$home_logo}}"></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        
                        <li class="nav-item"><a class="nav-link current" href="#">{{ __('messages.Menu1') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">{{ __('messages.Menu2') }}</a></li>
                        
                    </ul>
          <div class="header-info">
            <div class="lang">
              <a href="#"><i class="bi bi-translate"></i></a>
              <form method="post" action="{{ url('/manage_booking') }}">
                @csrf
                <div class="single-input">
                  <span><i class="bi bi-person"></i></span>
                  <input type="text" name="booking_id" placeholder="Booking Number" required="">
                </div>
                <div class="single-input">
                  <span><i class="bi bi-envelope"></i></span>
                  <input type="email" name="email" placeholder="Email Address" required="">
                </div>
                <div class="single-input submit-btn">
                  <input type="submit" value="Submit">
                </div>
              </form>
            </div>
            <div class="login">
              <a href="#"><i class="bi bi-person-circle"></i></a>
            </div>
            <div class="cart">
              <a href="#"><i class="bi bi-cart3"></i></a>
            </div>
          </div>
                </div>
            </div>
        </nav>