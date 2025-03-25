<footer id="mad-footer" class="mad-footer footer-2 py-5">
    <div class="mad-footer-main">
      <div class="container-fluid">
        <div class="row justify-content-between vr-size-2">
          <div class="col-xl-3 col-lg-6 col-md-6">
            <section class="mad-widget">
              <a href="{{ route('index') }}" class="mad-logo content-element-3">
                <img style="width: 160px;" src="{{ asset($setting['fav_icon_file']['file_name']) }}" alt="{{ $setting['title'] }}"/>
              </a>
              <div class="mad-vr-list">
                <ul>
                  <li>Bioclimatic Resort Entertainment & Fantasy.</li>
                  <li><b>Trade License Number:</b> {{ $setting['trade_license_number'] }}</li>
                  <li><b>Vat Registration Number:</b> {{ $setting['vat_registration_number'] }}</li>
                </ul>
              </div>
            </section>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-3">
            <!--================ Widget ================-->
            <section class="mad-widget">
              <h6 class="mad-widget-title">Menu</h6>
              <div class="mad-vr-list menu">
                <ul>
                 
                  <li>
                    <a href="{{url('about-us')}}" class="mad-text-link">
                      <div class="link-container">
                        <span class="link-title1 title">About Us</span>
                        <span class="link-title2 title">About Us</span>
                      </div>
                    </a>
                  </li>

                  <li>
                    <a href="{{url('privacy-policy')}}" class="mad-text-link">
                      <div class="link-container">
                        <span class="link-title1 title">Privacy Policy</span>
                        <span class="link-title2 title">Privacy Policy</span>
                      </div>
                    </a>
                  </li>
                 
                  <li>
                    <a href="{{url('terms-and-condition')}}" class="mad-text-link">
                      <div class="link-container">
                        <span class="link-title1 title">Terms And Condition</span>
                        <span class="link-title2 title">Terms And Condition</span>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a  href="{{url('terms-and-condition-bn')}}" class="mad-text-link">
                      <div class="link-container">
                        <span class="link-title1 title">Terms And Condition Bangla</span>
                        <span class="link-title2 title">Terms And Condition Bangla</span>
                      </div>
                    </a>
                  </li>
                  
                  <li>
                    <a href="{{url('refund-policy')}}" class="mad-text-link">
                      <div class="link-container">
                        <span class="link-title1 title">Refund Policy</span>
                        <span class="link-title2 title">Refund Policy</span>
                      </div>
                    </a>
                  </li>
                 
                  <li>
                    <a href="{{url('contact-us')}}" class="mad-text-link">
                      <div class="link-container">
                        <span class="link-title1 title">Contact Us</span>
                        <span class="link-title2 title">Contact Us</span>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </section>
            <!--================ End of Widget ================-->
          </div>
          {{-- <div class="col-xl-3 col-lg-3 col-md-3">
            <section class="mad-widget">
              <h6 class="mad-widget-title">Rooms & Suits</h6>
              <div class="mad-vr-list menu">
                <ul>
                  <li>
                    <a href="{{ asset('frontend_asset/#') }}" class="mad-text-link">
                      <div class="link-container">
                        <span class="link-title1 title">Classic</span>
                        <span class="link-title2 title">Classic</span>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="{{ asset('frontend_asset/#') }}" class="mad-text-link">
                      <div class="link-container">
                        <span class="link-title1 title">Superior</span>
                        <span class="link-title2 title">Superior</span>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="{{ asset('frontend_asset/#') }}" class="mad-text-link">
                      <div class="link-container">
                        <span class="link-title1 title">Deluxe</span>
                        <span class="link-title2 title">Deluxe</span>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="{{ asset('frontend_asset/#') }}" class="mad-text-link">
                      <div class="link-container">
                        <span class="link-title1 title">Master</span>
                        <span class="link-title2 title">Master</span>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </section>
          </div> --}}
          <div class="col-xl-3 col-lg-6 col-md-6">
            <section class="mad-widget">
              <h6 class="mad-widget-title">Stay Connected</h6>
              <div class="mad-vr-list menu">
                <ul>
                  <li>
                    <a href="{{ $setting['facebook'] }}" class="mad-text-link">
                      <div class="link-container">
                        <span class="link-title1 title">Facebook</span>
                        <span class="link-title2 title">Facebook</span>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="{{ $setting['instagram'] }}" class="mad-text-link">
                      <div class="link-container">
                        <span class="link-title1 title">Instagram</span>
                        <span class="link-title2 title">Instagram</span>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="{{ $setting['twitter'] }}" class="mad-text-link">
                      <div class="link-container">
                        <span class="link-title1 title">Twitter</span>
                        <span class="link-title2 title">Twitter</span>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="{{ $setting['linkedin'] }}" class="mad-text-link">
                      <div class="link-container">
                        <span class="link-title1 title">Linkedin</span>
                        <span class="link-title2 title">Linkedin</span>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </section>
          </div>
          <div class="col-xl-3 col-lg-6 col-md-6">
            <section class="mad-widget">
              <h6 class="mad-widget-title">Contact Us</h6>
              <div class="mad-vr-list">
                <ul>
                  <li>{{ $setting['address'] }}</li>
                  <li><b>Hotline:</b> {{ $setting['phone'] }}</li>
                  <li>
                    <b>Email:</b>
                    <a href="mail.to:{{ $setting['email'] }}" class="mad-link">{{ $setting['email'] }}</a>
                  </li>
                </ul>
              </div>
            </section>
          </div>

        </div>
       
        <div class="mad-footer-bottom">
          <div class="row">
            <div class="col-md-4">
              <img style="border-radius: 10px;" src="{{ asset('assets/img/common/sslcommerz.jpg') }}" alt="">
            </div>

            <div class="col-md-5">
              <p style="text-align: justify;">
                Surrounded by scenic beauty and attractive tourist attractions we make it convenient for you to visit all the beautiful places with our inhouse guide. We can also help you arrange transport facilities for an easier commute to nearby places.
              </p>
            </div>
            
            <div class="col-md-3">
              <p class="copyrights align-center">
                Copyright © {{ date('Y') }} <a href="{{ route('index') }}">ParkCity Resort</a>. All Rights Reserved.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
</footer>