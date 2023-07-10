<!-- Footer-->
        <footer class="bg-light py-5 footer-main">
      <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 ftr-upr">
          <div class="col-lg-3 col-sm-3 mb-4">
            <div class="ftr-info">
              <h4>Get In Touch</h4>
              <p>Cu qui probo malorum saperet. Ne admodum apeirian iracundia usu.</p>
            </div>
            <div class="social-info">
              <a href="#"><i class="bi bi-instagram"></i></a> <a href="#"><i class="bi bi-whatsapp"></i></a>
            </div>
                    </div>
          <div class="col-lg-3 col-sm-3 mb-4">
            <div class="ftr-info">
              <h4>Important Links</h4>
              <ul class="list-menu-ftr">
                <li><a href="#"><span>></span> Home</a></li>
                @foreach($pages as $page)
                <li><a href="{{ url('page') }}/{{ $page->page_url }}"><span>></span> {{ $page->page_title }}</a></li>
                
                @endforeach
              </ul>
            </div>
                    </div>
          <div class="col-lg-3 col-sm-3 mb-4">
            <div class="ftr-info">
              <h4>Popular Locations</h4>
              <ul class="list-menu-ftr">
                <li><a href="#"><span>></span> Milano</a></li>
                <li><a href="#"><span>></span> Firenze</a></li>
                <li><a href="#"><span>></span> Torino</a></li>
                <li><a href="#"><span>></span> Tirana</a></li>
              </ul>
            </div>
                    </div>
          <div class="col-lg-3 col-sm-3 mb-4">
            <div class="ftr-info">
              <h4>Featured Makes</h4>
              <ul class="list-menu-ftr">
                <li><a href="#"><span>></span> Audi</a></li>
                <li><a href="#"><span>></span> Mercedes Benz</a></li>
                <li><a href="#"><span>></span> KIA</a></li>
                <li><a href="#"><span>></span> BMW</a></li>
              </ul>
            </div>
                    </div>
        </div>
      </div>
            <div class="container px-4 px-lg-5 ftr-btm"><div class="small text-center">© 2023 Royal Car Rental</div></div>
        </footer>