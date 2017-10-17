<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {
	public function getUserAttribute() {
		return User::find($this->user_id);
	}

	public function getCallAttribute() {
		return Call::find($this->call_id);
	}
}
