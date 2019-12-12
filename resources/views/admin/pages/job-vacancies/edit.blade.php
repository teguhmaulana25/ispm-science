@extends('admin.layouts.admin')
@section('title')Edit Lowongan @endsection
@section('add')
    <a href="{{ route('job-vacancies.index') }}" class="btn btn-success btn-xs">
        <i class="fa fa-arrow-circle-left"></i> Kembali
    </a>
@endsection
@section('breadcrumb')
	<li><a href="{{ route('job-vacancies.index') }}">Lowongan</a></li>
	<li class="active"><a href="#">Edit Lowongan</a></li>
@endsection

@section('content')
	<div id="info"></div>
	<!-- right column -->
	<div class="col-xs-12">
		<!-- general form elements disabled -->
		<div class="widget">
			<!-- /.widget-header -->
			<div class="widget-body">
                <form action="{{ route('job-vacancies.update', $data->id) }}" role="form" method="post" accept-charset="utf-8" class="form-horizontal">
                    @csrf
    
                    <h3>Informasi</h3>
                    <div class="form-group {{ $errors->has('division_id') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">Division</label>
                        <div class="col-md-5">
                            <select name="division_id" id="division_id" class="form-control" required>
                                <option value="">- select division -</option>
                                @foreach($list_division as $key => $value)
                                    <option value="{{ $key }}" @if($key == $data->division_id) selected @endif>
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
                            <input type="text" name="title" class="form-control" value="{{ Request::old('title') ?: $data->title }}" required="required">
        
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
                            <textarea name="description" class="form-control" rows="5" id="description">{{ Request::old('description') ?: $data->description }}</textarea>
                            
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
                                        <input id="display_radio-{{ $key }}" type="radio" name="display" value="{{ $key }}" @if(Request::old('display') || $data->display == $key) checked @endif required>
                                        <label for="display_radio-{{ $key }}">{{ $value }}</label>
                                    </div>
                                @endforeach
                            </div>         
                        </div>
                    </div>

                    <h3 class="pd-top20">Criteria</h3>
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
                                        <td>{{ get_criteria_parent($item->criteria_detail_id) }}</td>
                                        <td>
                                            <select name="data[job_criteria][{{ $key }}][id]" class="form-control job_criteria_select" required>
                                                <option value="" data-id="{{ $key }}">- select kriteria -</option>
                                                @foreach(get_criteria_list($item->criteria_detail_id) as $key_detail => $value_detail)
                                                    <option value="{{ $value_detail->id }}" data-id="{{ $key }}" data-value="{{ $value_detail->value }}" 
                                                        @if($value_detail->id == $item->criteria_detail_id) selected @endif>
                                                        {{ $value_detail->name }}
                                                    </option>
                                                @endforeach
                                            </select>                                                    
                                        </td>
                                        <td class="text-center">
                                            <input type="hidden" id="job_criteria_value{{ $key }}" name="data[job_criteria][{{ $key }}][value]" value="@if($item->value) {{ $item->value }} @endif" >
                                            <span id="job_criteria_value_html{{ $key }}">@if($item->value) {{ $item->value }} @endif</span>
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
                                        <td>{{ $item->skill->name }}</td>
                                        <td>
                                            <input type="hidden" name="data[job_skill][{{ $key }}][id]" value="{{ $item->id }}" >
                                            <select name="data[job_skill][{{ $key }}][value]" class="form-control" required>
                                                <option value="">- select prioritas -</option>
                                                @foreach(priority_list() as $key_detail => $value_detail)
                                                    <option value="{{ $key_detail }}" @if($key_detail == $item->value) selected @endif>
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
    
                    <div class="form-group">
                        {{ method_field('PUT') }}
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-block btn-primary" id="submit_save">
                                <i class="fa fa-save"></i> Save
                            </button>                                    
                        </div>
                    </div>                    
                </form>
                
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!--/.col (right) -->
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <!-- Daterange -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
@endpush

@push('scripts')
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
			startDate: '{{ $start_date }}',
		    endDate: '{{ $end_date }}'            
		});

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
