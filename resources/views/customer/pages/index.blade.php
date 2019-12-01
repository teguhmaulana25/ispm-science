@extends('customer.layouts.frontend')
@section('title')Homepage @endsection

@section('content')
    <div class="block-top-banner">
        <span class="shape-1"></span>
        <span class="shape-2"></span>
        <div class="container">
            <div class="main-text-banner">
                <h3>If you’re looking for <span>a job</span><br>Dumet is not for you</h3>
                <p>If you want to go on an adventure where you’ll build a better future and solve challenging problems,<br>
                Dumet may be for you.</p>
            </div>
            <div class="main-image-banner" style="background-image: url({{ asset('img/main-banner.jpg') }});"></div>
        </div>
        <div class="scroll-to">
            <a href="#scroll-here" title=""><i class="la la-arrow-down"></i></a>
        </div>
    </div>
    <div class="container">
        <div class="head-text">
            <h3>
                <span>My Vacancy</span>
            </h3>
            <p class="sub-head">Start finding your purpose with Dumet School. See our latest vacancies below.</p>
        </div>
        <div>
            <div class="row catagory-clasification d-flex justify-content-center">
                @foreach($job_arr as $row)
                <div class="col-lg-3 col-sm-6">
                    <div class="catagory-clasification-part text-center @if($row->available == 0) not @endif">
                        <h3>{{ $row->name }}</h3>
                        <p>({{ ($row->available != 0)? $row->available : "No" }} Jobs Available)</p>
                        <div class="catagory-clasification-part-overlay">
                            <h3>{{ $row->name }}</h3>
                            <p>({{ ($row->available != 0)? $row->available : "No" }} Jobs Available)</p>
                            @if($row->available != 0)
                            <a href="#">View Jobs</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection