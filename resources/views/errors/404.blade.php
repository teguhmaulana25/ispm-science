@extends('customer.layouts.frontend')
@section('title')Page not found - 404 @endsection

@section('content')
 <div class="container">
    <div class="row">
      <div class="col">
        <div class="section-padding-50 content-page-wrap text-center mt-5">
          <div class="icon">
            <img src="{{ asset('img/error-404.png') }}" class="img-fluid" alt="">
          </div>
          <h1>We Are Sorry, Page Not Found (404)</h1>
          <p>Unfortunately the page you were looking for could not be found. It may be temporarily unavailable, moved or no longer exist. Check the Url you entered for any mistakes and try again.</p>
          <a href="/" class="btn btn-primary">Back To Homepage</a>
        </div>
      </div>
    </div>
  </div>
@endsection