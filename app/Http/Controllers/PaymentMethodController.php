<?php

namespace App\Http\Controllers;

use App\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Metode Pembayaran',
            'payments' => PaymentMethod::latest()->get()
        ];

        return view('dashboard.payment_method.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Metode Pembayaran'
        ];

        return view('dashboard.payment_method.create', $data);
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
            'payment_method' => ['required'],
            'account_destination' => ['required'],
            'account_name' => ['required']
        ]);

        $payments = new PaymentMethod();
        $payments->payment_method = $request->payment_method;
        $payments->account_destination = $request->account_destination;
        $payments->account_name = $request->account_name;
        $payments->user_id = Auth::user()->id;
        $payments->save();

        return redirect()->back()->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payments = PaymentMethod::find($id);
        $data = [
            'title' => 'Edit Metode Pembayaran',
            'payments' => $payments
        ];

        return view('dashboard.payment_method.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'payment_method' => ['required'],
            'account_destination' => ['required'],
            'account_name' => ['required']
        ]);

        $payments = PaymentMethod::findOrFail($id);

        $payments->payment_method = $request->payment_method;
        $payments->account_destination = $request->account_destination;
        $payments->account_name = $request->account_name;
        $payments->user_id = Auth::user()->id;
        $payments->save();

        return redirect()->back()->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payments = PaymentMethod::find($id);
        $payments->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
