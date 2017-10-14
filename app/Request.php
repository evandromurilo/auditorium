<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Request extends Model {
	public function getAuditoriumAttribute() {
		return Auditorium::find($this->auditorium_id);
	}

	public function getUserAttribute() {
		return User::find($this->user_id);
	}

	public function getDateCAttribute() {
		return new Carbon($this->date);
	}

	public function getPeriodFAttribute() {
		if ($this->period == 0) return "manhã";
		else if ($this->period == 1) return "tarde";
		else "noite";
	}
}
