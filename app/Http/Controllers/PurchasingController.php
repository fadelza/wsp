<?php

namespace App\Http\Controllers;

use App\Models\vendor;
use App\Models\purchasing;
use App\Models\inventory;
use App\Models\produk;
use Illuminate\Http\Request;

class PurchasingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ubahStatusPesan(Request $request, purchasing $purchasing, $id)
    {
        $purchasing=purchasing::find($id);
        inventory::create([
            'kode_barang' => "B" ,
            'nama_barang' => $purchasing->nama_material,
            'on_hand' => $purchasing->jumlah,
            'kebutuhan' =>$purchasing->nama_material,
        ]);
        
        purchasing::where('id_material', $request->id_material)
        ->update([
            'status'=>'Purchase Order',
        ]);
        return redirect('/purchasing');
    }

    public function tambahkeInventory(Request $request, purchasing $purchasing)
    {
        $nama_barang = purchasing::where('id_material', $request->id_material)->select('nama_material')->get();
        $nama_barang2 = purchasing::where('id_material', $request->id_material)->get();
        // dd($nama_barang[0]['nama_material']);
        inventory::where('nama_barang', $nama_barang[0]['nama_material'])
                    ->update([
                        'on_hand'=>$nama_barang2[0]['jumlah'],
                    ]);
        purchasing::where('id_material', $request->id_material)
        ->update([
            'status'=>'Barang Diterima',
        ]);
        return redirect('/purchasing')->with('status', 'Data telah berhasil diubah');

    }

    public function index()
    {
        $data=purchasing::all();
        // dd($data);
        return view ('/halamanPurchasing/index', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendor=vendor::all();
        return view('halamanPurchasing/tambahPurchasing', [
            'vendor'=>$vendor
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
        
        $validated = $request->validate([
            'id_vendor' => 'required',
            'nama_material' => 'required',
            'jumlah' => 'required',
            'satuan' => 'required',
            'tanggal_order' => 'required',
            'total_harga' => 'required',
            'status' => 'required',
        ]);
        purchasing::create($request->all());
        return redirect('/purchasing')->with ('status', 'Data telah berhasil ditambahkan');
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
    public function edit(purchasing $purchasing)
    {
        $vendor=vendor::all();
        return view ('halamanPurchasing/editPurchasing',[
            'purchasing'=>$purchasing,
            'vendor'=>$vendor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, purchasing $purchasing)
    {
        purchasing::where('id_material', $purchasing->id_material)
        ->update([    
            'id_vendor' => $request->id_vendor,
            'nama_material' => $request->nama_material,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'tanggal_order' => $request->tanggal_order,
            'total_harga' => $request->total_harga,
            'status' => $request->status,
        ]);
        return redirect('/purchasing')->with('status', 'Data telah berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(purchasing $purchasing)
    {
        purchasing::destroy($purchasing->id_material);
        return redirect('/purchasing')->with('status', 'Data telah berhasil dihapus');
    }
}
