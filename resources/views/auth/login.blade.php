@extends('auth.header')

@section('content')



<div class="form-container col-md-4">
    <h3 class="text-center">ABC BANK</h3>
    <h5 class="text-center mb-4">Login to your account</h5>

   <form method="POST" action="/login" class="mt-4">
 @csrf
        <div class="card-body">
            <form method="POST" action="/login" class="mt-4">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required placeholder="Enter your email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Enter your password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-25">Login</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer text-center">
            <p>Don't have an account? <a href="/register">Register here</a></p>
        </div>

@endsection
