<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    protected $primaryKey = 'id_kontak';
    protected $fillable = ['id_kontak','jenis_kelamin', 'nama', 'alamat','no_tlp'];
}
