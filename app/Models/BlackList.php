<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlackList extends Model
{
    use SoftDeletes;

    protected $fillable = ['ip_address', 'reason' , 'extra'];

    protected $casts = [
        'extra' => 'array'
    ];
    
}
