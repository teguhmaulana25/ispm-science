@extends('admin.layouts.admin')
@section('title')Add User @endsection
@section('add')
    <a href="{{ route('users.index') }}" class="btn btn-success btn-xs">
        <i class="fa fa-arrow-circle-left"></i> Back
    </a>
@endsection
@section('breadcrumb')
	<li><a href="{{ route('users.index') }}">User</a></li>
	<li class="active"><a href="#">Add User</a></li>
@endsection

@section('content')
	<div id="info"></div>
	<!-- right column -->
	<div class="col-xs-12">
		<!-- general form elements disabled -->
		<div class="widget">
			<!-- /.widget-header -->
			<div class="widget-body">
                <form action="{{ route('users.store') }}" role="form" method="post" accept-charset="utf-8" class="form-horizontal">
                    @csrf
    
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} name">
                        <label class="control-label col-md-2">Name</label>
                        <div class="col-md-5">
                            <input type="text" name="name" class="form-control" value="{{ Request::old('name') ?: '' }}" required="required" autofocus="autofocus">
        
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }} name">
                        <label class="control-label col-md-2">Username</label>
                        <div class="col-md-5">
                            <input type="text" name="username" class="form-control" value="{{ Request::old('username') ?: '' }}" required="required">
        
                            @if ($errors->has('username'))
                                <span class="help-block">
                                    {{ $errors->first('username') }}
                                </span>
                            @endif
                        </div>
                    </div>
    
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }} email">
                        <label class="control-label col-md-2">Email</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                <input type="email" name="email" class="form-control" value="{{ Request::old('email') ?: '' }}" required="required" maxlength="140">
                            </div>
                            
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                    </div>
    
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} password">
                        <label class="control-label col-md-2">Password</label>
                        <div class="col-md-5">
                            <input type="password" name="password" class="form-control" value="{{ Request::old('password') ?: '' }}" required="required" maxlength="255">
        
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>
                    </div>
    
                    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }} password_confirmation">
                        <label class="control-label col-md-2">Confirm Password</label>
                        <div class="col-md-5">
                            <input type="password" name="password_confirmation" class="form-control" value="{{ Request::old('password_confirmation') ?: '' }}" required="required" maxlength="255">
                            
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    {{ $errors->first('password_confirmation') }}
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

@push('scripts')
@endpush
