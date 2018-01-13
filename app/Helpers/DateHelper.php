<?php

namespace App\Helpers;
use App\BlockedDate;
use Carbon\Carbon;

class DateHelper {
  public static function canRequest(Carbon $date) {
    $now = Carbon::now();
    $tomorrow = Carbon::tomorrow();

    if ($now->dayOfWeek != Carbon::MONDAY) $nextMonday = Carbon::today()->next(Carbon::MONDAY);
    else $nextMonday = $now;

    // cannot request for monday on weekend
    if ($now->isWeekend() && $date->isSameDay($nextMonday)) {
      return false;
    }
    // cannot request for today
    if ($date->lt($tomorrow)) {
      return false;
    }
    // cannot request for tomorrow after 12:00
    if ($date->isSameDay($tomorrow) && $now->hour > 12) {
      return false;
    }
    // cannot request on a blocked date
    if (BlockedDate::whereDate('date', $date->toDateString())
                                ->where('block', true)
                                ->first() != null) {
      return false;
    }

    return true;
  }
}
