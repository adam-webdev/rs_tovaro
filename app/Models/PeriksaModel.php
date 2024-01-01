<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriksaModel extends Model
{
    use HasFactory;
    protected $table = "periksas";
    public function daftarpoli()
    {
        return $this->belongsTo(DaftarPoliModel::class);
    }
    public function detailperiksa()
    {
        return $this->belongsTo(DetailPeriksaModel::class);
    }
}
