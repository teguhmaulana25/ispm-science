@extends('admin.layouts.admin')
@section('title')Auth Profile @endsection
@push('css')
@endpush
@section('add')
@endsection
@section('breadcrumb')
    <li><a href="{{ route('dashboard') }}">Admin</a></li>
	<li class="active"><a href="{{ route('auth.profile') }}">My Profile</a></li>
@endsection

@section('content')
	<div id="info"></div>
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget-body">
                    <ul role="tablist" class="nav nav-tabs mb-15">
                        <li role="presentation">
                            <a href="{{ route('auth.profile') }}" >Profile</a>
                        </li>
                        <li role="presentation" class="active">
                            <a href="{{ route('auth.change_password') }}" >Change Password</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <form action="{{ route('auth.change_password_update') }}" method="POST" accept-charset="utf-8" class="form-horizontal">
                            @csrf
                            <div class="tab-pane active">
                                <div class="form-group {{ $errors->has('current_password') ? 'has-error' : '' }}">
                                    <label class="col-md-3 control-label">Current Password</label>
                                    <div class="col-md-5">
                                        <input type="password" name="current_password" autofocus="" class="form-control" value="{{ Request::old('current_password') ?: '' }}" >
                                        <span class="help-block">
                                            {{ $errors->first('current_password') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <label class="col-md-3 control-label">New Password</label>
                                    <div class="col-md-5">
                                        <input type="password" name="password" class="form-control" value="{{ Request::old('password') ?: '' }}" >
                                        <span class="help-block">
                                            {{ $errors->first('password') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                    <label class="col-md-3 control-label">Confirm Password</label>
                                    <div class="col-md-5">
                                        <input type="password" name="password_confirmation" class="form-control" value="{{ Request::old('password_confirmation') ?: '' }}">
                                        <span class="help-block">
                                            {{ $errors->first('password_confirmation') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-5">
                                        <button type="submit" class="btn btn-sm btn-flat btn-primary">
                                            <i class="fa fa-save"></i> Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
@endpush
