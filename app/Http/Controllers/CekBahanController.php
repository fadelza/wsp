<?php

namespace App\Http\Controllers;

use App\Models\purchasing;
use App\Models\bom;
use App\Models\inventory;
use App\Models\produk;
use App\Models\produksi;
use Illuminate\Http\Request;

class CekBahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cek(Request $request)
    {
        // get value 
        $valuePesanan = produksi::where('id_produksi', $request->cekBahan)->select('value')->first();
        
        // Cek ketersediaan produk yang sudah jadi
        $namaProdukJadi = produksi::where('id_produksi', $request->cekBahan)->select('pesan_produk')->first();
        $namaProdukJadi2= "Produk jadi ".$namaProdukJadi->pesan_produk ;
        // dd($namaProdukJadi2);
        $cekProdukJadiInv = inventory::where('kebutuhan', $namaProdukJadi2)->select('on_hand')->first();
        if ($cekProdukJadiInv->on_hand>=$valuePesanan->value) {
            return redirect('/produksi')->with('status', 'Produk Tersedia');
        }

        else{

        $namaProduk2 = produksi::where('id_produksi', $request->cekBahan)->select('pesan_produk')->first();
        $kodeProduk = produk::where('nama_produk', $namaProduk2->pesan_produk)->select('id_produk')->first();
        $idProdukBahan = bom::where('id_produk', $kodeProduk->id_produk)->get();
        $bahanInventory = inventory::where('kebutuhan', $namaProduk2->pesan_produk)->get();

        $hargaBahan = bom::where('id_produk', $kodeProduk->id_produk)->get();
        // $satuanBahan = bahan::where('id_produk', $kodeProduk->id_produk)->get();
        
        $kebutuhanProduk = $valuePesanan->value-$cekProdukJadiInv->on_hand;
        // dd($kebutuhanProduk);

        // dd($idProdukBahan[0]['id_produk']);
        // $bahanInventory = inventory::where('kebutuhan', $namaProduk2->pesan_produk)->get();

        $tidakLengkap=false;
        $BahanTidakLengkap=[];
        $jumlahTidakLengkap=[];
        $SatuanTidakLengkap=[];
    
        for ($i=0; $i < count($bahanInventory); $i++) { 
            if ($bahanInventory[$i]['on_hand']<$idProdukBahan[$i]['value']*$kebutuhanProduk) {
                $tidakLengkap=true;
                array_push($BahanTidakLengkap, $bahanInventory[$i]['nama_barang']);
                array_push($jumlahTidakLengkap, $idProdukBahan[$i]['value']*$kebutuhanProduk);
                array_push($SatuanTidakLengkap, $bahanInventory[$i]['satuan']);
            }
        }
        if (!$BahanTidakLengkap) {
            return redirect('/produksi')->with('status', 'Bahan Telah Lengkap');
        }
        else{
            // dd("halo");
            // input bahan yang kurang ke bom untuk dibeli
            for ($i=0; $i < count($BahanTidakLengkap); $i++) { 
                 $produks=$purchasing = purchasing::create([
                'id_vendor' =>1,
                'nama_material' => $BahanTidakLengkap[$i],
                'jumlah' => $jumlahTidakLengkap[$i],
                'satuan' => $hargaBahan[$i]['satuan'],
                'tanggal_order' =>date('Y-m-d'), 
                'total_harga' =>$jumlahTidakLengkap[$i]*$hargaBahan[$i]['harga'],
                'status' =>'Request for Quotation',
            ]);
            }   
        // akhir
        }
        return redirect('/produksi')->with('status', "Bahan kurang, cek bagian pembelian!");
    }

        // dd(count($bahanInventory));
        // dd($bahanInventory[3]['on_hand']);
        // $data=bahan::where('nama_bahan', $restaurantId)->get();
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
    public function destroy($id)
    {
        //
    }
}
