<?php 
  $setting = getConfigSettings();
?>

@extends('front.layout.app')  

@section('title', 'Refund Policy')  
@section('keywords', 'Refund Policy')  
@section('description', 'Refund Policy')  

@section('hero_section')

<x-home.breadcrumb :title="'Refund Policy'" :image="asset($data[0]->hero_thumbnail_image->file_name)" />

@endsection

@section('content') 

<div class="mad-content no-pd">
    <div class="container">
      <div class="mad-section" id="term_condi">
        <h2>Refund Policy</h3>
        {!! $data[0]->page_description !!}
      </div>
    </div>
  </div>

@endsection