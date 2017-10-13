<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use \App\Auditorium;

class AuditoriumController extends Controller {
	public function index(Request $request) {
		if ($request->has('date')) {
			$date = Carbon::createFromFormat('d/m/Y', $request->date);
			return view('auditorium.index')->with(['date' => $date,
																						 'auditoria' => Auditorium::all()]);
		}
		else {
			return view('auditorium.index')->with(['date' => Carbon::today(),
																						 'auditoria' => Auditorium::all()]);
		}
	}
}
