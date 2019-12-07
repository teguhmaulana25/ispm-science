@extends('admin.layouts.admin')
@section('title')Add Job Vacancy @endsection
@section('add')
    <a href="{{ route('job-vacancies.index') }}" class="btn btn-success btn-xs">
        <i class="fa fa-arrow-circle-left"></i> Back
    </a>
@endsection
@section('breadcrumb')
	<li><a href="{{ route('job-vacancies.index') }}">Job Vacancy</a></li>
	<li class="active"><a href="#">Add Job Vacancy</a></li>
@endsection

@section('content')
	<div id="info"></div>
	<!-- right column -->
	<div class="col-xs-12">
		<!-- general form elements disabled -->
		<div class="widget">
			<!-- /.widget-header -->
			<div class="widget-body">
                @if(!empty($data))
                    <div class="wizard clearfix">
                        <div class="steps clearfix">
                            <ul role="tablist">
                                <li role="tab" class="disabled" aria-disabled="true">
                                    <a href="{{ route('job-vacancies.create') }}">
                                        <span class="number">1.</span> Job Vacancy Information
                                    </a>
                                </li>
                                <li role="tab" class="first current" aria-disabled="false" aria-selected="true">
                                    <a href="{{ route('job-vacancies.create-detail', $data->id) }}">
                                        <span class="number">2.</span> Job Vacancy Requirment
                                    </a>
                                </li>
                            </ul>
                        </div><!-- end steps-->
                        <div class="content clearfix pd-top25">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-list pd-top10">
                                    <tbody>
                                        <tr>
                                            <th width="20%">Division Name</th>
                                            <td>{{ $data->division->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Title</th>
                                            <td>{{ $data->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>{!! $data->description !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Periode</th>
                                            <td>{{ $data->start_date .' To '. $data->end_date }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <h3>Criteria</h3>
                            <table class="table table-striped table-bordered table-list-product table-view  mg-top20">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nama Kriteria</th>
                                        <th class="text-center">Kriteria</th>
                                        <th class="text-center">Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobCriteria as $key => $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <select name="data[job_criteria][{{ $key }}]" class="form-control" required>
                                                    <option value="">- select kriteria -</option>
                                                    @foreach(get_criteria_detail($item->id) as $key => $value)
                                                        <option value="{{ $value->id }}">
                                                            {{ $value->name }}
                                                        </option>
                                                    @endforeach
                                                </select>                                                    
                                            </td>
                                            <td class="text-center">
                                                <span id="">-</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <h3 class="pd-top20">Skill</h3>
                            <table class="table table-striped table-bordered table-list-product table-view  mg-top20">
                                <thead>
                                    <tr>
                                        <th class="text-center">Skill Name</th>
                                        <th class="text-center">Prioritas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobSkill as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <select name="division_id" class="form-control" required>
                                                    <option value="">- select prioritas -</option>
                                                    @foreach(priority_list() as $key => $value)
                                                        <option value="{{ $key }}">
                                                            {{ $value}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!--/.col (right) -->
@endsection

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
			startDate: moment().subtract(29, "days"),
			endDate: moment()
		});
    </script>

@endpush
