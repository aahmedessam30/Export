@extends('layouts.app')

@section('title', 'Home')

@section('content')

    @if (Session::has('success'))
        <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger text-center">{{ Session::get('error') }}</div>
    @endif

    <div class="container-fluid mb-3">
        <div class="row">
            <div class="col-md-9">
                @if (Auth::user()->hasRole('admin'))
                    <a href="{{ route('user.create') }}" class="btn btn-primary">{{ __('messages.Add User') }}</a>
                @endif
                <a href="{{ route('pdf') }}" class="btn btn-danger">{{ __('messages.Export To PDF') }}</a>
                <a href="{{ route('excel') }}" class="btn btn-success">{{ __('messages.Export To Excel') }}</a>
            </div>
            <div class="col-md-3 ms-auto">
                <form class="d-flex" method="GET" action="{{ route('search') }}" id="search-form">
                    <input class="form-control me-2" type="search" id="search" name="search"
                        placeholder="{{ __('messages.Search') }}" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">{{ __('messages.Search') }}</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('messages.Full Name') }}</th>
                            <th scope="col">{{ __('messages.Username') }}</th>
                            <th scope="col">{{ __('messages.Email') }}</th>
                            <th scope="col">{{ __('messages.Phone') }}</th>
                            @if (Auth::user()->hasRole('admin'))
                                <th scope="col">{{ __('messages.Roles') }}</th>
                                <th scope="col">{{ __('messages.Actions') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                @if (Auth::user()->hasRole('admin'))
                                    <td>
                                        @foreach ($user->roles as $role)
                                            @if ($role->name == 'admin')
                                                {{ __('messages.Admin') }}
                                            @else
                                                {{ __('messages.User') }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('user.edit', $user->id) }}"
                                            class="btn btn-primary">{{ __('messages.Edit') }}</a>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="post"
                                            style="display: inline-block">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="btn btn-danger">{{ __('messages.Delete') }}</button>
                                        </form>
                                @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Pagination -->
    <ul class="pagination justify-content-center">
        <li class="page-item">
            {{ $users->render() }}
        </li>
    </ul>
@endsection
