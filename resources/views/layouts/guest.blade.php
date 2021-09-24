<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
</head>

<body>
    <!-- container -->
    <div class="container d-flex flex-column">
        @yield('content')
    </div>
    <!-- Scripts -->
    @include('layouts.footer')
