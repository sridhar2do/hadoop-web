<?php

include '../connection/hadoopqaconnection.php';

$category_id = $_POST['moduleName'];
$question = $_POST['question'];
$answer = $_POST['answer'];
$answer = mysql_real_escape_string($answer);

if( isset($_POST['recordId']) ) {

    $sql = "UPDATE " . $tableName . " SET `question` = '" . $question . "', `answer` = '" . $answer . "', category_id = " . $category_id . " WHERE `id` = " . $_POST['recordId'];
    mysql_query($sql);

} else {

    $sql = "insert into " . $tableName . "(`category_id`,`question`, `answer`)  values($category_id,'$question','$answer')";
    mysql_query($sql);

    $data['recordId'] = mysql_insert_id();

}

$data['success'] =  'Inserted Successfully';
echo json_encode($data);