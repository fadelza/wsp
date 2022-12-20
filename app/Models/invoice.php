<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    protected $primaryKey = 'id_invoice';
    protected $guarded = ['id_invoice', 'created_at', 'updated_at'];
}
