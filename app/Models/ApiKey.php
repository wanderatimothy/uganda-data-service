<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    /** @use HasFactory<\Database\Factories\ApiKeyFactory> */
    use HasFactory;

    protected $fillable = [ 
        'user_id',
        'api_keys_public_key',
        'api_keys_private_key',
        'api_keys_expiry',
        'api_keys_app_name'
    ];

    protected $casts = [
        'api_keys_expiry' => 'datetime'
    ];

    public function requests(){
        return $this->hasMany(ApiRequest::class, 'owner_id', 'id');
    }

    
}
