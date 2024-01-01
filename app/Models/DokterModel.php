<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokterModel extends Model
{
    use HasFactory;
    protected $table = "dokters";

    public function poli()
    {
        return $this->belongsTo(PoliModel::class);
    }
    public function jadwalperiksa()
    {
        return $this->belongsTo(JadwalPeriksaModel::class);
    }
}