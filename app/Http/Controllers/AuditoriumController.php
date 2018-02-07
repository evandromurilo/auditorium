<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use \App\Auditorium;
use \App\Period;

class AuditoriumController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('date')) {
            $date = Carbon::createFromFormat('d/m/Y', $request->date);
        } else {
            $date = Carbon::today();
        }

        if ($request->has('next')) {
            $date->addDay();
        } elseif ($request->has('previous')) {
            $date->subDay();
        }

        $canRequest = \App\Helpers\DateHelper::canRequest($date);
        $blockedDates = \App\BlockedDate::whereDate(
            'date',
            $date->toDateString()
        )->get();

        return view('auditorium.index')->with([
            'date' => $date,
            'auditoria' => Auditorium::all(),
            'canRequest' => $canRequest,
            'blockedDates' => $blockedDates,
            'periods' => Period::all(),
        ]);
    }
}
