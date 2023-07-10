<!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5 logo-new">
                <?php $home_logo = $page_info->home_logo; ?>
                <a class="navbar-brand" href="index.html"><img src="{{ asset('public/uploads/')}}/{{$home_logo}}"></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link current" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Rent</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Share</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Ride</a></li>
                    </ul>
          <div class="header-info">
            <div class="lang">
              <a href="#"><i class="bi bi-translate"></i></a>
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