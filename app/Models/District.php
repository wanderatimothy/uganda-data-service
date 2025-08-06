<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'districts_name',
        'districts_code',
        'is_verified',
        'country_id',
    ];


    protected $hidden = [
        'is_verified',
        'country_id'
    ];

    public function country(){

        return $this->belongsTo(Country::class,'country_id', 'id');
    }

}
