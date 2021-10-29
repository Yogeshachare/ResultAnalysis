<?php
include "dbh.inc.php";
// Query to get columns from table
$query = $conn->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'result' AND TABLE_NAME = 'sem_iv'");

while($row = $query->fetch_assoc()){
    $result[] = $row;
}

// Array of all column names
$columnArr = array_column($result, 'COLUMN_NAME');

$result2 = $conn->query("SELECT * FROM `sem_iv` WHERE COA < 40 OR CN < 40 OR OS < 40 OR AT < 40 OR Maths < 40");
$result3 = $conn->query("SELECT * FROM `sem_iv`");


if (!$conn) {
	die("Connection failed: " .mysqli_connect_error());
}

$queryStudent = 'SELECT Student_Name FROM sem_iv ORDER BY Percentage DESC LIMIT 5';

$result5 = mysqli_query($conn, $queryStudent);
$stack = array();
while( $row = mysqli_fetch_array( $result5, MYSQLI_ASSOC) ) {
    array_push( $stack, $row );	
}

$queryPercent = 'SELECT `Percentage` FROM sem_iv ORDER BY Percentage DESC LIMIT 5';

$resultPercent = mysqli_query($conn, $queryPercent);
$stackPercent = array();
while( $row = mysqli_fetch_array( $resultPercent, MYSQLI_ASSOC) ) {
    array_push( $stackPercent, $row );	
}

# IT 
$departPassIT = $conn->query("SELECT * FROM `sem_iv` WHERE COA > 60");
$resultIT  = $departPassIT -> num_rows;

# CS
$departPassCS = $conn->query("SELECT * FROM `sem_iv` WHERE CN > 60");
$resultCS  = $departPassCS -> num_rows;


# EXTC
$departPassEXTC = $conn->query("SELECT * FROM `sem_iv` WHERE OS > 60");
$resultEXTC  = $departPassEXTC -> num_rows;


# Electronics
$departPassElec = $conn->query("SELECT * FROM `sem_iv` WHERE AT > 60");
$resultElec  = $departPassElec -> num_rows;


# Mechanical
$departPassMech = $conn->query("SELECT * FROM `sem_iv` WHERE Maths > 60 ");
$resultMech  = $departPassMech -> num_rows;
?>