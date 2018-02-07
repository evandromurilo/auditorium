<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RequirementVerification;

class Requirement extends Model
{
    public function request()
    {
        return $this->belongsTo('App\Request');
    }

    public function isVerified()
    {
        $verification = RequirementVerification::where('requirement_id', $this->id)->first();

        return !is_null($verification) && $verification->status != 0;
    }
}
