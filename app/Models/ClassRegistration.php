<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_name',
        'nama_lengkap',
        'umur',
        'tempat_lahir',
        'nomor_whatsapp',
        'alamat_domisili',
        'status',
    ];
}
