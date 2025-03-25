<?php 
  $setting = getConfigSettings();
?>

@extends('front.layout.app')  

@section('title', 'Privacy Policy')  
@section('keywords', 'Privacy Policy')  
@section('description', 'Privacy Policy')  

@section('hero_section')

<x-home.breadcrumb :title="'Privacy Policy'" :image="asset($data[0]->hero_thumbnail_image->file_name)" />

@endsection

@section('content') 

 <div class="mad-content no-pd">
  <div class="container">
    <div class="mad-section" id="term_condi">
      <h4>Privacy Policy</h4>
      <div class="privacy pt-0 ps-5">
        {!! $data[0]->page_description !!}
      </div>
    </div>
  </div>
</div>

@endsection