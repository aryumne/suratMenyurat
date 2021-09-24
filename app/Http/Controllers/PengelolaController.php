<?php

namespace App\Http\Controllers;

class PengelolaController extends Controller
{
    public function index()
    {
        return view('dashboards.pengelolaDashboard', ['title' => 'Dashboard | Pegawai']);
    }
}
