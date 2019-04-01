@extends('admin.layouts.master')

@section('content')

@if (Session::has('success'))
	<div class="alert alert-success">
	  	{{ Session::get('success') }}
	</div>
@endif

<h4>Report</h4>

<div class="my-4"><a href="{{ route('admin.report.add') }}" class="btn btn-primary">Add new</a></div>

<?php $count = 0; ?>

<table id="data_table" class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th>No.</th>
			<th>Name</th>
            <th>Type</th>
            <th>Status</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($reports as $report)
		<?php $count++; ?>
		<tr>
			<td><?php echo $count; ?></td>
			<td>{{ $report->name }}</td>
            <td>{{ $report->report_type->name }}</td>
            <td><input type="checkbox" {{ ($report->status == 1) ? 'checked' : '' }} disabled name="status" id="status" data-toggle="toggle" data-size="sm" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="secondary"></td>
			<td>
				<a href="" class="btn btn-success btn-sm">Edit</a>
				<button type="button" class="btn btn-danger btn-sm btn-delete">Delete</button>
				<form class="d-none" method="post" action="">
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

	{{-- Delete confirm alert --}}
	$('.btn-delete').on('click', function() {
		var parent = $(this).parent();

		swal({
			title: 'Are you sure?',
			icon: 'warning',
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				parent.find('form').submit();
			}
		});
	});
</script>

@endsection