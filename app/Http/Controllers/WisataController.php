<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Models\WisataImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class WisataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wisata = Wisata::all();
        return view('wisata.index', compact('wisata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('wisata.create');
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
            'nama_wisata' => 'required',
            'deskripsi' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'images.*' => 'file|mimetypes:image/jpeg,image/png,image/jpg,image/gif|',
            'banner' => 'file|mimetypes:image/jpeg,image/png,image/jpg,image/gif|'
        ]);
        $banner = $request->file('banner');
        if ($banner) {
            $originalName = $banner->getClientOriginalName();
            $unikName = time() . "-" . $originalName;
            $bannerWisata = $banner->storeAs('wisata/banner', $unikName);
        }
        $add_wisata = new Wisata();
        $add_wisata->nama_wisata = $request->nama_wisata;
        $add_wisata->deskripsi = $request->deskripsi;
        $add_wisata->latitude = $request->latitude;
        $add_wisata->longitude = $request->longitude;
        $add_wisata->harga = $request->harga;
        $add_wisata->jam_buka = $request->jam_buka;
        $add_wisata->jam_tutup = $request->jam_tutup;
        $add_wisata->banner = $bannerWisata;
        $add_wisata->kecamatan = $request->kecamatan;
        $add_wisata->kota = $request->kota;
        $add_wisata->provinsi = $request->provinsi;
        $add_wisata->save();

        $wisataImages = $request->file('images');
        if ($wisataImages) {
            foreach ($wisataImages as $img) {
                $imgName = $img->getClientOriginalName();
                $imgUnikName = time() . "-" . $imgName;
                $imgWisata = $img->storeAs('wisata/images', $imgUnikName);
                $add_wisata_image = new WisataImages();
                $add_wisata_image->wisata_id = $add_wisata->id;
                $add_wisata_image->path = $imgWisata;
                $add_wisata_image->save();
            }
        }

        Alert::success('Berhasil', 'Data berhasil ditambahkan!');
        return redirect()->route('wisata.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wisata = Wisata::with('wisataimages')->where('id', $id)->first();
        return view('wisata.detail', compact('wisata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wisata = Wisata::with('wisataimages')->where('id', $id)->first();
        return view('wisata.edit', compact('wisata'));
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
            'nama_wisata' => 'required',
            'deskripsi' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'images.*' => 'file|mimetypes:image/jpeg,image/png,image/jpg,image/gif|',
            'banner' => 'file|mimetypes:image/jpeg,image/png,image/jpg,image/gif|'
        ]);
        // ddd($request->all());


        $edit_wisata =  Wisata::findOrFail($id);
        $inputbanner = $request->file('banner');
        if ($inputbanner) {
            // jika ada request banner hapus yang lama di storage
            if (Storage::disk('public')->exists($edit_wisata->banner)) {
                Storage::disk('public')->delete($edit_wisata->banner);
            }
            $originalName = $inputbanner->getClientOriginalName();
            $unikName = time() . "-" . $originalName;
            $banner = $inputbanner->storeAs('wisata/banner', $unikName);
        } else {
            $banner = $edit_wisata->banner;
        }
        $edit_wisata->nama_wisata = $request->nama_wisata;
        $edit_wisata->deskripsi = $request->deskripsi;
        $edit_wisata->latitude = $request->latitude;
        $edit_wisata->longitude = $request->longitude;
        $edit_wisata->harga = $request->harga;
        $edit_wisata->jam_buka = $request->jam_buka;
        $edit_wisata->jam_tutup = $request->jam_tutup;
        $edit_wisata->banner = $banner;
        $edit_wisata->kecamatan = $request->kecamatan;
        $edit_wisata->kota = $request->kota;
        $edit_wisata->provinsi = $request->provinsi;
        $edit_wisata->save();

        $inputWisataImages = $request->file('images');

        $edit_image_wisata = WisataImages::where('wisata_id', $id)->get();

        if ($inputWisataImages) {
            foreach ($edit_image_wisata as $item) {
                if (Storage::disk('public')->exists($item->path)) {
                    Storage::disk('public')->delete($item->path);
                    $item->delete();
                }
            }

            foreach ($inputWisataImages as $img) {
                $imgName = $img->getClientOriginalName();
                $imgUnikName = time() . "-" . $imgName;
                $imgWisata = $img->storeAs('wisata/images', $imgUnikName);
                $add_wisata_image = new WisataImages();
                $add_wisata_image->wisata_id = $id;
                $add_wisata_image->path = $imgWisata;
                $add_wisata_image->save();
            }
        }

        Alert::success('Berhasil', 'Data berhasil diubah!');
        return redirect()->route('wisata.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $wisata = Wisata::findOrFail($id);
        $wisata_images = WisataImages::where('wisata_id', $id)->get();
        foreach ($wisata_images as $item) {
            if (Storage::disk('public')->exists($item->path)) {
                Storage::disk('public')->delete($item->path);
            }
        }
        if (Storage::disk('public')->exists($wisata->banner)) {
            Storage::disk('public')->delete($wisata->banner);
        }
        $wisata->delete();
        Alert::success('Berhasil', 'Data berhasil dihapus!');
        return redirect()->route('wisata.index');
    }
}
