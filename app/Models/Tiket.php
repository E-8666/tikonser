<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'stock', 'deskripsi', 'kategori', 'tempat', 'harga', 'tanggal'
    ];
}
