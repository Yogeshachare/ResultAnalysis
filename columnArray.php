<?php
include "includes/dbh.inc.php";
// Query to get columns from table
$query = $conn->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'result' AND TABLE_NAME = 'sheet1'");

while($row = $query->fetch_assoc()){
    $result[] = $row;
}

// Array of all column names
$columnArr = array_column($result, 'COLUMN_NAME');

$result2 = $conn->query("SELECT * FROM `sheet1` WHERE Maths < 40 OR Chemistry < 40 OR BEE < 40 OR Physics < 40 OR Mechanics < 40");
$result3 = $conn->query("SELECT * FROM `sheet1`");
?>