<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Classes extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'class';
    protected $primaryKey = 'idclass';

    protected $fillable = [
        'name','duration','images','demo','tutor','description','imagesmitra','imagesinstructor',
    ];

    public function subclass()
    {
        return $this->hasMany('App\Models\SubClass','idclass','idclass');
    }

    public function hilights()
    {
        return $this->hasMany('App\Models\Hilights','idclass','idclass');
    }
}
