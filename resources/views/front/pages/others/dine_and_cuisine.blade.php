<?php 
 $dine_menu = json_decode(config('website_setting.dine'), true);
  
?>

@extends('front.layout.app')  

@section('title', 'Dine & Cuisine')
@section('keywords', 'Dine & Cuisine')  
@section('description', 'Dine & Cuisine')  

@section('style')
<style> 
    
</style>
@endsection

@section('hero_section') 
<x-home.breadcrumb :title="'Dine & Cuisine'" />
@endsection

@section('content') 
<div class="mad-content dine_cuisine pt-5">
    <div class="container-fluid">
      
      <nav class="mad-filter-wrap">
        <ul id="portfolio-filter" class="mad-filter justify-content-center">
          <li><a href="#" data-filter="*" class="{{ $title == 'all' ? 'mad-active' : '' }}">All</a></li>
          @foreach($dine_menu['sub_items'] as $dineMenu)
            <li><a href="#" class="{{ $title == Str::slug($dineMenu['title']) ? 'mad-active' : '' }}" data-filter=".mad-category-{{ $dineMenu['id'] }}">{{ $dineMenu['title'] }}</a></li>
          @endforeach
        </ul>
      </nav>
      
      <div data-isotope-layout="grid" data-isotope-filter="#portfolio-filter" class="mad-entities mad-pricing item-col-3 mad-grid--isotope type-7">
        <div class="mad-grid-sizer"></div>

        @foreach($galleries as $item)
        <div class="mad-grid-item mad-category-{{ $item->gallery_categorysuper_id }}">
          <article class="mad-entity shadow rounded border p-1 img-hover">
            <div class="mad-entity-media">
              <a class="dine_glry" data-gall="gallery02" href="{{ asset($item->file_info->file_name) ?? $item->id }}"><img src="{{ asset($item->file_info->file_name) ?? $item->id }}"/></a>
            </div>
            <div class="mad-entity-content">
              <h4 class="mad-entity-title">{{ $item->title }}</h4>
              <p>
                {{ $item->descriptions }}
              </p>
              <div class="mad-entity-footer">
                <div class="mad-pricing-value">
                  <span class="mad-pricing-value-num">৳ {{ $item->price }}</span>
                </div>
              </div>
            </div>
          </article>
        </div>
        @endforeach

      </div>
    </div>
  </div>

  <script src="{{ asset('frontend_asset/vendors/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('frontend_asset/js/modules/mad.isotope.js') }}"></script>

@endsection

@section('script')

<script>
    new VenoBox({
        selector: '.dine_glry',
        numeration: true,
        infinigall: true,
        share: true,
        spinner: 'rotating-plane'
    });
</script>
@endsection