<?php

//fetch.php
include "columnArray.php";
include('database_connection.php');

for($x = 0; $x < count($columnArr); $x++){

$column = array($columnArr[$x]);
}

$query = "SELECT * FROM `sheet1` WHERE Maths < 40 OR Chemistry < 40 OR BEE < 40 OR Physics < 40 OR Mechanics < 40";

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

foreach($result as $row)
{
 $sub_array = array();
 for($x = 0; $x < count($columnArr); $x++){
 $sub_array[] = $row[$columnArr[$x]];
 }
 $data[] = $sub_array;
}
function count_all_data($connect)
{
 $query = "SELECT * FROM `sheet1` WHERE Maths < 40 OR Chemistry < 40 OR BEE < 40 OR Physics < 40 OR Mechanics < 40";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 'draw'   => intval($_POST['draw']),
 'recordsTotal' => count_all_data($connect),
 'recordsFiltered' => $number_filter_row,
 'data'   => $data
);
echo json_encode($output);
?>