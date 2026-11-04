<?php

namespace App\Http\Controllers;

use App\Models\Siswa;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with(['user', 'kelas'])
            ->latest()
            ->paginate(10);

        return view('siswa.index', compact('siswas'));
    }
}
