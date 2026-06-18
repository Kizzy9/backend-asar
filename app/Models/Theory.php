<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theory extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table = 'theories';

    // Kolom yang diizinkan untuk diisi data
    protected $fillable = [
        'title',
        'excerpt',
        'image_url',
        'content',
    ];
}