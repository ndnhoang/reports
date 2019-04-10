@extends('admin.layouts.master')

@section('content')
<h4>Edit User</h4>

<div class="mt-4">
        <a href="{{ route('admin.user.reset.password', [$user->id]) }}" class="btn btn-success btn-sm">Reset Password</a>
</div>

<div class="row">
	<div class="col-md-6 mt-5">
		@if (Session::has('success'))
			<div class="alert alert-success">
			  	{{ Session::get('success') }}
			</div>
		@endif
		
		@if (Session::has('error'))
			<div class="alert alert-danger">
			  	{{ Session::get('error') }}
			</div>
		@endif

		<form class="needs-validation" method="post" action="{{ route('admin.user.edit', [$id]) }}" novalidate>
			{{ csrf_field() }}
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" name="username" id="username" placeholder="Username" class="form-control" value="{{ $user->username }}" readonly>
			</div>
			<div class="form-group">
				<label for="department_id">Department</label>
				<select class="custom-select" name="department_id" id="department_id">
                    <option value="0" {{ ($user->department_id == 0) ? 'selected' : '' }}>None</option>
				  @foreach($departments as $department)
						<option value="{{ $department->id }}" {{ ($user->department_id == $department->id) ? 'selected' : '' }}>{{ $department->name }}</option>
				  @endforeach
				</select>
            </div>
			<button type="submit" class="btn btn-primary">Edit</button>
			<a href="{{ route('admin.user') }}" class="btn btn-dark float-right">Return to list</a>
		</form>
	</div>
</div>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  	'use strict';
 	window.addEventListener('load', function() {
    	// Fetch all the forms we want to apply custom Bootstrap validation styles to
    	var forms = document.getElementsByClassName('needs-validation');
    	// Loop over them and prevent submission
    	var validation = Array.prototype.filter.call(forms, function(form) {
	      	form.addEventListener('submit', function(event) {
	        	if (form.checkValidity() === false) {
	          		event.preventDefault();
	          		event.stopPropagation();
	        	}
	        	form.classList.add('was-validated');
	      	}, false);
    	});
  	}, false);

 	// generate password
  	$('#generate_password').on('click', function() {
  		$.ajax({
  			headers: {
  				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
  			},
  			type: 'post',
  			url: '/admin/user/generate-password',
  			data: null,
  			dataType: 'json',
  			success: function(response) {
  				$('input[name=password]').val(response);
  			}
  		});
  	});

})();
</script>

@endsection