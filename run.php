<?php

$areas = json_decode(file_get_contents('results/areas.json'));
foreach ($areas->d as $d) {
    $res = json_decode(file_get_contents("results/{$d->id}.json"));
    $res = $res->d;
   print_r($d); print_r($res);

    $r = array();
    $r[] = $d->id;
    $r[] = $d->nm;
    $r[] = $res->bal;

    for ($round = 0; $round <= 12; $round++) {
        foreach ($res->res as $rr) {
            print_r($rr);
            $perc = $rr->rnd[$round];
            print_r($perc);
            exit;
        }
    }


    print implode($r,"\t")."\n";

    #break;
}
#print_r($areas);
