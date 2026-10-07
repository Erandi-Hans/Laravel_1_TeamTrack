@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Employee List</h2>
            
            <a href="/employees/create" class="btn btn-success">+ Add New Employee</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Salary</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- if the database donn't have employees show that -->
                        @if($employees->count() > 0)
                         @foreach($employees as $employee)
    <tr>
        <td>{{ $employee->id }}</td>
        <td>{{ $employee->name }}</td>
        <td>{{ $employee->email }}</td>
        <td>{{ $employee->department }}</td>
        <td>${{ number_format($employee->salary, 2) }}</td>
        <td>
            <a href="/employees/{{ $employee->id }}" class="btn btn-info btn-sm">View</a>
            <a href="/employees/{{ $employee->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
            
            <!-- Delete the Form  -->
            <form action="/employees/{{ $employee->id }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">No employees found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection