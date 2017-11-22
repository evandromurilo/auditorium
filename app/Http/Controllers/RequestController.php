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
			$requests = \App\Request::where('status', '<>', 0)->orderBy('date', 'desc');
		} else if ($request->filter == "rejected") {
			$requests = \App\Request::where('status', 1)->orderBy('date', 'desc');
		} else if ($request->filter == "accepted") {
			$requests = \App\Request::where('status', 2)->orderBy('date', 'desc');
		} else if ($request->filter == "all") {
			$requests = \App\Request::orderBy('date', 'desc');
		} else {
			$filter = "pending";
			$requests = \App\Request::where('status', 0)->orderBy('date', 'asc');
		}

		return view('request.index')->with(['requests' => $requests->paginate(9),
		                                    'filter' => $filter]);
	}

	public function create(Request $request) {
		$this->authorize('create', \App\Request::class);

		$aud = Auditorium::find($request->id);
		$date = Carbon::createFromFormat('d/m/Y', $request->date);

		if ($date->lt(Carbon::today())) {
			$date = Carbon::today();

			return view('request.create', ['aud' => $aud,
				'date' => $date,
				'period' => $request->period])
				->withErrors(['date' => 'A data requisitada era no passado!']);
		}

		return view('request.create', ['aud' => $aud,
			'date' => $date,
			'period' => $request->period]);
	}

	public function store(Request $request) {
		$this->authorize('create', \App\Request::class);

		$validateData = $request->validate([
			'event' => 'required|string|max:50',
			'period' => 'required|numeric|min:0|max:2',
			'description' => 'required|string|max:500',
		], [
			'event.required' => 'O campo evento é obrigatório.',
			'event.max' => 'O campo evento deve ter até 50 caracteres.',
			'description.required' => 'O campo descrição é obrigatório.',
			'description.max' => 'O campo descrição deve ter até 500 caracteres.'
		]);

		$audit = \App\Auditorium::find($request->auditorium_id);
		if (!$audit->freeOn(new Carbon($request->date), $request->period)) {
			return redirect()->back()->withInput($request->input())
				->withErrors(['period' => 'Auditório indisponível!']);
		}

		$nrequest = new \App\Request;

		$nrequest->auditorium_id = $request->auditorium_id;
		$nrequest->user_id = Auth::id();
		$nrequest->period = $request->period;
		$nrequest->date = $request->date;
		$nrequest->event = $request->event;
		$nrequest->description = $request->description;
		$nrequest->status = 0;

		$nrequest->save();

		event(new \App\Events\RequestCreated($nrequest));

		$date = (new Carbon($request->date))->format('d/m/Y');
		return redirect()->route('auditoria.index', ['date' => $date]);
	}

	public function update(Request $request) {
		$this->authorize('resolve', \App\Request::class);

		$nrequest = \App\Request::find($request->segment(2));

		$nrequest->status = $request->status;
		$nrequest->save();

		event(new \App\Events\RequestStatusChanged($nrequest));

		if ($request->from == 'index') {
			return redirect()->route('requests.index', ['filter' => $request->filter]);
		} else if ($request->from == 'show') {
			return redirect()->route('requests.show', $nrequest->id);
		}
	}

	public function accept(Request $request) {
		$this->authorize('resolve', \App\Request::class);
		return $this->changeStatus($request, 2);
	}

	public function negate(Request $request) {
		$nrequest = \App\Request::find($request->segment(2));

		if (Auth::id() != $nrequest->user_id) {
			$this->authorize('resolve', \App\Request::class);
		}

		return $this->changeStatus($request, 1);
	}

	public function pending(Request $request) {
		$this->authorize('resolve', \App\Request::class);
		return $this->changeStatus($request, 0);
	}

	public function changeStatus(Request $request, int $status) {
		$nrequest = \App\Request::find($request->segment(2));

		$nrequest->status = $status;
		$nrequest->save();

		event(new \App\Events\RequestStatusChanged($nrequest));

		if ($request->from == 'index') {
			return redirect()->route('requests.index', ['filter' => $request->filter]);
		}
		else if ($request->from == 'show') {
			return redirect()->route('requests.show', $nrequest->id);
		}
		else {
			return redirect()->route('requests.index');
		}
	}

	public function modal(Request $request) {
		$nrequest = \App\Request::find($request->segment(2));
		return view('partials.request.request_modal')->with('request', $nrequest);
	}

	public function show(Request $request) {
		$nrequest = \App\Request::find($request->segment(2));

		return view('request.show')->with('request', $nrequest);
	}
}
