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
                        <li role="presentation" class="active">
                            <a href="{{ route('auth.profile') }}" >Profile</a>
                        </li>
                        <li role="presentation">
                            <a href="{{ route('auth.change_password') }}" >Change Password</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <form action="{{ route('auth.profile_update') }}" method="POST" accept-charset="utf-8" class="form-horizontal">
                            @csrf
                            <div class="tab-pane active">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Username</label>
                                    <div class="col-md-5">
                                        <input type="text" name="username" disabled="disabled" class="form-control" value="{{ $data->username }}">
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label class="col-md-3 control-label">Email</label>
                                    <div class="col-md-5">
                                        <input type="text" name="email" class="form-control" value="{{ Request::old('email') ?: $data->email }}" required="" maxlength="140" autofocus="">
        
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                {{ $errors->first('email') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label class="col-md-3 control-label">Name</label>
                                    <div class="col-md-5">
                                        <input type="text" name="name" class="form-control" value="{{ Request::old('name') ?: $data->name }}" required="">
        
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                {{ $errors->first('name') }}
                                            </span>
                                        @endif
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
