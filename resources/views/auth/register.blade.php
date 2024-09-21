
@extends('auth.header')

@section('content')



<div class="form-container col-md-4">
    <h3 class="text-center">ABC BANK</h3>
    <h5 class="text-center mb-4">Create new account</h5>

    <form method="POST" action="/register" class="mt-4">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required placeholder="Enter your name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
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
                    <label for="password_confirmation" class="form-label">Confirm Password:</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Confirm your password">
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary w-25">Register</button>
                </div>
                            </form>

    <div class="text-center mt-3">
        <p>Already have an account? <a href="/login">Sign in</a></p>
    </div>
</div>
@endsection


