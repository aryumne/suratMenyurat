<!doctype html>
<html lang="en">

<head>
    @include('layouts.head')
</head>

<body>

    <div id="db-wrapper">

        <!-- Sidebar -->
        @include('layouts.sidebar')

        <div id="page-content">

            <!-- Header Nav -->
            @include('layouts.header')
            <!-- Content Page -->
            <div class="container-fluid px-6 py-4">
                @yield('content')
            </div>

        </div>

    </div>

    @include('layouts.footer')
