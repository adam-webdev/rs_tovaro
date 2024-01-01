<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPoliModel extends Model
{
    use HasFactory;
    protected $table = "daftarpolis";
    public function jadwalperiksa()
    {
        return $this->belongsTo(JadwalPeriksaModel::class);
    }
    public function pasien()
    {
        return $this->belongsTo(PasienModel::class);
    }
    public function periksa()
    {
        return $this->belongsTo(PeriksaModel::class);
    }
}
