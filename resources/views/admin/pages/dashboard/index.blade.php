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
        <div class="col-md-8">
          <div class="widget">
            <div class="widget-heading clearfix">
              <h3 class="widget-title pull-left">Order Status</h3>
              <ul class="widget-tools pull-right list-inline">
                <li><a href="javascript:;" class="widget-collapse"><i class="ti-angle-up"></i></a></li>
                <li><a href="javascript:;" class="widget-reload"><i class="ti-reload"></i></a></li>
                <li><a href="javascript:;" class="widget-remove"><i class="ti-close"></i></a></li>
              </ul>
            </div>
            <div class="widget-body">
              <div id="flot-order" style="height: 302px"></div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="row">
            <div class="col-sm-6">
              <div class="widget no-border p-15 bg-purple media">
                <div class="media-left media-middle"><i class="media-object ti-shopping-cart fs-36"></i></div>
                <div class="media-body">
                  <h6 class="m-0">Transactions</h6>
                  <div class="fs-20">685 <span class="fs-12"><i class="ti-arrow-up fs-10"></i> 8%</span></div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="widget no-border p-15 bg-success media">
                <div class="media-left media-middle"><i class="media-object ti-user fs-36"></i></div>
                <div class="media-body">
                  <h6 class="m-0">Sales</h6>
                  <div class="fs-20">532 <span class="fs-12"><i class="ti-arrow-up fs-10"></i> 4%</span></div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="widget no-border p-15 bg-danger media">
                <div class="media-left media-middle"><i class="media-object ti-trash fs-36"></i></div>
                <div class="media-body">
                  <h6 class="m-0">Cancels</h6>
                  <div class="fs-20">20 <span class="fs-12"><i class="ti-arrow-down fs-10"></i> 3%</span></div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="widget no-border p-15 bg-warning media">
                <div class="media-left media-middle"><i class="media-object ti-paint-bucket fs-36"></i></div>
                <div class="media-body">
                  <h6 class="m-0">Refunds</h6>
                  <div class="fs-20">20 <span class="fs-12"><i class="ti-arrow-down fs-10"></i> 4%</span></div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="widget no-border p-15 bg-info media">
                <div class="media-left media-middle"><i class="media-object ti-direction-alt fs-36"></i></div>
                <div class="media-body">
                  <h6 class="m-0">Chargebacks</h6>
                  <div class="fs-20">24 <span class="fs-12"><i class="ti-arrow-down fs-10"></i> 2%</span></div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="widget no-border p-15 bg-primary media">
                <div class="media-left media-middle"><i class="media-object ti-email fs-36"></i></div>
                <div class="media-body">
                  <h6 class="m-0">Emails</h6>
                  <div class="fs-20">6114 <span class="fs-12"><i class="ti-arrow-up fs-10"></i> 4%</span></div>
                </div>
              </div>
            </div>
          </div>
          <div class="widget no-border p-20 bg-black">
            <div class="media">
              <div class="media-left media-middle pr-15"><i class="ti-pulse fs-60"></i></div>
              <div class="media-body">
                <ul class="list-unstyled fs-12 mb-0">
                  <li class="pt-5 pb-5">
                    <div class="block clearfix mb-5"><span class="pull-left text-white">Upload</span><span class="pull-right text-white">1.457 MB/s</span></div>
                    <div class="progress progress-xs bg-light mb-0">
                      <div role="progressbar" data-transitiongoal="65" aria-valuenow="65" style="width: 65%;" class="progress-bar progress-bar-white"></div>
                    </div>
                  </li>
                  <li class="pt-5 pb-5">
                    <div class="block clearfix mb-5"><span class="pull-left text-white">Download</span><span class="pull-right text-white">2.864 MB/s</span></div>
                    <div class="progress progress-xs bg-light mb-0">
                      <div role="progressbar" data-transitiongoal="80" aria-valuenow="80" style="width: 80%;" class="progress-bar progress-bar-white"></div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
