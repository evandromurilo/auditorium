<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Requirement;
use \App\RequirementVerification;

class RequirementController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function grant(Request $request, Requirement $requirement)
    {
        $this->authorize('resolve', Requirement::class);

        if ($requirement->isVerified()) {
            return response('OK', 200);
        }

        $requirement->granted = true;
        $requirement->save();

        return response('OK', 200);
    }

    public function ungrant(Request $request, Requirement $requirement)
    {
        $this->authorize('resolve', Requirement::class);

        if ($requirement->isVerified()) {
            return response('OK', 200);
        }

        $requirement->granted = false;
        $requirement->save();

        return response('OK', 200);
    }

    public function showVerification(Request $request, Requirement $requirement)
    {
        $verification = RequirementVerification::where('requirement_id', $requirement->id)
            ->where('hash', $request->hash)
            ->firstOrFail();

        return view('requirement.verification')->with([
            'verification' => $verification,
            'requirement' => $requirement
        ]);
    }

    public function updateVerification(Request $request, Requirement $requirement)
    {
        $verification = RequirementVerification::where('requirement_id', $requirement->id)
            ->where('hash', $request->hash)
            ->firstOrFail();

        if ($request->confirm == 'true') {
            $verification->status = 2;
            $requirement->granted = true;
        } else {
            $verification->status = 1;
            $requirement->granted = false;
        }

        $verification->save();
        $requirement->save();

        return response('OK', 200);
    }
}
