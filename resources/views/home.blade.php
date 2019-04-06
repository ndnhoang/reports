@extends('layouts.app')

@section('content')
<div class="container">
    @if ($user->department)
    <h2>{{ $user->department->name }}</h2>
    @else
        <div class="alert alert-danger">
            <h5 class="mb-0">No data</h5>
        </div>
    @endif
</div>
@endsection
