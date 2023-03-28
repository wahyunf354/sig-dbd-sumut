<?php

namespace App\Helper\Impl;

use App\Helper\DateHelper;
use Carbon\Carbon;

class DateHelperImpl implements DateHelper
{
  function numberToMonth(int $num): string
  {
    if ($num > 12 || $num < 1) {
      throw new \Exception('Input number in valid');
    }
    $date = Carbon::create(2023, $num, 1);
    $monthName = $date->format('F');
    return $monthName;
  }
}
