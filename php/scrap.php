<?php
//------------------------------------------------
//Copyright 2022, Nicolas VAILLANT, All rights reserved.
//------------------------------------------------

//Goutte client required
require __DIR__ . "/vendor/autoload.php";
use Goutte\Client;
//Headers
//Content-Type
//CORS : to allow origin to reach the content
header("Content-Type: application/json");
header("Access-Control-Allow-Origin:*");
//scraped url
$urlEDT = 'https://ent.istp-france.com/ENT/Eleve/MonPlanning.aspx';
//password method
$iphone = $_GET['iphone'];
$mdp = $_GET['TGQPQKJRYU'] ?? $password;
$user = $_GET['BJ64F8ALSX'] ?? $username;
//login with Goutte
$client = new Client();
$crawler = $client->request('GET', $urlEDT);
$form = $crawler->selectButton('LoginButton')->form();
$crawler = $client->submit($form, array(
    'UserName' => $user,
    'Password' => $mdp
));
//Formatting text
$crawler->filter('script')->each(function ($node) use ($iphone) {
    $all_content = $node->text();
    //array not empty but style does not match
    if ($all_content !== "") {
        $exp = explode("list = ", $all_content);
        $a = explode(" v.hashes", $exp[1]);
        //get texts
        $all = $a[0];
        $r = explode("{", $all);
        $stack = array("status" => "ok");
        $red = array();
        foreach ($r as $item) {
            if ($item !== "") {
                //remove all html tags
                $z = strip_tags($item);
                $j = html_entity_decode($z);
                //text format
                $o = str_replace("\\", "", $j);
                $t = str_replace("[", "", $o);
                if (str_contains($t, 'webkit-gradient')) {
                    //DS
                    $label = explode('","start"', $t);
                } else {
                    $label = explode('","barColor', $t);
                }
                $title_all = explode('"text":"', $label[0])[1];
                $teacher = explode('M.', $title_all)[1];
                $title = explode('M.', $title_all)[0];
                if (empty($teacher)) {
                    $teacher = explode('Mme', $title_all)[1];
                    $title = explode('Mme', $title_all)[0];
                }
                if (str_contains($t, 'webkit-gradient')) {
                    $start_a = explode('"end":', $label[1])[0];
                    $start = substr($start_a, 1, -1);

                    $end_int = explode('"end":', $label[1])[1];
                    $end = explode(',"barColor"', $end_int)[0];
                } else {
                    $start_int = explode('"start":', $label[1])[1];
                    $start = explode(',"id"', $start_int)[0];
                    $end_int = explode('"end":', $label[1])[1];
                    $end = explode('},', $end_int)[0];
                }
                $array = array(
                    "title" => $title,
                    "loc" => $matches,
                    "teacher" => ltrim($teacher),
                    "start" => $start,
                    "end" => $end
                );
                array_push($stack, $array);
            }
        }

        if (sizeof($stack) !== 1) {
            $size = array("taille" => sizeof($stack));
            array_push($red, $stack);
            array_push($red, $size);

            if ($iphone == true) {
                echo json_encode($stack);
            } else {
                echo json_encode($red);
            }

        }
    }
});
