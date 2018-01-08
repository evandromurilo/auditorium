<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Requirement;
use \App\RequirementVerification;

class RequirementController extends Controller {
	public function __construct() {
		//$this->middleware('auth');
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

  public function showVerification(Request $request) {
		$requirement = Requirement::findOrFail($request->segment(2));
    $verification = RequirementVerification::where('hash', $request->hash)->
      firstOrFail();

    return "Ok!";
  }

  public function updateVerification(Request $request) {
    return "Ok!";
  }
}
