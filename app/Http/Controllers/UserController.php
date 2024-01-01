<?php

namespace App\Http\Controllers;

use App\Models\DokterModel;
use App\Models\PoliModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'jenis_kelamin' => 'required'
        ]);

        $new_user = new User();
        $new_user->name = $request->name;
        $new_user->jenis_kelamin = $request->jenis_kelamin;
        $new_user->email = $request->email;
        $new_user->password = Hash::make($request->password);

        if ($request->role === "Dokter") {
            $new_user->assignRole("Dokter");
        } else if ($request->role === "Admin") {
            $new_user->assignRole('Admin');
        } else {
            $new_user->assignRole('Pasien');
        }
        $new_user->save();
        Alert::success("Tersimpan", "Data Berhasil Disimpan!");
        return redirect()->route('user.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $id_poli = DokterModel::select("poli_id")->where("nama", Auth::user()->name)->pluck('poli_id');
        $poli = PoliModel::whereIn('id', $id_poli)->get();
        return view('user.profile', compact('user', 'poli'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrfail($id);

        return view('user.edit', compact('user'));
    }

    public function profile($id)
    {
        $user = User::findOrfail($id);
        return view('front.user.profile', compact('user'));
    }

    public function editprofile($id)
    {
        $user = User::findOrfail($id);
        return view('front.user.edit', compact('user'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:100|string',
            'email' => 'required',
            'jenis_kelamin' => 'required'
        ]);

        $user = User::findOrfail($id);

        $user->name = $request->name;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->email = $request->email;
        if ($request->password) {
            $password = Hash::make($request->password);
        } else {
            $password = $user->password;
        }
        $user->password = $password;

        $user->removeRole("Admin", "Dokter", "Pasien");
        if ($request->role === "Dokter") {
            $user->assignRole("Dokter");
        } else if ($request->role === "Admin") {
            $user->assignRole('Admin');
        } else {
            $user->assignRole('Pasien');
        }


        $user->save();
        Alert::success("Tersimpan", "Data Berhasil Disimpan!");
        return redirect()->route('user.index');
    }

    public function updateprofile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:100|string',
            'email' => 'required',
            'jenis_kelamin' => 'required'
        ]);

        $user = User::findOrfail($id);

        $user->name = $request->name;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->email = $request->email;

        if ($request->password) {
            $password = Hash::make($request->password);
        } else {
            $password = $user->password;
        }
        $user->password = $password;

        $user->save();
        Alert::success("Tersimpan", "Data Berhasil Disimpan!");
        return redirect()->route('user.profile', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $user->removeRole("Admin", "Manager", "User");
        Alert::success("Terhapus", "Data Berhasil Terhapus");
        return redirect()->route('user.index');
    }
}
