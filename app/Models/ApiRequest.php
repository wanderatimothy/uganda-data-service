<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApiRequest extends Model
{
    use SoftDeletes;

    protected $fillable = ['owner_id' , 'data'];

    protected $casts = [
        'data' => 'array'
    ];

    public function owner() {

        return $this->belongsTo(ApiKey::class,'owner_id', 'id');
    }
}
