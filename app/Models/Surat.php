<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id', 'filename', 'pengirim', 'kepada', 'sifat', 'perihal', 'arah', 'jenis', 'nomor', 'tanggal'
    ];

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
