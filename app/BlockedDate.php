<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlockedDate extends Model {
	public function request() {
		return $this->belongsTo('App\User');
	}
}
