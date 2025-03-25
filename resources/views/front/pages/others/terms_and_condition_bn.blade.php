<?php 
  $setting = getConfigSettings();
?>

@extends('front.layout.app')  

@section('title', 'শর্তাবলী')  
@section('keywords', 'শর্তাবলী')  
@section('description', 'শর্তাবলী')   

@section('hero_section')

<x-home.breadcrumb :title="'শর্তাবলী'" :image="asset($data[0]->hero_thumbnail_image->file_name)" />

@endsection

@section('content') 
<div class="mad-content no-pd">
  <div class="container">
    <div class="mad-section" id="term_condi">
      <h2>শর্তাবলী</h3>
      {!! $data[0]->page_description !!}
    </div>
  </div>
</div>
@endsection