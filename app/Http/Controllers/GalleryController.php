<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Master Gallery',
            'galleries' => Gallery::latest()->get()
        ];

        return view('dashboard.gallery.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Gallery'
        ];

        return view('dashboard.gallery.create', $data);
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
            'judul' => ['required']
        ]);

        if ($request->hasFile('thumbnail')) {
            $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename);
        }

        $galleries = new Gallery();
        $galleries->thumbnail = isset($file_path) ? $file_path : '';
        $galleries->judul = $request->judul;
        $galleries->slug = Str::slug($request->judul);
        $galleries->user_id = Auth::user()->id;
        $galleries->save();

        return redirect()->back()->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $galleries = Gallery::find($id);
        $data = [
            'title' => 'Edit Gallery',
            'galleries' => $galleries
        ];

        return view('dashboard.gallery.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'thumbnail' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'between:0,2048'],
            'judul' => ['required']
        ]);

        $galleries = Gallery::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            if ($galleries->thumbnail != '') {
                Storage::delete($galleries->thumbnail);
            }

            $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename);
        }

        $galleries->thumbnail = isset($file_path) ? $file_path : $galleries->thumbnail;
        $galleries->judul = $request->judul;
        $galleries->slug = Str::slug($request->judul);
        $galleries->user_id = Auth::user()->id;
        $galleries->save();

        return redirect()->back()->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $galleries = Gallery::find($id);
        if ($galleries->thumbnail != '') {
            Storage::delete($galleries->thumbnail);
        }
        $galleries->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
