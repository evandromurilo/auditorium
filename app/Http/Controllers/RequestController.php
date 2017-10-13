<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Auditorium;
use Carbon\Carbon;

class RequestController extends Controller
{
	public function index(Request $request) {
		if ($request->filter == "resolved") {
			$requests = \App\Request::where('status', '<>', 0)->orderBy('date', 'asc')->get();
		} else if ($request->filter == "rejected") {
			$requests = \App\Request::where('status', 1)->orderBy('date', 'asc')->get();
		} else if ($request->filter == "accepted") {
			$requests = \App\Request::where('status', 2)->orderBy('date', 'asc')->get();
		} else if ($request->filter == "all") {
			$requests = \App\Request::orderBy('date', 'asc')->get();
		} else {
			$requests = \App\Request::where('status', 0)->orderBy('date', 'asc')->get();
		}

		return view('request.index')->with(['requests' => $requests,
		                                    'filter' => $request->filter]);
	}

	public function create(Request $request) {
		$aud = Auditorium::find($request->id);
		$date = Carbon::createFromFormat('d/m/Y', $request->date);

		return view('request.create', ['aud' => $aud,
			                             'date' => $date]);
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

	public function update(Request $request) {
		$nrequest = \App\Request::find($request->segment(2));

		$nrequest->status = $request->status;
		$nrequest->save();

		return redirect()->route('requests.index');
	}
}
