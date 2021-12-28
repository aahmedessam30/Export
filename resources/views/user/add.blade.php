@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ __('messages.Add User') }}</h1>

        <form method="post" action="{{ route('user.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- User Name --}}
            <div class="form-group mb-3">
                <label for="name">{{ __('messages.Full Name') }}</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" required
                    autofocus value="{{ old('name') }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- User Username --}}
            <div class="form-group mb-3">
                <label for="username">{{ __('messages.Username') }}</label>
                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                    value="{{ old('username') }}" required autocomplete="username" autofocus>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- User Email --}}
            <div class="form-group mb-3">
                <label for="email">{{ __('messages.Email') }}</label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" required
                    autofocus value="{{ old('email') }}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- User Password --}}
            <div class="form-group mb-3">
                <label for="password">{{ __('messages.Password') }}</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    id="password" required autofocus value="{{ old('password') }}">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- User Phone --}}
            <div class="form-group mb-3">
                <label for="phone">{{ __('messages.Phone') }}</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone"
                    required autofocus value="{{ old('phone') }}">
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">{{ __('messages.Add User') }}</button>
        </form>
    </div>
@endsection
