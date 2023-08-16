<?php

namespace App\Http\Controllers;
use App\Wisata;
use App\Fasilitas;
use App\Kategori;
use App\Transaction;
use App\User;
use App\Promotion;
use App\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $wisata = Wisata::all()->count();
        $fasilitas = Fasilitas::all()->count();
        $kategori = Kategori::all()->count();
        $karyawan = User::where('role', 'staff')->count();
        $member = User::where('role', 'member')->count();
        $admin = User::where('role', 'super_admin')->count();
        $transaksi = Transaction::all()->count();
        $promo = Promotion::all()->count();
        $artikel = Post::all()->count();
        $laporan = Transaction::where('status', 1)->sum('grand_total');
        $data = [
            'title' => 'E-Wisata | Dashboard',
            'wisata' => $wisata,
            'fasilitas' => $fasilitas,
            'kategori' => $kategori,
            'karyawan' => $karyawan,
            'member' => $member,
            'transaksi' => $transaksi,
            'admin' => $admin,
            'promo' => $promo,
            'artikel' => $artikel,
            'laporan' => $laporan,
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

    public function indexPemilik()
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

        return view('dashboard.dashboard_pemilik.index', $data);
    }
}

