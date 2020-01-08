@extends('admin.layouts.app')

@section('content')
<div class="container page-container">
    <div class="page-content wow fadeInDown">
        <div class="v2">
            <div class="logo">
                <!-- Branding Image -->
                <img src="{{ asset('img/logo-dumet.png') }}" alt="Dumet School Logo" width="200"/>
            </div>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                @csrf
                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <input id="username" type="text" autocomplete="username" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required autofocus>

                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <input id="password" type="password" autocomplete="current-password" class="form-control" name="password" placeholder="Password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn-lg btn btn-primary btn-rounded btn-block">Sign in</button>
            </form>
        </div>
    </div>
</div>
@endsection