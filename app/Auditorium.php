<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Auditorium extends Model
{
    public function freeOn(Carbon $date, $period)
    {
        return $this->statusOn($date, $period) == 1;
    }

    public function requestsOn(Carbon $date)
    {
        return Request::where('auditorium_id', $this->id)
            ->where('date', $date->toDateString());
    }

    public function statusOn(Carbon $date, $period)
    {
        $query = DB::table('period_request')
            ->where('period_request.period_id', $period->id)
            ->join('requests', 'requests.id', '=', 'period_request.request_id')
            ->where('requests.date', '=', $date->toDateString())
            ->where('requests.status', '!=', '1')
            ->join('auditoria', 'auditoria.id', '=', 'requests.auditorium_id')
            ->where('auditoria.id', '=', $this->id)
            ->first();

        if (!$query) return 1;
        else return $query->status;
    }
}

