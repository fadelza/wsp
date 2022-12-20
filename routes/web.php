<?php

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

Route::get('/', function () {
    return view('/HalamanUtama/index');
});


// produk 
Route::get('/produk', 'ProdukController@index');
Route::get('/produk/tambah', 'ProdukController@create');
Route::post('/produk', 'ProdukController@store');
Route::delete('/produk/{produk}', 'ProdukController@destroy');
Route::get('/produk/{produk}/edit', 'ProdukController@edit');
Route::patch('/produk/{produk}', 'ProdukController@update');


// sales
Route::get('/sales', 'SalesController@index');
Route::get('/sales/tambah', 'SalesController@create');
Route::post('/sales', 'SalesController@store');
Route::delete('/sales/{sales}', 'SalesController@destroy');
Route::get('/sales/{sales}/edit', 'SalesController@edit');
Route::patch('/sales/{sales}', 'SalesController@update');

// BoM
Route::get('/bom', 'BoMController@index');
Route::get('/bom/tambah', 'BoMController@create');
Route::post('/bom', 'BoMController@store');
Route::delete('/bom/{bom}', 'BoMController@destroy');
Route::get('/bom/{bom}/edit', 'BoMController@edit');
Route::patch('/bom/{bom}', 'BoMController@update');

// inventory
Route::get('/inventory', 'InventoryController@index');
Route::get('/inventory/tambah', 'InventoryController@create');
Route::post('/inventory', 'InventoryController@store');
Route::delete('/inventory/{inventory}', 'InventoryController@destroy');
Route::get('/inventory/{inventory}/edit', 'InventoryController@edit');
Route::patch('/inventory/{inventory}', 'InventoryController@update');

// produksi
Route::get('/produksi', 'produksiController@index');
Route::get('/produksi/tambah', 'produksiController@create');
Route::post('/produksi', 'produksiController@store');
Route::delete('/produksi/{produksi}', 'produksiController@destroy');
Route::get('/produksi/{produksi}/edit', 'produksiController@edit');
Route::patch('/produksi/{produksi}', 'produksiController@update');

// Purchasing
Route::get('/purchasing', 'PurchasingController@index');
Route::get('/purchasing/tambah', 'PurchasingController@create');
Route::post('/purchasing', 'PurchasingController@store');
Route::delete('/purchasing/{purchasing}', 'PurchasingController@destroy');
Route::get('/purchasing/{purchasing}/edit', 'PurchasingController@edit');
Route::patch('/purchasing/{purchasing}', 'PurchasingController@update');

// vendor
Route::get('/vendor', 'VendorController@index');
Route::get('/vendor/tambah', 'VendorController@create');
Route::post('/vendor', 'VendorController@store');
Route::delete('/vendor/{vendor}', 'VendorController@destroy');
Route::get('/vendor/{vendor}/edit', 'VendorController@edit');
Route::patch('/vendor/{vendor}', 'VendorController@update');

// kontak
Route::get('/contact', 'ContactController@index');
Route::get('/contact/tambah', 'ContactController@create');
Route::post('/contact', 'ContactController@store');
Route::delete('/contact/{contact}', 'ContactController@destroy');
Route::get('/contact/{contact}/edit', 'ContactController@edit');
Route::patch('/contact/{contact}', 'ContactController@update');

// invoice
Route::get('/invoice', 'InvoiceController@index');
Route::get('/invoice/tambah', 'InvoiceController@create');
Route::post('/invoice', 'InvoiceController@store');
Route::delete('/invoice/{invoice}', 'InvoiceController@destroy');
Route::get('/invoice/{invoice}/edit', 'InvoiceController@edit');
Route::patch('/invoice/{invoice}', 'InvoiceController@update');

// accounting
Route::get('/accounting', 'AccountingController@index');
Route::get('/accounting/tambah', 'AccountingController@create');
Route::post('/accounting', 'AccountingController@store');
Route::delete('/accounting/{accounting}', 'AccountingController@destroy');
Route::get('/accounting/{accounting}/edit', 'AccountingController@edit');
Route::patch('/accounting/{accounting}', 'AccountingController@update');

// cek bahan
Route::get('/cekBahan/{cekBahan}', 'cekBahanController@cek');

// ubah status ke mark as todo
Route::get('/markastodo/{markastodo}', 'UbahStatusController@cek');

// tambah bahan ke inventory
Route::get('/Pesan/{id_material}', 'PurchasingController@ubahStatusPesan');
Route::get('/tambahBahanInventory/{id_material}', 'PurchasingController@tambahkeInventory');

// Proses Pesanan
Route::get('/prosespesanan/{id_produksi}', 'prosesPesananController@proses');
Route::get('/tambahBahanInventory/{id_produksi}', 'prosesPesananController@tambahkeInventory');

// selesaikan pesanan
Route::get('/selesai/{id_produksi}', 'prosesPesananController@selesai');

//ubah status sales
Route::get('/Sales/{id_sales}', 'SalesController@ubahStatusSales');
// sales selesai
Route::get('/invoicing/{id_sales}', 'SalesController@invoicing');

// invoice selesai
Route::get('/payment/{id_invoice}', 'InvoiceController@payment');
// Route::get('/produksi', 'produksiController@index');
// Route::get('/produksi/tambah', 'produksiController@create');
// Route::post('/produksi', 'produksiController@store');
// Route::delete('/produksi/{produksi}', 'produksiController@destroy');
// Route::patch('/produksi/{produksi}', 'produksiController@update');