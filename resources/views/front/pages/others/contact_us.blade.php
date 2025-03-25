<?php 
  $setting = getConfigSettings();
?>

@extends('front.layout.app')  

@section('title', 'Contact Us')  
@section('keywords', 'Contact Us')  
@section('description', 'Contact Us')  

@section('hero_section')

<x-home.breadcrumb :title="'Contact Us'" :image="asset($data[0]->hero_thumbnail_image->file_name)" />

@endsection

@section('content') 

<div class="mad-content no-pd">
    <div class="container">
      <div class="mad-section pb-5">
        <div class="row vr-size-2">
          <div class="col-lg-5">
            <div class="mad-title-wrap">
              <div class="mad-pre-title">Contact Details</div>
              <h2 class="mad-section-title">Get In Touch</h2>
            </div>
            <div class="mad-vr-list mad-text-medium content-element-3">
              <ul>
                <li>ParkCity Resort, Ping Food Industrial Park, Aminbazar, Savar, Dhaka-1348, Bangladesh</li>
                <li><b>Phone:</b> +880 132 11 00 800</li>
                <li>
                  <b>Email:</b>
                  <a href="#" class="mad-link">parkcitybd@gmail.com</a>
                </li>
              </ul>
            </div>
            <div class="mad-social-icons">
              <ul>
                <li>
                  <a href="#"><i class="fab fa-facebook-f"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fab fa-instagram"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fab fa-twitter"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fab fa-tripadvisor"></i></a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-7">

            
            <form action="{{ route('contact.store') }}" method="POST" class="mad-form type-2 item-col-2">
              @csrf
              <div class="mad-col">
                
                <div class="mad-form-item">
                  <label>Name *</label>
                  <input
                    type="text"
                    id="name"
                    name="name"
                    required=""
                    placeholder="Name"
                  />
                </div>
                
                <div class="mad-form-item">
                  <label>Email *</label>
                  <input
                    type="email"
                    id="email"
                    name="email"
                    required=""
                    placeholder="Email Address"
                  />
                </div>
                <div class="mad-form-item">
                  <label>Phone number</label>
                  <input
                    type="tel"
                    id="phone_number"
                    name="phone_number"
                    placeholder="Phone Number"
                  />
                </div>
              </div>
              <div class="mad-col">
                
                <div class="mad-form-item full-height">
                  <label>Message *</label>
                  <textarea
                    rows="5"
                    id="message"
                    name="message"
                    required=""
                    placeholder="Message"
                  ></textarea>
                </div>
                <div class="mad-form-item">

                  

                  <button type="submit" class="btn btn-big">
                    <span>Submit</span>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="py-5" >
        <div class="row">
            <div class="col-md-12">
                <div class="gle-map mb-0 pb-0">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.750228453717!2d90.31442067533725!3d23.791907078642087!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c15c8312404d%3A0xda9c914a51cae570!2sParkcity%20Resort!5e0!3m2!1sen!2sid!4v1723006145221!5m2!1sen!2sid"   height="850" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection