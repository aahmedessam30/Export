@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container-fluid mt-3 mb-3">
        <div class="row">
            <div class="col-md-9">
                @if (Auth::user()->hasRole('admin'))
                    <a href="" class="btn btn-success">Add User</a>
                @endif
                <a href="" class="btn btn-secondary">Export</a>
            </div>
            <div class="col-md-3 ms-auto">
                <form class="d-flex" method="GET" action="{{ route('search') }}" id="search-form">
                    <input class="form-control me-2" type="search" id="search" name="search" placeholder="Search"
                        aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Full Name</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Roles</th>
                @if (Auth::user()->hasRole('admin'))
                    <th scope="col">Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if (count($users) > 0)
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>
                            @foreach ($user->roles as $role)
                                | {{ $role->name }} |
                            @endforeach
                        </td>
                        <td>
                            @if (Auth::user()->hasRole('admin'))
                                <a href="" class="btn btn-primary">Edit</a>
                                <a href="" class="btn btn-danger">Delete</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7">No Users Found</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
