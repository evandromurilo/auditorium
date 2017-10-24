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
	var $requests;
	var $morning_requests;
	var $afternoon_requests;
	var $night_requests;

	var $morning;
	var $afternoon;
	var $night;

	function __construct($auditorium_id, Carbon $date) {
		$this->date = $date;

		$this->requests = Request::where('auditorium_id', $auditorium_id)->
			where('date', $date->toDateString());

		$this->morning_requests = Request::where('auditorium_id', $auditorium_id)->
			where('date', $date->toDateString())->where('period', 0);

		$this->afternoon_requests = Request::where('auditorium_id', $auditorium_id)->
			where('date', $date->toDateString())->where('period', 1);

		$this->night_requests = Request::where('auditorium_id', $auditorium_id)->
			where('date', $date->toDateString())->where('period', 2);

		// set morning status
		if (Request::where('auditorium_id', $auditorium_id)->
			where('date', $date->toDateString())->where('period', 0)->
			where('status', 2)->count() > 0) {
			$this->morning = 2;
		} else if (Request::where('auditorium_id', $auditorium_id)->
			where('date', $date->toDateString())->where('period', 0)->
			where('status', 0)->count() > 0) {
			$this->morning = 0;
		} else {
			$this->morning = 1;
		}

		// set afternoon status
		if (Request::where('auditorium_id', $auditorium_id)->
			where('date', $date->toDateString())->where('period', 1)->
			where('status', 2)->count() > 0) {
			$this->afternoon = 2;
		} else if (Request::where('auditorium_id', $auditorium_id)->
			where('date', $date->toDateString())->where('period', 1)->
			where('status', 0)->count() > 0) {
			$this->afternoon = 0;
		} else {
			$this->afternoon = 1;
		}
		
		// set night status
		if (Request::where('auditorium_id', $auditorium_id)->
			where('date', $date->toDateString())->where('period', 2)->
			where('status', 2)->count() > 0) {
			$this->night = 2;
		} else if (Request::where('auditorium_id', $auditorium_id)->
			where('date', $date->toDateString())->where('period', 2)->
			where('status', 0)->count() > 0) {
			$this->night = 0;
		} else {
			$this->night = 1;
		}
	}

	public function codeToString($code) {
		if ($code == 0) {
			return "pendente";
		} else if ($code == 2) {
			return "indisponível";
		} else if ($code == 1) {
			return "disponível";
		}
	}
}
