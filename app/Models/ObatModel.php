<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObatModel extends Model
{
    use HasFactory;
    protected $table = "obats";
    public function detailperiksa()
    {
        return $this->belongsTo(DetailPeriksaModel::class);
    }
}
