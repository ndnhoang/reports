@extends('admin.layouts.master')

@section('content')
<h4>Edit Report</h4>

<div class="row">
	<div class="col-md-12 mt-3">
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

		{{--  Tabs Report Detail  --}}
		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a href="#nav-info" class="nav-item nav-link active" id="nav-info-tab" data-toggle="tab" role="tab" aria-controls="nav-info" aria-selected="true">Info</a>
				<a href="#nav-meta" class="nav-item nav-link" id="nav-meta-tab" data-toggle="tab" role="tab" aria-controls="nav-meta" aria-selected="true">Meta</a>
			</div>
		</nav>

		{{--  Tab content  --}}
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
				<div class="col-md-6 my-5">
						<form class="needs-validation" method="post" action="{{ route('admin.report.edit', [$id]) }}" novalidate>
							{{ csrf_field() }}
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{ $report->name }}" required>
								<div class="invalid-feedback">Report name is required</div>
							</div>
							<div class="form-group">
								<label for="type">Report Type</label>
								<select class="custom-select" name="type" id="type">
										@foreach($report_types as $report_type)
										<option value="{{ $report_type->id }}" {{ ($report->type_id == $report_type->id) ? 'selected' : '' }}>{{ $report_type->name }}</option>
										@endforeach
								</select>
										</div>
							<div class="form-group">
								<label class="mr-3" for="status">Active</label>
								<input type="checkbox" {{ ($report->status == 1) ? 'checked' : '' }}  name="status" id="status" data-toggle="toggle" data-size="sm" data-onstyle="outline-success" data-offstyle="outline-secondary">
							</div>
							<button type="submit" class="btn btn-primary">Edit</button>
							<a href="{{ route('admin.report') }}" class="btn btn-dark float-right">Return to list</a>
						</form>
				</div>
			</div>
			<div class="tab-pane fade" id="nav-meta" role="tabpanel" aria-labelledby="nav-meta-tab">
				<div class="my-5">
					<form class="needs-validation" action="" novalidate>
						{{ csrf_field() }}
						<div class="form-group">
							<div class="form-row">
								<div class="col-md-6">
									<label for="period">Period</label>
									<div class="form-row">
										<div class="col-md-6">
											<div class="input-group">
												<input type="text" class="form-control datepicker-view-mode" placeholder="From">
												<div class="input-group-append">
													<span class="input-group-text">
															<i class="far fa-calendar-alt"></i>
													</span>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-group">
												<input type="text" class="form-control datepicker-view-mode" placeholder="To">
												<div class="input-group-append">
													<span class="input-group-text">
															<i class="far fa-calendar-alt"></i>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-row">
										<div class="col-md-6">
											<label for="last_year">Last year</label>
											<div class="input-group">
												<input type="text" class="form-control datepicker-view-mode" placeholder="Last year">
												<div class="input-group-append">
													<span class="input-group-text">
															<i class="far fa-calendar-alt"></i>
													</span>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<label for="dispatch_date">Dispatch date</label>
											<div class="input-group">
												<input type="text" class="form-control datepicker-view-mode-month" placeholder="Dispatch date">
												<div class="input-group-append">
													<span class="input-group-text">
															<i class="far fa-calendar-alt"></i>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="form-row">
								<div class="col-md-6">
									<button type="button" class="btn btn-primary" id="add_department">Add department</button>
								</div>
							</div>
						</div>
						<div id="departments_container"></div>
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
function addMetaOfDepartment(departmentId) {
	$html = '<div class="form-group"><div class="form-row"><div class="col-md-6"><input type="text" name="money_source_'+departmentId+'" class="form-control"></div></div></div>';
	return $html;
}
$('#add_department').on('click', function() {
	
});
</script>

@endsection