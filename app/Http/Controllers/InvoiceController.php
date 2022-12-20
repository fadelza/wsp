<?php

namespace App\Http\Controllers;

use App\Models\inventory;
use App\Models\produk;
use App\Models\produksi;
use App\Models\sales;
use App\Models\contact;
use App\Models\invoice;
use App\Models\accounting;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function payment(Request $request, $id)
    {
        // $dataInvoice = invoice::where('id_invoice', $request->id_invoice)->get();
        $invoice=invoice::find($id);
        $accounting = accounting::create([
            'kode_order' => $invoice->kode_order,
            'nama_pemesan' => $invoice->nama_pemesan,
            'tanggal_order' => $invoice->tanggal_order,
            'total_harga' => $invoice->total_harga,
        ]);
        
        invoice::where('id_invoice', $request->id_invoice)
        ->update([
            'status'=>'Paid',
        ]);
        return redirect('/invoice');
    }
    
     public function index()
    {
        $data=invoice::all();
        return view ('/halamanInvoice/index', [
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
    public function destroy(invoice $invoice)
    {
        invoice::destroy($invoice->id_invoice);
        return redirect('/invoice')->with('status', 'Data telah berhasil dihapus');
    }
}
