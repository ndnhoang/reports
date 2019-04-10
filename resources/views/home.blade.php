@extends('layouts.app')

@section('content')
<div class="container">
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    @if ($user->department && count($user->department->reports) > 0)
        @foreach ($user->department->reports as $report)
            <?php ?>
            <form class="card my-4 needs-validation h6" action="{{ route('report.save') }}" method="post" novalidate>
                {{ csrf_field() }}
                <div class="card-header"><strong>{{ $report->report_type->name }}</strong> - {{ $report->name }}</div>
                <input type="hidden" name="report" value="{{ $report->id }}">
                <div class="card-body">
                    <h5 class="card-title"><strong>{{ $user->department->name }}</strong></h5>
                    <input type="hidden" name="departments[]" value="{{ $user->department->id }}">
                    <div class="card-content mb-5">
                        <div class="form-group">
                            <label for=""><strong>Chi tiết (tỷ lệ % hoặc mức đóng góp, đối tượng nộp và nội dung nguồn thu của Quỹ)</strong></label>
                            <div class="form-row">
                                <?php $meta_value = $user->department->reports()->where('report_id', $report->id)->first()->pivot->value ?>
                                @if ($meta_value)
                                    <?php $meta_value = json_decode($meta_value) ?>
                                    <?php $value_data = $user->department->reports()->where('report_id', $report->id)->first()->pivot->value_data ?>
                                    <?php $value_data = json_decode($value_data) ?> 
                                    <?php $departmentTmp = $user->department->id ?>
                                    <?php $count_key = $value_data ? count($value_data->$departmentTmp->detail) : 0; ?>
                                    @foreach ($meta_value as $key => $value)
                                        <div class="col-md-4">
                                            <label for="">{{ $value }}</label>
                                            <div class="input-group">
                                                <input class="form-control input-number" value="{{ ($key < $count_key) ? $value_data->$departmentTmp->detail[$key] : '' }}" type="text" name="detail_{{ $user->department->id }}[]">
                                                <div class="input-group-append"><span class="input-group-text">triệu đ</span></div>   
                                                <div class="invalid-feedback">Field is required</div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <?php $report_meta_period = App\ReportMeta::where('report_id', $report->id)->where('meta_name', 'period')->first(); 
                        if ($report_meta_period) {
                            $report_meta_period = json_decode($report_meta_period->meta_value);
                        }
                        $report_meta_last_year = App\ReportMeta::where('report_id', $report->id)->where('meta_name', 'last_year')->first();
                        if ($report_meta_last_year) {
                            $report_meta_last_year = $report_meta_last_year->meta_value;
                        }
                        ?>
                        @if ($report_meta_period && $report_meta_period->period_from && $report_meta_last_year)
                            @for ($i = $report_meta_period->period_from; $i <= $report_meta_last_year; $i++)
                                <?php $year = 'year_'.$i ?>
                                <?php $count_kh = $value_data ? count($value_data->$departmentTmp->$year->kh) : 0 ?>
                                <?php $count_th = $value_data ? count($value_data->$departmentTmp->$year->th) : 0 ?>
                                <div class="form-group">
                                    <label for=""><strong>Năm {{ $i }} (KH)</strong></label>
                                    <div class="form-row">
                                        @if ($meta_value)
                                            @foreach ($meta_value as $key => $value)
                                                <div class="col-md-4">
                                                    <label for="">{{ $value }}</label>
                                                    <div class="input-group">
                                                        <input class="form-control input-number" value="{{ ($key < $count_kh) ? $value_data->$departmentTmp->$year->kh[$key] : '' }}" type="text" name="KH{{ $i }}_{{ $user->department->id }}[]">
                                                        <div class="input-group-append"><span class="input-group-text">triệu đ</span></div>   
                                                        <div class="invalid-feedback">Field is required</div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for=""><strong>Năm {{ $i }} (TH)</strong></label>
                                    <div class="form-row">
                                        @if ($meta_value)
                                            @foreach ($meta_value as $key => $value)
                                                <div class="col-md-4">
                                                    <label for="">{{ $value }}</label>
                                                    <div class="input-group">
                                                        <input class="form-control input-number" value="{{ ($key < $count_th) ? $value_data->$departmentTmp->$year->th[$key] : '' }}" type="text" name="TH{{ $i }}_{{ $user->department->id }}[]">
                                                        <div class="input-group-append"><span class="input-group-text">triệu đ</span></div>   
                                                        <div class="invalid-feedback">Field is required</div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endfor
                        @endif
                        @if ($report_meta_period && $report_meta_period->period_to && $report_meta_last_year)
                            @for ($i = $report_meta_last_year + 1; $i <= $report_meta_period->period_to; $i++)
                                <?php $year = 'year_'.$i ?>
                                <?php $count_kh = $value_data ? count($value_data->$departmentTmp->$year->kh) : 0 ?>
                                <div class="form-group">
                                    <label for=""><strong>Kế hoạch {{ $i }}</strong></label>
                                    <div class="form-row">
                                        @if ($meta_value)
                                            @foreach ($meta_value as $key => $value)
                                                <div class="col-md-4">
                                                    <label for="">{{ $value }}</label>
                                                    <div class="input-group">
                                                        <input class="form-control input-number" value="{{ ($key < $count_kh) ? $value_data->$departmentTmp->$year->kh[$key] : '' }}" type="text" name="KH{{ $i }}_{{ $user->department->id }}[]">
                                                        <div class="input-group-append"><span class="input-group-text">triệu đ</span></div>   
                                                        <div class="invalid-feedback">Field is required</div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endfor
                        @endif
                    </div>
                    <?php $department_childs = App\Department::where('parent', $user->department->id)->get() ?>
                    @if ($department_childs)
                        @foreach ($department_childs as $child)
                            <?php $departmentTmp = $child->id ?>
                            <?php $count_key = $value_data ? count($value_data->$departmentTmp->detail) : 0 ?>
                            <h5 class="card-title"><strong>{{ $child->name }} (tách ra từ "{{ $user->department->name }}")</strong></h5>
                            <input type="hidden" name="departments[]" value="{{ $child->id }}">
                            <div class="card-content mb-5">
                                <div class="form-group">
                                    <label for=""><strong>Chi tiết (tỷ lệ % hoặc mức đóng góp, đối tượng nộp và nội dung nguồn thu của Quỹ)</strong></label>
                                    <div class="form-row">
                                        <?php $meta_value = $user->department->reports()->where('report_id', $report->id)->first()->pivot->value ?>
                                        @if ($meta_value)
                                            <?php $meta_value = json_decode($meta_value) ?>
                                            @foreach ($meta_value as $key => $value)
                                                <div class="col-md-4">
                                                    <label for="">{{ $value }}</label>
                                                    <div class="input-group">
                                                        <input class="form-control input-number" value="{{ ($key < $count_key) ? $value_data->$departmentTmp->detail[$key] : '' }}" type="text" name="detail_{{ $child->id }}[]">
                                                        <div class="input-group-append"><span class="input-group-text">triệu đ</span></div>   
                                                        <div class="invalid-feedback">Field is required</div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <?php $report_meta_period = App\ReportMeta::where('report_id', $report->id)->where('meta_name', 'period')->first(); 
                                if ($report_meta_period) {
                                    $report_meta_period = json_decode($report_meta_period->meta_value);
                                }
                                $report_meta_last_year = App\ReportMeta::where('report_id', $report->id)->where('meta_name', 'last_year')->first();
                                if ($report_meta_last_year) {
                                    $report_meta_last_year = $report_meta_last_year->meta_value;
                                }
                                ?>
                                @if ($report_meta_period && $report_meta_period->period_from && $report_meta_last_year)
                                    @for ($i = $report_meta_period->period_from; $i <= $report_meta_last_year; $i++)
                                        <?php $year = 'year_'.$i ?>
                                        <?php $count_kh = $value_data ? count($value_data->$departmentTmp->$year->kh) : 0 ?>
                                        <?php $count_th = $value_data ? count($value_data->$departmentTmp->$year->th) : 0 ?>
                                        <div class="form-group">
                                            <label for=""><strong>Năm {{ $i }} (KH)</strong></label>
                                            <div class="form-row">
                                                @if ($meta_value)
                                                    @foreach ($meta_value as $key => $value)
                                                        <div class="col-md-4">
                                                            <label for="">{{ $value }}</label>
                                                            <div class="input-group">
                                                                <input class="form-control input-number" value="{{ ($key < $count_kh) ? $value_data->$departmentTmp->$year->kh[$key] : '' }}" type="text" name="KH{{ $i }}_{{ $child->id }}[]">
                                                                <div class="input-group-append"><span class="input-group-text">triệu đ</span></div>   
                                                                <div class="invalid-feedback">Field is required</div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for=""><strong>Năm {{ $i }} (TH)</strong></label>
                                            <div class="form-row">
                                                @if ($meta_value)
                                                    @foreach ($meta_value as $key => $value)
                                                        <div class="col-md-4">
                                                            <label for="">{{ $value }}</label>
                                                            <div class="input-group">
                                                                <input class="form-control input-number" value="{{ ($key < $count_th) ? $value_data->$departmentTmp->$year->th[$key] : '' }}" type="text" name="TH{{ $i }}_{{ $child->id }}[]">
                                                                <div class="input-group-append"><span class="input-group-text">triệu đ</span></div>   
                                                                <div class="invalid-feedback">Field is required</div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                                @if ($report_meta_period && $report_meta_period->period_to && $report_meta_last_year)
                                    @for ($i = $report_meta_last_year + 1; $i <= $report_meta_period->period_to; $i++)
                                        <?php $year = 'year_'.$i ?>
                                        <?php $count_kh = $value_data ? count($value_data->$departmentTmp->$year->kh) : 0 ?>
                                        <div class="form-group">
                                            <label for=""><strong>Kế hoạch {{ $i }}</strong></label>
                                            <div class="form-row">
                                                @if ($meta_value)
                                                    @foreach ($meta_value as $key => $value)
                                                        <div class="col-md-4">
                                                            <label for="">{{ $value }}</label>
                                                            <div class="input-group">
                                                                <input class="form-control input-number" value="{{ ($key < $count_kh) ? $value_data->$departmentTmp->$year->kh[$key] : '' }}" type="text" name="KH{{ $i }}_{{ $child->id }}[]">
                                                                <div class="input-group-append"><span class="input-group-text">triệu đ</span></div>   
                                                                <div class="invalid-feedback">Field is required</div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                            </div>
                        @endforeach
                    @endif
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        @endforeach
    @else
        <div class="alert alert-danger">
            <h5 class="mb-0">No data</h5>
        </div>
    @endif
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
    $(document).ready(function () {
        // Adds the thousands separator
        function formatNumber(num) {
            return ("" + num).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, function($1) { return $1 + "." });
        }

        //called when key is pressed in textbox
        $(".input-number").keypress(function (e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
        $(".input-number").keyup(function (e) {
            var value = this.value;
            for(var i = 0; i < value.length; i++) {
                value = value.replace(".", "");
            }
            this.value = formatNumber(value);
        });
    });
</script>

@endsection
