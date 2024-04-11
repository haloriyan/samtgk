<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiLayanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'lokasi_id', 'layanan_id'
    ];
}
