<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'color', 'cel', 'description',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

		public function requests() {
			return $this->hasMany('App\Request');
		}

		public function callMembers() {
			return $this->hasMany('App\CallMember');
		}

		public function isMember($callId) {
			return CallMember::where('user_id', $this->id)
				->where('call_id', $callId)
				->count() > 0;
		}
}
