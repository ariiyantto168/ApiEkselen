<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Userprofiles extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'userprofiles';
    protected $primaryKey = 'iduserprofiles';



    protected $fillable = [
        'firstname','lastname','tempatlahir','jobrole','address','tanggallahir'
    ];

}
