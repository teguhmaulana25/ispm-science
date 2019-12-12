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
                <form action="{{ route('job-vacancies.store') }}" role="form" method="post" accept-charset="utf-8" class="form-horizontal wizard clearfix">
                    @csrf
    
                    <div class="steps clearfix">
                        <ul role="tablist">
                            <li role="tab" class="first current" aria-disabled="false" aria-selected="true">
                                <a href="{{ route('job-vacancies.create') }}">
                                    <span class="number">1.</span> Job Vacancy Information
                                </a>
                            </li>
                            <li role="tab" class="disabled" aria-disabled="true">
                                <a href="#">
                                    <span class="number">2.</span> Job Vacancy Requirement
                                </a>
                            </li>
                        </ul>
                    </div><!-- end steps-->
                    <div class="content clearfix pd-top25">
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

                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">Title</label>
                            <div class="col-md-5">
                                <input type="text" name="title" class="form-control" value="{{ Request::old('title') ?: '' }}" required="required">
            
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        {{ $errors->first('title') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">Description</label>
                            <div class="col-md-8">
                                <textarea name="description" class="form-control" rows="5" id="description">{{ Request::old('description') ? Request::old('description') : '' }}</textarea>
                                
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        {{ $errors->first('description') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Date Range of Job</label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="date_range" class="form-control" id="date_range" value=""/>
                                </div>
                            </div>
                        </div>
        
                        <div class="form-group {{ $errors->has('display') ? 'has-error' : '' }} ">
                            <label class="control-label col-md-2">Display</label>
                            <div class="col-md-5">
                                <div>
                                    @foreach (display_status_list() as $key => $value)
                                        <div class="radio-custom radio-inline">
                                            <input id="display_radio-{{ $key }}" type="radio" name="display" value="{{ $key }}" @if(Request::old('display') == $key) checked @endif required>
                                            <label for="display_radio-{{ $key }}">{{ $value }}</label>
                                        </div>
                                    @endforeach
                                </div>         
                            </div>
                        </div>
        
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-5">
                                <button type="submit" class="btn btn-sm btn-flat btn-primary" id="submit_save">
                                    <i class="fa fa-save"></i> Save
                                </button>                                    
                            </div>
                        </div>
                    </div><!-- end content-->
                </form>
                
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
			// startDate: moment().subtract(29, "days"),
            startDate: moment().startOf("month"),
			endDate: moment().endOf("month")
		});
    </script>

@endpush
