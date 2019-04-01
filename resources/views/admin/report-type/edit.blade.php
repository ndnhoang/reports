@extends('admin.layouts.master')

@section('content')
<h4>Edit Report Type</h4>

<div class="row">
	<div class="col-md-6 mt-5">
		@if (Session::has('success'))
			<div class="alert alert-success">
			  	{{ Session::get('success') }}
			</div>
		@endif

		<form class="needs-validation" method="post" action="{{ route('admin.report.type.edit', [$id]) }}" novalidate>
			{{ csrf_field() }}
			<div class="form-group">
				<label for="type_name">Type Name</label>
				<input type="text" name="type_name" id="type_name" placeholder="Type Name" class="form-control" value="{{ $report_type->name }}" required>
				<div class="invalid-feedback">Type name is required</div>
			</div>
			<div class="form-group">
				<label for="description">Description</label>
				<input type="text" name="description" id="description" placeholder="Description" class="form-control" value="{{ $report_type->description }}">
			</div>
			<button type="submit" class="btn btn-primary">Edit</button>
			<a href="{{ route('admin.report.type') }}" class="btn btn-dark float-right">Return to list</a>
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