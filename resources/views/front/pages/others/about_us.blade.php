<?php 
  $setting = getConfigSettings();
  $about_us = $data['about_us'][0];
  // print_r($about_us->meta_info_details);die;
?>

@extends('front.layout.app')  

@section('title', $about_us->meta_info_details->meta_title)  
@section('keywords', $about_us->meta_info_details->meta_keywords)  
@section('description', $about_us->meta_info_details->meta_description)  

@section('hero_section') 

<x-home.breadcrumb :title="'About Us'" :image="asset($about_us->hero_thumbnail_image->file_name)" />

@endsection

@section('content') 

<div class="mad-content no-pd">
    <div class="container">
      <div class="mad-section">
        <div class="mad-entities mad-entities-reverse type-4">
          <!--================ Entity ================-->
          <article class="mad-entity">
            <div class="mad-entity-media">
              <img src="{{ uploaded_asset($about_us->thumbnail) }}" alt="">
            </div>
            <div class="mad-entity-content">
              <div class="mad-entity-pre-title">time to reconnect</div>
              <h2 class="mad-entity-title">
                ParkCity Resort
              </h2>
              
              <p>
                {!! $about_us->page_description !!}
              </p>
            </div>
          </article>
          <!--================ End of Entity ================-->
        </div>
      </div>

      <!-- Visit Youtube Channel -->
      <div class="mad-section ">
        <h2>Visit Our Youtube Channel...</h2>
        <div class="  type-2  d-flex justify-content-between align-items-stretch flex-wrap item-col-3">
          <div class="mad-col">
            <iframe src="https://www.youtube.com/embed/YNgUvvG1dE8" title="the PARKCITY RESORT_Dec 2023 (Recent Aerial View) পার্কসিটি রিসোর্ট, আমিন বাজার, ঢাকা" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen=""></iframe>
          </div>
          <div class="mad-col">
            <iframe src="https://www.youtube.com/embed/YNgUvvG1dE8" title="the PARKCITY RESORT_Dec 2023 (Recent Aerial View) পার্কসিটি রিসোর্ট, আমিন বাজার, ঢাকা" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen=""></iframe>
          </div>
          <div class="mad-col">
            <iframe src="https://www.youtube.com/embed/YNgUvvG1dE8" title="the PARKCITY RESORT_Dec 2023 (Recent Aerial View) পার্কসিটি রিসোর্ট, আমিন বাজার, ঢাকা" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen=""></iframe>
          </div>
        </div>
      </div>
     
    </div>
</div>
@endsection