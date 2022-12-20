<?php

namespace App\Http\Controllers;

use App\Models\bom;
use App\Models\inventory;
use App\Models\produk;
use App\Models\vendor;
use Illuminate\Http\Request;

class BoMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=bom::all();
        // dd($data);
        return view ('/halamanBoM/index', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produk=produk::all();
        return view('halamanBoM/tambahBoM', [
                    'produk'=>$produk,
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
        // mendapatkan nama bahan untuk diinputkan ke inventory
        $nama_barang = produk::where('id_produk',$request->id_produk)->select('nama_produk')->first();
        // dd($nama_barang);
        $kode_barang = 'B'.date('Y-') . mt_rand(100, 999);
        $inventory = inventory::create([
            'kode_barang' => $kode_barang,
            'nama_barang' => $request->nama_bahan,
            'on_hand' => 0,
            'kebutuhan' =>$nama_barang->nama_produk,
        ]);

        $validated = $request->validate([
            'id_produk' => 'required',
            'nama_bahan' => 'required',
            'value' => 'required',
            'satuan' => 'required',
        ]);
        bom::create($request->all());
        return redirect('/bom')->with ('status', 'Data telah berhasil ditambahkan');
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
    public function edit(bom $bom)
    {
        $produk=produk::all();
        return view('halamanBoM/editBoM', [
                    'bom'=>$bom,
                    'produk'=>$produk
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, bom $bom)
    {
        // $this->validate($request, [
        //     'id_produk' => 'required',
        //     'nama_bahan' => 'required',
        //     'value' => 'required',
        //     'satuan' => 'required',
        //     'vendor' => 'required',
        // ]);

        $nama_produkInv = produk::where('id_produk',$request->id_produk)->select('nama_produk')->first();
        inventory::where('nama_barang', $request->bahan_lama)->update([
                        'nama_barang'=>$request->nama_bahan,
                        'kebutuhan'=>$nama_produkInv->nama_produk,
        ]);

        bom::where('id', $request->id)
                    ->update([
                        'id_produk'=>$request->id_produk,
                        'nama_bahan'=>$request->nama_bahan,
                        'value'=>$request->value,
                        'satuan'=>$request->satuan,
                    ]);
        return redirect('/bom')->with('status', 'Data telah berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(bom $bom)
    {
        // $nama_bahan = produk::where('id_produk', $bahan->id_produk)->select('nama_produk')->first();
        // dd($nama_bahan-);
        $deleteInventory = inventory::where('nama_barang', $bom->nama_bahan)->delete();
        bom::destroy($bom->id);
        return redirect('/bom')->with('status', 'Data telah berhasil dihapus');
    }
}
