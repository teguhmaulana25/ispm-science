@extends('admin.layouts.admin')
@section('title')Job Vacancy @endsection
@section('add')
    <a href="{{ route('job-vacancies.index') }}" class="btn btn-success btn-xs">
        <i class="fa fa-arrow-circle-left"></i> Back
    </a>
    <a href="{{ route('job-vacancies.edit', $data->id) }}" class="btn btn-success btn-xs">
        <i class="fa fa-edit"></i> Edit Job Vacancy
    </a>
@endsection
@section('breadcrumb')
	<li><a href="{{ route('job-vacancies.index') }}">Job Vacancy</a></li>
	<li class="active"><a href="#">View Job Vacancy</a></li>
@endsection

@section('content')
	<div id="info"></div>
	<!-- right column -->
	<div class="col-xs-12">
		<!-- general form elements disabled -->
		<div class="widget">
			<!-- /.widget-header -->
			<div class="widget-body table-responsive">
                @if(!empty($data))
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

                        <h3>Criteria</h3>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Step</th>
                                        <th class="text-center">Criteria</th>
                                        <th class="text-center">Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobCriteria as $item)
                                        <tr>
                                            <td>@if(get_criteria_parent($item->criteria_detail_id)) {{ get_criteria_parent($item->criteria_detail_id)->name }}  @endif</td>
                                            <td class="text-center">@if(get_criteria_parent($item->criteria_detail_id)) {{ criteria_step(get_criteria_parent($item->criteria_detail_id)->step) }}  @endif</td>
                                            <td>{{ $item->name }}</td>
                                            <td class="text-center">{{ $item->value }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <h3>Skill</h3>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Priority</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobSkill as $item)
                                        <tr>
                                            <td>{{ $item->skill->name }}</td>
                                            <td>{!! priority($item->value) !!}</td>
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

@push('scripts')
@endpush
