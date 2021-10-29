<?php
include "dbh.inc.php";
// Query to get columns from table
$query = $conn->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'result' AND TABLE_NAME = 'sem_ii'");

while($row = $query->fetch_assoc()){
    $result[] = $row;
}

// Array of all column names
$columnArr = array_column($result, 'COLUMN_NAME');

$result2 = $conn->query("SELECT * FROM `sem_ii` WHERE Maths < 40 OR Chemistry < 40 OR ED < 40 OR Physics < 40 OR SPA < 40");
$result3 = $conn->query("SELECT * FROM `sem_ii`");


if (!$conn) {
	die("Connection failed: " .mysqli_connect_error());
}

$queryStudent = 'SELECT Student_Name FROM sem_ii ORDER BY Percentage DESC LIMIT 5';

$result5 = mysqli_query($conn, $queryStudent);
$stack = array();
while( $row = mysqli_fetch_array( $result5, MYSQLI_ASSOC) ) {
    array_push( $stack, $row );	
}

$queryPercent = 'SELECT `Percentage` FROM sem_ii ORDER BY Percentage DESC LIMIT 5';

$resultPercent = mysqli_query($conn, $queryPercent);
$stackPercent = array();
while( $row = mysqli_fetch_array( $resultPercent, MYSQLI_ASSOC) ) {
    array_push( $stackPercent, $row );	
}

# IT 
$departPassIT = $conn->query("SELECT * FROM `sem_ii` WHERE Maths > 60");
$resultIT  = $departPassIT -> num_rows;

# CS
$departPassCS = $conn->query("SELECT * FROM `sem_ii` WHERE ED > 60");
$resultCS  = $departPassCS -> num_rows;


# EXTC
$departPassEXTC = $conn->query("SELECT * FROM `sem_ii` WHERE SPA > 60");
$resultEXTC  = $departPassEXTC -> num_rows;


# Electronics
$departPassElec = $conn->query("SELECT * FROM `sem_ii` WHERE Physics > 60");
$resultElec  = $departPassElec -> num_rows;


# Mechanical
$departPassMech = $conn->query("SELECT * FROM `sem_ii` WHERE Chemistry > 60 ");
$resultMech  = $departPassMech -> num_rows;
?>