<?php

namespace App\Http\Controllers;

use App\FacilityWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FacilityWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Master Fasilitas',
            'facilities' => FacilityWisata::latest()->get()
        ];

        return view('dashboard.fasilitas_wisata.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Fasilitas'
        ];

        return view('dashboard.fasilitas_wisata.create', $data);
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
            'thumbnail' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'between:0,2048'],
            'judul' => ['required'],
            'deskripsi' => ['nullable']
        ]);

        if ($request->hasFile('thumbnail')) {
            $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename);
        }

        $facilities = new FacilityWisata();
        $facilities->thumbnail = isset($file_path) ? $file_path : '';
        $facilities->judul = $request->judul;
        $facilities->slug = Str::slug($request->judul);
        $facilities->deskripsi = $request->deskripsi;
        $facilities->user_id = Auth::user()->id;
        $facilities->save();

        return redirect()->back()->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FacilityWisata  $facilityWisata
     * @return \Illuminate\Http\Response
     */
    public function show(FacilityWisata $facilityWisata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FacilityWisata  $facilityWisata
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $facilities = FacilityWisata::find($id);
        $data = [
            'title' => 'Edit Fasilitas',
            'facilities' => $facilities
        ];

        return view('dashboard.fasilitas_wisata.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FacilityWisata  $facilityWisata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'thumbnail' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'between:0,2048'],
            'judul' => ['required'],
            'deskripsi' => ['nullable']
        ]);

        $facilities = FacilityWisata::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            if ($facilities->thumbnail != '') {
                Storage::delete($facilities->thumbnail);
            }

            $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename);
        }

        $facilities->thumbnail = isset($file_path) ? $file_path : $facilities->thumbnail;
        $facilities->judul = $request->judul;
        $facilities->slug = Str::slug($request->judul);
        $facilities->deskripsi = $request->deskripsi;
        $facilities->user_id = Auth::user()->id;
        $facilities->save();

        return redirect()->back()->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FacilityWisata  $facilityWisata
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $facilities = FacilityWisata::find($id);
        if ($facilities->thumbnail != '') {
            Storage::delete($facilities->thumbnail);
        }
        $facilities->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
