@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Global Settings')}}</h5>
</div>

<form action="{{ route('global.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="title">{{translate('Title')}}</label>
                        <input type="text" placeholder="{{translate('Title')}}" value="{{optional($data)->title}}" name="title" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>{{translate('Phone')}}</label>
                        <input type="text" placeholder="{{translate('Phone')}}" value="{{optional($data)->phone}}" name="phone" class="form-control" >
                    </div>
                    <div class="form-group mb-3">
                        <label>{{translate('Email')}}</label>
                        <input type="email" placeholder="{{translate('Email')}}" value="{{optional($data)->email}}" name="email" class="form-control" >
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">{{translate('Address')}}</label>
                        <textarea name="address" rows="3" class="form-control"> {{optional($data)->address}} </textarea>
                    </div>
                
                    <div class="form-group mb-3">
                        <label for="name">{{translate('Body Start Script')}}</label>
                        <textarea name="body_start_scripts" rows="5" class="form-control">{{optional($data)->body_start_scripts}}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">{{translate('Body End Script')}}</label>
                        <textarea name="body_end_scripts" rows="5" class="form-control">{{optional($data)->body_end_scripts}}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">{{translate('Custom CSS')}}</label>
                        <textarea name="custom_css" rows="5" class="form-control">{{optional($data)->custom_css}}</textarea>
                    </div>

                    {{-- <x-meta-information :metainfo="$data" /> --}}

                    <div class="row my-2">
                        <div class="col-md-12">
                            <div id="accordion">
                                <div class="card">
                                  <div class="" id="metaInformationHeading">
                                      <button class="btn btn-link form-control text-left" type="button" data-toggle="collapse" data-target="#metaInformation-collaps" aria-expanded="false" aria-controls="metaInformation-collaps">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="text-primary mb-0" style="text-decoration: none !important;">Meta Information</h5>
                                            <i class="las la-angle-right"></i>
                                        </div>
                                      </button>
                                  </div>
                              
                                  <div id="metaInformation-collaps" class="collapse" aria-labelledby="metaInformationHeading" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="meta-title-input">Meta title</label>
                                                    <input type="text" name="meta_title" class="form-control" value="{{ optional($data)->meta_title ?? old('meta_title') }}" placeholder="Enter meta title" id="meta-title-input">
                                                </div>
                                            </div>
                            
                                            <div class="col-lg-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="meta-keywords-input">Meta Keywords</label>
                                                    <input type="text" name="meta_keywords" class="form-control" value="{{ optional($data)->meta_keywords ?? old('meta_keywords') }}" placeholder="Enter meta keywords" id="meta-keywords-input">
                                                </div>
                                            </div>
                    
                                            <div class="col-lg-12">
                                                <div class="form-group ">
                                                    <label class="col-form-label" for="signinSrEmail">{{translate('Meta Image')}} <small>(290x300)</small></label>
                                                    <div class="">
                                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                                            </div>
                                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                            <input type="hidden" name="meta_image" value="{{ optional($data)->meta_image ?? '' }}" class="selected-files">
                                                        </div>
                                                        <div class="file-preview box sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <div class="col-lg-12">
                                                <label class="form-label" for="meta-keywords-input">Tags</label>
                                                <input type="text" name="meta_tags" class="form-control" value="{{ optional($data)->meta_tags ?? old('meta_tags') }}" placeholder="Enter meta tags" id="meta-tag-input">
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label class="form-label" for="meta-description-input">Meta Description</label>
                                                <textarea class="form-control" name="meta_description" id="meta-description-input" placeholder="Enter meta description" rows="2">{{ optional($data)->meta_description ?? old('meta_description')}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                        
                    <div class="form-group mb-3 text-right">
                        <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>{{translate('Logo')}}</label>
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="logo" value="{{ optional($data)->logo }}" class="selected-files">
                        </div>
                    
                        <div class="file-preview box sm">
                        </div>                        
                    </div>

                    <div class="form-group mb-3">
                        <label>{{translate('Favicon')}}</label>
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="favicon" value="{{ optional($data)->favicon }}" class="selected-files">
                        </div>
                        
                        <div class="file-preview box sm">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label>{{translate('Facebook')}}</label>
                        <input type="text" placeholder="{{translate('Facebook')}}" value="{{optional($data)->facebook}}" name="facebook" class="form-control" >
                    </div>    
                    <div class="form-group mb-3">
                        <label>{{translate('Instagram')}}</label>
                        <input type="text" placeholder="{{translate('Instagram')}}" value="{{optional($data)->instagram}}" name="instagram" class="form-control" >
                    </div>    
                    <div class="form-group mb-3">
                        <label>{{translate('Whatsapp')}}</label>
                        <input type="text" placeholder="{{translate('Whatsapp')}}" value="{{optional($data)->whatsapp}}" name="whatsapp" class="form-control" >
                    </div>    
                    <div class="form-group mb-3">
                        <label>{{translate('Linkedin')}}</label>
                        <input type="text" placeholder="{{translate('Linkedin')}}" value="{{optional($data)->linkedin}}" name="linkedin" class="form-control" >
                    </div>    
                    <div class="form-group mb-3">
                        <label>{{translate('Twitter')}}</label>
                        <input type="text" placeholder="{{translate('Twitter')}}" value="{{optional($data)->twitter}}" name="twitter" class="form-control" >
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
