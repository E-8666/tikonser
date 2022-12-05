<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_reedem', 'id_customer', 'id_tiket', 'status', 'jumlah_harga', 'jumlah_tiket'
    ];
}
