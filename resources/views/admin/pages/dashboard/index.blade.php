@extends('admin.layouts.admin')
@section('title')Dashboard @endsection
@push('css')
    <meta http-equiv="refresh" content="60">
@endpush
@section('breadcrumb')
    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
@endsection
@section('content')
  <div class="row">
    <div class="col-sm-4">
      <div class="widget no-border p-15 bg-success media">
        <div class="media-left media-middle"><i class="media-object fa fa-users fs-36"></i></div>
        <div class="media-body">
          <h6 class="m-0">Candidate</h6>
          <div class="fs-20">{{ $count_candidate }} </div>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="widget no-border p-15 bg-danger media">
        <div class="media-left media-middle"><i class="media-object fa fa-suitcase fs-36"></i></div>
        <div class="media-body">
          <h6 class="m-0">Job Vacancy Active</h6>
          <div class="fs-20">{{ $count_job_vacancy }} </div>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="widget no-border p-15 bg-info media">
        <div class="media-left media-middle"><i class="media-object fa fa-tags fs-36"></i></div>
        <div class="media-body">
          <h6 class="m-0">Division</h6>
          <div class="fs-20">{{ $count_division }} </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="widget">
        <div class="widget-body text-center">
          <h3>Hello <span class="text-success">{{ Auth::user()->name }}</span></h3>
          <h3>Welcome to Admin Dumet HR</h3>
        </div>
      </div>
    </div>
  </div>
@endsection
