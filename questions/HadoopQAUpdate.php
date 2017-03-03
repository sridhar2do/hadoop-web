<?php

include 'connection/hadoopqaconnection.php';

mysql_connect($host, $userName, $password)or die("cannot connect"); 
mysql_select_db($dbName)or die("cannot select DB");

$modulename=$_POST['_modulename'];
$questionNo=$_POST['_questionNo'];
$question=$_POST['_question'];
$answer=$_POST['_answer'];
$answer = mysql_real_escape_string($answer);


$updateSql="update $tableName set modulename='$modulename',question='$question',answer='$answer' where questionid=$questionNo";
//echo $updateSql;
mysql_query($updateSql);
$data = array('success'=> 'Updated Successfully');
//$data = array('success'=> $updateSql);
echo json_encode($data);

?>
	