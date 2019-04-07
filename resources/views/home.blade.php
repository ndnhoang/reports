@extends('layouts.app')

@section('content')
<div class="container">
    @if ($user->department && count($user->department->reports) > 0)
        
            @foreach ($user->department->reports as $report)
                <div class="card my-4">
                    <div class="card-header"><strong>{{ $report->report_type->name }}</strong> - {{ $report->name }}</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->department->name }}</h5>
                        <div class="card-content mb-5">
                            
                        </div>
                        <?php $department_childs = App\Department::where('parent', $user->department->id)->get() ?>
                        @if ($department_childs)
                            @foreach ($department_childs as $child)
                                <h6 class="card-title">{{ $child->name }} (tách ra từ "{{ $user->department->name }}")</h6>
                                <div class="card-content mb-5">
                            
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach
        
    @else
        <div class="alert alert-danger">
            <h5 class="mb-0">No data</h5>
        </div>
    @endif
</div>
@endsection
