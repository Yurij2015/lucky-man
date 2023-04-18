@extends('main')
@section('content')
    <div class="container">
        @if(!isset($token))
            <h1>Player register</h1>
            <form method="post" action="{{ route('player-create') }}">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">User Name</label>
                    <input class="form-control @error('username') is-invalid @enderror" name="username" id="username"
                           value="{{ old('username') }}">
                    @error('username')
                    <div class="alert alert-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone"
                           value="{{ old('phone') }}">
                    @error('phone')
                    <div class="alert alert-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        @else
            <h1>Player registered</h1>
            <p>Link to game - <a href="{{ route('index') }}?token={{ $token }}">Jump to game!!!</a></p>
        @endif


    </div>
@stop
