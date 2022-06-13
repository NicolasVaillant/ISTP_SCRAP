<?php
$edt = file_get_contents('scrap.php');
$json = json_decode($edt)[0];
$current = date("Y-m-dTH:i:s");
$currentTst = strtotime($current);

foreach ($json as $key => $value) {
    if($key == "status"){
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
