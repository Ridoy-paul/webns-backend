<?php 
    $metaInfo = $metainfo;
?>

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
                                <input type="text" name="meta_title" class="form-control" value="{{ $metaInfo->meta_title ?? old('meta_title') }}" placeholder="Enter meta title" id="meta-title-input">
                            </div>
                        </div>
        
                        <div class="col-lg-12">
                            <div class="mb-2">
                                <label class="form-label" for="meta-keywords-input">Meta Keywords</label>
                                <input type="text" name="meta_keywords" class="form-control" value="{{ $metaInfo['meta_keywords'] ?? old('meta_keywords') }}" placeholder="Enter meta keywords" id="meta-keywords-input">
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
                                        <input type="hidden" name="meta_image" value="{{ $metaInfo['meta_image'] ?? '' }}" class="selected-files">
                                    </div>
                                    <div class="file-preview box sm">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <label class="form-label" for="meta-keywords-input">Tags</label>
                            <input type="text" name="meta_tags" class="form-control" value="{{ $metaInfo['meta_tags'] ?? old('meta_tags') }}" placeholder="Enter meta tags" id="meta-tag-input">
                        </div>
                        <div class="col-md-12 mt-2">
                            <label class="form-label" for="meta-description-input">Meta Description</label>
                            <textarea class="form-control" name="meta_description" id="meta-description-input" placeholder="Enter meta description" rows="2">{{ $metaInfo['meta_description'] ?? old('meta_description')}}</textarea>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>