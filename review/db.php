<?php
    $hostname = 'localhost';
    $dbuserid = 'hoon';
    $dbpasswd = '4204';
    $dbname = 'abcweb';

    $mysqli = new mysqli($hostname, $dbuserid, $dbpasswd, $dbname);

    if($mysqli -> connect_errno){
        die( 'mysqli connection error: '. $mysqli -> connect_error);
    }else{
        echo "성공";
    }
?>