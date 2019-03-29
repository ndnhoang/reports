@extends('admin.layouts.master')

@section('content')

@if (Session::has('success'))
	<div class="alert alert-success">
	  	{{ Session::get('success') }}
	</div>
@endif

<h4>Department</h4>

<div class="my-4"><a href="{{ route('admin.department.add') }}" class="btn btn-primary">Add new</a></div>

<?php $count = 0; ?>

@if ($departments)
<table id="data_table" class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th>STT</th>
			<th>Department</th>
			<th>Department Parent</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($departments as $department)
		<?php $count++; ?>
		<tr>
			<td><?php echo $count; ?></td>
			<td>{{ $department->name }}</td>
			<td>{{ ($department->parent > 0) ? $department->getDepartmentName($department->parent) : '' }}</td>
			<td>
				<a href="{{ route('admin.department.edit', [$department->id]) }}" class="btn btn-success btn-sm">Edit</a>
				<form class="d-inline" method="post" action="{{ route('admin.department.delete', [$department->id]) }}">
					{{ csrf_field() }}
					<button type="submit" class="btn btn-danger btn-sm">Delete</button>
				</form>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

<script type="text/javascript">
	$(document).ready(function() {
	    $('#data_table').DataTable();
	} );
</script>
@endif

@endsection