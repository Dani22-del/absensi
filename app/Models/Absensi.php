<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensis';
    protected $primaryKey = 'id_absensi';
    public $timestamp = true;
    

    public function sales()
    {
        return $this->belongsTo(Sales::class, 'sales_id');
    }
}
