<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Call extends Model {
	public function messages() {
		return $this->hasMany('App\Message');
	}

	/* public function getMessagesAttribute() { */
	/* 	return Message::where('call_id', $this->id)->get(); */
	/* } */

	public function callMembers() {
		/* $call_members = CallMember::where('call_id', $this->id);:w */
		/* $users = DB::table('users') */
		/* 	->join('call_members', 'users.id', '=', 'call_members.user_id') */
		/* 	->join('calls', 'calls.id', '=', 'call_members.call_id') */
		/* 	->select('users.*') */
		/* 	->distinct() */
		/* 	->get(); */

		return $this->hasMany('App\CallMember');
	}

	public function members() {
		return $this->belongsToMany('App\User');
	}
}
