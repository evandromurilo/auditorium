<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequirementVerification extends Model
{
    public function request()
    {
        return $this->belongsTo('App\Requirement');
    }
}
