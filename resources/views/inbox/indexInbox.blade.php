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

                <div class="px-4 pb-4">
                    <form action="{{ route('inbox.index') }}">
                        <div class="row mb-3">
                            <div class="col-lg-3 col-sm-12">
                                <div class="pb-2">
                                    <label for=" min" class="form-label">Tanggal
                                        Awal</label>
                                    <input type="date" class="form-control" id="min" name="min"
                                        value="{{ request('min') }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="pb-2">
                                    <label for="max" class="form-label">Tanggal Akhir</label>
                                    <input type="date" class="form-control" id="max" name="max"
                                        value="{{ request('max') }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="pb-2">
                                    <label for="jenis_surat" class="form-label">Jenis Surat</label>
                                    <select id="jenis_surat" name="jenis_surat" class="form-select">
                                        <option value="0" selected>Semua</option>
                                        @foreach ($jenisSurat as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('jenis_surat') == $item->id ? 'selected' : '' }}>
                                                {{ $item->jenis_surat_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12 d-flex justify-content-evenly align-items-center">
                                <div class="pt-3">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <a href="{{ route('inbox.index') }}" class="btn btn-light">Refresh</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row mb-3 px-3">
                        <button type="button" class="btn btn-secondary">Cetak Excel</button>

                    </div>
                    <div class="table-responsive">
                        <table id="dataTables" class="table text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal Masuk</th>
                                    <th scope="col">Nomor Surat</th>
                                    <th scope="col">Jenis Surat</th>
                                    <th scope="col">Perihal</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            @if ($inboxes->count() > 0)
                                <tbody>
                                    @foreach ($inboxes as $item)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $item->tanggal_masuk }}</td>
                                            <td>{{ $item->nomor_surat }}</td>
                                            <td>{{ $item->jenisSurat->jenis_surat_name }} </td>
                                            <td>{{ $item->perihal }}</td>
                                            <td>
                                                <a href="{{ route('inbox.show', $item) }}" class="btn btn-primary p-2"><i
                                                        data-feather="eye" class="nav-icon icon-xs"></i></a>
                                                <a href="{{ route('inbox.show', $item) }}" class="btn btn-warning p-2"><i
                                                        data-feather="edit-3" class="nav-icon icon-xs"></i></a>
                                                <form action="{{ route('inbox.destroy', $item) }}" method="POST"
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
                                            Belum ada surat masuk
                                        </td>
                                    </tr>
                                </tbody>
                            @endif
                        </table>

                        {{-- <div class="d-flex justify-content-end me-3">
                        {{ $inboxes->links() }}
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="newInbox" tabindex="-1" role="dialog" aria-labelledby="newInboxTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="newInboxTitle">Tambah Surat Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('inbox.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="tipe_surat" name="tipe_surat" class="form-control" value="1">
                        <div class="mb-3">
                            <label class="form-label" for="nomor_surat">Nomor Surat</label>
                            <input type="text" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat') }}"
                                class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="tanggal_masuk">Tanggal Masuk</label>
                            <input type="date" id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}"
                                class="form-control" required>
                            <span class="text-muted"><em>* klik ikon untuk pilih tanggal</em></span>
                        </div>
                        <select class="form-select" name="jenis_surat" id="jenis_surat">
                            <option value="" {{ old('jenis_surat') == '' ? 'selected' : '' }}>Pilih Tipe Surat</option>
                            @foreach ($jenisSurat as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('jenis_surat') == $item->id ? 'selected' : '' }}>
                                    {{ $item->jenis_surat_name }}</option>
                            @endforeach
                        </select>
                        <div class="mb-3">
                            <label class="form-label" for="perihal">Perihal</label>
                            <input type="text" id="perihal" name="perihal" value="{{ old('perihal') }}"
                                class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="catatan">Catatan</label>
                            <textarea class="form-control" name="catatan" id="catatan"
                                rows="4"> {{ old('catatan') }}</textarea>
                            {{-- <textarea type="text" id="textInput" class="form-control"> --}}
                        </div>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="path_lampiran" name="path_lampiran[]">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#dataTables').DataTable();
        });
    </script>
@endsection
