<?php
include "dbh.inc.php";
// Query to get columns from table
$query = $conn->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'result' AND TABLE_NAME = 'sem_viii'");

while($row = $query->fetch_assoc()){
    $result[] = $row;
}

// Array of all column names
$columnArr = array_column($result, 'COLUMN_NAME');

$result2 = $conn->query("SELECT * FROM `sem_viii` WHERE IOE < 40 OR BDA < 40 OR ERP < 40 OR IRS < 40 OR EM < 40");
$result3 = $conn->query("SELECT * FROM `sem_viii`");


if (!$conn) {
	die("Connection failed: " .mysqli_connect_error());
}

$queryStudent = 'SELECT Student_Name FROM sem_viii ORDER BY Percentage DESC LIMIT 5';

$result5 = mysqli_query($conn, $queryStudent);
$stack = array();
while( $row = mysqli_fetch_array( $result5, MYSQLI_ASSOC) ) {
    array_push( $stack, $row );	
}

$queryPercent = 'SELECT `Percentage` FROM sem_viii ORDER BY Percentage DESC LIMIT 5';

$resultPercent = mysqli_query($conn, $queryPercent);
$stackPercent = array();
while( $row = mysqli_fetch_array( $resultPercent, MYSQLI_ASSOC) ) {
    array_push( $stackPercent, $row );	
}

# IT 
$departPassIT = $conn->query("SELECT * FROM `sem_viii` WHERE IOE > 60");
$resultIT  = $departPassIT -> num_rows;

# CS
$departPassCS = $conn->query("SELECT * FROM `sem_viii` WHERE BDA > 60");
$resultCS  = $departPassCS -> num_rows;


# EXTC
$departPassEXTC = $conn->query("SELECT * FROM `sem_viii` WHERE ERP > 60");
$resultEXTC  = $departPassEXTC -> num_rows;


# Electronics
$departPassElec = $conn->query("SELECT * FROM `sem_viii` WHERE IRS > 60");
$resultElec  = $departPassElec -> num_rows;


# Mechanical
$departPassMech = $conn->query("SELECT * FROM `sem_viii` WHERE EM > 60 ");
$resultMech  = $departPassMech -> num_rows;
?>