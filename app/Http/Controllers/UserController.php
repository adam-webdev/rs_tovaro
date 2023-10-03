<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        return view('admin.user', compact('user'));
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
            'name' => 'required|min:3|max:100|string',
            'email' => 'required|email|unique:users',
            'nik' => 'required',
            'foto' =>  'file|mimetypes:image/jpeg,image/png,image/jpg,image/gif|',
            'no_hp' => 'required|min:10|max:13',
        ]);
        $foto = $request->file('foto');
        if ($foto) {
            $originalName = $foto->getClientOriginalName();
            $unik = time(). '-'. $originalName;
            $picture = $foto->storeAs('user/profil',$unik);
        } else {
            $picture = 'user/profil/default.jpg';
        }

        $new_user = new User();
        $new_user->name = $request->name;
        $new_user->nik = $request->nik;
        $new_user->jenis_kelamin = $request->jenis_kelamin;
        $new_user->no_hp = $request->no_hp;
        $new_user->foto = $picture;
        $new_user->email = $request->email;
        $new_user->password = bcrypt($request->password);
        if ($request->get('roles') === "Admin") {
            $new_user->assignRole("Admin");
        } else if ($request->get('roles') === "Manager") {
            $new_user->assignRole("Manager");
        } else if ($request->get('roles') === "Staff") {
            $new_user->assignRole("Staff");
        } else {
            $new_user->assignRole("User");
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
        $user = User::with('posisi', 'seksi', 'pgr')->where('id', $id)->first();
        return view('admin.profile', compact('user'));
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

        return view('admin.edit', compact('user'));
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
        $user = User::findOrfail($id);
        $foto = $request->file('foto');
        if ($foto) {
            Storage::delete($user->foto);
            $foto = $foto->store('user/profil');
        } else {
            $foto = $user->foto;
        }

        $user->name = $request->name;
        $user->nik = $request->nik;
        $user->posisi_id = $request->posisi_id;
        $user->seksi_id = $request->seksi_id;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->foto = $foto;
        $user->pgr_id = $request->pgr_id;
        $user->email = $request->email;
        if ($request->password) {
            $password = bcrypt($request->password);
        } else {
            $password = $user->password;
        }
        $user->password = $password;
        if ($request->get('roles') === "Admin") {
            $user->syncRoles("Admin");
        } else if ($request->get('roles') === "Manager") {
            $user->syncRoles("Manager");
        } else if ($request->get('roles') === "Staff") {
            $user->syncRoles("Staff");
        } else {
            $user->syncRoles("User");
        }
        $user->save();
        Alert::success("Tersimpan", "Data Berhasil Disimpan!");
        return redirect()->route('user.show', [$id]);
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