<?php 

include "dbh.inc.php";
if (isset($_POST['result-submit'])){
    $admissionNo = $_POST['admission'];
    $name = $_POST['name'];
    echo $admissionNo;
    $records = $conn->query("SELECT * FROM sem_i WHERE `Admission_No` = '$admissionNo'");
    header("Location: ./getPdf.php?error=sqlerror");
}
    ?>