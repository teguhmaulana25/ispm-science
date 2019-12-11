@extends('admin.layouts.admin')
@section('title')Hiring - Curriculum Vitae @endsection
@section('add')
@endsection
@section('breadcrumb')
	<li class="active"><a>Curriculum Vitae</a></li>
@endsection

@section('content')
	<div id="info"></div>
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget-body">
                <form action="{{ route('hiring-external.filter') }}" role="form" method="post" accept-charset="utf-8" class="form-horizontal">
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
    
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-5">
                            <button type="submit" class="btn btn-sm btn-flat btn-primary" id="submit_save">
                                <i class="fa fa-save"></i> Save
                            </button>                                    
                        </div>
                    </div>
                </form>


			</div>
		</div>
	</div>
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