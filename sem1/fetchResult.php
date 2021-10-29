<?php

//fetch.php
include "columnArray.php";
include('database_connection.php');

for($x = 0; $x < count($columnArr); $x++){

$column = array($columnArr[$x]);
}

$query = "SELECT * FROM sem_i";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE Admission_No LIKE "%'.$_POST["search"]["value"].'%" 
 OR Student_Name LIKE "%'.$_POST["search"]["value"].'%"
 OR Roll_No LIKE "%'.$_POST["search"]["value"].'%"
 OR Department LIKE "%'.$_POST["search"]["value"].'%"
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY id ASC ';
}
$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

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
 $query = "SELECT * FROM sem_i";
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