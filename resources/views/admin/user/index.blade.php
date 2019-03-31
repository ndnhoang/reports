@extends('admin.layouts.master')

@section('content')

@if (Session::has('success'))
	<div class="alert alert-success">
	  	{{ Session::get('success') }}
	</div>
@endif

<h4>Users</h4>

<div class="my-4"><a href="{{ route('admin.user.add') }}" class="btn btn-primary">Add new</a></div>

<?php $count = 0; ?>

<table id="data_table" class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th>No.</th>
			<th>Username</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($users as $user)
		<?php $count++; ?>
		<tr>
			<td><?php echo $count; ?></td>
			<td>{{ $user->username }}</td>
			<td>
				<a href="{{ route('admin.user.reset.password', [$user->id]) }}" class="btn btn-success btn-sm">Reset Password</a>
				<button type="button" class="btn btn-danger btn-sm btn-delete">Delete</button>
				<form class="d-none" method="post" action="{{ route('admin.user.delete', [$user->id]) }}">
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