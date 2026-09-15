<?php

namespace App\Http\Controllers;

use App\Models\Meja;

class HomeController extends Controller
{
    public function index()
    {
        $mejas = Meja::where('status', 'tersedia')
            ->orderBy('lantai')
            ->orderBy('nomor_meja')
            ->get();

        return view('home', compact('mejas'));
    }
}