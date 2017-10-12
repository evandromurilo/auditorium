<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use \App\Auditorium;

class AuditoriumController extends Controller {
	public function index(Request $request) {
		if ($request->has('date')) {
			return view('auditorium.index')->with(['date' => new Carbon($request->date),
																						 'auditoria' => Auditorium::all()]);
		}
		else {
			return view('auditorium.index')->with(['date' => Carbon::today(),
																						 'auditoria' => Auditorium::all()]);
		}
	}
}
