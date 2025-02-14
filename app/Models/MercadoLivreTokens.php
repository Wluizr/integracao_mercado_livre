<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MercadoLivreTokens extends Model
{
    /** @use HasFactory<\Database\Factories\MercadoLivreTokensFactory> */
    use HasFactory;


    protected $fillable = [
        'access_token',
        'token_type',
        'expires_in',
        'scope',
        'user_id',
        'is_valid',
        'refresh_token',
    ];

    protected $hidden = [
        // 'created_at',
        // 'updated_at',
    ];

}
