@extends('admin.layouts.admin')
@section('title')View Candidate @endsection
@section('add')
    <a href="{{ route('onboarding.index') }}" class="btn btn-success btn-xs">
        <i class="fa fa-arrow-circle-left"></i> Back
    </a>
@endsection
@section('breadcrumb')
	<li><a href="{{ route('onboarding.index') }}">Onboarding</a></li>
	<li class="active"><a href="#">View</a></li>
@endsection

@section('content')
	<div id="info"></div>
	<!-- right column -->
	<div class="col-xs-12">
		<!-- general form elements disabled -->
		<div class="widget">
			<!-- /.widget-header -->
			<div class="widget-body">
                <form action="{{ route('onboarding.update', ['division' => $division, 'job_vacancy' => $job_vacancy]) }}" role="form" method="post" accept-charset="utf-8" id="form_candidate">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-list pd-top10">
                            <tbody>
                                <tr>
                                    <th width="20%">Division Name</th>
                                    <td>{{ get_division($division) }}</td>
                                </tr>
                                <tr>
                                    <th>Job Vacancy Title</th>
                                    <td>@if(job_vacancy($job_vacancy)) {{ job_vacancy($job_vacancy)->title }} @endif</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>@if(job_vacancy($job_vacancy)) {!! job_vacancy($job_vacancy)->description !!} @endif</td>
                                </tr>
                                <tr>
                                    <th>Periode</th>
                                    <td>@if(job_vacancy($job_vacancy)) {{ job_vacancy($job_vacancy)->start_date.' To '.job_vacancy($job_vacancy)->end_date }} @endif</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="3%">No.</th>
                                    <th width="15%">Name</th>
                                    <th width="15%">Birth</th>
                                    <th width="20%">Email</th>
                                    <th width="13%">Apply</th>
                                    <th width="13%">Status</th>
                                    <th width="5%" class="text-center">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($data_candidate) > 0)
                                    <?php
                                    $no = 1;
                                    ?>
                                    @foreach ($data_candidate as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $no }}</td>
                                            <td>{{ $item['candidate']->name }}</td>
                                            <td>{{ $item['candidate']->birth_place.', '.$item['candidate']->birth_date }}</td>
                                            <td>{{ $item['candidate']->email }}</td>
                                            <td>{{ humanize_date_format($item['candidate']->created_at) }}</td>
                                            <td>{{ $item['status_description'] }}</td>
                                            <td class="text-center">
                                                <label>
                                                    <input type="hidden" name="data[DataCandidate][{{ $key }}][candidate]" class="candidate_{{ $item['candidate']->id }}" value="{{ $item['candidate']->id }}" readonly disabled>
                                                    <input type="hidden" name="data[DataCandidate][{{ $key }}][candidate_status]" class="candidate_status_{{ $item['candidate']->id }}" value="{{ $item['status_id'] }}" readonly disabled>
                                                    <input type="checkbox" value="{{ $item['candidate']->id }}" name="checkbox_email[]" class="choose_candidate" data-id="{{ $item['candidate']->id }}" >
                                                </label>
                                            </td>
                                        </tr>
                                        <?php $no++ ?>                                  
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center"><i class="fa fa-exclamation-circle fa-fw"></i> There is no data.</td>
                                    </tr>
                                @endif
                            </tbody>
                            @if(count($data_candidate) > 0)
                                <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            <div class="btn-block-intv">
                                                <button type="button" class="btn btn-info btn-block" id="btn-intv" onclick="popupIntv('checkbox_email[]');">Send Information Onboarding Date</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>

                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="mdl-set-intv" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Set Information Date</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="val_checkbox" id="val_chkd" class="form-control">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Information Date</label>
                                    <input type="text" name="information_date" class="form-control" id="val_int_date" placeholder="ex: 2020/10/29" autocomplete="off">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="#" onclick="event.preventDefault(); document.getElementById('form_candidate').submit();" class="btn btn-primary">
                                    Save
                                </a>
                                {{-- <button type="button" onclick="saveInt();" id="btnSUbmitIntv" class="btn btn-primary">Save</button> --}}
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- Modal alert -->
                    <div class="modal modal_area modal_user_area fade" id="popup_alert_candidate_form" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="popup_alert_candidate_formLabel">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                            <i class="fa fa-4x fa-fw fa-exclamation-circle"></i>
                            <h2>You must be select candidates first</h2>              
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button> 
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- End Modal alert -->
                </form>
                
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!--/.col (right) -->
@endsection

@push('css')
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
            $("#popup_alert_candidate_form").modal('show');
            // alert('You must be select candidates first.');
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
                $('#btnSUbmitIntv').attr('disabled', false).html('Save');
                if(data.message == "Success"){
                    $('#mdl-set-intv').modal('hide');
                    $('#val_int_date').val('');
                }
                // alert('Email already sent.');
                setTimeout("location.reload()", 2000);
                
            },
            error: function(xhr) { // if error occured
                alert('Something wrong, please reload the page.');
                $('#btnSUbmitIntv').attr('disabled', false).html('Save');
            }
        });
    }

    $(".choose_candidate").bind("change", function(e){
        var status_checked 	= $(this).is(":checked");
        var candidate_id 	= $(this).data("id");
        console.log('candidate_id', candidate_id);
        if(status_checked == true){
            $('.candidate_'+candidate_id+'').removeAttr('disabled');
            $('.candidate_status_'+candidate_id+'').removeAttr('disabled');
        }else{
            $('.candidate_'+candidate_id+'').attr('disabled', 'disabled');
            $('.candidate_status_'+candidate_id+'').attr('disabled', 'disabled');
        }
    });
        
</script>
@endpush
