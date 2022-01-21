<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    protected $fillable = [
        'user_id', 'pengaduan_id', 'tanggal', 'isi_laporan', 'status',
      ];
}
