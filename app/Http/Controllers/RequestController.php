<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Auditorium;
use Carbon\Carbon;

class RequestController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}

	public function index(Request $request) {
		$this->authorize('resolve', \App\Request::class);

		$filter = $request->filter;

		if ($request->filter == "resolved") {
			$requests = \App\Request::where('status', '<>', 0)->orderBy('date', 'asc')->get();
		} else if ($request->filter == "rejected") {
			$requests = \App\Request::where('status', 1)->orderBy('date', 'asc')->get();
		} else if ($request->filter == "accepted") {
			$requests = \App\Request::where('status', 2)->orderBy('date', 'asc')->get();
		} else if ($request->filter == "all") {
			$requests = \App\Request::orderBy('date', 'asc')->get();
		} else {
			$filter = "pending";
			$requests = \App\Request::where('status', 0)->orderBy('date', 'asc')->get();
		}

		return view('request.index')->with(['requests' => $requests,
		                                    'filter' => $filter]);
	}

	public function create(Request $request) {
		$this->authorize('create', \App\Request::class);

		$aud = Auditorium::find($request->id);
		$date = Carbon::createFromFormat('d/m/Y', $request->date);

		return view('request.create', ['aud' => $aud,
			'date' => $date,
			'period' => $request->period]);
	}

	public function store(Request $request) {
		$this->authorize('create', \App\Request::class);

		$nrequest = new \App\Request;

		$nrequest->auditorium_id = $request->auditorium_id;
		$nrequest->user_id = Auth::id();
		$nrequest->period = $request->period;
		$nrequest->date = $request->date;
		$nrequest->event = $request->event;
		$nrequest->description = $request->description;
		$nrequest->status = 0;

		$nrequest->save();
		
		$date = (new Carbon($request->date))->format('d/m/Y');
		return redirect()->route('auditoria.index', ['date' => $date]);
	}

	public function update(Request $request) {
		$this->authorize('resolve', \App\Request::class);

		$nrequest = \App\Request::find($request->segment(2));

		$nrequest->status = $request->status;
		$nrequest->save();

		event(new \App\Events\RequestStatusChanged($nrequest));

		return redirect()->route('requests.index', ['filter' => $request->filter]);
	}

	public function show(Request $request) {
		$nrequest = \App\Request::find($request->segment(2));

		if ($request->has('from') && $request->from == 'notification') {
			$read = false;
				foreach (Auth::user()->unreadNotifications as $notification) {
					if ($notification->type == "App\Notifications\RequestResolved" &&
						$notification->data['request_id'] == $nrequest->id) {
						$read = true;
						$notification->markAsRead();
					}
				}

			if ($read) event(new \App\Events\NotificationRead($nrequest->user));
		}

		return view('request.show')->with('request', $nrequest);
	}
}
