<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'schedule';
    protected $primaryKey = 'id_schedule';
    public $timestamp = true;

    public function sales()
    {
        return $this->belongsTo(Sales::class, 'sales_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
