<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    /**
     * Menampilkan daftar kategori (Read)
     * Analogi: Resepsionis yang nyiapin daftar tamu yang udah datang
     */
    public function index()
    {
        $kategoris = Kategori::latest()->paginate(10);
        return view('kategori.index', compact('kategoris'));
    }

    /**
     * Menyimpan kategori baru (Create)
     * Analogi: Resepsionis yang nenerima tamu baru dan ngecek KTP-nya
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk (kayak ngecek KTP tamu)
        $request->validate([
            'kategori' => 'required|string|max:50|unique:kategoris,kategori',
            'deskripsi' => 'nullable|string|max:255',
        ], [
            'kategori.required' => 'Nama kategori wajib diisi.',
            'kategori.unique' => 'Nama kategori sudah terdaftar.',
            'kategori.max' => 'Maksimal 50 karakter.',
        ]);

        // Simpan data ke database
        Kategori::create([
            'kategori' => $request->kategori,
            'slug_Kategori' => Str::slug($request->kategori),
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Mengupdate kategori yang udah ada (Update)
     * Analogi: Resepsionis yang ngedit data tamu yang udah terdaftar
     */
    public function update(Request $request, Kategori $kategori)
    {
        // Validasi, tapi exclude ID sendiri biar nggak error "sudah terdaftar"
        $request->validate([
            'kategori' => 'required|string|max:50|unique:kategoris,kategori,' . $kategori->id,
            'deskripsi' => 'nullable|string|max:255',
        ]);

        // Update data
        $kategori->update([
            'kategori' => $request->kategori,
            'slug_Kategori' => Str::slug($request->kategori),
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Menghapus kategori (Delete)
     * Analogi: Resepsionis yang ngehapus data tamu yang batal datang
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}