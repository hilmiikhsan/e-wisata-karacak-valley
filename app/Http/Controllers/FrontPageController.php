<?php

namespace App\Http\Controllers;

use App\ContactForm;
use App\Fasilitas;
use App\Kategori;
use App\Post;
use App\Transaction;
use App\TransactionDetail;
use App\User;
use App\Wisata;
use App\WisataFasilitas;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontPageController extends Controller
{
    public function index()
    {
        $wisatas = Wisata::latest()->take(3)->get();
        $fasilitas = Fasilitas::all();
        $kategori = Kategori::all();
        $data = [
            'title' => 'Homepage',
            'wisatas' => $wisatas,
            'fasilitas' => $fasilitas,
            'kategori' => $kategori,
        ];

        return view('welcome', $data);
    }

    public function berita_list()
    {
        $beritas = Post::all();
        $data = [
            'title' => 'Berita',
            'beritas' => $beritas,
        ];

        return view('pages.berita_list', $data);
    }

    public function wisata_list()
    {
        $wisatas = Wisata::all();
        $data = [
            'title' => 'Homepage',
            'wisatas' => $wisatas,
        ];

        return view('pages.wisata_list', $data);
    }

    public function wisata_list_by_kategori($id)
    {
        $wisatas = Wisata::where('category_id', $id)->get();
        $kategori = Kategori::findOrFail($id);
        $data = [
            'title' => 'Wisata Kategori',
            'wisatas' => $wisatas,
            'kategori' => $kategori,
        ];

        return view('pages.wisata_list_by_kategori', $data);
    }

    public function wisata_list_search(Request $request)
    {
        $request->validate([
            'keyword' => ['required', 'string', 'max:191']
        ]);

        $wisatas = Wisata::where('wisata', 'like', '%'. $request->keyword .'%')->orWhere('desc', 'like', '%'. $request->keyword .'%')->get();
        $data = [
            'title' => 'Homepage',
            'wisatas' => $wisatas,
            'keyword' => $request->keyword
        ];

        return view('pages.wisata_list', $data);
    }

    public function about()
    {
        $wisata = Wisata::all()->count();
        $fasilitas = Fasilitas::all()->count();
        $member = User::where('role', 'member')->get()->count();
        $data = [
            'title' => 'Tentang',
            'wisata' => $wisata,
            'fasilitas' => $fasilitas,
            'member' => $member,
        ];

        return view('pages.about', $data);
    }

    public function kontak()
    {
        $wisata = Wisata::all()->count();
        $fasilitas = Fasilitas::all()->count();
        $member = User::where('role', 'member')->get()->count();
        $data = [
            'title' => 'Tentang',
            'wisata' => $wisata,
            'fasilitas' => $fasilitas,
            'member' => $member,
        ];

        return view('pages.kontak', $data);
    }

    public function wisata_detail($slug)
    {
        $wisata = Wisata::where('slug', $slug)->with(['facilities'])->first();
        $data = [
            'title' => '' . $wisata->wisata,
            'wisata' => $wisata
        ];

        return view('pages.wisata_detail', $data);
    }

    public function berita_detail($slug)
    {
        $berita = Post::where('slug', $slug)->first();
        $data = [
            'title' => $berita->judul,
            'berita' => $berita
        ];

        return view('pages.berita_detail', $data);
    }

    /**
     * Store a booking data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function booking(Request $request, $id)
    {
        $request->validate([
            'check_in' => ['required'],
            'people_count' => ['integer'],
            'days' => ['integer'],
        ]);

        $wisata = Wisata::findOrFail($id);
        $member = User::findOrFail(Auth::user()->id);
        $data = [
            'title' => 'Detail Pemesanan Wisata ' . $wisata->wisata,
            'pemesan' => $member,
            'wisata' => $wisata,
            'additional_data' => $request->all()
        ];

        $transaksi = new Transaction();
        $transaksi->trans_code = time() . '-' . Auth::user()->id;
        $transaksi->member_id = $member->id;
        $transaksi->wisata_id = $wisata->id;
        $transaksi->message = isset($request->message) ? $request->message : '';
        $transaksi->check_in = isset($request->check_in) ? $request->check_in : Carbon::now()->format('Y-m-d');
        $transaksi->days = isset($request->days) ? $request->days : 1;
        $transaksi->people_count = isset($request->people_count) ? $request->people_count : 1;

        // Hitung grand total
        $grand_total = 0;
        $i = 0;
        $transaksi->grand_total = 0;
        $transaksi->save();
        if ($request->facilities) {
            if (count($request->facilities) > 0) {
                foreach($request->facilities as $item) {
                    $facility = Fasilitas::find($item);
                    $subtotal = $facility->price * $request->people_count * $request->days;
                    $data['transaction_detail'][$i++] = [
                        'facility_id' => $facility->id,
                        'facility' => $facility,
                        'price' => $facility->price,
                        'people_count' => $request->people_count,
                        'days' => $request->days,
                        'subtotal' => $subtotal
                    ];
                    $grand_total += $subtotal;

                    // Save transaction detail
                    $transaksi_detail = New TransactionDetail();
                    $transaksi_detail->transaction_id = $transaksi->id;
                    $transaksi_detail->facility_id = $facility->id;
                    $transaksi_detail->price = $facility->price;
                    $transaksi_detail->save();
                }
            }
        }
        $data['grand_total'] = $grand_total;

        $grand_total += $wisata->price * $transaksi->people_count * $transaksi->days;
        $transaksi = Transaction::find($transaksi->id);
        $transaksi->grand_total = $grand_total;
        $transaksi->save();

        return redirect()->route('dashboard.pesananku');
    }

    /**
     * Confirm a booking data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function booking_confirmation(Request $request)
    {
        dd($request->all());
        session(['booking_data' => session('booking_data')]);
        $data = [
            'title' => 'Konfirmasi Booking Wisata',
            'booking' => session('booking_data')
        ];
        // dd($request->session()->all());
        return view('pages.booking_confirmation', $data);
    }

    public function booking_cancel(Request $request)
    {
        $request->session()->forget('booking_data');
        return redirect()->route('welcome');
    }
}
