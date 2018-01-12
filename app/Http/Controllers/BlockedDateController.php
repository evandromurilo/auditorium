<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\BlockedDate;

class BlockedDateController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

  public function index() {
		$this->authorize('manage', BlockedDate::class);
    
    return view('blocked_date.index');
  }

  public function store(Request $request) {
		$this->authorize('manage', BlockedDate::class);

		$validateData = $request->validate([
			'date' => 'required|date',
		], [
			'date.required' => 'O campo data é obrigatório.',
		]);

		$blocked_date = new BlockedDate;

    $blocked_date->user_id = Auth::id();
    $blocked_date->motive = $request->motive;
    $blocked_date->date = $request->date;

    $blocked_date->save();

    return response('OK', 200);
  }

  public function delete(Request $request) {
		$this->authorize('manage', BlockedDate::class);

    BlockedDate::whereDate('date', $request->date)->delete();

    return response('OK', 200);
  }

  public function all() {
    return BlockedDate::all();
  }
}
