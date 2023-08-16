<?php

use PostController as PostController;
use UserController as UserController;
use KategoriController as KategoriController;
use FasilitasController as FasilitasController;
use PromotionController as PromotionController;
use GalleryController as GalleryController;
use PaymentMethodController as PaymentMethodController;
use WisataController as WisataController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FrontPageController@index')->name('welcome');
Route::get('wisata', 'FrontPageController@wisata_list')->name('wisata_list');
Route::get('fasilitas', 'FrontPageController@fasilitas_list')->name('fasilitas_list');
Route::get('promo', 'FrontPageController@promo_list')->name('promo_list');
Route::get('gallery', 'FrontPageController@gallery_list')->name('gallery_list');
Route::get('berita', 'FrontPageController@berita_list')->name('berita_list');
Route::post('wisata', 'FrontPageController@wisata_list_search')->name('wisata_list.search');
Route::get('wisata/{slug}', 'FrontPageController@wisata_detail')->name('wisata.detail');
Route::get('fasilitas/{slug}', 'FrontPageController@fasilitas_detail')->name('fasilitas.detail');
Route::get('promo/{slug}', 'FrontPageController@promo_detail')->name('promo.detail');
Route::get('berita/{slug}', 'FrontPageController@berita_detail')->name('berita.detail');
Route::get('wisata/kategori/{id}', 'FrontPageController@wisata_list_by_kategori')->name('wisata.list_by_kategori');
Route::get('tentang', 'FrontPageController@about');
Route::get('kontak', 'FrontPageController@kontak');
Route::get('maps', 'FrontPageController@maps');
Route::post('booking/{wisata_id}', 'FrontPageController@booking')->name('booking')->middleware(['auth']);
Route::post('booking_confirmation', 'FrontPageController@booking_confirmation')->name('booking_confirmation')->middleware(['auth']);
Route::post('contact', 'ContactFormController@store')->name('contact_form.store');
Route::get('booking_cancel', 'FrontPageController@booking_cancel')->name('booking_cancel')->middleware(['auth']);

Auth::routes([]);

// Dashboard semua role
Route::group(['prefix' => 'dashboard', 'as' => 'dashboard', 'middleware' => ['auth']], function() {
    // index dashboard
    Route::get('/', 'DashboardController@index');

    // Sub-index
    Route::group(['as' => '.'], function() {
        Route::resource('user', UserController::class)->except('show');
        Route::get('akun', 'UserController@akun')->name('akun');
        // Route::get('akun', function() {
        //   abort(403, 'Fitur ini tidak berlaku saat demo');
        // })->name('akun');
        Route::get('pesananku', 'TransactionController@index')->name('pesananku');
        Route::get('dashboard_pemilik', 'DashboardController@indexPemilik')->name('dashboard_pemilik');
        Route::get('buat-pesanan', 'TransactionController@create')->name('create');
        Route::get('pesananku/{id}', 'TransactionController@show')->name('transaction.show');
        Route::get('pesanan/{id}', 'TransactionController@detail')->name('transaction.detail');
        Route::put('upload_bukti/{id}', 'TransactionController@upload_bukti')->name('transaction.upload_bukti');
        Route::put('transaksi/{id}', 'TransactionController@set_lunas')->name('transaction.set_lunas');
        Route::delete('transaksi/{id}', 'TransactionController@destroy')->name('transaction.destroy');
        Route::put('testimoni/{id}', 'TransactionController@testimoni_update')->name('transaction.testimoni_update');

        // Khusus petugas (super_admin dan staff)
        Route::group(['middleware' => ['role:super_admin,staff']], function(){
            Route::get('user/admin', 'UserController@akun_admin')->name('akun_admin');
            Route::get('user/karyawan', 'UserController@akun_karyawan')->name('akun_karyawan');
            Route::get('user/member', 'UserController@akun_member')->name('akun_member');
            Route::resource('berita', PostController::class)->except('show');
            Route::resource('promotion', PromotionController::class)->except('show');
            Route::resource('gallery', GalleryController::class)->except('show');
            Route::resource('payment_method', PaymentMethodController::class)->except('show');
            Route::resource('fasilitas_wisata', FacilityWisataController::class)->except('show');
            Route::resource('kategori', KategoriController::class)->except('show');
            Route::resource('fasilitas', FasilitasController::class)->except('show');
            Route::resource('wisata', WisataController::class)->except('show');
            Route::get('wisata/{id}/setup_fasilitas', 'WisataController@setup_fasilitas')->name('setup_fasilitas');
            Route::put('wisata/{id}/setup_fasilitas', 'WisataController@setup_fasilitas_save')->name('setup_fasilitas_save');

            Route::get('pemesanan', 'TransactionController@pemesanan')->name('pemesanan');
            Route::get('contact_form', 'ContactFormController@index')->name('contact_form.index');
            Route::delete('contact_form/{id}', 'ContactFormController@destroy')->name('contact_form.destroy');

            Route::get('pemasukan', 'LaporanController@pemasukan')->name('laporan.pemasukan');
            Route::post('get_pemasukan', 'LaporanController@get_pemasukan')->name('statistik.get_pemasukan');
        });
    });
});
