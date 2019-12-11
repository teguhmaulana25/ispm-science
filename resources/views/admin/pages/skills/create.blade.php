@extends('admin.layouts.admin')
@section('title')Add Skill @endsection
@section('add')
    <a href="{{ route('skills.index') }}" class="btn btn-success btn-xs">
        <i class="fa fa-arrow-circle-left"></i> Back
    </a>
@endsection
@section('breadcrumb')
	<li><a href="{{ route('skills.index') }}">Skill</a></li>
	<li class="active"><a href="#">Add Skill</a></li>
@endsection

@section('content')
	<div id="info"></div>
	<!-- right column -->
	<div class="col-xs-12">
		<!-- general form elements disabled -->
		<div class="widget">
			<!-- /.widget-header -->
			<div class="widget-body">
                <form action="{{ route('skills.store') }}" role="form" method="post" accept-charset="utf-8" class="form-horizontal">
                    @csrf

                    <div class="form-group {{ $errors->has('division_id') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">Division</label>
                        <div class="col-md-5">
                            <select name="division_id" id="division_id" class="form-control" autofocus required>
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
    
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} name">
                        <label class="control-label col-md-2">Name</label>
                        <div class="col-md-5">
                            <input type="text" name="name" class="form-control" value="{{ Request::old('name') ?: '' }}" required="required" maxlength="45">
        
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>
                    </div>
    
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }} status">
                        <label class="control-label col-md-2">Status Active</label>
                        <div class="col-md-5">
                            <div>
                                @foreach (AI_status_list() as $key => $value)
                                    <div class="radio-custom radio-inline">
                                      <input id="status_radio-{{ $key }}" type="radio" name="status" value="{{ $key }}" @if(Request::old('status') == $key) checked @endif required>
                                      <label for="status_radio-{{ $key }}">{{ $value }}</label>
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
@endpush

@push('scripts')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $("#division_id").select2();
    </script>

@endpush
