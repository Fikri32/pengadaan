<?php

use Illuminate\Support\Facades\Route;
use App\User;
use Spatie\Permission\Models\Role;

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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'supplier'], function(){
    Route::get('/index','SupplierController@index')->name('supplier.index');
    Route::match(['get', 'post'], 'tambah', 'SupplierController@tambah')->name('supplier.tambah');
    Route::get('/edit/{id}','SupplierController@edit')->name('supplier.edit');
    Route::post('/update/{id}','SupplierController@update')->name('supplier.update');
    Route::delete('/delete/{id}','SupplierController@delete')->name('supplier.delete');
});

Route::group(['prefix' => 'bahanbaku'],function(){
    Route::get('/index','BahanBakuController@index')->name('bahanbaku.index');
    Route::match(['get' , 'post'],'tambah','BahanBakuController@tambah')->name('bahanbaku.tambah');
    Route::get('/keluar','BahanBakuController@tambah_keluar')->name('bahanbaku.keluar');
    Route::get('/edit/{id}','BahanBakuController@edit')->name('bahanbaku.edit');
    Route::post('/update/{id}','BahanBakuController@update')->name('bahanbaku.update');
    Route::delete('/delete/{id}','BahanBakuController@delete')->name('bahanbaku.delete');
});

Route::group(['prefix' => 'bahanmasuk'],function(){
    Route::get('/index','MasukController@index')->name('masuk.index');
    Route::match(['get' , 'post'],'tambah','MasukController@tambah')->name('masuk.tambah');
    Route::get('/edit/{id}','MasukController@edit')->name('masuk.edit');
    Route::post('/update/{id}','MasukController@update')->name('masuk.update');
    Route::delete('/delete/{id}','MasukController@delete')->name('masuk.delete');
});
Route::group(['prefix' => 'bahankeluar'],function(){
    Route::get('/index','KeluarController@index')->name('keluar.index');
    Route::match(['get' , 'post'],'tambah','KeluarController@tambah')->name('keluar.tambah');
    Route::get('/edit/{id}','KeluarController@edit')->name('keluar.edit');
    Route::post('/update/{id}','KeluarController@update')->name('keluar.update');
    Route::delete('/delete/{id}','KeluarController@delete')->name('keluar.delete');
});

Route::group(['prefix' => 'produk'],function(){
    Route::get('/index','ProdukController@index')->name('produk.index');
    Route::match(['get' , 'post'],'tambah','ProdukController@tambah')->name('produk.tambah');
    Route::get('/edit/{id}','ProdukController@edit')->name('produk.edit');
    Route::post('/update/{id}','ProdukController@update')->name('produk.update');
    Route::delete('/delete/{id}','ProdukController@delete')->name('produk.delete');
});

Route::group(['prefix' => 'produkmasuk'],function(){
    Route::get('index','ProdukMasukController@index')->name('produkmasuk.index');
    Route::match(['get','post'],'tambah','ProdukMasukController@tambah')->name('produkmasuk.tambah');
    Route::get('/edit/{id}','ProdukMasukController@edit')->name('produkmasuk.edit');
    Route::post('/update/{id}','ProdukMasukController@update')->name('produkmasuk.update');
    Route::delete('/delete/{id}','ProdukMasukController@delete')->name('produkmasuk.delete');
});

Route::group(['prefix' => 'penjualan'],function(){
    Route::get('/index','PenjualanController@index')->name('penjualan.index');
    Route::match(['get' , 'post'],'tambah','PenjualanController@tambah')->name('penjualan.tambah');
    Route::get('/edit/{id}','PenjualanController@edit')->name('penjualan.edit');
    Route::post('/update/{id}','PenjualanController@update')->name('penjualan.update');
    Route::delete('/delete/{id}','PenjualanController@delete')->name('penjualan.delete');
});
Route::group(['prefix' => 'pengadaan'],function(){
    Route::get('/index','PengadaanController@index')->name('pengadaan.index');
    Route::match(['get' , 'post'],'tambah','PengadaanController@tambah')->name('pengadaan.tambah');
    Route::get('/edit/{id}','PengadaanController@edit')->name('pengadaan.edit');
    Route::post('/update/{id}','PengadaanController@update')->name('pengadaan.update');
    Route::get('/getJumlah','PengadaanController@getJumlah')->name('penjualan.getJumlah');
    Route::get('/getTotal','PengadaanController@getTotal')->name('penjualan.getTotal');

});
Route::group(['prefix' => 'peramalan'],function(){

    Route::match(['get' , 'post'],'tambah','PeramalanController@tambah')->name('peramalan');
    Route::get('/index','PeramalanController@index')->name('peramalan.index');

});
Route::group(['prefix' => 'komposisi'],function(){
    Route::get('/index/{id}','KomposisiController@index')->name('komposisi.index');
    Route::post('/tambah','KomposisiController@tambah')->name('komposisi.tambah');
    Route::get('edit/{id}','KomposisiController@edit')->name('komposisi.edit');
    Route::post('/update/{id}','KomposisiController@update')->name('komposisi.update');
    Route::delete('/delete/{id}','KomposisiController@delete')->name('komposisi.delete');
});
Route::group(['prefix' => 'laporan'], function () {
    Route::get('/bahanmasuk','LaporanMasukController@index')->name('laporan.masuk');
    Route::get('/bahankeluar', 'LaporanKeluarController@index')->name('laporan.keluar');
});
