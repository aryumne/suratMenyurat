<?php

namespace App\Http\Controllers;

use App\Models\Disposition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DispositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dispos = Disposition::latest()->paginate(10);
        $title = 'Data Disposisi';
        return view('inbox.indexDisposisi', [
            'title' => $title,
            'dispos' => $dispos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'inbox_id' => ['required'],
            'pesan' => ['required', 'max:300'],
            'user_id_to' => ['required'],
        ]);

        $validatedData['user_id_from'] = Auth::user()->id;
        // dd($validatedData);
        Disposition::create($validatedData);
        return back()->with('dispSuccess', 'Surat telah didisposisikan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Disposition $disposition)
    {
        dd($disposition);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disposition $disposition)
    {
        $disposition->delete();
        return back()->with('successDelete', 'Disposition sudah dihapus');

    }
}
