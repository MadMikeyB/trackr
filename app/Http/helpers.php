<?php

function timeDiffForHumans(int $diffInSeconds)
{
    $result = '';

    $data = array(
        'days' => 86400,
        'hours' => 3600,
        'minutes' => 60,
        'seconds' => 1,
    );

    foreach ($data as $k => $v) {
        if ($diffInSeconds >= $v) {
            $diff = floor($diffInSeconds / $v);
            $result .= "$diff " . ($diff > 1 ? $k : substr($k, 0, -1));
            $diffInSeconds -= $v * $diff;
        }
    }

    return $result;
}
