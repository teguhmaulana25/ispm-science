@extends('admin.layouts.admin')
@section('title')Hiring - Interview & Test Data @endsection
@section('add')
    <a href="{{ route('hiring.index') }}" class="btn btn-success btn-xs">
        <i class="fa fa-arrow-circle-left"></i> Back
    </a>
@endsection
@section('breadcrumb')
	<li><a href="{{ route('hiring.index') }}">Hiring - Interview & Test</a></li>
	<li class="active"><a href="#">Data</a></li>
@endsection

@section('content')
	<div id="info"></div>
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget-body">
                <div class="table-responsive">
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th class="text-center">Job Name</th>
								<th class="text-center">Divisi</th>
								<th class="text-center" width="30%">Candidate Info</th>
								<th class="text-center">Interview Date</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							@if(count($getCandidate) > 0)
								@foreach ($getCandidate as $item)
									<tr>
										<td>{{ $item->title_job }}</td>
										<td class="text-center">{{ get_division($item->division_id) }}</td>
										<td>
											<address>
												<b>Birthday : </b>{{ $item->birth_place.', '.$item->birth_date }}<br/>
												<b>Email : </b>{{ $item->email }}<br/>
												<b>Phone : </b>{{ $item->phone }}
											</address>
										</td>
										<td class="text-center">{{ $item->interview_date }}</td>
										<td class="text-center">
											<a href="{{ route('hiring.candidate', $item->id) }}" class="btn btn-info btn-block">
												<span class="fas fa-eye fa-fw"></span> View
											</a>
										</td>
									</tr>
								@endforeach
							@else 
								<tr>
									<td colspan="5" class="text-center"><i class="fa fa-exclamation-circle fa-fw"></i> There is no data.</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>
@endsection

@push('css')
@endpush

@push('scripts')

@endpush
