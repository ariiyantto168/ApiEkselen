<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whislists extends Model
{
    protected $dates = ['deleted_at'];

    protected $table = 'whislists';
    protected $primaryKey = 'idwhislists';

    protected $fillable = [
        'idclass','idusers'
    ];

    public function users()
    {
      return $this->belongsTo('App\Models\User', 'idusers');
    }   

    public function classes()
    {
        return $this->hasMany('App\Models\Classes','idclass');
    }
}
