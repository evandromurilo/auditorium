<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RequirementVerification;
use Carbon;

class Period extends Model
{
    public function requests()
    {
        return $this->belongsToMany('\App\Request');
    }

    public function getBeginningFAttribute()
    {
        return date('H:i', strtotime($this->beginning));
    }

    public function getEndFAttribute()
    {
        return date('H:i', strtotime($this->end));
    }
}
