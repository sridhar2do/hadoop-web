<?php

include 'connection/hadoopqaconnection.php';

$moduleName=$_POST['moduleName'];
$question=$_POST['question'];
$answer=$_POST['answer'];
$answer = mysql_real_escape_string($answer);

$sql="insert into $tableName(`modulename`,`question`, `answer`)  values('$moduleName','$question','$answer')";
mysql_query($sql);

//$data = array('success'=> $sql);
$data = array('success'=> 'Inserted Successfully');
echo json_encode($data);
?>
	