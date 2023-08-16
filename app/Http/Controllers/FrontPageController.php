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
use App\FacilityWisata;
use App\Promotion;
use App\Gallery;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontPageController extends Controller
{
    public function index()
    {
        $wisatas = Wisata::latest()->take(3)->get();
        $fasilitasWisata = FacilityWisata::latest()->take(6)->get();
        $promo = Promotion::latest()->take(6)->get();
        $galleries = Gallery::latest()->take(6)->get();
        $fasilitas = Fasilitas::all();
        $kategori = Kategori::all();
        $data = [
            'title' => 'Homepage',
            'wisatas' => $wisatas,
            'fasilitas' => $fasilitas,
            'kategori' => $kategori,
            'fasilitasWisata' => $fasilitasWisata,
            'promo' => $promo,
            'galleries' => $galleries,
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

    public function fasilitas_list()
    {
        $fasilitas = FacilityWisata::all();
        $data = [
            'title' => 'Homepage',
            'fasilitas' => $fasilitas,
        ];

        return view('pages.fasilitas_list', $data);
    }

    public function promo_list()
    {
        $promo = Promotion::all();

        $data = [
            'title' => 'Homepage',
            'promo' => $promo,
        ];

        return view('pages.promo_list', $data);
    }

    public function gallery_list()
    {
        $galleries = Gallery::all();

        $data = [
            'title' => 'Homepage',
            'galleries' => $galleries,
        ];

        return view('pages.gallery_list', $data);
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

    public function maps()
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

        return view('pages.maps', $data);
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

    public function fasilitas_detail($slug)
    {
        $fasilitas = FacilityWisata::where('slug', $slug)->first();
        $data = [
            'title' => '' . $fasilitas->judul,
            'fasilitas' => $fasilitas
        ];

        return view('pages.fasilitas_detail', $data);
    }

    public function promo_detail($slug)
    {
        $promo = Promotion::where('slug', $slug)->first();
        $data = [
            'title' => '' . $promo->judul,
            'promo' => $promo
        ];

        return view('pages.promo_detail', $data);
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

        $categoryAge = $request->input('category_age');
        $visited = $request->input('visited');
        $peopleCount = $request->input('people_count');
        $days = $request->input('days');

        if ($categoryAge === 'Dewasa' && $visited === 'Liburan') {
            $hargaTiketPerorang = 10000;
        } elseif ($categoryAge === 'Anak-anak' && $visited === 'Liburan') {
            $hargaTiketPerorang = 5000;
        } else {
            $hargaTiketPerorang = 15000;
        }

        $grandTotal = $hargaTiketPerorang * $peopleCount * $days;

        $transaksi->grand_total = $grandTotal;

        $transaksi->category_age = $request->input('category_age', '');
        $transaksi->visited = $request->input('visited', '');
        $transaksi->payment_method = $request->input('payment_method', '');

        $transaksi->account_name = $request->input('account_name', '');
        $transaksi->account_number = $request->input('account_number', '');

        // dd($request->all(), $grandTotal);

        $transaksi->save();

        // Hitung grand total
        // $grand_total = 0;
        // $i = 0;
        // $transaksi->grand_total = 0;
        // $transaksi->save();
        // if ($request->facilities) {
        //     if (count($request->facilities) > 0) {
        //         foreach($request->facilities as $item) {
        //             $facility = Fasilitas::find($item);
        //             $subtotal = $facility->price * $request->people_count * $request->days;
        //             $data['transaction_detail'][$i++] = [
        //                 'facility_id' => $facility->id,
        //                 'facility' => $facility,
        //                 'price' => $facility->price,
        //                 'people_count' => $request->people_count,
        //                 'days' => $request->days,
        //                 'subtotal' => $subtotal
        //             ];
        //             $grand_total += $subtotal;

        //             // Save transaction detail
        //             $transaksi_detail = New TransactionDetail();
        //             $transaksi_detail->transaction_id = $transaksi->id;
        //             $transaksi_detail->facility_id = $facility->id;
        //             $transaksi_detail->price = $facility->price;
        //             $transaksi_detail->save();
        //         }
        //     }
        // }
        // $data['grand_total'] = $grand_total;

        // $grand_total += $wisata->price * $transaksi->people_count * $transaksi->days;
        // $grand_total += $transaksi->people_count * $transaksi->days;
        // $transaksi = Transaction::find($transaksi->id);
        // $transaksi->grand_total = $grand_total;
        // $transaksi->save();

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
