<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkinCare extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'brand',
        'deskripsi',
        'gambar',
    ];

    protected $table = 'skin_care';
}
