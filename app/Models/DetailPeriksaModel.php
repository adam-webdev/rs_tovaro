<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeriksaModel extends Model
{
    use HasFactory;
    protected $table = "detail_periksas";
    public function periksa()
    {
        return $this->belongsTo(PeriksaModel::class);
    }
    public function obat()
    {
        return $this->belongsTo(ObatModel::class);
    }
}
