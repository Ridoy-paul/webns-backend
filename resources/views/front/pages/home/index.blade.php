<?php 
  $setting = getConfigSettings();
  $home_about_us = $data['home_about_us'];

  $home_facility_services = $data['facility_and_services'];
  $galleryData = $data['home_gallery'];
?>

@extends('front.layout.app')  

@section('title', $setting['meta_info']['meta_title'])  
@section('keywords', $setting['meta_info']['meta_keywords'])  
@section('description', $setting['meta_info']['meta_description'])  

@section('hero_section') <x-home.hero-video-section /> @endsection

@section('content') 



<div class="mad-content no-pd">
  <div class="container">
      
    <x-home.home-about-section :info="$home_about_us" />

    {{-- Home slider  --}}
    <div class="mad-section pt-5 room_and_suits no-pb mad-section--stretched-content-no-px mad-colorizer--scheme-color-">
      <div class="mad-title-wrap align-center">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="mad-pre-title">Special</div>
            <h2 class="mad-page-title">Homes & Villas</h2>
            <p class="mad-text-medium">Not your average convention hall. Park City Resort’s newly opened rivera complex is remixing meetings, conferences, exhibitions, weddings and grand events in its new home at the top of Cape Panwa in Phuket.</p>
          </div>
        </div>
      </div>
      <div class=" mad-section no-pd mad-section--stretched-content-no-px mad-colorizer--scheme-">
        <div class=" mad-entities single-entity style-2 mad-grid owl-carousel mad-grid--cols-1 no-dots">
          @foreach($data['sliders'] as $slide)
          <div class="mad-col">
            <div class="mad-section with-overlay mad-colorizer--scheme-" data-bg-image-src="{{ asset($slide->fileInfo->file_name) }}">
              <article class="mad-entity">
                <h3 class="mad-entity-title">{{ $slide->title }}</h3>
                <p>
                  {{ $slide->description }}
                </p>
                <div class="btn-set justify-content-center">
                  <a href="{{ $slide->button_1_link }}" class="btn btn-big">Book Now</a>
                  <a href="{{ $slide->button_2_link }}" class="btn btn-big style-2">Details</a>
                </div>
              </article>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
   
    <x-home.home-facility-services :info="$home_facility_services" />
   
   
    {{-- <div class="mad-title-wrap align-center">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="mad-pre-title">Make memories happen</div>
          <h2 class="mad-page-title">Special Offers </h2>
        </div>
      </div>
    </div>
   
    <div class="mad-section no-pt mad-section-pb-mobile mad-section--stretched-content-no-px mad-colorizer--scheme-color-2" >
      <div class="mad-entities mad-owl-center mad-pricing type-3 with-img-border mad-grid owl-carousel mad-owl-moving mad-grid--cols-2 nav-size-2 no-dots">
        <!-- owl item -->
        <div class="mad-grid-item">
          <!--================ Entity ================-->
          <article class="mad-entity">
            <div class="mad-entity-media mad-owl-center-img">
              <a href="{{ asset('frontend_asset/#') }}"><div class="ovr_hidden"><img class="animate-h-image" src="{{ asset('frontend_asset/images/880x712_img3.jpg') }}" alt="" /></div></a>
            </div>
            <div class="mad-entity-content mad-owl-center-element">
              <div class="mad-entity-inner">
                <h4 class="mad-entity-title">Stay Longer</h4>
                <p>
                  Mauris fermentum dictum magna. Sed laoreet aliquam leo.
                  Ut tellus dolor, dapibus eget, elementum vel, cursus
                  eleifend, elit. Aenean auctor wisi et urna.
                </p>
                <div class="mad-entity-footer">
                  <div class="mad-pricing-value">
                    <span>From</span>
                    <span class="mad-pricing-value-num"
                      >$299/<span>stay</span></span
                    >
                  </div>
                  <a href="{{ asset('frontend_asset/#') }}" class="btn btn-big">View offer</a>
                </div>
              </div>
            </div>
          </article>
          <!--================ End of Entity ================-->
        </div>
        <!-- / owl item -->
        <!-- owl item -->
        <div class="mad-grid-item">
          <!--================ Entity ================-->
          <article class="mad-entity">
            <div class="mad-entity-media mad-owl-center-img">
              <a href="{{ asset('frontend_asset/#') }}"><img src="{{ asset('frontend_asset/images/880x712_img5.jpg') }}" alt="" /></a>
            </div>
            <div class="mad-entity-content mad-owl-center-element">
              <div class="mad-entity-inner">
                <h4 class="mad-entity-title">E-Bike Sightseeing</h4>
                <p>
                  Mauris fermentum dictum magna. Sed laoreet aliquam leo.
                  Ut tellus dolor, dapibus eget, elementum vel, cursus
                  eleifend, elit. Aenean auctor wisi et urna.
                </p>
                <div class="mad-entity-footer">
                  <div class="mad-pricing-value">
                    <span>From</span>
                    <span class="mad-pricing-value-num"
                      >$99/<span>stay</span></span
                    >
                  </div>
                  <a href="{{ asset('frontend_asset/#') }}" class="btn btn-big">View offer</a>
                </div>
              </div>
            </div>
          </article>
          <!--================ End of Entity ================-->
        </div>
        <!-- / owl item -->
        <!-- owl item -->
        <div class="mad-grid-item">
          <!--================ Entity ================-->
          <article class="mad-entity">
            <div class="mad-entity-media mad-owl-center-img">
              <a href="{{ asset('frontend_asset/#') }}"><img src="{{ asset('frontend_asset/images/880x712_img4.jpg') }}" alt="" /></a>
            </div>
            <div class="mad-entity-content mad-owl-center-element">
              <div class="mad-entity-inner">
                <h4 class="mad-entity-title">Honeymoon Package</h4>
                <p>
                  Mauris fermentum dictum magna. Sed laoreet aliquam leo.
                  Ut tellus dolor, dapibus eget, elementum vel, cursus
                  eleifend, elit. Aenean auctor wisi et urna.
                </p>
                <div class="mad-entity-footer">
                  <div class="mad-pricing-value">
                    <span>From</span>
                    <span class="mad-pricing-value-num"
                      >$973/<span>stay</span></span
                    >
                  </div>
                  <a href="{{ asset('frontend_asset/#') }}" class="btn btn-big">View offer</a>
                </div>
              </div>
            </div>
          </article>
          <!--================ End of Entity ================-->
        </div>
        <!-- / owl item -->
      </div>
    </div> --}}

    <!-- Amenities & Ficilites Start -->
    <div class="mad-title-wrap align-center pt-3">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="mad-pre-title">Explore Activities</div>
          <h2 class="mad-page-title">Amenities & Facilities</h2>
        </div>
      </div>
    </div>
    
    <div class="mad-section no-pt amenities mad-section--stretched-content mad-colorizer--scheme-color-2 with-texture" style="margin-left: -207.5px; margin-right: -207.5px;"><div class="mad-colorizer-bg-color"></div>
      <div class="content-element-main">
        <div class="mad-entities with-bg-backplate  mad-grid mad-grid--cols-3  no-dots owl-loaded owl-carousel mad-grid--cols-2">
        <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-2409px, 0px, 0px); transition: 0.5s; width: 5421px;">

          @foreach($data['home_amenities'] as $amenity)
          <div class="owl-item img-hover" style="width: 570.333px; margin-right: 32px;">
              <div class="mad-col">
              <article class="mad-entity img-hover  shadow rounded border">
                <div class="mad-entity-media h-560">
                  <a href="blog_single_sidebar.html"><img src="{{ asset($amenity->amenities->file_info->file_name ?? '') }}" alt=""></a>
                </div>
                <div class="mad-entity-content">
                  <h4 class="mad-entity-title">{{ $amenity->amenities->name ?? '' }}</h4>
                  <p>
                    {{ $amenity->amenities->description ?? '' }}
                  </p>
                  {{-- <a href="pages_services.html#" class="mad-text-link">
                    <div class="link-container">
                      <span class="link-title1 title">Discover More</span>
                      <span class="link-title2 title">Discover More</span>
                    </div>
                  </a> --}}
                </div>
              </article>
            </div>
          </div>
          @endforeach

        </div></div><div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div><div class="owl-dots disabled"><button role="button" class="owl-dot active"><span></span></button></div></div>
      </div>
    </div>
   
    <!-- Parkcity Inside Gallery Start-->
    <div class="mad-section pt-3 pb-5">
      <div class="mad-title-wrap align-center">
        <div class="mad-pre-title">#Parkcity</div>
        <h2 class="mad-page-title">Our Inside Pictures</h2>
      </div>
      <div class="inside-img-glry">
        <div class="row">
          <!-- First Column: 2 Images in a Row -->
          <div class="col-4">
            <div class="row">
              @foreach ($galleryData->take(2) as $item)
                <div class="col-12 img-hover">
                  <a class="glry" data-gall="gallery01" href="{{ asset($item['file_info']['file_name']) }}">
                    <img src="{{ asset($item['file_info']['file_name']) }}" alt="">
                  </a>
                </div>
              @endforeach
            </div>
          </div>

          <!-- Second Column: 2 Large Images -->
          @foreach ($galleryData->slice(2, 2) as $item)
            <div class="col-8 h-80 img-hover">
              <a class="glry" data-gall="gallery01" href="{{ asset($item['file_info']['file_name']) }}">
                <img src="{{ asset($item['file_info']['file_name']) }}" alt="">
              </a>
            </div>
          @endforeach

          <!-- Third Column: 2 Images in a Row -->
          <div class="col-4">
            <div class="row">
              @foreach ($galleryData->slice(4, 2) as $item)
                <div class="col-12 img-hover">
                  <a class="glry" data-gall="gallery01" href="{{ asset($item['file_info']['file_name']) }}">
                    <img src="{{ asset($item['file_info']['file_name']) }}" alt="">
                  </a>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--================ Testimonials ================-->
    <div class="mad-testimonials">
      <div class="mad-title-wrap align-center">
        <div class="mad-pre-title">Reviews</div>
        <h2 class="mad-page-title">What Our Guests Say</h2>
      </div>
      
      <div class="mad-grid mad-grid--cols-1 owl-carousel no-dots   owl-loaded owl-drag">
        <div class="owl-stage-outer">
            <div class="owl-stage" style="transform: translate3d(-5421px, 0px, 0px); transition: all; width: 10842px;">

              @foreach ($data['home_reviews']->take(5) as $testimonial)
              <div class="owl-item" style="width: 1775px; margin-right: 32px;"><div class="mad-grid-item">
                  <div class="mad-testimonial">
                    <div class="mad-testimonial-info">
                      <blockquote>
                        <p class="test-feedback">
                          {!! $testimonial->review_feedback ?? '' !!}
                        </p>
                      </blockquote>
                    </div>
                    <div class="mad-author">
                      <div class="mad-author-info">
                        <span class="mad-author-name test-author">{{ $testimonial->guest_name ?? '' }}</span>
                        <a href="#"><img src="{{ asset($testimonial->fileInfo->file_name ?? '') }}" alt=""></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
              @endforeach

            </div>
          </div>
        <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div><div class="owl-dots"><button role="button" class="owl-dot"><span></span></button><button role="button" class="owl-dot active"><span></span></button></div></div>
    </div>

    <x-home.home-newsletter />

  </div>
</div>

@endsection