<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'bentuk', 'image', 'address', 'gmaps_link', 'coordinates'
    ];

    public function layanans() {
        return $this->belongsToMany(Layanan::class, 'lokasi_layanans');
    }
    public function jadwals() {
        return $this->hasMany(LokasiJadwal::class, 'lokasi_id');
    }
    public function images() {
        return $this->hasMany(LokasiImage::class, 'lokasi_id');
    }
}
