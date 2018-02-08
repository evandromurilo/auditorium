<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\BlockedDate;
use Carbon\Carbon;

class BlockedDateController extends Controller
{
    public function index()
    {
        $this->authorize('manage', BlockedDate::class);

        return view('blocked_date.index');
    }

    public function store(Request $request)
    {
        $this->authorize('manage', BlockedDate::class);

        $validateData = $request->validate([
            'date' => 'required|date_format:d/m/Y',
            'motive' => 'required|string|max:80',
        ], [
            'date.required' => 'O campo data é obrigatório.',
            'date.date_format' => 'Data em formato inválido.',
            'motive.required' => 'O campo de descrição é obrigatório.',
            'motive.max' => 'O campo de descrição passou do limite de caracteres!',
        ]);

        $blocked_date = new BlockedDate;

        $blocked_date->user_id = Auth::id();
        $blocked_date->motive = $request->motive;
        $blocked_date->block = $request->block;
        $blocked_date->date = Carbon::createFromFormat('d/m/Y', $request->date)->toDateString();

        $blocked_date->save();

        return $blocked_date->id;
    }

    public function delete(Request $request, BlockedDate $date)
    {
        $this->authorize('manage', BlockedDate::class);

        $date->delete();

        return response('OK', 200);
    }

    public function all()
    {
        return BlockedDate::all();
    }
}
