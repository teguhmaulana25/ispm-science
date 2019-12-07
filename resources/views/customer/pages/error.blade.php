@extends('customer.layouts.frontend')
@section('title')Apply Vacancy Error @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-padding-50 content-page-wrap text-center mt-5">
                    <div class="icon">
                        <img src="{{ asset('img/cross.svg') }}" class="img-fluid" alt="" width="180">
                    </div>
                    <h1>Your application has been rejected, you've applied in this vacancy before.</h1>
                    <a href="/" class="btn btn-primary">Back To Homepage</a>
                </div>
          </div>
        </div>
    </div>
@endsection