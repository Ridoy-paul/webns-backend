
@extends('front.layout.app')  


@section('hero_section') 

@endsection

@section('content') 

 <!--================ End of Header ================-->
 <div class="mad-content no-pd">
    <div class="container">
      <div class="mad-404-content">
        <div class="row justify-content-center">
          <div class="col-xxl-6">
            <div class="content-element-3 align-center">
              <h1 class="mad-404-title">404</h1>
              <h6>
                We're sorry, but we can't find the page you were looking
                for.
              </h6>
            </div>
            <p class="align-center mad-text-medium">
              It's probably some thing we've done wrong but now we know
              about it and we'll try to fix it. <br />
              Go <a href="{{url('')}}" class="mad-link color-2">Home</a> or try to
              search:
            </p>
            <form
              class="one-line justify-content-center"
            >
              <div class="mad-col">               
              </div>
              <div class="mad-col">
                <a class="btn btn-huge btn-style-3" href="{{url('')}}">
                  Back to Home
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection