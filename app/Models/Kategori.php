<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kategori extends Model
{
    // Kolom yang boleh diisi massal (sesuai nama kolom di migration)
    protected $fillable = [
        'kategori',
        'slug_Kategori',
        'deskripsi'
    ];

    /**
     * Boot method - jalan otomatis pas model dipake
     * Analoginya: ini kayak "sesepuh" yang ngawasin 
     * setiap kali ada data baru masuk atau diupdate
     */
    protected static function boot()
    {
        parent::boot();

        // Pas data BARU mau dibuat → auto-generate slug
        static::creating(function ($kategori) {
            $kategori->slug_Kategori = Str::slug($kategori->kategori);
        });

        // Pas data mau di-UPDATE → auto-generate slug lagi
        static::updating(function ($kategori) {
            $kategori->slug_Kategori = Str::slug($kategori->kategori);
        });
    }
}