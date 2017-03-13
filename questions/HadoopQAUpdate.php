<?php

include '../connection/hadoopqaconnection.php';

$id = $_POST['question_id'];

$sql = "select * from " . $tableName . " where id = " . $id;

$res = mysql_query( $sql );
$data  = mysql_fetch_assoc($res);

echo json_encode($data);