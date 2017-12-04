<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Call extends Model {
	public function messages() {
		return $this->hasMany('App\Message');
	}

	public function callMembers() {
		return $this->hasMany('App\CallMember');
	}

	public function members() {
		return $this->belongsToMany('App\User');
	}
}
