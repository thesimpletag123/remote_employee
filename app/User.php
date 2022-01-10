<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'google_id', 'linkedin_id', 'country','user_type', 'is_verified','user_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	
	public function employee()
	{
		return $this->belongsTo('App\Employee', 'id', 'user_id');
	}
	public function jobpost()
	{
		//return $this->belongsTo(User::class , 'user_id' , 'id');
		return $this->belongsTo('App\JobPost', 'assigned_to_id');
	}
	
	public function GetUserById($id)
	{
		$user = User::where('id',$id)->first();
		
		return $user;
	}

}
