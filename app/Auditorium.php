<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Auditorium extends Model {
	public function statusOn(Carbon $date) {
		return new Status($this->id, $date);
	}

	public function freeOn(Carbon $date, $period) {
		if ($period == 0) return $this->statusOn($date)->morning == 1;
		else if ($period == 1) return $this->statusOn($date)->afternoon == 1;
		else return $this->statusOn($date)->night == 1;
	}
}

class Status {
  var $auditorium_id;

	var $requests;
	var $morning_requests;
	var $morning2_requests;
	var $afternoon_requests;
	var $afternoon2_requests;
	var $intermediary_requests;
	var $night_requests;
	var $night2_requests;

	var $morning;
	var $morning2;
	var $afternoon;
	var $afternoon2;
	var $intermediary;
	var $night;

	function __construct($auditorium_id, Carbon $date) {
    $this->auditorium_id = $auditorium_id;
		$this->date = $date;

		$this->requests = Request::where('auditorium_id', $auditorium_id)->
			where('date', $date->toDateString());

		$this->morning_requests = Request::where('auditorium_id', $auditorium_id)->
			where('date', $date->toDateString())->where('period', 0);

		$this->morning2_requests = Request::where('auditorium_id', $auditorium_id)->
			where('date', $date->toDateString())->where('period', 1);

		$this->afternoon_requests = Request::where('auditorium_id', $auditorium_id)->
			where('date', $date->toDateString())->where('period', 2);

		$this->afternoon2_requests = Request::where('auditorium_id', $auditorium_id)->
			where('date', $date->toDateString())->where('period', 3);

		$this->intermediary_requests = Request::where('auditorium_id', $auditorium_id)->
			where('date', $date->toDateString())->where('period', 4);

		$this->night_requests = Request::where('auditorium_id', $auditorium_id)->
			where('date', $date->toDateString())->where('period', 5);

		$this->night2_requests = Request::where('auditorium_id', $auditorium_id)->
			where('date', $date->toDateString())->where('period', 6);

		// set statuses
    $this->morning = $this->getStatus(0);
    $this->morning2 = $this->getStatus(1);
    $this->afternoon = $this->getStatus(2);
    $this->afternoon2 = $this->getStatus(3);
    $this->intermediary = $this->getStatus(4);
    $this->night = $this->getStatus(5);
    $this->night2 = $this->getStatus(6);
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

  public function getStatus($period) {
		if (Request::where('auditorium_id', $this->auditorium_id)->
			where('date', $this->date->toDateString())->where('period', $period)->
			where('status', 2)->count() > 0) {
			return 2;
		} else if (Request::where('auditorium_id', $this->auditorium_id)->
			where('date', $this->date->toDateString())->where('period', $period)->
			where('status', 0)->count() > 0) {
      return 0;
		} else {
      return 1;
		}
  }

  public function getFirstRequest($period) {
    if ($period == 0) return $this->morning_requests->first();
    else if ($period == 1) return $this->morning2_requests->first();
    else if ($period == 2) return $this->afternoon_requests->first();
    else if ($period == 3) return $this->afternoon2_requests->first();
    else if ($period == 4) return $this->intermediary_requests->first();
    else if ($period == 5) return $this->night_requests->first();
    else return $this->night2_requests->first();
  }
}
