<?php

//fetch.php

include('database_connection.php');

$column = array("id", "Admission_No", "Student_Name", "Roll_No", "Department","Maths","Mechanics","BEE","Physics","Chemistry","Total","Percentage");

$query = "SELECT * FROM sheet1";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE Admission_No LIKE "%'.$_POST["search"]["value"].'%" 
 OR Student_Name LIKE "%'.$_POST["search"]["value"].'%"
 OR Roll_No LIKE "%'.$_POST["search"]["value"].'%"
 OR Department LIKE "%'.$_POST["search"]["value"].'%"
 OR Maths LIKE "%'.$_POST["search"]["value"].'%"
 OR Mechanics LIKE "%'.$_POST["search"]["value"].'%"
 OR BEE LIKE "%'.$_POST["search"]["value"].'%"
 OR Physics LIKE "%'.$_POST["search"]["value"].'%" 
 OR Chemistry LIKE "%'.$_POST["search"]["value"].'%"
 OR Total LIKE "%'.$_POST["search"]["value"].'%"
 OR Percentage LIKE "%'.$_POST["search"]["value"].'%"
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY id DESC ';
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
 $sub_array[] = $row['id'];
 $sub_array[] = $row['Admission_No'];
 $sub_array[] = $row['Student_Name'];
 $sub_array[] = $row['Roll_No'];
 $sub_array[] = $row['Department'];
 $sub_array[] = $row['Maths'];
 $sub_array[] = $row['Mechanics'];
 $sub_array[] = $row['BEE'];
 $sub_array[] = $row['Physics'];
 $sub_array[] = $row['Chemistry'];
 $sub_array[] = $row['Total'];
 $sub_array[] = $row['Percentage'];
 $data[] = $sub_array;
}

function count_all_data($connect)
{
 $query = "SELECT * FROM sheet1";
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