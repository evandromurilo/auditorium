<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChatBot
{
    const ERROR_AUDITORIUM_NAME = "Nome de auditório inválido.";
    const ERROR_DATE_FORMAT = "Data em formato inválido.";
    const ERROR_ARGS = "Quantidade de argumentos inválida.";

    public static function resolveCommand($command)
    {
        $args = preg_split("~:~", $command);

        if ($args[0] == "\\local") {
            if (count($args) < 2) {
                return self::ERROR_ARGS;
            }

            $audit = \App\Auditorium::where('name', $args[1])->first();

            if (!$audit) {
                return self::ERROR_AUDITORIUM_NAME;
            }

            $message = "Localização do ".$audit->name.": ".$audit->location;
        } elseif ($args[0] == "\\status") {
            if (count($args) < 3) {
                return self::ERROR_ARGS;
            }

            $audit = \App\Auditorium::where('name', $args[1])->first();

            if (!$audit) {
                return self::ERROR_AUDITORIUM_NAME;
            }

            try {
                $date = Carbon::createFromFormat('d/m/Y', $args[2]);
            } catch (\Exception $e) {
                return self::ERROR_DATE_FORMAT;
            }

            $status = $audit->statusOn($date);
            $message = "Status do ".$audit->name." no dia ".$args[2].": ".
                "pela manhã, ".$status->codeToString($status->morning)."; ".
                "pela tarde, ".$status->codeToString($status->afternoon)."; ".
                "pela noite, ".$status->codeToString($status->night).".";
        } else {
            $message = "Não conheço esse comando.";
        }

        return $message;
    }
}
