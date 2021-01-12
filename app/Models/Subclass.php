<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Subclass extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'subclass';
    protected $primaryKey = 'idsubclass';

    protected $fillable = [
        'headmateri',
    ];

    protected $hidden = [
        'deleted_at','created_by','updated_by','deleted_by'
    ];

    public function class_belong()
    {
        return $this->belongsTo('App\Models\Classes','idclass');
    }

    public function materies()
    {
        return $this->hasMany('App\Models\Materies','idsubclass');
    }

}
