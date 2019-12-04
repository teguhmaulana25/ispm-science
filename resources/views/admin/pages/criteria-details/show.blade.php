@extends('admin.layouts.admin')
@section('title')Criteria Detail @endsection
@section('add')
    <a href="{{ route('criterias.show', $data->id) }}" class="btn btn-success btn-xs">
        <i class="fa fa-arrow-circle-left"></i> Back
    </a>
@endsection
@section('breadcrumb')
	<li><a href="{{ route('criterias.index') }}">Criteria</a></li>
	<li class="active"><a href="#">Criteria Detail</a></li>
@endsection

@section('content')
	<div id="info"></div>
	<!-- right column -->
	<div class="col-xs-12">
		<!-- general form elements disabled -->
		<div class="widget">
			<!-- /.widget-header -->
			<div class="widget-body">
                
                <form action="{{ route('criteria-details.store', $data->id) }}" role="form" method="post" accept-charset="utf-8" class="form-horizontal">
                    @csrf
    
                    <div class="form-group">
                        <label class="control-label col-md-2">Criteria Name</label>
                        <div class="col-md-5">
                            <p class="form-control-static">{{ $data->name }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">Criteria Detail Name</label>
                        <div class="col-md-5">
                            <input type="text" name="name" class="form-control " value="{{ Request::old('name') ?: '' }}" required="required" autofocus="autofocus">
        
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">Value</label>
                        <div class="col-md-4">
                            <input type="text" name="value" class="form-control " value="{{ Request::old('value') ?: '' }}" required="required">
        
                            @if ($errors->has('value'))
                                <span class="help-block">
                                    {{ $errors->first('value') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-5">
                            <button type="submit" class="btn btn-sm btn-flat btn-primary" id="submit_save">
                                <i class="fa fa-save"></i> Save
                            </button>                                    
                        </div>
                    </div>                    
                </form>

                <div class="table-responsive pd-top25">
                    <table class="table table-condensed table-bordered table-hover table-striped" id="table-data">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Value</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>                
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!--/.col (right) -->
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
                ajax: '{!! route('criteria-details.data', $data->id) !!}',
                columns: [
                    { data: 'id', name: 'id', visible: false, searchable: false },
                    { data: 'name', name: 'criteria_details.name'},
                    { data: 'value', name: 'criteria_details.value'},
                    { data: 'created_at', name: 'created_at', searchable: false },
                    { data: 'updated_at', name: 'updated_at', searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false, sClass: 'text-left action-column' }
                ],
                order: [[0, "desc" ]]
            });
        });
    </script>
@endpush
