<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPeriksaModel extends Model
{
    use HasFactory;
    protected $table = "jadwalperiksas";
    public function dokter()
    {
        return $this->belongsTo(DokterModel::class);
    }
    public function daftarpoli()
    {
        return $this->belongsTo(DaftarPoliModel::class);
    }
}
