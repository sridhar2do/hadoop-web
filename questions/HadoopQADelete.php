<?php

include '../connection/hadoopqaconnection.php';

$id = $_POST['question_id'];

$sql = "delete from " . $tableName . " where id = " . $id;
mysql_query($sql);

$data = array('success'=> 'Deleted Successfully');

echo json_encode($data);