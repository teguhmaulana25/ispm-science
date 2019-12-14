@extends('admin.layouts.admin')
@section('title')Hiring - Interview & Test @endsection
@section('add')
@endsection
@section('breadcrumb')
	<li class="active"><a>Interview & Test</a></li>
@endsection

@section('content')
	<div id="info"></div>
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget-body">
                <form action="{{ route('hiring.filter') }}" role="form" method="post" accept-charset="utf-8" class="form-horizontal">
                    @csrf

                    <div class="form-group">
                        <label class="control-label col-md-3">Date Range of Interview</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="date_range" class="form-control" id="date_range" value=""/>
                            </div>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-5">
                            <button type="submit" class="btn btn-sm btn-flat btn-primary">
                                <i class="fa fa-search"></i> Search
                            </button>                                    
                        </div>
                    </div>
                </form>


			</div>
		</div>
	</div>
@endsection

@push('css')
    <!-- Daterange -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
@endpush

@push('scripts')
    <!-- Daterange -->
    <script src="{{ asset('plugins/daterangepicker/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>   
    <script type="text/javascript">
        $('#date_range').daterangepicker({
			autoApply: true,
			ranges: {
			    Today: [moment(), moment()],
			    Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
			    "Last 7 Days": [moment().subtract(6, "days"), moment()],
			    "Last 30 Days": [moment().subtract(29, "days"), moment()],
			    "This Month": [moment().startOf("month"), moment().endOf("month")],
			    "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
			},
			// startDate: moment().subtract(29, "days"),
            startDate: moment().startOf("month"),
			endDate: moment().endOf("month")
		});
    </script>

@endpush
