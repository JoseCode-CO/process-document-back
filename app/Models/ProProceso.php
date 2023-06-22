<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProProceso extends Model
{
    use HasFactory;
    protected $table = "pro_procesos";

    protected $fillable = [
        'pro_prefijo',
        'pro_nombre'
    ];

    public $timestamps = true;
}
