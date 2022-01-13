<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DispositionController;
use App\Models\Inbox;
use App\Models\JenisSurat;
use App\Models\Lampiran;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InboxController extends Controller
{
    public function index()
    {
        $inboxes = Inbox::latest()->get();
        // dd(request()->all());
        if (request('min') && request('max') && request('jenis_surat') > 0) {
            $min = request('min');
            $max = request('max');
            $jenis_surat = request('jenis_surat');
            $inboxes = Inbox::whereBetWeen('tanggal_masuk', [$min, $max])->where('jenis_surat_id', $jenis_surat)->get();
        }
        //get data from table jenisSurat
        $jenisSurat = JenisSurat::all();
        //get data from inbox sort by descending and paginated 10 records
        return view('inbox.indexInbox', [
            'title' => 'All Inboxes',
            'jenisSurat' => $jenisSurat,
            'inboxes' => $inboxes,
        ]);

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'nomor_surat' => ['required', 'unique:inboxes', 'max:255'],
            'tanggal_masuk' => ['required', 'max:255'],
            'perihal' => ['required', 'max:255'],
            'jenis_surat' => ['required'],
            'catatan' => ['nullable', 'max:500'],
            'path_lampiran.*' => ['mimes:pdf', 'file'],
        ]);

        $validated['user_id'] = Auth::user()->id;

        $getId = Inbox::create([
            'nomor_surat' => $request->nomor_surat,
            'perihal' => $request->perihal,
            'tipe_surat' => $request->tipe_surat,
            'tanggal_masuk' => $request->tanggal_masuk,
            'user_id' => $validated['user_id'],
            'catatan' => $request->catatan,
            'jenis_surat_id' => $request->jenis_surat,
            'edit_status' => 1,
        ]);

        //buat objek request baru
        $storeDisposition = new Request();
        $storeDisposition->setMethod('POST');
        $storeDisposition->request->add([
            'inbox_id' => $getId->id,
            'pesan' => 'Mohon untuk divalidasi dan didisposisikan',
            'user_id_from' => Auth::user()->id,
            'user_id_to' => User::where('role_id', 2)->first()->id,
        ]);
        //buat objeck baru untuk mengakses function dispositionController
        $Dispos = new DispositionController;
        if ($getId) {
            $Dispos->store($storeDisposition);
        }

        // cek isi inputan lampiran,
        // kalau ada panggil function storePath untuk upload file
        if ($request->hasFile('path_lampiran')) {
            $this->storePath($request->file('path_lampiran'), $getId->id);
        }

        return back()->with('success', 'Surat baru berhasil ditambahkan');

    }
    public function upload(Request $request)
    {
        // check validation request
        $request->validate([
            'inbox_id' => ['required'],
            'path_lampiran.*' => ['mimes:pdf', 'file'],
        ]);

        if ($request->hasFile('path_lampiran')) {
            $this->storePath($request->file('path_lampiran'), $request->inbox_id);
            return back()->with('successUpload', 'Surat baru berhasil ditambahkan');
        }

        return back();
    }

    public function show(Inbox $inbox)
    {
        //get field nomor_surat from inbox object
        $nomor = $inbox->nomor_surat;
        // get All table jenisSurats
        $jenisSurat = JenisSurat::all();
        //get lampiran where id.inboxes = inbox_id.lampirans
        $lampirans = $inbox->lampiran()->get();
        // get User
        $users = User::all();
        //get disposition where id.inboxes = inbox_id.dispositions
        $dispos = $inbox->disposition()->get();
        // get roles tabel where id <= 3 (superadmin, admin, and pengelola)
        // $roles = Role::where('id', '<=', 3)->get();
        $roles = Role::find([2, 3]);
        // dd($roles);
        // set title
        $title = "Detail Surat | " . $nomor;
        return view('inbox.showInbox', [
            'title' => $title,
            'inbox' => $inbox,
            'lampirans' => $lampirans,
            'jenisSurat' => $jenisSurat,
            'roles' => $roles,
            'users' => $users,
            'dispos' => $dispos,
        ]);
    }

    public function edit(Inbox $inbox)
    {
        //
    }

    public function update(Request $request, Inbox $inbox)
    {
        //make rules before validation
        $rulesValidate = [
            'tanggal_masuk' => ['required', 'max:255'],
            'perihal' => ['required', 'max:255'],
            'jenis_surat' => ['required'],
        ];

        //check "nomor_surat" has been changed or not
        // if changed add to validation rules
        if ($request->nomor_surat != $inbox->nomor_surat) {
            $rulesValidate['nomor_surat'] = ['required', 'unique:inboxes', 'max:255'];
        }

        // check validation
        $request->validate($rulesValidate);

        //first can use "where"
        // Inbox::where('id', $inbox->id)->update([
        //     'nomor_surat' => $request->nomor_surat,
        //     'perihal' => $request->perihal,
        //     'tipe_surat' => $request->tipe_surat,
        //     'tanggal_masuk' => $request->tanggal_masuk,
        //     'user_id' => $inbox->user_id,
        //     'catatan' => $request->catatan,
        //     'jenis_surat_id' => $request->jenis_surat,
        //     'edit_status' => $inbox->edit_status,
        // ]);

        //second can user "findorFail"
        Inbox::findOrFail($inbox->id)->update([
            'nomor_surat' => $request->nomor_surat,
            'perihal' => $request->perihal,
            'tipe_surat' => $request->tipe_surat,
            'tanggal_masuk' => $request->tanggal_masuk,
            'user_id' => $inbox->user_id,
            'catatan' => $request->catatan,
            'jenis_surat_id' => $request->jenis_surat,
            'edit_status' => $inbox->edit_status,
        ]);

        return back()->with('success', 'Surat berhasil diubah');

    }

    //  Delete inbox with its lampiran and file storage
    public function destroy(Inbox $inbox)
    {
        $paths = $inbox->lampiran()->select('lampiran_path')->get();
        foreach ($paths as $path) {
            // echo $path->lampiran_path;
            Storage::delete($path->lampiran_path);

        }
        //cara pertama menggunakan where
        // Lampiran::where('inbox_id', $inbox->id)->delete();
        // cara kedua
        $inbox->lampiran()->delete();
        $inbox->disposition()->delete();
        $inbox->delete();
        return redirect()->route('inbox.index')->with('success', 'Data berhasil dihapus.');

    }

    public function disposition()
    {
        return view('inbox.disposisi', ['title' => 'Disposisi Inbox']);
    }

    public function storePath($path_lampiran, $id)
    {
        foreach ($path_lampiran as $path) {
            $lampiran_path = time() . rand(1, 100) . '.' . $path->extension();
            $pathUrl = $path->storeAs('lampiran', $lampiran_path);
            Lampiran::create(['inbox_id' => $id, 'lampiran_path' => $pathUrl]);
        }
    }

    public function downloadPath($id)
    {
        $dataLampiran = Lampiran::findOrFail($id);
        $path = $dataLampiran->lampiran_path;
        return Storage::download($path);
    }

    //Delete for lampirans record and filestorage
    public function removePath($id)
    {
        $dataLampiran = Lampiran::findOrFail($id);
        $path = $dataLampiran->lampiran_path;
        Storage::delete($path);
        Lampiran::destroy($id);
        return back()->with('success', 'Lampiran sudah dihapus');
    }

    public function updateEditAccess(Request $request, $id)
    {
        //second can user "findorFail"
        Inbox::findOrFail($id)->update([
            'edit_status' => $request->edit_status,
        ]);

        return response()->json(['success' => 'Surat berhasil diubah' . '|' . $request->edit_status . '|' . $id]);

    }

}
