@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">Employee Details</h4>
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $employee->id }}</p>
                <p><strong>Name:</strong> {{ $employee->name }}</p>
                <p><strong>Email:</strong> {{ $employee->email }}</p>
                <p><strong>Department:</strong> {{ $employee->department }}</p>
                <p><strong>Salary:</strong> ${{ number_format($employee->salary, 2) }}</p>
                
                <a href="/employees" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection