<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    public function user()
{
    return $this->belongsTo('App\Models\User');
}

public function tanggapan()
{
  return $this->hasMany('App\Models\Tanggapan');
}

    protected $fillable = [
        'user_id', 'tanggal', 'isi_laporan', 'status', 'foto',
    ];
}
