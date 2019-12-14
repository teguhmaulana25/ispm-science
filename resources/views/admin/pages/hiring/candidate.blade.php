@extends('admin.layouts.admin')
@section('title')Hiring - Candidate @endsection
@section('add')
    <a href="{{ route('hiring.index') }}" class="btn btn-success btn-xs">
        <i class="fa fa-arrow-circle-left"></i> Back
    </a>
@endsection
@section('breadcrumb')
	<li><a href="{{ route('hiring.index') }}">Hiring - Interview & Test</a></li>
	<li class="active"><a href="#">Candidate</a></li>
@endsection

@section('content')
	<div id="info"></div>
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-list pd-top10">
                            <tbody>
                                <tr>
                                    <th width="20%">Candidate Name</th>
                                    <td>{{ $data->name }}</td>
                                </tr>
                                <tr>
                                    <th>Job Name</th>
                                    <td><b>{{ $data->title_job }}</b></td>
                                </tr>
                                <tr>
                                    <th>Division</th>
                                    <td><b>{{ get_division($data->division_id) }}</b></td>
                                </tr>
                                <tr>
                                    <th>Birthday</th>
                                    <td>{{ $data->birth_place. ', '.$data->birth_date }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $data->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $data->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Interview Date</th>
                                    <td>{{ $data->interview_date }}</td>
                                </tr>
                                <tr>
                                    <th>Created</th>
                                    <td>{{ $data->created_at }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>


                    <h3>Assessment Interview & Test</h3>
                    <h5>#Criteria</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Criteria</th>
                                    <th class="text-center">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($criteria as $key => $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <select name="data[job_criteria][{{ $key }}][id]" class="form-control job_criteria_select" required>
                                            <option value="" data-id="{{ $key }}">- select criteria -</option>
                                            @foreach(get_criteria_list_hiring($item->id) as $key_detail => $value_detail)
                                                <option value="{{ $value_detail->id }}" data-id="{{ $key }}" data-value="{{ $value_detail->value }}" 
                                                    @if($value_detail->id == $item->criteria_detail_id) selected @endif>
                                                    {{ $value_detail->name }}
                                                </option>
                                            @endforeach
                                        </select>                                                    
                                    </td>
                                    <td class="text-center">
                                        <input type="hidden" id="job_criteria_value{{ $key }}" name="data[job_criteria][{{ $key }}][value]" value="" >
                                        <span id="job_criteria_value_html{{ $key }}">-</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h5 class="pd-top20">#Skill</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Employee Choose</th>
                                    <th class="text-center">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($skill as $key => $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td class="text-center">{!! check_skill_user($data->id, $item->id) !!}</td>
                                        <td>
                                            <input type="hidden" name="data[job_skill][{{ $key }}][id]" value="{{ $item->id }}" >
                                            <select name="data[job_skill][{{ $key }}][value]" class="form-control" required>
                                                <option value="">- No Available -</option>
                                                @foreach(priority_list() as $key_detail => $value_detail)
                                                    <option value="{{ $key_detail }}">
                                                        {{ $value_detail }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <button type="submit" class="btn btn-block btn-primary" id="submit_save">
                        <i class="fa fa-save"></i> Save
                    </button>
			</div>
		</div>
	</div>
@endsection

@push('css')
@endpush

@push('scripts')
<script type="text/javascript">

    $(".job_criteria_select").bind("change", function(e) {
        var data_select = $(this).val();
        var data_id = $(this).find(':selected').attr('data-id');
        var data_value = $(this).find(':selected').attr('data-value');
        if (data_select) {
            console.log('data_select', data_select);
            console.log('data_id', data_id);
            console.log('data_value', data_value);
            $("#job_criteria_value" + data_id).val(data_value);
            $("#job_criteria_value_html" + data_id).html(data_value);
        } else {
            console.log('data_select', data_select);
            $("#job_criteria_value" + data_id).val();
            $("#job_criteria_value_html" + data_id).html('-');                
        }
    });

</script>
@endpush
