<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Kategori::all();
        $data = [
            'title' => 'E-Wisata | Master Kategori',
            'categories' => $categories
        ];
        
        return view('dashboard.kategori.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'E-Wisata | Tambah Kategori'
        ];

        return view('dashboard.kategori.create', $data);
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
            'category' => ['required', 'string', 'max:255']
        ]);

        if ($request->hasFile('thumbnail')) {
            $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename); 
        }

        $category = new Kategori;
        $category->category = $request->category;
        $category->thumbnail = isset($file_path) ? $file_path : '';
        $category->save();

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
        $category = Kategori::find($id);
        $data = [
            'title' => 'Edit Kategori',
            'category' => $category
        ];

        return view('dashboard.kategori.edit', $data);
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
            'category' => ['required', 'string', 'max:255'],
            'thumbnail' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'between:0,2048']
        ]);

        $category = Kategori::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            if ($category->thumbnail != '') {
                Storage::delete($category->thumbnail);
            }

            $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename);
        }

        $category->category = $request->category;
        $category->thumbnail = isset($file_path) ? $file_path : $category->thumbnail;
        $category->save();

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
        $category = Kategori::find($id);
        if ($category->thumbnail != '') {
            Storage::delete($category->thumbnail);
        }
        $category->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
