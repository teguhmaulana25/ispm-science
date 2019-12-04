@extends('customer.layouts.frontend')
@section('title')Detail Vacancy @endsection

@section('content')
    <div class="page-header-area">
        <div class="container">
            <div class="head-text pgh">
                <h3>
                    <span>Detail Vacancy</span>
                </h3>
                <p class="sub-head"><a href="/" class="brd breadcrumb-a">Home</a><a href="{{ route('list_vacancy',$id_div) }}" class="brd breadcrumb-a">Vacancy Listing</a><span class="brd breadcrumb-active">Detail Vacancy</span></p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 vc-detail pb-4">
                <h3 class="pb-2 mt-4 mb-4 border-bottom">
                    {{ $data['title'] }}
                </h3>
                <div class="row">
                    <div class="col-xl-7 col-lg-8 mb-4">
                        {!! $data['description'] !!}
                    </div>
                    <div class="col-xl-4 offset-xl-1 col-lg-4">
                        <div class="vc-summary">
                            <h5 class="pb-2 mb-2">
                                Vacancy Summary
                            </h5>
                            <div class="vc-info-date"><span>Published on: </span> {{ date('j F Y', strtotime($data['start_date'])) }}</div>
                            <div class="vc-info-date"><span>Application Deadline: </span> {{ date('j F Y', strtotime($data['end_date'])) }}</div>
                        </div>
                        <a href="#" class="btn btn-block btn-apply active-btn mt-3">Apply Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection