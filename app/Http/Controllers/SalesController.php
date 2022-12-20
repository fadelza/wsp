<?php

namespace App\Http\Controllers;

use App\Models\inventory;
use App\Models\produk;
use App\Models\produksi;
use App\Models\sales;
use App\Models\contact;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ubahStatusSales(Request $request, sales $sales)
    {
        sales::where('id_sales', $request->id_sales)
        ->update([
            'status'=>'Sales Order',
        ]);
        return redirect('/sales');
    }

    public function invoicing(Request $request, sales $sales)
    {
        sales::where('id_sales', $request->id_sales)
        ->update([
            'status'=>'Selesai',
        ]);
        return redirect('/invoice');
    }

    
     public function index()
    {
        $data=sales::all();
        return view ('/halamanSales/index', [
            'data'=>$data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contact=contact::all();
        $produk=produk::all();
        return view('HalamanSales/tambahSales', [
            'produk'=>$produk,
            'contact'=>$contact,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // mengambil harga dari tabel prouk
        $harga = produk::where('id_produk',$request->id_produk)->select('harga')->first();
        $total_harga = $harga->harga * $request->value;
        // mengganti nilai $reuest->total_harga
        $request->merge(['total_harga' => $total_harga]);

        // cek untuk melihat apakah sudah ada nama yang order di database sebelumnya
        $cekNama = contact::where('id_kontak',$request->id_kontak)->select('nama')->first();

        //if ($cekNama) {
        //    $request->merge(['kode_order' => $cekNama->kode_order]);
        //}

        // dd($request->id_produk);
        // untuk input data ke produksi
        $nama_produkSi = produk::where('id_produk',$request->id_produk)->select('nama_produk')->first();
        // dd($nama_barang);
        $produksi = produksi::create([
            'kode_order' => $request->kode_order,
            'nama_pemesan' => $cekNama->nama,
            'pesan_produk' => $nama_produkSi->nama_produk,
            'value' => $request->value,
            'status' => 'Dalam Antrian',
            'id_produk' => $request->id_produk,
        ]);
        // akhir kode input data ke produksi

        $validated = $request->validate([
            'kode_order' => 'required',
            'id_kontak' => 'required',
            'id_produk' => 'required',
            'value' => 'required',
            'tanggal_order' => 'required',
            'total_harga' => 'required',
            'status' => 'required',
        ]);
        
        sales::create($request->all());
        return redirect('/produksi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(sales $sales)
    {
        return view ('halamanSales/editSales', ['sales'=>$sales]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sales $sales)
    {
 
         // mengambil harga dari tabel prouk
         $harga = produk::where('id_produk',$request->id_produk)->select('harga')->first();
         $total_harga = $harga->harga * $request->value;
         // mengganti nilai $reuest->total_harga
         $request->merge(['total_harga' => $total_harga]);
 
         // cek untuk melihat apakah sudah ada nama yang order di database sebelumnya
        //  $cekNama = sales::where('nama_customer',$request->nama_customer)->select('kode_order')->first();
 
        //  if ($cekNama) {
        //      $request->merge(['kode_order' => $cekNama->kode_order]);
        //  }

        //  edit data yang ada di tabel produksi
        $nama_produkSi = produk::where('id_produk',$request->id_produk)->select('nama_produk')->first();
        produksi::where('kode_order', $request->kode_order_lama)->update([
                        'nama_pemesan'=>$request->nama_customer,
                        'pesan_produk'=>$nama_produkSi->nama_produk,
                        'value'=>$request->value,
        ]);
        // akhir edit data produksi

        sales::where('id_sales', $request->id_sales)
                    ->update([
                        'kode_order'=>$request->kode_order_lama,
                        'id_kontak'=>$request->id_kontak,
                        'id_produk'=>$request->id_produk,
                        'value'=>$request->value,
                        'tanggal_order'=>$request->tanggal_order,
                        'total_harga'=>$request->total_harga,
                    ]);
        return redirect('/sales')->with('status', 'Data telah berhasil diubah');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(sales $sales)
    {
        produksi::destroy($sales->kode_order);
        sales::destroy($sales->id_sales);
        return redirect('/sales')->with('status', 'Data telah berhasil dihapus');
    }
}
