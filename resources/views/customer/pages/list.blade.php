@extends('customer.layouts.frontend')
@section('title')List Vacancy @endsection

@section('content')
    <div class="page-header-area">
        <div class="container">
            <div class="head-text pgh">
                <h3>
                    <span>Vacancy Listing</span>
                    <div class="division-name">{{ $data->name }}</div>
                </h3>
                <p class="sub-head"><a href="/" class="brd breadcrumb-a">Home</a><span class="brd breadcrumb-active">Vacancy Listing</span></p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="block-vc-list">
            <div class="row">
                @foreach($vacancies as $r)
                <div class="col-md-6">
                    <div class="vc-list">
                        <div class="vc-desc">
                            <h4>{{ $r['title'] }}</h4>
                            <span class="vc-time"><span class="text-dl">Deadline</span> {{ date('j F Y', strtotime($r['end_date'])) }}</span>
                        </div>
                        <div class="vc-apply">
                            <a href="#" class="btn btn-block btn-apply">Apply Now</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection