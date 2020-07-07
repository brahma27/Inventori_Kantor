<?php

use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;


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

// Route::get('/', function () {
//     return view('barang_masuk/index');
// });

//login logout
Route::get('/','LoginController@index');
Route::post('/cek_login','LoginController@cek_login');
Route::get('/logout','LoginController@logout');

//admin
Route::get('/tambahakun','AdminController@index');
Alert::success();
Alert::warning();
// alert()->info('InfoAlert','Lorem ipsum dolor sit amet.');
Route::post('/addAdmin','AdminController@store');
Route::get('/editA','AdminController@edit_Admin');
Route::post('/edit_akun','AdminController@edit_akun_admin');

//Barang
Route::get('/daftar_barang','BarangController@index');
Route::post('/tambah_barang','BarangController@store');
Route::get('/deleteBarang/{id}','BarangController@destroy');
Route::post('/edit_barang','BarangController@edit');
Route::get('/pdf-barang','BarangController@cetak_pdf');

//Kategori
Route::get('/kategori','KategoriController@index');
Route::post('/tambah_kategori','KategoriController@store');
Route::post('/edit_kategori','KategoriController@edit');

//Barang Masuk
Route::get('/barang_masuk','BarangMasukController@index');
Route::post('/addBMasuk','BarangMasukController@create');
Route::get('/deleteBMasuk/{id}','BarangMasukController@destroy');
Route::post('/editBMasuk','BarangMasukController@edit');
//bagian cetak pdf
Route::get('/buatlap-BMasuk','BarangMasukController@buatlaporan');
Route::post('/lap-bmasuk','BarangMasukController@laporan');
Route::post('/pdf-bmasuk','BarangMasukController@cetak_pdf');

//Barang Keluar
Route::get('/barang_keluar','BarangKeluarController@index');
Route::post('/addBKeluar','BarangKeluarController@create');
Route::get('/deleteBKeluar/{id}','BarangKeluarController@destroy');
Route::post('/editBKeluar','BarangKeluarController@edit');
//bagian cetak pdf
Route::get('/buatlap-BKeluar','BarangKeluarController@buatlaporan');
Route::post('/lap-bkeluar','BarangKeluarController@laporan');
Route::post('/pdf-bkeluar','BarangKeluarController@cetak_pdf');