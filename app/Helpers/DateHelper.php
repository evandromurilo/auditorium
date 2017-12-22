<?php

namespace App\Helpers;
use Carbon\Carbon;

class DateHelper {
  public static function canRequest(Carbon $date) {
    $now = Carbon::now();
    $tomorrow = Carbon::tomorrow();

    // cannot request for monday on weekend
    if (DateHelper::isWeekend($now) && $date->dayOfWeek == Carbon::MONDAY) {
      return false;
    }
    // cannot request for today
    if ($date->lt($tomorrow)) {
      return false;
    }
    // cannot request for tomorrow after 12:00
    else if ($date->day == $tomorrow->day && $now->hour > 12) {
      return false;
    }

    return true;
  }

  public static function isWeekend(Carbon $date) {
    return $date->dayOfWeek == Carbon::SUNDAY && $date->dayOfWeek == Carbon::SATURDAY;
  }
}
