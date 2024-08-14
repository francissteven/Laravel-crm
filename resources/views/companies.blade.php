@extends('adminlte::page')
@section('title', 'LARAVEL CRM | Companies')
@section('content_header')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            {{-- <h1 class="mt-4">All Companies</h1> --}}
            <h1 class="mt-4">{{ trans('company.all_companies') }}</h1>
            <button class="btn btn-outline-secondary my-3" data-bs-toggle="modal" data-bs-target="#addCompanyModal">{{ trans('company.add_company') }}</button>
            <div class="card mb-4">
                <div class="card-body">
                    <table id="companyTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Logo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Website</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($companies as $company)
                                <tr>
                                    <td>
                                        @if ($company->logo)
                                            <img src="{{ asset('storage/' . $company->logo) }}" class="rounded-logo" alt="Logo" width="30" height="30">
                                        @else
                                            No Logo
                                        @endif
                                    </td>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td>{{ $company->website }}</td>
                                    <td>
                                        <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#UpdateCompanyModal{{ $company->id }}">
                                            <i class="fas fa-fw fa-edit"></i>
                                            Edit
                                        </a>
                                        <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-fw fa-trash"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @include('companies.create')
                                @include('companies.edit')
                            @endforeach
                        </tbody> 
                    </table>
                </div>
            </div>
        </div>
        
        @push('js')
            <script>
                $(document).ready(function() {
                    $('#companyTable').DataTable({
                        layout: {
                            bottomStart: 'info',
                            bottomEnd: null
                        },
                        columnDefs: [
                            { "className": "text-center", "targets": "_all" }
                        ],
                        responsive: true,
                        columns: [
                            { width: '3%', targets: 0 }, 
                            { width: '5%', targets: 1 }, 
                            { width: '5%', targets: 2 }, 
                            { width: '5%', targets: 3 },
                            { width: '5%', targets: 4 }
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
