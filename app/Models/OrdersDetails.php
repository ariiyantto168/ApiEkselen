<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersDetails extends Model
{
    protected $dates = ['deleted_at'];

    protected $table = 'orders_details';
    protected $primaryKey = 'idordersdetails';

    protected $fillable = [
        'idusers','idclass','quantity'
    ];

    public function classes()
    {
        return $this->hasMany('App\Models\Classes','idclass','idclass');
    }
}
