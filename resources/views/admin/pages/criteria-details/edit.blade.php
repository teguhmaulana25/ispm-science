@extends('admin.layouts.admin')
@section('title')Edit Criteria Detail @endsection
@section('add')
    <a href="{{ route('criteria-details.show', $data->criteria_id) }}" class="btn btn-success btn-xs">
        <i class="fa fa-arrow-circle-left"></i> Back
    </a>
@endsection
@section('breadcrumb')
    <li><a href="{{ route('criterias.index') }}">Criteria</a></li>
    <li><a href="{{ route('criteria-details.show', $data->criteria_id) }}">Criteria Detail</a></li>
	<li class="active"><a href="#">Edit Criteria Detail</a></li>
@endsection

@section('content')
	<div id="info"></div>
	<!-- right column -->
	<div class="col-xs-12">
		<!-- general form elements disabled -->
		<div class="widget">
			<!-- /.widget-header -->
			<div class="widget-body">
                <form action="{{ route('criteria-details.update', [$data->criteria_id, $data->id]) }}" role="form" method="post" accept-charset="utf-8" class="form-horizontal">
                    @csrf
    
                    <div class="form-group">
                        <label class="control-label col-md-2">Criteria Name</label>
                        <div class="col-md-5">
                            <p class="form-control-static">{{ $data->criteria->name }}</p>
                        </div>
                    </div>
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
                    <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">Value</label>
                        <div class="col-md-4">
                            <input type="text" name="value" class="form-control txt_number" value="{{ Request::old('value') ?: $data->value }}" required="required">
        
                            @if ($errors->has('value'))
                            <span class="help-block">
                                {{ $errors->first('value') }}
                            </span>
                            @endif
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
