<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Auditorium;
use Carbon\Carbon;

class RequestController extends Controller
{
	public function create(Request $request) {
		$aud = Auditorium::find($request->id);

		return view('request.create', ['aud' => $aud,
			                             'date' => new Carbon($request->date)]);
	}

	public function store(Request $request) {
		$nrequest = new \App\Request;

		$nrequest->auditorium_id = $request->auditorium_id;
		$nrequest->user_id = Auth::id();
		$nrequest->from_time = $request->from_time;
		$nrequest->until_time = $request->until_time;
		$nrequest->date = $request->date;
		$nrequest->event = $request->event;
		$nrequest->description = $request->description;
		$nrequest->status = 0;

		$nrequest->save();
		
		$date = (new Carbon($request->date))->format('d/m/Y');
		return redirect()->route('auditoria.index', ['date' => $date]);
	}
}
