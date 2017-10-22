<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChatBot {
	public static function resolveCommand($command) {
			$args = preg_split("~:~", $command);

			if ($args[0] == "\\local") {
				$audit = \App\Auditorium::where('name', $args[1])->first();
				$message = "Localização do ".$audit->name.": ".$audit->location;
			} else if ($args[0] == "\\status") {
				$audit = \App\Auditorium::where('name', $args[1])->first();
				$date = new Carbon($args[2]);
				$status = $audit->statusOn($date);
				$message = "Status do ".$audit->name." no dia ".$args[2].": ".
					"pela manhã, ".$status->codeToString($status->morning)."; ".
					"pela tarde, ".$status->codeToString($status->afternoon)."; ".
					"pela noite, ".$status->codeToString($status->night).".";
				
			}
			else {
				$message = "Não conheço esse comando.";
			}

			return $message;
	}
}
