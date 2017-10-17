<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Call extends Model {
	public function getMessagesAttribute() {
		return Message::where('call_id', $this->id)->get();
	}

	public function getMembersAttribute() {
		$users = DB::table('users')
			->join('call_members', 'users.id', '=', 'call_members.user_id')
			->join('calls', 'calls.id', '=', 'call_members.call_id')
			->select('users.*')
			->distinct()
			->get();

		return $users;
	}
}
