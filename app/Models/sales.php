<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    protected $primaryKey = 'id_sales';
    // protected $fillable = ['kode_order', 'nama_customer', 'alamat', 'kontak', 'id_produk', 'tanggal_order', 'durasi_pengerjaan'];
    protected $fillable = ['id_sales','kode_order','id_kontak','id_produk','value','tanggal_order','total_harga','status', 'created_at', 'updated_at'];

    public function produks(){
        return $this->belongsTo('App\Models\produk','id_produk')->withDefault([
            'id_produk'=>'tidak ada'
        ]);    
    }
    public function contacts(){
        return $this->belongsTo('App\Models\contact','id_kontak')->withDefault([
            'id_kontak'=>'tidak ada'
        ]);    
    }
}
