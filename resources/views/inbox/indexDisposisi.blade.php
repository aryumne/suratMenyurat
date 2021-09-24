@extends('layouts.app')
@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div class="">
                    <h1>
                        All Inboxes
                    </h1>
                </div>
                <div>
                    <button  class="
                    btn btn-primary" data-bs-toggle="modal" data-bs-target="#newInbox">Surat Baru
                    Masuk</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white border-bottom-0 py-4">
                    <h4 class="mb-0">Daftar Surat Masuk</h4>
                </div>
                <div class="py-2 px-4">
                    @if (session()->has('success'))
                        <div class="alert alert-info" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Disposisi Dari</th>
                                <th scope="col">Disposisi Ke</th>
                                <th scope="col">Catatan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        @if ($dispos->total() > 0)
                            <tbody>
                                @foreach ($dispos as $key => $item)
                                    <tr>
                                        <td scope="row">{{ $dispos->firstItem() + $key }}</td>
                                        <td>{{ $item->userIdFrom->name }}</td>
                                        <td>{{ $item->userIdTo->name }}</td>
                                        <td>{{ Str::limit($item->pesan, 25) }} </td>
                                        <td>
                                            <a href="{{ route('disposition.show', $item) }}"
                                                class="btn btn-primary p-2"><i data-feather="eye"
                                                    class="nav-icon icon-xs"></i></a>
                                            <a href="{{ route('disposition.show', $item) }}"
                                                class="btn btn-warning p-2"><i data-feather="edit-3"
                                                    class="nav-icon icon-xs"></i></a>
                                            <form action="{{ route('disposition.destroy', $item) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger p-2"
                                                    onclick="return confirm('Apakah anda yakin untuk menghapus data ini?')"><i
                                                        data-feather="trash-2" class="nav-icon icon-xs"> </i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @else
                            <tbody>
                                <tr class="text-center">
                                    <td colspan="5">
                                        Belum ada surat yang didisposisi
                                    </td>
                                </tr>
                            </tbody>
                        @endif
                    </table>
                    <div class="d-flex justify-content-end me-3">
                        {{ $dispos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
