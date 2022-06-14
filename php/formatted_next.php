<?php
//------------------------------------------------
// Copyright 2022, Thérence FOROT and Nicolas VAILLANT, All rights reserved.
//------------------------------------------------

$edt = file_get_contents('scrap.php');
$json = json_decode($edt)[0];
$current = date("Y-m-dTH:i:s");
// Check if day is set in the GET data
if (!isset($_GET['day'])) {
    $day = 0;
} else {
    $day = intval($_GET['day']);
}
// Get current timestamp (shifting it to the next days if $day is > 0)
$currentTst = strtotime($current) + $day*60*60*24;
$found = 0;
// Loop through week classes
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
    // Check if the timestamp is between start and end of the class
    if ($currentTst > $start && $currentTst < $end) {
        // We found a class !
        $found = 1;
    } else {
        // No match, continue on other class
        continue;
    }
    // Get our interesting values
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
    // Display
    echo "Cours de ".$title." avec ".$teacher." jusqu'a ".$end;
    // Break because we can't have two matching class at the same time
}
if ($found == 0) {
    // Indiciate if no class is found
    echo "Libre";
}
