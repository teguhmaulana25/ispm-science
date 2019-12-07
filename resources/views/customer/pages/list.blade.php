@extends('customer.layouts.frontend')
@section('title')Vacancy Listing @endsection

@section('content')
    <div class="page-header-area">
        <div class="container">
            <div class="head-text pgh">
                <h3>
                    <span>Vacancy Listing</span>
                    <div class="name-sub">{{ $data->name }}</div>
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
                            <a href="{{ route('detail_vacancy', [$data->id, $r['id']]) }}" class="btn btn-block btn-apply">Apply Now</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection