@extends('admin.layouts.master')

@section('content')
<h4>Add User</h4>

<div class="row">
	<div class="col-md-6 mt-5">
		@if (Session::has('success'))
			<div class="alert alert-success">
			  	{{ Session::get('success') }}
			</div>
		@endif
		
		@if ($errors->any())
			<div class="alert alert-danger">
				@foreach ($errors->all() as $error)
					{{ $error }}<br>
				@endforeach
			</div>
		@endif

		<form class="needs-validation" method="post" action="{{ route('admin.user.add') }}" novalidate>
			{{ csrf_field() }}
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" name="username" id="username" placeholder="Username" class="form-control" value="{{ old('username') }}" required>
				<div class="invalid-feedback">Username is required</div>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<div class="input-group">
					<input type="text" name="password" id="password" placeholder="Password" class="form-control" value="" required>
					<div class="input-group-append">
						<button class="btn btn-outline-secondary" type="button" id="generate_password">Generate</button>
					</div>
					<div class="invalid-feedback">Password is required</div>
				</div>
			</div>
			<div class="form-group">
					<label for="department_id">Department</label>
					<select class="custom-select" name="department_id" id="department_id">
						<option value="0" {{ (old('department_id') == 0) ? 'selected' : '' }}>None</option>
					  @foreach($departments as $department)
							<option value="{{ $department->id }}" {{ (old('department_id') == $department->id) ? 'selected' : '' }}>{{ $department->name }}</option>
					  @endforeach
					</select>
				</div>
			<button type="submit" class="btn btn-primary">Add</button>
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