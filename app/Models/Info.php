<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id', 'title', 'featured_image', 'body', 'hit', 'labels'
    ];

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
