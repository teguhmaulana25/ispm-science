@extends('admin.layouts.admin')
@section('title')Data Candidate @endsection
@section('add')
@endsection
@section('breadcrumb')
	<li class="active"><a>View All Candidates Per Division </a></li>
@endsection

@section('content')
	<div id="info"></div>
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget-body">
				<form class="form-horizontal">
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
                </form>
			</div>
		</div>
		{{-- <div class="widget">
			<div class="widget-body"> --}}
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="3%">No.</th>
								<th width="26%">Name</th>
								<th width="20%">Birth</th>
								<th width="20%">Vacancy Title</th>
								<th width="13%">Cronbach</th>
								<th width="13%">Apply</th>
								<th width="5%">#</th>
							</tr>
						</thead>
					<tbody id="body-list-candidates">
						<tr class="no-data">
							<td colspan="7" class="text-center">
								<i class="fa fa-exclamation-circle fa-fw"></i> There is no data, select a division first.
							</td>
						</tr>
						<tr class="list-data" style="display: none;"></tr>
					</tbody>
					</table>
					<div class="btn-block-intv">
						<button type="button" class="btn btn-info" id="btn-intv" onclick="popupIntv('checkbox_email[]');">Add Interview Date</button>
					</div>
			    </div>
			    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="mdl-set-intv" data-backdrop="static" data-keyboard="false">
				  <div class="modal-dialog modal-sm" role="document">
				    <div class="modal-content">
				    	<div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title">Set Interview Date</h4>
					     </div>
					     <div class="modal-body">
					    	<input type="hidden" name="val_checkbox" id="val_chkd" class="form-control">
					     	<div class="form-group">
							    <label for="exampleInputEmail1">Interview Date</label>
							    <input type="text" name="intv_date" class="form-control" id="val_int_date" placeholder="ex: 2020/10/29" autocomplete="off">
							</div>
						</div>
						<div class="modal-footer">
					        <button type="button" onclick="saveInt();" id="btnSUbmitIntv" class="btn btn-primary">Save</button>
					    </div>
				    </div>
				  </div>
				</div>
			{{-- </div>
		</div> --}}
	</div>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/datetimepicker/bootstrap-datetimepicker.min.css') }}"/>

    <style type="text/css">
    	.btn-block-intv {
			margin-top: 20px;
			margin-bottom: 10px;
			text-align: right;
    	}
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/daterangepicker/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
    	$('#val_int_date').datetimepicker({
            //uiLibrary: 'bootstrap',
            format: 'YYYY-MM-DD HH:mm:ss',
            locale:  moment.locale('en', {
		        week: { dow: 1 }
		    }),
		    minDate:new Date(),
		    toolbarPlacement: 'bottom',
  			showClose: true,
  			icons: {close: 'glyphicon glyphicon-ok'}
        });

        $("#division_id").select2();
		$('#division_id').on("select2:select", function(e) { 
	        getDataCandidates($(this).val());
	    });

	    function getDataCandidates(var_id) {
	    	$.ajax({
			    type    : "POST",
	            url     : "{{ route('candidates.show') }}",
	            data    : {id: var_id, _token: "{{ Session::token() }}"},

			    beforeSend: function() {
			    	$('#body-list-candidates .list-data').css('display', 'none');
			        $('#body-list-candidates').html('<tr class="no-data"><td colspan="7" class="text-center"><i class="fa fa-spin fa-spinner fa-fw"></i> Loading...</td></tr>');
			    },
			    success: function(data) {
			    	if(data.message == "Success") {
			    		if(data.count == 0){
			    			$('#body-list-candidates').html('<tr class="no-data"><td colspan="7" class="text-center">Data is empty.</td></tr>');
			    		}else{
			    			$('#body-list-candidates').html(data.data);
			    		}
			    	}
			        
			    },
			    error: function(xhr) { // if error occured
			    	$('#body-list-candidates').html('<tr class="no-data"><td colspan="7" class="text-center"><div class="text-danger">Error occured, please try again</div></td></tr>');
			    }
			});
	    }

	    function popupIntv(chkboxName) {
	    	$('#val_chkd').val('');
			var checkboxes = document.getElementsByName(chkboxName);
			var checkboxesChecked = [];
			// loop over them all
			for (var i=0; i<checkboxes.length; i++) {
			 // And stick the checked ones onto an array...
			 if (checkboxes[i].checked) {
			    checkboxesChecked.push(checkboxes[i].value);
			 }
			}
			// Return the array if it is non-empty, or null
			var Arr = checkboxesChecked.length > 0 ? checkboxesChecked : null;
			if(Arr != null) {
				$('#val_chkd').val(Arr);
				$('#mdl-set-intv').modal('show');
			} else {
				alert('You must be select candidates first.');
			}  
	    }

	    function saveInt() {
	    	if($('#val_int_date').val() == "") {
	    		alert('Interview Date cannot be empty.');
	    		return false;
	    	}
	    	$.ajax({
			    type    : "POST",
	            url     : "{{ route('candidates.saveIntv') }}",
	            data    : {id: $('#val_chkd').val(), interview_date: $('#val_int_date').val(), _token: "{{ Session::token() }}"},
			    beforeSend: function() {
			    	$('#btnSUbmitIntv').attr('disabled',true).html('<i class="fa fa-spin fa-spinner fa-fw"></i> Loading...');
			    },
			    success: function(data) {
			    	if(data.message == "Success"){
			    		$('#mdl-set-intv').modal('hide');
			    		$('#val_int_date').val('');
			    	}
			    	$('#body-list-candidates').html('<tr class="no-data"><td colspan="7" class="text-center"><i class="fa fa-exclamation-circle fa-fw"></i> There is no data, select a division first.</td></tr>');
			    	$('#btnSUbmitIntv').attr('disabled', false).html('Save');
			    	
			    	$('#division_id').val('').trigger('change');
			    },
			    error: function(xhr) { // if error occured
			    	alert('Something wrong, please reload the page.');
			    	$('#btnSUbmitIntv').attr('disabled', false).html('Save');
			    }
			});
	    }
			
    </script>
@endpush