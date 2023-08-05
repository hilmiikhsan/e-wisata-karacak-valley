<?php

namespace App\Http\Controllers;

use App\Fasilitas;
use App\Kategori;
use App\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WisataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wisatas = Wisata::with(['category'])->get();
        $data = [
            'title' => 'E-Wisata | Master Wisata',
            'wisatas' => $wisatas
        ];
        
        return view('dashboard.wisata.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Kategori::all();
        $data = [
            'title' => 'E-Wisata | Tambah Wisata',
            'categories' => $categories
        ];

        return view('dashboard.wisata.create', $data);
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
            'wisata' => ['required', 'string', 'max:255'],
            'desc' => ['string'],
            'address' => ['string'],
            'latitude' => ['string'],
            'longitude' => ['string'],
            'price' => ['required', 'integer']
        ]);

        if ($request->hasFile('thumbnail')) {
            $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename); 
        }

        $wisata = new Wisata;
        $wisata->wisata = $request->wisata;
        $wisata->slug = Str::slug($request->wisata, '-');
        $wisata->price = $request->price;
        $wisata->category_id = $request->category_id;
        $wisata->desc = $request->desc;
        $wisata->address = $request->address;
        $wisata->latitude = $request->latitude;
        $wisata->longitude = $request->longitude;
        $wisata->thumbnail = isset($file_path) ? $file_path : '';
        $wisata->save();

        return redirect()->back()->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wisata = Wisata::find($id);
        $categories = Kategori::all();
        $data = [
            'title' => 'Edit Wisata',
            'wisata' => $wisata,
            'categories' => $categories
        ];

        return view('dashboard.wisata.edit', $data);
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
            'thumbnail' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'between:0,2048'],
            'wisata' => ['required', 'string', 'max:255'],
            'desc' => ['string'],
            'address' => ['string'],
            'latitude' => ['string'],
            'longitude' => ['string'],
            'price' => ['required', 'integer']
        ]);

        $wisata = Wisata::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            if ($wisata->thumbnail != '') {
                Storage::delete($wisata->thumbnail);
            }

            $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename);
        }

        $wisata->wisata = $request->wisata;
        $wisata->slug = Str::slug($request->wisata, '-');
        $wisata->price = $request->price;
        $wisata->category_id = $request->category_id;
        $wisata->desc = $request->desc;
        $wisata->address = $request->address;
        $wisata->latitude = $request->latitude;
        $wisata->longitude = $request->longitude;
        $wisata->thumbnail = isset($file_path) ? $file_path : $wisata->thumbnail;
        $wisata->save();

        return redirect()->back()->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wisata = Wisata::find($id);
        if ($wisata->thumbnail != '') {
            Storage::delete($wisata->thumbnail);
        }
        $wisata->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }

    /**
     * Setup the fasilitas of the wisata
     * a Wisata can contains multiple fasilitas
     */
    public function setup_fasilitas($id)
    {
        $wisata = Wisata::find($id);
        $facilities = Fasilitas::with(['wisatas'])->get();
        $data = [
            'title' => 'E-Wisata | Setup Fasilitas',
            'facilities' => $facilities,
            'wisata' => $wisata
        ];

        return view('dashboard.wisata.setup_fasilitas', $data);
    }

    /**
     * Setup Fasilitas save
     */
    public function setup_fasilitas_save(Request $request, $id)
    {
        $wisata = Wisata::find($id);
        $wisata->facilities()->sync($request->facilities);

        return redirect()->back()->with('success', 'Berhasil setup fasilitas');
    }
}
