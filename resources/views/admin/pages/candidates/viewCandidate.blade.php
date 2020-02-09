@extends('admin.layouts.admin')
@section('title')View Candidate Detail @endsection
@section('add')
    <a href="{{ route('candidates.view', ['division'=>$division, 'job_vacancy'=>$job_vacancy]) }}" class="btn btn-success btn-xs">
        <i class="fa fa-arrow-circle-left"></i> Back
    </a>
@endsection
@section('breadcrumb')
	<li><a href="{{ route('candidates.view', ['division'=>$division, 'job_vacancy'=>$job_vacancy]) }}">Onboarding</a></li>
	<li class="active"><a href="#">View Candidate Detail</a></li>
@endsection

@section('content')
	<div id="info"></div>
	<!-- right column -->
	<div class="col-xs-12">
		<!-- general form elements disabled -->
		<div class="widget">
			<!-- /.widget-header -->
			<div class="widget-body">
                @if(!empty($candidate))
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-list pd-top10">
                            <tbody>
                                <tr>
                                    <th width="20%">Full Name</th>
                                    <td>{{ $candidate->name }}</td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <td>{{ $candidate->name }}</td>
                                </tr>
                                <tr>
                                    <th>Birth</th>
                                    <td>{{ $candidate->birth_place.', '.$candidate->birth_date }}</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>{{ gender($candidate->gender) }}</td>
                                </tr>
                                <tr>
                                    <th>Nationality</th>
                                    <td>{{ $candidate->nationality }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $candidate->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone number</th>
                                    <td>{{ $candidate->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Religion</th>
                                    <td>{{ religion($candidate->religion) }}</td>
                                </tr>
                                <tr>
                                    <th>Blood Type</th>
                                    <td>{{ blood_type($candidate->blood_type) }}</td>
                                </tr>
                                <tr>
                                    <th>Height</th>
                                    <td>{{ $candidate->height }} cm</td>
                                </tr>
                                <tr>
                                    <th>Weight</th>
                                    <td>{{ $candidate->weight }} Kg</td>
                                </tr>
                                <tr>
                                    <th>Social Media</th>
                                    <td>{!! $candidate->social_media !!}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $candidate->address }}</td>
                                </tr>
                                <tr>
                                    <th>Photo</th>
                                    <td>
                                        <a href="{{ get_data_picture('img/candidates/', $candidate->photo) }}" target="_blank">
                                            <img class="img img-responsive" style="width:50px;" src="{{ get_data_picture('img/candidates/', $candidate->photo) }}" alt="Image" class="img img-responsive">
                                        </a>
                                    </td>                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h5>#Criteria</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Step</th>
                                    <th class="text-center">Criteria</th>
                                    <th class="text-center">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($criteria as $key => $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-center">{{ $item->step }}</td>
                                    <td>
                                        @foreach(get_criteria_list_hiring($item->id) as $key_detail => $value_detail)
                                            @if(get_candidate_criteria($candidate->id, $value_detail->id))
                                                {{ $value_detail->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <?php
                                            $criteria_value = "";
                                        ?>
                                        @foreach(get_criteria_list_hiring($item->id) as $key_detail => $value_detail)
                                            @if(get_candidate_criteria($candidate->id, $value_detail->id))
                                                <?php
                                                    $criteria_value = get_candidate_criteria($candidate->id, $value_detail->id)->answer;
                                                ?>
                                            @endif
                                        @endforeach
                                        <input type="hidden" id="job_criteria_value{{ $key }}" name="data[job_criteria][{{ $key }}][value]" value="@if($criteria_value) {{ $criteria_value }}  @endif" >
                                        <span id="job_criteria_value_html{{ $key }}">@if($criteria_value) {{ $criteria_value }} @else {{ '-'}} @endif</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h4>Skill List</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-list-product table-view">
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
                                        <td class="text-center">{!! check_skill_user($candidate->id, $item->id) !!}</td>
                                        <td>
                                            @foreach(priority_list() as $key_detail => $value_detail)
                                                @if(get_candidate_skill($candidate->id, $item->id, $key_detail) > 0)
                                                    {{ $value_detail }}
                                                @else
                                                    {{-- {{ '-' }} --}}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!--/.col (right) -->
@endsection

@push('scripts')
@endpush
