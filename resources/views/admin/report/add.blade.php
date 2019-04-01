@extends('admin.layouts.master')

@section('content')
<h4>Add Report</h4>

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

		<form class="needs-validation" method="post" action="{{ route('admin.report.add') }}" novalidate>
			{{ csrf_field() }}
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{ old('name') }}" required>
				<div class="invalid-feedback">Report name is required</div>
			</div>
			<div class="form-group">
				<label for="type">Report Type</label>
				<select class="custom-select" name="type" id="type">
				  	@foreach($report_types as $report_type)
						<option value="{{ $report_type->id }}" {{ (old('type') == $report_type->id) ? 'selected' : '' }}>{{ $report_type->name }}</option>
				  	@endforeach
				</select>
            </div>
            <div class="form-group">
                <label class="mr-3  " for="status">Active</label>
                <input type="checkbox" {{ (old('status') == 'on') ? 'checked' : '' }}  name="status" id="status" data-toggle="toggle" data-size="sm" data-onstyle="outline-success" data-offstyle="outline-secondary">
            </div>
			<button type="submit" class="btn btn-primary">Add</button>
			<a href="{{ route('admin.report') }}" class="btn btn-dark float-right">Return to list</a>
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