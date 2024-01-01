<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasienModel extends Model
{
    use HasFactory;
    protected $table = "pasiens";
    public function daftarpoli()
    {
        return $this->belongsTo(DaftarPoliModel::class);
    }

    public static function no_rm()
    {
        $tahunSekarang = Carbon::now()->format("Y");
        $bulanSekarang = Carbon::now()->format("m");
        $jumlahPasien = PasienModel::max('id');
        $jumlahPasienIncrement = $jumlahPasien + 1;
        $no_rekam_medis = (string) $tahunSekarang . $bulanSekarang . "-" . $jumlahPasienIncrement;
        return $no_rekam_medis;
    }
}
