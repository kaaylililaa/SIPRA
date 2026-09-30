<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $fillable = [
        'kategori_id',
        'judul_buku',
        'nama_pengarang',
        'nama_penerbit',
        'tahun_terbit',
        'isbn',
        'gambar_sampul',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function detailPinjam()
    {
        return $this->hasMany(DetailPinjam::class);
    }

    public function detailKembali()
    {
        return $this->hasMany(DetailKembali::class);
    }
}