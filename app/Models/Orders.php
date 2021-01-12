<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $dates = ['deleted_at'];

    protected $table = 'orders';
    protected $primaryKey = 'idorders';

    protected $fillable = [
        'total','codeorder','status_orders','status_payment','snap_token'
    ];


    public function users()
    {
      return $this->belongsTo('App\Models\Users', 'idusers');
    }

    public function orders_details()
    {
        return $this->hasMany('App\Models\OrdersDetails', 'idorders');
    }
}
