<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Berita',
            'post' => Post::latest()->get()
        ];

        return view('dashboard.post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Blog'
        ];

        return view('dashboard.post.create', $data);
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

        $post = new Post();
        $post->thumbnail = isset($file_path) ? $file_path : '';
        $post->judul = $request->judul;
        $post->slug = Str::slug($request->judul);
        $post->deskripsi = $request->deskripsi;
        $post->user_id = Auth::user()->id;
        $post->is_publish = isset($request->is_publish) ? 1 : 0;
        $post->tanggal = $request->tanggal;
        $post->save();

        return redirect()->back()->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $data = [
            'title' => 'Edit Berita',
            'post' => $post
        ];

        return view('dashboard.post.edit', $data);
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
            'judul' => ['required'],
            'deskripsi' => ['nullable']
        ]);

        $post = Post::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail != '') {
                Storage::delete($post->thumbnail);
            }

            $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename);
        }

        $post->thumbnail = isset($file_path) ? $file_path : $post->thumbnail;
        $post->judul = $request->judul;
        $post->slug = Str::slug($request->judul);
        $post->deskripsi = $request->deskripsi;
        $post->user_id = Auth::user()->id;
        $post->is_publish = isset($request->is_publish) ? 1 : 0;
        $post->tanggal = $request->tanggal;
        $post->save();

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
        $post = Post::find($id);
        if ($post->thumbnail != '') {
            Storage::delete($post->thumbnail);
        }
        $post->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
