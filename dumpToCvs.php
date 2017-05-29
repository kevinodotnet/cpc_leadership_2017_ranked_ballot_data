<?php

$head = array();

$areas = json_decode(file_get_contents("json/areas.json"));
$areas = $areas->d;
foreach ($areas as $a) {
    #print_r($a);
    $id = $a->id;
    $nm = $a->nm;

    $head[] = 'areaId';
    $head[] = 'areaName';
    $head[] = 'round';

    $res = json_decode(file_get_contents("json/$id.json"));
    $res = $res->d;

    $bal = $res->bal;
    $head[] = 'ballots';
    $head[] = 'totalPts';

    $candidates = $res->res;

    for ($round = 0; $round <= 12; $round++) {

        $row = array();
        $row[] = $id;
        $row[] = $nm;
        $row[] = $round;

        $totalPoints = 0;
        foreach ($candidates as $c) {
            $c->rnd[$round] = preg_replace('/,/','',$c->rnd[$round]);
            if ($c->nm == 'Undervotes') {
                continue;
            }
            if ($c->nm == 'Remainder') {
                continue;
            }
            #print "ROUND $round {$c->nm} points {$c->rnd[$round]}\n";
            $totalPoints += $c->rnd[$round];
        }
        if ($round == 0) {
            $row[] = $bal;
        } else {
            $row[] = '';
        }
        $row[] = $totalPoints;

        foreach ($candidates as $c) {
            if ($round == 0) {
                $head[] = $c->nm;
            }
            if ($c->nm == 'Undervotes') {
                $row[] = $c->rnd[$round];
                continue;
            }
            if ($c->nm == 'Remainder') {
                $row[] = $c->rnd[$round];
                continue;
            }
            #$row[] = $c->rnd[$round]; continue;
            $pts = $c->rnd[$round];
            $perc = $pts/$totalPoints;
            $row[] = $perc;
        }
        if ($id == 1 && $round == 0) {
            print implode("\t",$head)."\n";
        }

        print implode("\t",$row)."\n";
    }

    #print_r($res);

    #print_r($head);
}
