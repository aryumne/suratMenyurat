@extends('layouts.guest')

@section('content')
    <div
        class="row align-items-center justify-content-center g-0
                                                                                                                            min-vh-100">
        <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0">
            <!-- Card -->
            <div class="card smooth-shadow-md">
                <!-- Card body -->
                <div class="card-body p-6 pt-6">
                    <div class="mb-2">
                        <h2 class="text-center text-primary pb-1 mb-2" style="font-weight: 600;">SIGN IN</h2>
                        <hr width="60px" class="mx-auto mt-0 pt-0 mb-6" style="color:#754ffe; height: 3px">
                        <p class="">Please enter your user information.</p>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger pb-0" role="alert">
                            <div class="font-medium">
                                Whoops! Something went wrong.
                            </div>
                            <p>Please sign in again</p>
                        </div>
                    @endif
                    <!-- Form -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Username -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}"
                                placeholder="Example@gmail.com" required autofocus>
                        </div>
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control" name="password"
                                placeholder="**********" required autocomplete="current-password">
                        </div>
                        <!-- Checkbox -->
                        <div class="d-lg-flex justify-content-between align-items-center mb-4">
                            <div class="form-check custom-checkbox">
                                <input type="checkbox" class="form-check-input" id="rememberme" name="rememberme">
                                <label class="form-check-label" for="rememberme">Remember me</label>
                            </div>
                        </div>
                        <div>
                            <!-- Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Sign
                                    in</button>
                            </div>

                            <div class="d-md-flex justify-content-between mt-4">
                                <div class="mb-2 mb-md-0">
                                    <a href="{{ route('register') }}" class="fs-5">Create An
                                        Account </a>
                                </div>
                                <div>
                                    <a href="{{ route('password.request') }}"
                                        class="text-inherit
                                                                                                                                            fs-5">Forgot
                                        your
                                        password?</a>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
