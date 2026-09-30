<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKembali extends Model
{
    use HasFactory;

    protected $table = 'detail_kembali';

    protected $fillable = [
        'pengembalian_id',
        'buku_id',
        'denda',
    ];

    protected $casts = [
        'denda' => 'decimal:2',
    ];

    public function pengembalian()
    {
        return $this->belongsTo(Pengembalian::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}