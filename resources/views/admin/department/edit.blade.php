@extends('admin.layouts.master')

@section('content')
<h4>Edit Department</h4>

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

		<form class="needs-validation" method="post" action="{{ route('admin.department.edit', [$id]) }}" novalidate>
			{{ csrf_field() }}
			<div class="form-group">
				<label for="department_name">Department Name</label>
				<input type="text" name="name" id="department_name" placeholder="Department Name" class="form-control" value="{{ $department->name }}" required>
				<div class="invalid-feedback">Department name is required</div>
			</div>
			<div class="form-group">
				<label for="department_parent">Deparment Parent</label>
				<select class="custom-select" name="parent" id="department_parent">
				  	<option value="0" {{ ($department->parent == 0) ? 'selected' : '' }}>None</option>
				  	@foreach($departments as $item)
						<option value="{{ $item->id }}" {{ ($department->parent == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
				  	@endforeach
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Edit</button>
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