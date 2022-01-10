<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenerateOtp extends Model
{
    protected $table = 'generate_otps';
	protected $fillable = [
        'user_id', 'otp'
    ];
}
