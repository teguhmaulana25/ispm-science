@extends('admin.layouts.admin')
@section('title')Data User @endsection
@section('add')
    <a href="{{ route('users.create') }}" class="btn btn-success btn-xs">
        <i class="fa fa-plus-circle"></i> Add User
    </a>
@endsection
@section('breadcrumb')
	<li class="active"><a>User</a></li>
@endsection

@section('content')
	<div id="info"></div>
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget-body table-responsive">
                <table class="table table-condensed table-bordered table-hover table-striped" id="admins-table">
                {{-- <table class="table table-striped table-condensed table-bordered table-hover" id="tables"> --}}
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Status</th>
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
            $('#admins-table').DataTable({
                ajax: '{!! route('users.data') !!}',
                columns: [
                    { data: 'id', name: 'id', visible: false, searchable: false },
                    { data: 'name', name: 'users.name'},
                    { data: 'username', name: 'users.username'},
                    { data: 'email', name: 'users.email'},
                    { data: 'status', name: 'status', searchable: false, sClass: 'text-center' },
                    { data: 'updated_by', name: 'updated_by', searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false, sClass: 'text-left action-column' }
                ],
                order: [[0, "desc" ]]
            });
        });
    </script>
@endpush
