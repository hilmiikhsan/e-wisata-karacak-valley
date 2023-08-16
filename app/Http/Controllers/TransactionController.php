<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\TransactionDetail;
use App\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('member_id', Auth::user()->id)->with(['wisata', 'transaksi_detail'])->get();
        $data = [
            'title' => 'E-Wisata | Pesanan Saya',
            'transactions' => $transactions,
            'userName' => Auth::user()->name
        ];

        return view('dashboard.transaksi.pesananku', $data);
    }

    public function create()
    {
        $paymentMethods = PaymentMethod::all();

        $data = [
            'title' => 'Buat Pesanan',
            'paymentMethods' => $paymentMethods
        ];

        return view('dashboard.transaksi.create', $data);
    }

    public function pemesanan()
    {
        $transactions = Transaction::with(['wisata', 'member'])->orderBy('id', 'DESC')->get();
        $data = [
            'title' => 'E-Wisata | Data Pemesanan',
            'transactions' => $transactions
        ];

        return view('dashboard.transaksi.pemesanan', $data);
    }

    /**
     * Show pesanan saya detail oleh member, can upload bukti pembayaran
     */
    public function show($id)
    {
        $transaction = Transaction::where('id', $id)->with(['wisata', 'transaksi_detail'])->first();
        $data = [
            'title' => env('APP_NAME') . ' | Detail Pesanan',
            'transaction' => $transaction,
            'userName' => Auth::user()->name,
            'userRole' => Auth::user()->role
        ];

        return view('dashboard.transaksi.show', $data);
    }

    /**
     * Detail pesanan and admin can manage status lunas
     */
    public function detail($id)
    {
        $transaction = Transaction::where('id', $id)->with(['wisata', 'transaksi_detail'])->first();
        $data = [
            'title' => env('APP_NAME') . ' | Detail Pesanan',
            'transaction' => $transaction
        ];
        $transaction->read_booking = 1;
        $transaction->read_review = 1;
        $transaction->save();
        return view('dashboard.transaksi.detail', $data);
    }

    public function upload_bukti(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => ['required', 'file', 'mimes:jpg,jpeg,png,bmp', 'between:0,2048']
        ]);

        if ($request->hasFile('payment_proof')) {
            $filename = Str::random(32) . '.' . $request->file('payment_proof')->getClientOriginalExtension();
            $file_path = $request->file('payment_proof')->storeAs('public/uploads', $filename);
        }

        $transaksi = Transaction::find($id);
        $transaksi->payment_proof = isset($file_path) ? $file_path : '';
        $transaksi->save();

        return redirect()->back()->with('success', 'Berhasil mengupload bukti pembayaran');
    }

    public function destroy($id)
    {
        $transaksi = Transaction::find($id);

        // Delete transaksi detail
        TransactionDetail::where('transaction_id', $transaksi->id)->delete();

        $transaksi->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data transaksi');
    }

    public function set_lunas(Request $request, $id)
    {
        $transaksi = Transaction::find($id);
        $transaksi->status = 1;
        $transaksi->save();

        return redirect()->back()->with('success', 'Berhasil mengupdate data');
    }

    public function testimoni_update(Request $request, $id)
    {
        $request->validate([
            'testimoni' => ['required', 'string', 'max:255']
        ]);

        $transaksi = Transaction::find($id);
        $transaksi->testimoni = $request->testimoni;
        $transaksi->star_score = $request->star_score;
        $transaksi->read_review = 0;
        $transaksi->save();

        return redirect()->back()->with('success', 'Berhasil memberikan review');
    }
}
