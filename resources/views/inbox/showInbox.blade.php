@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-8 col-12 pe-md-1 mb-2">
            <div class="card mb-2">
                <div class="card-body" style="margin-bottom: -10px;">
                    <h4 class="card-title pb-1">
                        Deskripsi {{ $inbox->tipe_surat === 1 ? 'Masuk' : 'Keluar' }}
                    </h4>
                    <h6 class="card-subtitle pt-1 mb-1 text-muted ">{{ $inbox->jenisSurat->jenis_surat_name }}</h6>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-info mx-3" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="table-responsive pe-md-4 p-2 mt-0">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th scope="row" style="width: 30%; padding-right:0;">Nomor Surat</th>
                                <td style="width: 5%: padding: 0px;">:</td>
                                <td class="text-capitalize" style="width: 65%; padding-left:0;">{{ $inbox->nomor_surat }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="padding-right:0;">Tanggal Masuk</th>
                                <td>:</td>
                                <td class="text-capitalize" style="padding-left:0;">
                                    {{ date('d M Y', strtotime($inbox->tanggal_masuk)) }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="padding-right:0;">Jenis Surat</th>
                                <td>:</td>
                                <td class="text-capitalize" style="padding-left:0;">
                                    {{ $inbox->jenisSurat->jenis_surat_name }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="padding-right:0;">Perihal</th>
                                <td>:</td>
                                <td class="text-capitalize" style="padding-left:0;">{{ $inbox->perihal }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="padding-right:0;">Catatan</th>
                                <td>:</td>
                                <td class="text-capitalize" style="text-align: justify; padding-left:0;">
                                    {{ $inbox->catatan }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="padding-right:0;">Pengelola</th>
                                <td>:</td>
                                <td class="text-capitalize" style="padding-left:0;">{{ $inbox->user->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-end">
                    <form action="{{ route('inbox.destroy', $inbox) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Apakah anda yakin untuk menghapus data ini?')">Hapus</button>
                    </form>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                        data-bs-target="#formEdit">Ubah</button>
                </div>
            </div>
            <div class="card">
                <div class="card-body d-flex justify-content-between" style="margin-bottom: -10px;">
                    <h4 class="card-title" style="display: inline-block;">
                        Progress Disposisi
                    </h4>
                    @if ($dispos->count() < 3)
                        <button type="button" class="btn btn-primary btn-sm" style="display: inline-block"
                            data-bs-toggle="modal" data-bs-target="#dispositionModal">Disposisikan</button>
                    @else
                        <button type="button" class="btn btn-secondary btn-sm" style="display: inline-block"
                            data-bs-toggle="tooltip" data-placement="top" title="Disposisi sudah selesai!">
                            Disposisikan
                        </button>
                    @endif
                </div>
                <div class="px-3">
                    @if (session()->has('dispSuccess'))
                        <div class="alert alert-info" role="alert">
                            {{ session('dispSuccess') }}
                        </div>
                    @endif
                    @if (session()->has('successDelete'))
                        <div class="alert alert-info" role="alert">
                            {{ session('successDelete') }}
                        </div>
                    @endif
                    {{-- @if (session()->has('successDelete'))
                        <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
                            <div id="liveToast" class="toast fade show" role="alert" aria-live="assertive"
                                aria-atomic="true">
                                <div class="toast-header bg-primary">
                                    <img src="..." class="rounded me-2" alt="...">
                                    <strong class="me-auto text-white fw-normal">Success</strong>
                                    <small class="text-light">menghapus</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast"
                                        aria-label="Close"></button>
                                </div>
                                <div class="toast-body">
                                    {{ session('successDelete') }}
                                </div>
                            </div>
                        </div>
                    @endif --}}

                </div>
                <div class="mx-4 mb-5">
                    <div class="progress mt-5 mb-4 mx-3">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                            style="width: {{ ($dispos->count() / 3) * 100 }}%"
                            aria-valuenow="{{ ($dispos->count() / 3) * 100 }}" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                </div>
                <div class="table-responsive pe-md-4 p-2 mt-0">
                    <table class="table table-borderless">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Disposisi Dari</th>
                                <th scope="col">Disposisi Ke</th>
                                <th scope="col">Catatan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dispos as $item)
                                <tr>
                                    <td>{{ $item->userIdFrom->name }}</td>
                                    <td>{{ $item->userIdTo->name }}</td>
                                    <td>{{ $item->pesan }}</td>
                                    <td>Terkirim</td>
                                    <td>
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
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-12 ps-md-1">
            <div class="row">
                <div class="col-12 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title pb-1">
                                Daftar Lampiran
                            </h4>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#uploadModal">Upload File</button>
                        </div>
                        <div class="mx-5 mb-4 px-2">
                            @if (session()->has('successUpload'))
                                <div class="alert alert-info" role="alert">
                                    {{ session('successUpload') }}
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
                            @if (count($lampirans) === 0)
                                <p class="text-center">Lampiran belum diupload</p>
                            @endif
                            @foreach ($lampirans as $url)
                                <div class="row d-flex justify-content-between align-items-center mb-1">
                                    <div class="col-7 text-truncate">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <a href="{{ asset('storage/' . $url->lampiran_path) }}" target="_blank"
                                                class="text-decoration-none text-secondary">
                                                {{ substr($url->lampiran_path, 9) }}</a>
                                        </label>
                                    </div>
                                    <div class="col-5 ps-2">
                                        {{-- href without routenmae "/admin/download/{{ $url->id }}" --}}
                                        <a href="{{ route('inbox.download', $url) }}"
                                            class="btn btn-warning btn-sm mb-1"><i data-feather="download"
                                                class="nav-icon icon-xs"> </i></a>
                                        <form action="{{ route('inbox.removePath', $url) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm mb-1"
                                                onclick="return confirm('Hapus lampiran ini?');"><i data-feather="trash-2"
                                                    class="nav-icon icon-xs"> </i></button>
                                        </form>
                                    </div>


                                </div>
                            @endforeach

                            <div class="btn-group mt-3 d-flex justify-content-evenly" role="group"
                                aria-label="Basic example">


                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body" style="margin-bottom: -10px;">
                            <h4 class="card-title">
                                Hak Akses User
                            </h4>
                        </div>
                        <div class="mx-5 mb-4 px-2">
                            <div class="row d-flex justify-content-between align-items-center mb-1 px-3">
                                @foreach ($roles as $role)
                                    <div class="form-check form-switch pb-1">
                                        <input class="form-check-input" type="checkbox" id="checkbox{{ $role->id }}"
                                            name="checkbox{{ $role->id }}" value="{{ $role->id }}"
                                            {{ $role->id <= $inbox->edit_status ? 'checked' : '' }}>
                                        <input type="hidden" id="checkId" value="{{ $inbox->id }}">
                                        <label class="form-check-label" for="checkbox{{ $role->id }}"
                                            style="color: black;">{{ $role->role_name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal edit data --}}
    <div class="modal fade" id="formEdit" tabindex="-1" role="dialog" aria-labelledby="formEditModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="formEditModal">Ubah Surat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('inbox.update', $inbox) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="tipe_surat" name="tipe_surat" class="form-control" value="1">
                        <div class="mb-3">
                            <label class="form-label" for="nomor_surat">Nomor Surat</label>
                            <input type="text" id="nomor_surat" name="nomor_surat"
                                value="{{ old('nomor_surat', $inbox->nomor_surat) }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="tanggal_masuk">Tanggal Masuk</label>
                            <input type="date" id="tanggal_masuk" name="tanggal_masuk"
                                value="{{ old('tanggal_masuk', $inbox->tanggal_masuk) }}" class="form-control"
                                required>
                            <span class="text-muted"><em>* klik ikon untuk pilih tanggal</em></span>
                        </div>
                        <select class="form-select" name="jenis_surat" id="jenis_surat">
                            @foreach ($jenisSurat as $item)
                                <option value="{{ $item->id }}"
                                    {{ $item->id === $inbox->jenisSurat->id ? 'selected' : '' }}>
                                    {{ $item->jenis_surat_name }}</option>
                            @endforeach
                        </select>
                        <div class="mb-3">
                            <label class="form-label" for="perihal">Perihal</label>
                            <input type="text" id="perihal" name="perihal" value="{{ old('perihal', $inbox->perihal) }}"
                                class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="catatan">Catatan</label>
                            <textarea class="form-control" name="catatan" id="catatan"
                                rows="4"> {{ old('catatan', $inbox->catatan) }}</textarea>
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

    {{-- Modal Disposisi --}}
    <div class="modal fade" id="dispositionModal" tabindex="-1" role="dialog" aria-labelledby="formEditModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="formEditModal">Form Disposisi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('disposition.store', $inbox) }}" method="POST">
                        @csrf
                        <input type="hidden" id="inbox_id" name="inbox_id" class="form-control"
                            value="{{ $inbox->id }}">
                        <input type="hidden" id="user_id_from" name="user_id_from" class="form-control"
                            value="{{ $inbox->user_id }}">
                        <div class="mb-3">
                            <label class="form-label" for="user_id_to">Disposisi ke</label>
                            <select class="form-select" name="user_id_to" id="user_id_to">
                                @foreach ($users as $user)
                                    @if ($user->id != $inbox->user_id)
                                        <option value="{{ $user->id }}">
                                            {{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="pesan">Pesan</label>
                            <textarea class="form-control" name="pesan" id="pesan"
                                rows="4"> {{ old('pesan') }}</textarea>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal upload lampiran --}}
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Lampiran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('inbox.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body" id="rows">
                        <input type="hidden" name="inbox_id" value="{{ $inbox->id }}">
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="path_lampiran" name="path_lampiran[]">
                            <button class="btn btn-outline-secondary" type="button" onclick="addRow()"
                                id="inputGroupFileAddon04">Tambah</button>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('/js/inbox.js') }}"></script>
@endsection
