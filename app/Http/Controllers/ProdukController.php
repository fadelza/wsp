<?php

namespace App\Http\Controllers;

use App\Models\inventory;
use App\Models\produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=produk::all();
        return view ('/halamanProduk/index', [
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
        return view('halamanProduk/tambahProduk');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        inventory::create([
            'kode_barang' => $request->kode_produk,
            'nama_barang' => $request->nama_produk,
            'on_hand' => $request->value,
            'kebutuhan' =>"Produk jadi ".$request->nama_produk,
        ]);

        $validated = $request->validate([
            'kode_produk' => 'required',
            'nama_produk' => 'required',
            'harga' => 'required',
            'value' => 'required',
            'keterangan_produk' => 'required',
        ]);

        produk::create($request->all());
        return redirect('/produk')->with ('status', 'Data telah berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(produk $produk)
    {
        return view ('halamanProduk/editProduk', ['produk'=>$produk]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, produk $produk)
    {
        produk::where('id_produk', $produk->id_produk)
                    ->update([
                        // 'kode_lembaga'=>$request->kode_lembaga,
                        'kode_produk'=>$request->kode_produk,
                        'nama_produk'=>$request->nama_produk,
                        'harga'=>$request->harga,
                        'value'=>$request->value,
                        'keterangan_produk'=>$request->keterangan_produk,
                    ]);
        return redirect('/produk')->with('status', 'Data telah berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(produk $produk)
    {
        produk::destroy($produk->id_produk);
        return redirect('/produk')->with('status', 'Data telah berhasil dihapus');
    }
}
