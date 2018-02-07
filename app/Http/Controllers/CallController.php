<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \App\User;
use \App\Call;
use \App\CallMember;
use Bouncer;

class CallController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->has("id")) {
            return view('call.show')->with("first_call_id", $request->id);
        }
        else {
            return view('call.show')->with("first_call_id", 1);
        }
    }

    public function create()
    {
        return view('call.create')->with('users', User::all());
    }

    public function show(Request $request)
    {
        $call = Call::find($request->segment(2));

        $this->authorize('see', $call);

        return $call;
    }

    public function createCall(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|max:35',
            'members' => 'required|min:2',
        ], [
            'title.required' => 'O campo título é obrigatório.',
            'title.max' => 'O campo título deve ter até 35 caracteres',
            'members.min' => 'Insira alguém na chamada!',
        ]);

        $call = new Call;
        $call->title = $request->title;
        $call->save();

        foreach ($request->members as $member) {
            $user = User::where('email', $member['email'])->first();
            $call->members()->attach($user->id);
        }

        event(new \App\Events\CallCreated($call, Auth::user()));

        return $call;
    }

    public function createOneToOneCall($user_id)
    {
        $call_user = DB::table('call_user as first')
            ->join('call_user as second', 'first.call_id', '=', 'second.call_id')
            ->join('calls', 'first.call_id', '=', 'calls.id')
            ->where('calls.user_to_user', '=', true)
            ->where('first.user_id', '=', $user_id)
            ->where('second.user_id', '=', Auth::id())
            ->first();

        if (!$call_user) {
            $call = new Call;
            $call->title = User::find($user_id)->name.' e '.Auth::user()->name;
            $call->user_to_user = true;
            $call->save();

            $call->members()->attach($user_id);
            $call->members()->attach(Auth::id());

            event(new \App\Events\CallCreated($call, Auth::user()));
        } else {
            $call = Call::find($call_user->call_id);
        }

        return $call;
    }

    public function store(Request $request)
    {
        if ($request->from == "create_call") {
            $call = $this->createCall($request);
            return route('calls.index', ["id" => $call->id]);
        } else {
            $call = $this->createOneToOneCall($request->user_id);
            return redirect()->route('calls.index', ["id" => $call->id]);
        }
    }

    public function getOut(Request $request)
    {
        $call = Call::find($request->segment(2));
        Auth::user()->disallow('see', $call);
        $call->members()->detach(Auth::id());
    }

    public function members(Request $request)
    {
        $call = Call::find($request->segment(2));
        $this->authorize('see', $call);

        return $call->members;
    }

    public function messages(Request $request)
    {
        $call = Call::find($request->segment(2));
        $this->authorize('see', $call);

        if ($request->has("page")) {
            $messages = $call->messages->reverse()->forPage($request->page, 11);
            return $messages;
        }

        return $call->messages;
    }
}
