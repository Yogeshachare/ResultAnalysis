<?php

//fetch.php

include('database_connection.php');

$column = array("id", "admissionNo", "email", "branch", "description", "status");

$query = "SELECT * FROM harassment";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE admissionNo LIKE "%'.$_POST["search"]["value"].'%" 
 OR email LIKE "%'.$_POST["search"]["value"].'%" 
 OR branch LIKE "%'.$_POST["search"]["value"].'%" 
 OR description LIKE "%'.$_POST["search"]["value"].'%"
 OR status LIKE "%'.$_POST["search"]["value"].'%"
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
 $sub_array[] = $row['admissionNo'];
 $sub_array[] = $row['email'];
 $sub_array[] = $row['branch'];
 $sub_array[] = $row['description'];
 $sub_array[] = $row['status'];
 $data[] = $sub_array;
}

function count_all_data($connect)
{
 $query = "SELECT * FROM harassment";
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