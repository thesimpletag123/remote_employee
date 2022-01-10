<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobRequest extends Model
{
	protected $table = 'job_requests';
	protected $fillable = [
        'job_id', 'request_as', 'from_userid', 'from_username', 'to_userid', 'to_username', 'is_accept', 'comment'
    ];
}
