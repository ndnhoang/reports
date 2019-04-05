@extends('admin.layouts.master')

@section('content')
<div class="row">
	<div class="col-md-12">
		<h4 class="float-left">Edit Report</h4>
		<a href="{{ route('admin.report.export', [$id]) }}" class="btn btn-primary float-right">Export</a>
	</div>
</div>

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
					<form class="needs-validation" action="{{ route('admin.report.add.meta', [$id]) }}" method="post" novalidate>
						{{ csrf_field() }}
						<div class="form-group">
							<div class="form-row">
								<div class="col-md-6">
									<label for="period">Period</label>
									<div class="form-row">
										<div class="col-md-6">
											<div class="input-group">
												<input type="text" name="period_from" value='{{ $report_metas->period ? $report_metas->period->period_from : ''}}' class="form-control datepicker-view-mode" placeholder="From" required>
												<div class="input-group-append">
													<span class="input-group-text">
															<i class="far fa-calendar-alt"></i>
													</span>
												</div>
												<div class="invalid-feedback">Period from is required</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-group">
												<input type="text" name="period_to" value='{{ $report_metas->period ? $report_metas->period->period_to : '' }}' class="form-control datepicker-view-mode" placeholder="To" required>
												<div class="input-group-append">
													<span class="input-group-text">
															<i class="far fa-calendar-alt"></i>
													</span>
												</div>
												<div class="invalid-feedback">Period to is required</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-row">
										<div class="col-md-6">
											<label for="last_year">Last year</label>
											<div class="input-group">
												<input type="text" name="last_year" value='{{ $report_metas->last_year }}' class="form-control datepicker-view-mode" placeholder="Last year" required>
												<div class="input-group-append">
													<span class="input-group-text">
															<i class="far fa-calendar-alt"></i>
													</span>
												</div>
												<div class="invalid-feedback">Last year is required</div>
											</div>
										</div>
										<div class="col-md-6">
											<label for="dispatch_date">Dispatch date</label>
											<div class="input-group">
												<input type="text" name="dispatch_date" value='{{ $report_metas->dispatch_date }}' class="form-control datepicker-view-mode-month" placeholder="Dispatch date" required>
												<div class="input-group-append">
													<span class="input-group-text">
															<i class="far fa-calendar-alt"></i>
													</span>
												</div>
												<div class="invalid-feedback">Dispatch date is required</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="form-row">
								<div class="col-md-12">
									<div class="input-group select2">
										<input type="hidden" name="departments_prev" value='{{ collect($report_metas->departments)->implode(",") }}'>
										<select name="departments" class="form-control select2-multiple" multiple="multiple">
												@if ($departments)
													@foreach ($departments as $department)
														<option value="{{ $department->id }}">{{ $department->name }}</option>
													@endforeach
												@endif
										</select>
										<div class="input-group-append">
											<button type="button" class="btn btn-primary" id="add_department">Add department</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="departments_container" class="py-3">
							@if ($report_metas->money_sources)
								@foreach ($report_metas->money_sources as $key => $items)
									<div id="department_meta_{{ $key }}" class="department-group py-2">
										<hr>
										<label>{{ App\Department::find($key)->name }}</label>
										@foreach($items as $index => $item)
										<div class="form-group">
											<div class="form-row">
												<div class="col-md-6">
													<div class="input-group">
														<input type="text" name="money_source_{{ $key }}[]" value="{{ $item }}" class="form-control" required="">
														<div class="input-group-append">
															<button class="btn btn-outline-success btn-add" type="button" data-id="{{ $key }}"><i class="fas fa-plus"></i></button>
															<button style="display: {{ ($index == 0) ? 'none' : 'block' }};" class="btn btn-outline-danger btn-remove" type="button" data-id="{{ $key }}"><i class="fas fa-minus"></i></button>
														</div>
														<div class="invalid-feedback">Please enter data</div>
													</div>
												</div>
											</div>
										</div>
										@endforeach
									</div>
								@endforeach
							@endif
						</div>
						<button type="submit" class="btn btn-primary">Save</button>
						<a href="{{ route('admin.report') }}" class="btn btn-dark float-right">Return to list</a>
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

$(function() {
    $('a[data-toggle="tab"]').on('click', function(e) {
        window.localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = window.localStorage.getItem('activeTab');
    if (activeTab) {
		$('#nav-tab a[href="' + activeTab + '"]').tab('show');
    }
});

function addDepartment(department) {
	$html = '<div id="department_meta_'+department["id"]+'" class="department-group py-2"><hr>' +
		'<label>'+department["name"]+'</label>' +
		'<div class="form-group">' + 
		'<div class="form-row">' +
			'<div class="col-md-6">' +
				'<div class="input-group">' +
					'<input type="text" name="money_source_'+department["id"]+'[]" class="form-control" required>' +
					'<div class="input-group-append">' +
						'<button class="btn btn-outline-success btn-add" type="button" data-id="'+department["id"]+'"><i class="fas fa-plus"></i></button>' +
						'<button style="display: none;" class="btn btn-outline-danger btn-remove" type="button" data-id="'+department["id"]+'"><i class="fas fa-minus"></i></button>' +
					'</div>' +
					'<div class="invalid-feedback">Please enter data</div>' + 
				'</div>' +
			'</div>' +
		'</div>' +
		'</div>' +
	'</div>';
	return $html;
}
function addMetaOfDepartment(departmentId) {
	$html = '<div class="form-group">' +
		'<div class="form-row">' +
			'<div class="col-md-6">' +
				'<div class="input-group">' +
					'<input type="text" name="money_source_'+departmentId+'[]" class="form-control" required>' +
					'<div class="input-group-append">' +
						'<button class="btn btn-outline-success btn-add" type="button" data-id="'+departmentId+'"><i class="fas fa-plus"></i></button>' +
						'<button class="btn btn-outline-danger btn-remove" type="button" data-id="'+departmentId+'"><i class="fas fa-minus"></i></button>' +
					'</div>' +
					'<div class="invalid-feedback">Please enter data</div>' + 
				'</div>' +
			'</div>' +
		'</div>' +
	'</div>';
	return $html;
}
$(document).on('click', '.btn-add', function() {
	var id = $(this).attr('data-id');
	var parent = $(this).parents('.form-group').first();
	$(addMetaOfDepartment(id)).insertAfter(parent);
	var parent_group = $(this).parents('.department-group').first();
	parent_group.find('.btn-remove').show();
});
$(document).on('click', '.btn-remove', function() {
	var parent_group = $(this).parents('.department-group').first();
	var group = parent_group.find('.form-group');
	if (group.length <= 2) {
		parent_group.find('.btn-remove').hide();
	}

	var id = $(this).attr('data-id');
	var parent = $(this).parents('.form-group').first();
	parent.remove();
});

$( ".select2-single, .select2-multiple" ).select2( {
	theme: "bootstrap",
	placeholder: "Select a State",
	maximumSelectionSize: 6,
	containerCssClass: ':all:'
} );
$("select[name=departments]").on("select2:select", function (evt) {
	var element = evt.params.data.element;
	var $element = $(element);
	
	$element.detach();
	$(this).append($element);
	$(this).trigger("change");
});
@if ($report_metas->departments)
	var departments = [];
	@foreach ($report_metas->departments as $department)
		departments.push({{ $department }});
	@endforeach
	$("select[name=departments]").val(departments);
	$('select[name=departments]').trigger('change');
@endif
$('#add_department').on('click', function() {
	var departments_prev = $('input[name=departments_prev]').val();
	var departments = $('select[name=departments]').select2('val');
	$('input[name=departments_prev]').val(departments);
	if (departments_prev == '') {
		departments_prev = [];
	} else {
		departments_prev = departments_prev.split(',');
	}
	if (departments == '') {
		departments = [];
	} 
	var departments_add = arr_diff(departments_prev, departments);
	var departments_remove = arr_diff(departments, departments_prev);
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		},
		type: 'get',
		url: '/admin/report/departments',
		data: {departments_add: departments_add, departments_remove: departments_remove},
		dataType: 'json',
		success: function(response) {
			if (response.departments_add.length > 0) {
				for (var i = 0; i < response.departments_add.length; i++) {
					$('#departments_container').append(addDepartment(response.departments_add[i]));
				}
			}
			if (response.departments_remove.length > 0) {
				for (var i = 0; i < response.departments_remove.length; i++) {
					$('#department_meta_'+response.departments_remove[i]['id']).remove();
				}
			}
		}
	});
});
function arr_diff (a1, a2) {

    var a = []

    for (var i = 0; i < a2.length; i++) {
        if (a1.indexOf(a2[i]) == -1) {
			a.push(a2[i]);
		}
	}
	return a;
}

</script>

@endsection