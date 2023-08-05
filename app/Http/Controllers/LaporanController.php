<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function pemasukan()
    {
        $data = [
            'title' => 'E-Wisata | Laporan Pemasukan'
        ];

        return view('dashboard.laporan.pemasukan', $data);
    }

    public function get_pemasukan(Request $request)
    {
        $request->validate([
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date'],
        ]);

        if($request->date_from == '' && $request->date_to == '') {
            $lunas_m = Transaction::where('status', 1)->sum('grand_total');
            $belum_lunas_m = Transaction::where('status', 0)->sum('grand_total');
            $pemasukan = $lunas_m + $belum_lunas_m;
        } else {
            $date_from = $request->date_from . " 00:00:00";
            $date_to = $request->date_to . " 23:59:59";
            $lunas_m = Transaction::where('status', 1)->whereBetween('created_at', [$date_from, $date_to])->sum('grand_total');
            $belum_lunas_m = Transaction::where('status', 0)->whereBetween('created_at', [$date_from, $date_to])->sum('grand_total');
            $pemasukan = $lunas_m + $belum_lunas_m;

        }
        $data = [
            'pemasukan' => $pemasukan,
            'pemasukan_lunas' => $lunas_m,
            'pemasukan_belum_lunas' => $belum_lunas_m
        ];

        return response()->json($data);
    }
}
