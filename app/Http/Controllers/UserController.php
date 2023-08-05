<?php

namespace App\Http\Controllers;

use App\TransactionDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Menampilkan akun karyawan (role staff).
     *
     * @return \Illuminate\Http\Response
     */
    public function akun_karyawan()
    {
        $users = User::where('username', '!=', 'super_admin')->where('role', 'staff')->get();
        $data = [
            'title' => 'E-Wisata | Akun Karyawan',
            'users' => $users
        ];
        
        return view('dashboard.user.akun_karyawan', $data);
    }

    /**
     * Menampilkan akun member (role member).
     *
     * @return \Illuminate\Http\Response
     */
    public function akun_member()
    {
        $users = User::where('username', '!=', 'super_admin')->where('role', 'member')->get();
        $data = [
            'title' => 'E-Wisata | Akun Member',
            'users' => $users
        ];
        
        return view('dashboard.user.akun_member', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'E-Wisata | Tambah Akun',
        ];

        return view('dashboard.user.create', $data);
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
            'avatar' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'between:0,2048'],
            'username' => ['required', 'string', 'max:191'],
            'password' => ['required', 'string', 'max:191'],
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string', 'max:191']
        ]);

        if ($request->hasFile('avatar')) {
            $filename = Str::random(32) . '.' . $request->file('avatar')->getClientOriginalExtension();
            $file_path = $request->file('avatar')->storeAs('public/uploads', $filename); 
        }

        $user = new User;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = 'staff';
        $user->avatar = isset($file_path) ? $file_path : '';
        $user->save();

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
        $user = User::find($id);
        $data = [
            'title' => 'Edit User',
            'user' => $user,
        ];

        return view('dashboard.user.edit', $data);
    }

    public function akun()
    {
    $user = User::find(Auth::user()->id);
        $data = [
            'title' => 'E-Wisata | Akun',
            'user' => $user,
        ];

        return view('dashboard.user.akun', $data);
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
            'avatar' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'between:0,2048'],
            'username' => ['nullable', 'string', 'max:191'],
            'password' => ['nullable', 'string', 'max:191'],
            'name' => ['nullable', 'string', 'max:191'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string', 'max:191']
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('avatar')) {
            if ($user->avatar != '') {
                Storage::delete($user->avatar);
            }

            $filename = Str::random(32) . '.' . $request->file('avatar')->getClientOriginalExtension();
            $file_path = $request->file('avatar')->storeAs('public/uploads', $filename); 
        }

        if (isset($request->password)) {
            $user->username = $request->username;
        }
        if (isset($request->password)) {
            $user->password = Hash::make($request->password);
        }
        
        if (isset($request->name)){
            $user->name = $request->name;
        }
        if (isset($request->email)){
            $user->email = $request->email;
        }
        if (isset($request->phone)){
            $user->phone = $request->phone;
        }
        $user->avatar = isset($file_path) ? $file_path : $user->avatar;
        $user->save();

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
        $user = User::where('id', $id)->with(['pesanan'])->first();

        // Hapus transaksi detail
        foreach($user->pesanan as $trans) {
            $trans->transaksi_detail()->delete();
        }

        // Hapus data Transaksi master
        $user->pesanan()->delete();

        // Hapus user
        $user->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data');
        
    }
}
