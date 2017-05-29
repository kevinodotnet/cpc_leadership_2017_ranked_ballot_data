#!/bin/bash

i=352

    n=`date +%s`0000

    echo "##############################"
    echo "##############################"
    echo "##############################"

    echo $i

curl "https://www.intvoting.com/cpcresults/ResultsService.svc/GetAreaResult?id=$i&_=$n" \
    -H 'Cookie: langSelected=en; ivapptime_hold=mjljmwyfzmtlkd5jhjj5dunb' \
    -H 'Accept-Encoding: gzip, deflate, sdch, br' \
    -H 'Accept-Language: en-US,en;q=0.8' \
    -H 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36' \
    -H 'Accept: application/json, text/javascript, */*; q=0.01' \
    -H 'Referer: https://www.intvoting.com/cpcresults/index.html?lang=en' \
    -H 'X-Requested-With: XMLHttpRequest' \
    -H 'Connection: keep-alive' --compressed > $i.json

php ../ottwatch/bin/api.php $i.json  | head

