@extends('adminlte::page')
@section('title', 'LARAVEL CRM | Dashboard')
@section('content_header')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <h1>Dashboard</h1>
@stop

@auth
    @section('content')
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-secondary">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                Logout
            </button>
        </form>
        <div class="container-fluid px-4">
            <h1 class="mt-4">All Employees</h1>
            <button type="button" class="btn btn-outline-secondary my-3" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">Add Employee</button>
            @include('employees.create')
            <div class="card mb-4">
                <div class="card-body">
                    <table id="employeeTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->first_name }}</td>
                                    <td>{{ $employee->last_name }}</td>
                                    <td>{{ $employee->company->name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>
                                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#UpdateEmployeeModal{{ $employee->id }}">
                                            <i class="fas fa-fw fa-edit"></i>
                                            Edit
                                        </a>
                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-fw fa-trash"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @include('employees.edit')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        @push('js')
            <script>
                $(document).ready(function() {
                    $('#employeeTable').DataTable({
                        layout: {
                            bottomStart: 'info',
                            bottomEnd: null
                        },
                        columnDefs: [
                            { "className": "text-center", "targets": "_all" }
                        ],
                        responsive: true,
                        columns: [
                            { width: '5%', targets: 0 }, 
                            { width: '5%', targets: 1 }, 
                            { width: '5%', targets: 2 }, 
                            { width: '5%', targets: 3 },
                            { width: '5%', targets: 4 },
                            { width: '5%', targets: 5 }
                        ]
                    });
                });
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        @endpush
    @stop
@endauth
