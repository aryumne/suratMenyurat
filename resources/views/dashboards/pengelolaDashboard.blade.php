@extends('layouts.app')
@section('content')
    <h1>
        Hello Pegawai asfas
    </h1>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-outline-primary" type="submit"> keluar</button>
    </form>
@endsection
