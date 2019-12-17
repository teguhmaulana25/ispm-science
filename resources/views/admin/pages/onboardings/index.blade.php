@extends('admin.layouts.admin')
@section('title')Hiring - Onboarding @endsection
@section('add')
@endsection
@section('breadcrumb')
	<li class="active"><a>Onboarding</a></li>
@endsection

@section('content')
	<div id="info"></div>
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget-body">
                <form action="{{ route('onboarding.filter') }}" role="form" method="post" accept-charset="utf-8" class="form-horizontal">
                    @csrf

                    <div class="form-group {{ $errors->has('division_id') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">Division</label>
                        <div class="col-md-5">
                            <select name="division_id" id="division_id" class="form-control" required>
                                <option value="">- select division -</option>
                                @foreach($list_division as $key => $value)
                                    <option value="{{ $key }}">
                                        {{ $value}}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('division_id'))
                                <span class="help-block">
                                    {{ $errors->first('division_id') }}
                                </span>
                            @endif
                        </div>
                    </div>
    
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-5">
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
@push('css')
	<!-- jQuery Steps-->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/jquery.steps/demo/css/jquery.steps.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}">

    <!-- Daterange -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
@endpush

@push('scripts')
    <!-- jQuery Steps-->
    <script src="{{ asset('plugins/jquery.steps/build/jquery.steps.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <!-- CKEeditor-->
    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script> 
     <!-- Daterange -->
     <script src="{{ asset('plugins/daterangepicker/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>   
    <script type="text/javascript">
        $("#division_id").select2();
        CKEDITOR.replace( 'description', {
            uiColor: '#E0E0E0'
        });

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