<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Request extends Model
{
    public function auditorium()
    {
        return $this->belongsTo('App\Auditorium');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function requirements()
    {
        return $this->hasMany('App\Requirement');
    }

    public function periods()
    {
        return $this->belongsToMany('\App\Period');
    }

    public function getBeginningAttribute()
    {
        return $this->periods()->orderBy('beginning')->first();
    }

    public function getEndAttribute()
    {
        return $this->periods()->orderBy('end', 'desc')->first();
    }

    public function getDateCAttribute()
    {
        return new Carbon($this->date);
    }

    public function getPeriodFAttribute()
    {
        if ($this->period == 0) {
            return "manhã";
        } elseif ($this->period == 1) {
            return "manhã 2";
        } elseif ($this->period == 2) {
            return "tarde";
        } elseif ($this->period == 3) {
            return "tarde 2";
        } elseif ($this->period == 4) {
            return "intermediário";
        } elseif ($this->period == 5) {
            return "noite";
        } else {
            return "noite 2";
        }
    }

    public function getPeriodTimeFAttribute()
    {
        return \App\Helpers\StatusFormatting::periodTimeF($this->period);
    }

    public function getStatusFAttribute()
    {
        if ($this->status == 0) {
            return "pendente";
        } elseif ($this->status == 1) {
            return "rejeitado";
        } else {
            return "aceito";
        }
    }
}
