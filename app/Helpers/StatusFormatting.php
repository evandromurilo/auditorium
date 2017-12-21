<?php

namespace App\Helpers;

class StatusFormatting {
  public static function periodTimeF($period) {
		if ($period == 0) return "07:00 às 09:30";
		else if ($period == 1) return "09:30 às 12:00";
		else if ($period == 2) return "13:00 às 15:30";
		else if ($period == 3) return "15:30 às 17:30";
		else if ($period == 4) return "17:30 às 19:00";
		else if ($period == 5) return "19:00 às 20:30";
		else return "20:30 às 22:00";
  }
}