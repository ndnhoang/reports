@extends('admin.layouts.master')

@section('content')
<h4>Add Department</h4>

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

		<form class="needs-validation" method="post" action="{{ route('admin.department.add') }}" novalidate>
			{{ csrf_field() }}
			<div class="form-group">
				<label for="department_name">Department Name</label>
				<input type="text" name="name" id="department_name" placeholder="Department Name" class="form-control" value="{{ old('name') }}" required>
				<div class="invalid-feedback">Department name is required</div>
			</div>
			<div class="form-group">
				<label for="department_parent">Deparment Parent</label>
				<select class="custom-select" name="parent" id="department_parent">
				  	<option value="0" {{ (old('parent') == 0 || old('parent') == null) ? 'selected' : '' }}>None</option>
				  	@foreach($departments as $department)
						<option value="{{ $department->id }}" {{ (old('parent') == $department->id) ? 'selected' : '' }}>{{ $department->name }}</option>
				  	@endforeach
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Add</button>
			<a href="{{ route('admin.department') }}" class="btn btn-dark float-right">Return to list</a>
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
})();
</script>

@endsection