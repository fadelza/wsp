<?php

namespace App\Http\Controllers;

use App\Models\vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=vendor::all();
        return view ('/halamanVendor/index', [
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
        return view('halamanVendor/tambahVendor');
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
            'nama_vendor' => 'required',
            'alamat' => 'required',
            'no_tlp' => 'required',
        ]);
        vendor::create($request->all());
        return redirect('/vendor')->with ('status', 'Data telah berhasil ditambahkan');
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
    public function edit(vendor $vendor)
    {
        return view ('halamanVendor/editVendor', ['vendor'=>$vendor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, vendor $vendor)
    {
        vendor::where('id_vendor', $vendor->id_vendor)
                    ->update([
                        'nama_vendor'=>$request->nama_vendor,
                        'alamat'=>$request->alamat,
                        'no_tlp'=>$request->no_tlp,
                        'email'=>$request->email,
                    ]);
        return redirect('/vendor')->with('status', 'Data telah berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(vendor $vendor)
    {
        vendor::destroy($vendor->id_vendor);
        return redirect('/vendor')->with('status', 'Data telah berhasil dihapus');
    }
}
