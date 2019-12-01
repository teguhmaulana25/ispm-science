@if(!empty($errors))
	@if($errors->any())
	    <div class="alert alert-danger">
	    	<ul>
	        @foreach($errors->all() as $error)
	            <li>{{ $error }}</li>
	        @endforeach
	        </ul>
	    </div>
	@endif
@endif

{{-- @if(session('alt_red')) --}}
@if(Session::has('error'))
	<div class="alert alert-danger fade in">
		<button class="close" data-dismiss="alert" aria-hidden="true" type="button">&times;</button>
		<i class="icon fa fa-check"></i> {{ Session::get('error') }}
	</div>
@endif

{{-- @if(session('alt_green')) --}}
@if(Session::has('info'))
	<div class="alert alert-success fade in">
		<button class="close" data-dismiss="alert" aria-hidden="true" type="button">&times;</button>
		<i class="icon fa fa-check"></i> {{ Session::get('info') }}
	</div>
@endif
