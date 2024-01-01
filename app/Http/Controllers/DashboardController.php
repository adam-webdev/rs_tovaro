<?php

namespace App\Http\Controllers;

use App\Models\DokterModel;
use App\Models\ObatModel;
use App\Models\PasienModel;
use App\Models\PoliModel;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            "user" => Auth::user()->name,
            "poli" => PoliModel::count(),
            "pasien" => PasienModel::count(),
            "dokter" => DokterModel::count(),
            "obat" => ObatModel::count(),
        ];
        return view("dashboard", $data);
    }
}
