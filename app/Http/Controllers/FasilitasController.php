<?php

namespace App\Http\Controllers;

use App\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facilities = Fasilitas::all();
        $data = [
            'title' => 'E-Wisata | Master Fasilitas',
            'facilities' => $facilities
        ];
        
        return view('dashboard.fasilitas.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'E-Wisata | Tambah Fasilitas'
        ];

        return view('dashboard.fasilitas.create', $data);
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
            'facility' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer']
        ]);

        if ($request->hasFile('thumbnail')) {
            $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename); 
        }

        $facility = new Fasilitas;
        $facility->facility = $request->facility;
        $facility->price = $request->price;
        $facility->thumbnail = isset($file_path) ? $file_path : '';
        $facility->save();

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
        $facility = Fasilitas::find($id);
        $data = [
            'title' => 'Edit Fasilitas',
            'facility' => $facility
        ];

        return view('dashboard.fasilitas.edit', $data);
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
            'facility' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer'],
            'thumbnail' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'between:0,2048']
        ]);

        $facility = Fasilitas::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            if ($facility->thumbnail != '') {
                Storage::delete($facility->thumbnail);
            }

            $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename);
        }

        $facility->facility = $request->facility;
        $facility->price = $request->price;
        $facility->thumbnail = isset($file_path) ? $file_path : $facility->thumbnail;
        $facility->save();

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
        $facility = Fasilitas::find($id);
        if ($facility->thumbnail != '') {
            Storage::delete($facility->thumbnail);
        }
        $facility->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
