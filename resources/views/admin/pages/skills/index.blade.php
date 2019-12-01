@extends('admin.layouts.admin')
@section('title')Data Skill @endsection
@section('add')
    <a href="{{ route('skills.create') }}" class="btn btn-success btn-xs">
        <i class="fa fa-plus-circle"></i> Add Skill
    </a>
@endsection
@section('breadcrumb')
	<li class="active"><a>Skill</a></li>
@endsection

@section('content')
	<div id="info"></div>
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget-body table-responsive">
                <table class="table table-condensed table-bordered table-hover table-striped" id="table-data">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Division</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
			</div>
		</div>
	</div>
@endsection

@push('css')
	<!--  Datatable -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('js/app_tools.js') }}" type="text/javascript"  async></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-data').DataTable({
                ajax: '{!! route('skills.data') !!}',
                columns: [
                    { data: 'id', name: 'id', visible: false, searchable: false },
                    { data: 'name', name: 'skills.name'},
                    { data: 'division_name', name: 'divisions.division_name'},
                    { data: 'status', name: 'status', searchable: false, sClass: 'text-center' },
                    { data: 'created_at', name: 'created_at', searchable: false },
                    { data: 'updated_at', name: 'updated_at', searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false, sClass: 'text-left action-column' }
                ],
                order: [[0, "desc" ]]
            });
        });
    </script>
@endpush
