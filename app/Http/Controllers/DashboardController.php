<?php

namespace App\Http\Controllers;

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
            // "pengguna" => User::count(),
            // "pembayaran" => Shipment::where('status', 'Pembayaran')->count(),
            // "approve" => Shipment::where('status', 'Approve')->count(),
            // "delivery" => Shipment::where('status', 'Delivery')->count(),
            // "jalur_merah" => Shipment::where('status', 'Jalur Merah')->count(),
            // "spv_verif" => Shipment::where('status', 'spv-verification')->count()
        ];
        return view("dashboard", $data);
    }
}