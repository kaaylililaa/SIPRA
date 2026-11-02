<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $fillable = [
        'nama',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
}