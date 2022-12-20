<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendor extends Model
{
    protected $primaryKey = 'id_vendor';
    protected $fillable = ['id_vendor', 'nama_vendor', 'alamat','no_tlp'];
}
