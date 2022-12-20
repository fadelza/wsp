<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accounting extends Model
{
    protected $primaryKey = 'id_accounting';
    protected $guarded = ['id_accounting', 'created_at', 'updated_at'];
}
