@extends('admin.layouts.login')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-6 offset-md-3">
			@if (Session::has('msg'))
				<div class="alert alert-danger">
				  	{{ Session::get('msg') }}
				</div>
			@endif
			<div class="card">
				<div class="card-header bg-info text-white">
					<h4>Login</h4>
				</div>
				<div class="card-body">
					<form class="needs-validation" method="post" action="{{ route('admin.login') }}" novalidate>
						{{ csrf_field() }}
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" name="username" id="username" placeholder="Username" class="form-control" required>
							<div class="invalid-feedback">Username is required</div>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" name="password" id="password" placeholder="Password" class="form-control" required>
							<div class="invalid-feedback">Password is required</div>
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="remember" name="remember">
								<label class="custom-control-label" for="remember">Remember me?</label>
							</div>
						</div>
						<button class="btn btn-info btn-block">Login</button>
					</form>
				</div>
			</div>
		</div>
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