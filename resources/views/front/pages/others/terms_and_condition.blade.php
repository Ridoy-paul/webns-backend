@extends('front.layout.app')  

@section('title', 'Terms & Conditions')  
@section('keywords', 'Terms & Conditions')  
@section('description', 'Terms & Conditions')  

@section('hero_section')

<x-home.breadcrumb :title="'Terms & Conditions'" :image="asset($data[0]->hero_thumbnail_image->file_name)" />

@endsection

@section('content') 

<div class="mad-content no-pd">
    <div class="container">
      <div class="mad-section" id="term_condi">
            <h2>Terms and Conditions</h3>
            {!! $data[0]->page_description !!}
      </div>
    </div>
  </div>
@endsection