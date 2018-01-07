<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Requirement;

class RequirementController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

  public function grant(Request $request) {
    $this->authorize('resolve', Requirement::class);

    $requirement = Requirement::find($request->id);
    $requirement->granted = true;
    $requirement->save();

    return response('OK', 200);
  }

  public function ungrant(Request $request) {
    $this->authorize('resolve', Requirement::class);

    $requirement = Requirement::find($request->id);
    $requirement->granted = false;
    $requirement->save();

    return response('OK', 200);
  }
}
