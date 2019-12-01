@extends('admin.layouts.admin')
@section('title')View Division @endsection
@section('add')
    <a href="{{ route('divisions.index') }}" class="btn btn-success btn-xs">
        <i class="fa fa-arrow-circle-left"></i> Back
    </a>
    <a href="{{ route('skills.index') }}" class="btn btn-success btn-xs">
        <i class="fa fa-eye"></i> View Data Skill
    </a>
@endsection
@section('breadcrumb')
	<li><a href="{{ route('divisions.index') }}">Division</a></li>
	<li class="active"><a href="#">View Division</a></li>
@endsection

@section('content')
	<div id="info"></div>
	<!-- right column -->
	<div class="col-xs-12">
		<!-- general form elements disabled -->
		<div class="widget">
			<!-- /.widget-header -->
			<div class="widget-body table-responsive">
                @if(!empty($data))
                    <table class="table table-bordered table-hover table-list pd-top10">
                        <tbody>
                            <tr>
                                <th width="20%">Division Name</th>
                                <td>{{ $data->name }}</td>
                            </tr>
                            <tr>
                                <th>Active</th>
                                <td>{!! AI_status($data->display) !!}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-striped table-bordered table-list-product table-view  mg-top20">
                        <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Created</th>
                                <th class="text-center">Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($skill as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-center">{{ $item->sequence }}</td>
                                    <td class="text-center">{!! AI_status($item->status) !!}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
