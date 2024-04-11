<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiJadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'lokasi_id', 'hari', 'jam_mulai', 'jam_selesai'
    ];
}
