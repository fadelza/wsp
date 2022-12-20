<?php

namespace App\Http\Controllers;

use App\Models\bom;
use App\Models\inventory;
use App\Models\produk;
use App\Models\produksi;
use App\Models\invoice;
use App\Models\sales;
use Illuminate\Http\Request;

class prosesPesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function proses(request $request)
    {
        // ambil jumlah produk yang sudah jadi untuk di cek berapa pcs yang harus dibuat
        $namaProdukJadi = produksi::where('id_produksi', $request->id_produksi)->get();
        $namaProdukJadi2= "Produk jadi ".$namaProdukJadi[0]['pesan_produk'] ;
        $cekProdukJadiInv = inventory::where('kebutuhan', $namaProdukJadi2)->select('on_hand')->first();
        $BarangInventory = inventory::where('kebutuhan', $namaProdukJadi2)->get();
        $kebutuhanProduk = $namaProdukJadi[0]['value']-$cekProdukJadiInv->on_hand;

        // mengambil data dari inventory
        $dataInventory = inventory::where('kebutuhan', $namaProdukJadi[0]['pesan_produk'])->get();


        $jumlahSebelumnya = inventory::where('kebutuhan', $namaProdukJadi[0]['pesan_produk'])->get();

        // memproses bahan untuk membuat produk yang kurang
        $bom = bom::where('id_produk', $namaProdukJadi[0]['id_produk'])->get();
        $kebutuhanMaterial = [];

        for ($i=0; $i < count($bom); $i++) { 
            inventory::where('nama_barang', $jumlahSebelumnya[$i]['nama_barang'])
                    ->update([
                        'on_hand'=>$jumlahSebelumnya[$i]['on_hand']-($bom[$i]['value']*$kebutuhanProduk),
                    ]);
        }

        produksi::where('id_produksi', $request->id_produksi)
                    ->update([
                        'status'=>'dalam proses pengerjaan',
                    ]);
        

        $jumlahProduk = inventory::where('nama_barang', $namaProdukJadi[0]['pesan_produk'])->first();
        inventory::where('nama_barang', $jumlahProduk->nama_barang)
        ->update([
                    'on_hand'=>$jumlahProduk->on_hand+$kebutuhanProduk,
                ]);
        produk::where('nama_produk', $jumlahProduk->nama_barang)
        ->update([
                    'value'=>$jumlahProduk->on_hand+$kebutuhanProduk,
                ]);
        return redirect('/produksi')->with('status', 'Data telah berhasil diubah');
    }

    public function selesai(request $request,$id)
    {
        // dd($id);
        $dataProduksi = produksi::where('id_produksi', $request->id_produksi)->get();
        $dataSales = sales::where('id_sales', $request->id_sales)->get();
        $dataInventory = inventory::where('nama_barang', $dataProduksi[0]['pesan_produk'])->first();
        $dataProduk = produk::where('nama_produk', $dataProduksi[0]['pesan_produk'])->first();
        
        //input invoice
        $produksi=produksi::find($id);
        $sales=sales::find($id);
        // dd($produksi);
        $invoice = invoice::create([
            'kode_order' => $produksi->kode_order,
            'nama_pemesan' => $produksi->nama_pemesan,
            'pesan_produk' => $produksi->pesan_produk,
            'value' => $produksi->value,
            'tanggal_order' => $sales->tanggal_order,
            'total_harga' => $sales->total_harga,
            'status' => 'To Invoiced',
            'id_produk' => $request->id_produk,
        ]);
        
        inventory::where('nama_barang', $dataProduksi[0]['pesan_produk'])
        ->update([
                    'on_hand'=>$dataInventory->on_hand-$dataProduksi[0]['value'],
                ]);
        produk::where('nama_produk', $dataProduksi[0]['pesan_produk'])
        ->update([
                    'value'=>$dataProduk->value-$dataProduksi[0]['value'],
                ]);
        produksi::where('id_produksi', $request->id_produksi)
        ->update([
                    'status'=>"Selesai",
                ]);
                
        return redirect('/sales')->with('status', 'Pesanan telah selesai');

    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(manufacturing $manufacturing)
    {
        //
    }
}
