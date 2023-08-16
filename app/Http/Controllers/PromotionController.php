<?php

namespace App\Http\Controllers;

use App\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Master Promo',
            'promotions' => Promotion::latest()->get()
        ];

        return view('dashboard.promotion.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Promo'
        ];

        return view('dashboard.promotion.create', $data);
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

        $promotions = new Promotion();
        $promotions->thumbnail = isset($file_path) ? $file_path : '';
        $promotions->judul = $request->judul;
        $promotions->slug = Str::slug($request->judul);
        $promotions->deskripsi = $request->deskripsi;
        $promotions->tanggal = $request->tanggal;
        $promotions->user_id = Auth::user()->id;
        $promotions->save();

        return redirect()->back()->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $promotions = Promotion::find($id);
        $data = [
            'title' => 'Edit Promo',
            'promotions' => $promotions
        ];

        return view('dashboard.promotion.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'thumbnail' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'between:0,2048'],
            'judul' => ['required'],
            'deskripsi' => ['nullable']
        ]);

        $promotions = Promotion::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            if ($promotions->thumbnail != '') {
                Storage::delete($promotions->thumbnail);
            }

            $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename);
        }

        $promotions->thumbnail = isset($file_path) ? $file_path : $promotions->thumbnail;
        $promotions->judul = $request->judul;
        $promotions->slug = Str::slug($request->judul);
        $promotions->deskripsi = $request->deskripsi;
        $promotions->tanggal = $request->tanggal;
        $promotions->user_id = Auth::user()->id;
        $promotions->save();

        return redirect()->back()->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promotions = Promotion::find($id);
        if ($promotions->thumbnail != '') {
            Storage::delete($promotions->thumbnail);
        }
        $promotions->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
