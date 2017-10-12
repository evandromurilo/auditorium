<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Auditorium extends Model {
	public function statusOn(Carbon $date) {
		return new Status($this->id, $date);
	}
}

class Status {
	var $status;
	var $date;
	var $requests;

	function __construct($auditorium_id, Carbon $date) {
		$this->requests = Request::where('date', $date->toDateString())->
			where('auditorium_id', $auditorium_id)->where('status', '<>', 1);

		$this->date = $date;

		if ($this->requests->count() == 0) {
			$this->status = 1; // available
		} else if ($this->requests->where('status', 2)->count() > 0) {
			$this->status = 2; // unavailable
		} else  {
			$this->status = 0; // pending
		}

	}

	function __toString() {
		if ($this->status == 1) {
			return "Disponível";
		}
		else if ($this->status == 2) {
			return "Indisponível";
		}
		else {
			return "Pendente";
		}
	}
}
