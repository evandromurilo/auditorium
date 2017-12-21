<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Request extends Model {
	public function auditorium() {
		return $this->belongsTo('App\Auditorium');
	}

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function getDateCAttribute() {
		return new Carbon($this->date);
	}

	public function getPeriodFAttribute() {
		if ($this->period == 0) return "manhã";
		else if ($this->period == 1) return "manhã 2";
		else if ($this->period == 2) return "tarde";
		else if ($this->period == 3) return "tarde 2";
		else if ($this->period == 4) return "intermediário";
		else if ($this->period == 5) return "noite";
		else return "noite 2";
	}

  public function getPeriodTimeFAttribute() {
    return App\Helpers\StatusFormatting::periodTimeF($this->period);
  }

	public function getStatusFAttribute() {
		if ($this->status == 0) return "pendente";
		else if ($this->status == 1) return "rejeitado";
		else return "aceito";
	}
}
