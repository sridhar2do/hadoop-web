<?php
    $host = "localhost";
    $userName = "root";
    $password = "admin123";
    $dbName = "npntraining";

    $tableName = "interview_questions";
    $tblCategory = "interview_category";

//    error_reporting(E_ALL ^ E_NOTICE);
//    $con = mysqli_connect( $host, $userName, $password, $dbName);
    $con = mysql_connect( $host, $userName, $password);
    mysql_select_db($dbName);

    if (mysql_errno()) echo "Failed to connect to MySQL: " . mysql_error();