@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Add New Employee</h4>
            </div>
            <div class="card-body">
                
                <!-- Errors පෙන්වීමට -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/employees" method="POST">
                    @csrf <!-- Laravel Security Token එක (අනිවාර්යයි) -->

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-label form-control" id="name" name="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <input type="text" class="form-control" id="department" name="department" value="{{ old('department') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="salary" class="form-label">Salary ($)</label>
                        <input type="number" step="0.01" class="form-control" id="salary" name="salary" value="{{ old('salary') }}" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="/employees" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-success">Save Employee</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection