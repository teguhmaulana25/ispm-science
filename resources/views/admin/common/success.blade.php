@if(Session::has('info'))
	<div class=" col-xs-12">
		<div class="alert alert-success">
			<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			{!! Session::get('info') !!}
		</div>
	</div>
@endif
@if(Session::has('error'))
	<div class=" col-xs-12">
		<div class="alert alert-danger">
			<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			{!! Session::get('error') !!}
		</div>
	</div>
@endif
