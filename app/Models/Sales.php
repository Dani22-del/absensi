<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Sales extends Model
{
    use HasFactory;
    protected $table = 'sales';
    protected $primaryKey = 'id_sales';
    public $timestamp = true;
}
