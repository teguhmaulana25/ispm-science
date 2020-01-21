@extends('admin.layouts.admin')
@section('title')Hiring - Onboarding @endsection
@section('add')
@endsection
@section('breadcrumb')
	<li class="active"><a>Onboarding</a></li>
@endsection

@section('content')
	<div id="info"></div>
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget-body">
                <form action="{{ route('onboarding.filter') }}" role="form" method="post" accept-charset="utf-8" class="form-horizontal">
                    @csrf

                    <!-- AREA NOTIF -->
					<div id="notif_info"></div>
					<div class="form-group">
						<label class="control-label col-md-2">Division</label>
						<div class="col-md-5">
							<select name="division" id="division_list" class="form-control" required>
								<option value="">- select division -</option>
								@foreach($list_division as $key => $value)
									<option value="{{ $key }}">
										{{ $value }}
									</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group {{ $errors->has('job_vacancy') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">Job Vacancy</label>
                        <div class="col-md-5">
                            <select name="job_vacancy" id="job_vacancy_list" class="form-control" required>
                                <option value="">- select job vacancy -</option>
                            </select>
                            @if ($errors->has('job_vacancy'))
                                <span class="help-block">
                                    {{ $errors->first('job_vacancy') }}
                                </span>
                            @endif
                        </div>
                    </div>

					<div class="form-group">
						<div class="col-md-offset-2 col-md-5">
							<button type="submit" class="btn btn-sm btn-flat btn-primary" id="submit_save">
								Submit
							</button>                                    
						</div>
					</div>
                </form>


			</div>
		</div>
	</div>
@endsection

@push('css')
    <!-- select2-->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}">
@endpush

@push('scripts')
    <!-- select2-->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $("#division_list").select2({ width: '100%' });
		$("#job_vacancy_list").select2({ width: '100%' });
		
		$("#division_list").bind("change", function(e){
            var division = $(this).val();
            $.ajax({
                url:"{{ route('onboarding.job-vacancy') }}",
                data:{"division" : division, _token: "{{ Session::token() }}"},
                dataType: "JSON",
                method: "POST",
                beforeSend: function(){
                    $(".page-ajax").show();
                },
                error: function(data){
                    $(".page-ajax").hide();
                },
                success: function(data){
                    $(".page-ajax").hide();
                    if (data.success === true) {
						$("#notif_info").html("");												
                        $("#job_vacancy_list").html("<option value=\"\">- select job vacancy -</option>");
                        $('#job_vacancy_list').select2({
                            placeholder: '- select job vacancy -',
                            data: data.data
                        });
                        $("#job_vacancy_list").prop('required', true);
                    }else if(data.success === false) {
						var message_data = '<div class="alert alert-danger fade in">';
							message_data += '<button class="close" data-dismiss="alert" aria-hidden="true" type="button">&times;</button>';
							message_data += ''+data.message+'';
							message_data += '</div>';
						$("#notif_info").html(message_data);

                        $("#job_vacancy_list").select2("destroy");
                        $("#job_vacancy_list").html("<option value=\"\">- select job vacancy -</option>");
                        $('#job_vacancy_list').select2({
                            placeholder: '- select job vacancy -',
                            data: []
                        });
                        $("#job_vacancy_list").prop('required', true);
                    }
                }
            });

            return false;
        });
    </script>
@endpush