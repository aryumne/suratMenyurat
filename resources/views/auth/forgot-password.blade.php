<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

@extends('layouts.guest')
@section('content')
    <div class="row align-items-center justify-content-center g-0
                                                    min-vh-100">
        <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0">
            <!-- Card -->
            <div class="card smooth-shadow-md">
                <!-- Card body -->
                <div class="card-body p-6 ">
                    <div class="mb-4">
                        <h3 class="text-start text-primary pb-1 mb-2" style="font-weight: 600;">Forgot Password</h3>
                        <p class="mb-5">Don't worry, we'll send you an email to reset your password.
                        </p>
                    </div>
                    <!-- Form -->
                    <form method="POST" action="{{ route('password.email') }}">
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" name="email" placeholder="Example@gmail.com"
                                required="">
                        </div>
                        <!-- Button -->
                        <div class="mb-3 d-grid">
                            <button type="submit" class="btn btn-primary">
                                Reset Password
                            </button>
                        </div>
                        <span>Don't have an account? <a href="{{ route('register') }}">sign up</a></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
