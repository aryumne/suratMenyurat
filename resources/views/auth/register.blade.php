@extends('layouts.guest')
@section('content')
    <div class="row align-items-center justify-content-center g-0  min-vh-100">
        <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0">
            <!-- Card -->
            <div class="card smooth-shadow-md">
                <!-- Card body -->
                <div class="card-body p-6 pt-6">
                    <div class="mb-4">
                        <h2 class="text-center text-primary pb-1 mb-2" style="font-weight: 600;">SIGN UP</h2>
                        <hr width="60px" class="mx-auto mt-0 pt-0 mb-6" style="color:#754ffe; height: 3px">
                    </div>
                    <!-- Form -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <!-- Username -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                                name="name" placeholder="Enter your name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" placeholder="example@gmail.com" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="********" required>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm
                                Password</label>
                            <input type="password" id="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" placeholder="********" required>
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <!-- Checkbox -->
                        <div class="mb-3">
                            <div class="form-check custom-checkbox">
                                <input type="checkbox" class="form-check-input" id="agreeCheck">
                                <label class="form-check-label" for="agreeCheck"><span class="fs-5">I agree to the <a
                                            href="terms-condition-page.html">Terms of
                                            Service </a>and
                                        <a href="terms-condition-page.html">Privacy Policy.</a></span></label>
                            </div>
                        </div>
                        <div>
                            <!-- Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Create Free Account
                                </button>
                            </div>

                            <div class="d-md-flex justify-content-start mt-4">
                                <div class="mb-2 mb-md-0">
                                    <a href="{{ route('login') }}" class="fs-5">Already
                                        registered?</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
