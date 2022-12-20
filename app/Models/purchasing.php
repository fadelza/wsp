<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchasing extends Model
{
    protected $primaryKey = 'id_material';
    // protected $fillable = ['kode_order', 'nama_customer', 'alamat', 'kontak', 'id_produk', 'tanggal_order', 'durasi_pengerjaan'];
    protected $fillable = ['id_material','id_vendor','nama_material','jumlah','satuan','tanggal_order','total_harga','status', 'created_at', 'updated_at'];
    
    public function vendors(){
        return $this->belongsTo('App\Models\vendor','id_vendor')->withDefault([
            'id_vendor'=>'tidak ada'
        ]);    
    }
}
