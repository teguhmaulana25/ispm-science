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
                                        <span class="number">2.</span> Job Vacancy Requirement
                                    </a>
                                </li>
                            </ul>
                        </div><!-- end steps-->
                        <form method="post" action="{{ route('job-vacancies.store-detail', $data->id) }}" >
                            @csrf
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
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Criteria</th>
                                                <th class="text-center">Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jobCriteria as $key => $item)
                                                <tr>
                                                    <td>{{ $item->name }}</td>
                                                    <td>
                                                        <select name="data[job_criteria][{{ $key }}][id]" class="form-control job_criteria_select" required>
                                                            <option value="" data-id="{{ $key }}">- select criteria -</option>
                                                            @foreach(get_criteria_detail($item->id) as $key_detail => $value_detail)
                                                            <option value="{{ $value_detail->id }}" data-id="{{ $key }}" data-value="{{ $value_detail->value }}">
                                                                    {{ $value_detail->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>                                                    
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="hidden" id="job_criteria_value{{ $key }}" name="data[job_criteria][{{ $key }}][value]" value="" >
                                                        <span id="job_criteria_value_html{{ $key }}">-</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <h3 class="pd-top20">Skill</h3>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Priority</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jobSkill as $key => $item)
                                                <tr>
                                                    <td>{{ $item->name }}</td>
                                                    <td>
                                                        <input type="hidden" name="data[job_skill][{{ $key }}][id]" value="{{ $item->id }}" >
                                                        <select name="data[job_skill][{{ $key }}][value]" class="form-control" required>
                                                            <option value="">- select prioritas -</option>
                                                            @foreach(priority_list() as $key_detail => $value_detail)
                                                                <option value="{{ $key_detail }}">
                                                                    {{ $value_detail }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                <button type="submit" class="btn btn-block btn-primary" id="submit_save">
                                    <i class="fa fa-save"></i> Save
                                </button>
                            </div>
                        </form>
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
@endpush

@push('scripts')
    <!-- jQuery Steps-->
    <script src="{{ asset('plugins/jquery.steps/build/jquery.steps.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">

        $(".job_criteria_select").bind("change", function(e) {
            var data_select = $(this).val();
            var data_id = $(this).find(':selected').attr('data-id');
            var data_value = $(this).find(':selected').attr('data-value');
            if (data_select) {
                console.log('data_select', data_select);
                console.log('data_id', data_id);
                console.log('data_value', data_value);
                $("#job_criteria_value" + data_id).val(data_value);
                $("#job_criteria_value_html" + data_id).html(data_value);
            } else {
                console.log('data_select', data_select);
                $("#job_criteria_value" + data_id).val();
                $("#job_criteria_value_html" + data_id).html('-');                
            }
        });

    </script>

@endpush
