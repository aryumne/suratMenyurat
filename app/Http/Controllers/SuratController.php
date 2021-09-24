<?php

namespace App\Http\Controllers;

use Illuminate\Http\File;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index()
    {
        $path = "";
        return view('index', ['foto' => $path]);
    }
    public function upload(Request $request)
    {

        // $path = Storage::putFile('Foto Profil', $request->file('_file'));
        $path = $request->file('_file')->store('avatars');
        return view('index', ['foto' => $path]);

    }

}
