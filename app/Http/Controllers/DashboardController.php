<?php

namespace App\Http\Controllers;
use App\Wisata;
use App\Fasilitas;
use App\Kategori;
use App\Transaction;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $wisata = Wisata::all()->count();
        $fasilitas = Fasilitas::all()->count();
        $kategori = Kategori::all()->count();
        $karyawan = User::where('role', 'staff')->count();
        $member = User::where('role', 'member')->count();
        $transaksi = Transaction::all()->count();
        $data = [
            'title' => 'E-Wisata | Dashboard',
            'wisata' => $wisata,
            'fasilitas' => $fasilitas,
            'kategori' => $kategori,
            'karyawan' => $karyawan,
            'member' => $member,
            'transaksi' => $transaksi,
        ];
        
        if (Auth::user()->role == 'member') {
            return view('dashboard.index_member', [
                'member' => User::find(Auth::user()->id),
                'pesanan_done' => Transaction::where('member_id', Auth::user()->id)->where('status', 1)->count(),
                'pesanan_undone' => Transaction::where('member_id', Auth::user()->id)->where('status', 0)->count(),
            ]);
        }
        
        return view('dashboard.index', $data);
    }
}
