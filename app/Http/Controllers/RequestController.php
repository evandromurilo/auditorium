<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Auditorium;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Mail\DeanRequired;
use Illuminate\Support\Facades\Mail;
use App\Period;

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

    $requirements = DB::table('default_requirements')->get();
    $periods = Period::all();

    $view = view('request.create', [
      'aud' => $aud,
			'date' => $date,
      'period' => $request->period,
      'periods' => $periods,
      'requirements' => $requirements,
    ]);

    if (!\App\Helpers\DateHelper::canRequest($date)) {
      $date = Carbon::today();

      while (!\App\Helpers\DateHelper::canRequest($date)) {
        $date->addDay();
      }

			return $view->withErrors(['date' => 'A data requisitada estava bloqueada!']);
		}

    return $view;

	}

	public function store(Request $request) {
		$this->authorize('create', \App\Request::class);

		$validateData = $request->validate([
			'event' => 'required|string|max:50',
			'beginning' => 'required|numeric',
			'end' => 'required|numeric',
			'description' => 'required|string|max:500',
			'claimant' => 'max:20',
		], [
			'event.required' => 'O campo evento é obrigatório.',
			'event.max' => 'O campo evento deve ter até 50 caracteres.',
			'description.required' => 'O campo descrição é obrigatório.',
			'description.max' => 'O campo descrição deve ter até 500 caracteres.',
			'claimant.max' => 'O campo requerente deve ter até 30 caracteres.',
		]);

    $beginning = Period::findOrFail($request->beginning);
    $end = Period::findOrFail($request->end);

    if (strtotime($beginning->beginning) > strtotime($end->beginning)) {
        return redirect()->back()->withInput($request->input())
          ->withErrors(['period' => 'Ordem inválida!']);
    }

    $periods = Period::whereTime('beginning', '>=', $beginning->beginning)
      ->whereTime('end', '<=', $end->end)->get();


		$audit = \App\Auditorium::find($request->auditorium_id);
    foreach ($periods as $period) {
      if (!$audit->freeOn(new Carbon($request->date), $period)) {
        return redirect()->back()->withInput($request->input())
          ->withErrors(['period' => 'Auditório indisponível!']);
      }
    }

		$date = new Carbon($request->date);
    if (!\App\Helpers\DateHelper::canRequest($date)) {
			return redirect()->back()->withInput($request->input())
				->withErrors(['date' => 'Data estava bloqueada!']);
		}

    $requirements = $request->get('requirement');

		$nrequest = new \App\Request;

		$nrequest->auditorium_id = $request->auditorium_id;
		$nrequest->user_id = Auth::id();
		$nrequest->date = $request->date;
		$nrequest->event = $request->event;
		$nrequest->description = $request->description;
		$nrequest->status = 0;

    if (!empty($request->claimant)) {
      $nrequest->claimant = $request->claimant;
    }

		$nrequest->save();


    foreach ($periods as $period) {
      $nrequest->periods()->attach($period);
    }

    if (!empty($requirements)) {
      foreach ($requirements as $name) {
        $requirement = new \App\Requirement;
        $requirement->request_id = $nrequest->id;
        $requirement->name = $name;
        $requirement->save();
      }
    }

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

	public function negate(Request $request, $id) {
		$nrequest = \App\Request::find($id);

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

    if ($request->has('justification')) {
      $nrequest->justification = $request->justification;
    }
    else {
      $nrequest->justification = null;
    }

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

    if ($request->from == 'mail') {
      $notification = Auth::user()->notifications()->findOrFail($request->notification);
			$notification->markAsRead();
      event(new \App\Events\NotificationRead(Auth::user()));
    }

		return view('request.show')->with('request', $nrequest);
	}
}
