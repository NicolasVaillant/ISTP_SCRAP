<?php
//------------------------------------------------
//Copyright 2022, Thérence FOROT and Nicolas VAILLANT, All rights reserved.
//------------------------------------------------

//get json content
$edt = file_get_contents('scrap.php');
$json = json_decode($edt)[0];
//get current time
$current = date("Y-m-dTH:i:s");
$currentTst = strtotime($current);

foreach ($json as $key => $value) {
    if($key == "status"){
        //first key is NaN
        continue;
    }
    foreach ($value as $item => $val) {
        if($item == "start"){
            $start = strtotime($val);
        }
        if ($item == "end") {
            $end = strtotime($val);
        }
    }
    if ($currentTst > $start && $currentTst < $end) {
        echo $key;
    }
}
