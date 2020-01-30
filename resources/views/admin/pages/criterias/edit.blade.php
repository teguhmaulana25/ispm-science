@extends('admin.layouts.admin')
@section('title')Edit Criteria @endsection
@section('add')
    <a href="{{ route('criterias.index') }}" class="btn btn-success btn-xs">
        <i class="fa fa-arrow-circle-left"></i> Back
    </a>
@endsection
@section('breadcrumb')
	<li><a href="{{ route('criterias.index') }}">Criteria</a></li>
	<li class="active"><a href="#">Edit Criteria</a></li>
@endsection

@section('content')
	<div id="info"></div>
	<!-- right column -->
	<div class="col-xs-12">
		<!-- general form elements disabled -->
		<div class="widget">
			<!-- /.widget-header -->
			<div class="widget-body">
                <form action="{{ route('criterias.update', $data->id) }}" role="form" method="post" accept-charset="utf-8" class="form-horizontal">
                    @csrf
    
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} name">
                        <label class="control-label col-md-2">Name</label>
                        <div class="col-md-5">
                            <input type="text" name="name" class="form-control " value="{{ Request::old('name') ?: $data->name }}" required="required" autofocus="autofocus">
        
                            @if ($errors->has('name'))
                            <span class="help-block">
                                {{ $errors->first('name') }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('percentage') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">Percentage</label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" name="percentage" class="form-control txt_number_full" value="{{ Request::old('percentage') ?: $data->percentage }}" required="required">
                                <span class="input-group-addon">% </span>
                            </div>
        
                            @if ($errors->has('percentage'))
                                <span class="help-block">
                                    {{ $errors->first('percentage') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">Type</label>
                        <div class="col-md-5">
                            <div>
                                @foreach (criteria_type_list() as $key => $value)
                                    <div class="radio-custom radio-inline">
                                      <input id="type_radio-{{ $key }}" type="radio" name="type" value="{{ $key }}" @if($data->type == $key) checked @endif required>
                                      <label for="type_radio-{{ $key }}">{{ $value }}</label>
                                    </div>
                                @endforeach
                            </div>         
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('step') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">Step</label>
                        <div class="col-md-5">
                            <div>
                                @foreach (criteria_step_list() as $key => $value)
                                    <div class="radio-custom radio-inline">
                                      <input id="step_radio-{{ $key }}" type="radio" name="step" value="{{ $key }}" @if($data->step == $key) checked @endif required>
                                      <label for="step_radio-{{ $key }}">{{ $value }}</label>
                                    </div>
                                @endforeach
                            </div>         
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }} status">
                        <label class="control-label col-md-2">Status </label>
                        <div class="col-md-5">
                            <div>
                                @foreach (AI_status_list() as $key => $value)
                                    <div class="radio-custom radio-inline">
                                      <input id="status_radio-{{ $key }}" type="radio" name="status" value="{{ $key }}" @if($data->status == $key) checked @endif required>
                                      <label for="status_radio-{{ $key }}">{{ $value }}</label>
                                    </div>
                                @endforeach
                            </div>         
                        </div>
                    </div>
    
                    <div class="form-group">
                        {{ method_field('PUT') }}
                        <div class="col-md-offset-2 col-md-5">
                            <button type="submit" class="btn btn-sm btn-flat btn-primary" id="submit_save">
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

@push('scripts')
@endpush
