<?php

namespace App\Services\Utility;

use Carbon\CarbonInterval;

class TimeService
{
    public function covertToCarbonTime($time, $timeFormat)
    {
        //e.g 10 should be to but 5 should be 05
        $newTime = strlen($time) === 2 ? $time : '0'.$time;

        if($timeFormat === 'Minutes') {
            $newTime = '00:'.$newTime.':00';
        }

        if($timeFormat === 'Hours')
        {
            $newTime = $newTime.':00'.':00';
        }

        return CarbonInterval::createFromFormat('H:i:s', $newTime);
    }
}
