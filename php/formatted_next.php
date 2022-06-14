<?php
//------------------------------------------------
//Copyright 2022, Thérence FOROT and Nicolas VAILLANT, All rights reserved.
//------------------------------------------------

$edt = file_get_contents('scrap.php');
$json = json_decode($edt)[0];
$current = date("Y-m-dTH:i:s");
if (!isset($_GET['day'])) {
    $day = 0;
} else {
    $day = intval($_GET['day']);
}

$currentTst = strtotime($current) + $day*60*60*24;
$found = 0;

foreach ($json as $key => $value) {
    if($key == "status"){
        continue;
    }
    foreach ($value as $item => $val) {
        if($item == "start"){
            $start = strtotime(substr($val, 1, -1));
        }
        if ($item == "end") {
            $end = strtotime(substr($val, 1, -1));
        }
    }
    if ($currentTst > $start && $currentTst < $end) {
        // do nothing
        $found = 1;
    } else {
        continue;
    }
    foreach ($value as $item => $val) {
        $val = trim($val);
        if($item == "title"){
            $title = $val;
        }
        if ($item == "teacher") {
            $teacher = $val;
        }
        if ($item == "end") {
            $end = explode("T", substr($val, 1, -1))[1];
        }
    }
    echo "Cours de ".$title." avec ".$teacher." jusqu'a ".$end;
}
if ($found == 0) {
    //avoid empty string if requested
    echo "Vide";
}

