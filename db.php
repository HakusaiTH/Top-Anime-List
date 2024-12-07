<?php

    $host = "127.0.0.1";
    $name = "root";
    $pass = "Fujiwara2312";
    $base = "topanime";
    $port = 3306;

    mysqli_report(MYSQLI_REPORT_OFF);
    $connection = mysqli_connect($host,$name,$pass,$base,$port);
    if(!$connection){
       die ("error" . mysqli_connect_error());
    } else {
        // echo "pass";
    }
