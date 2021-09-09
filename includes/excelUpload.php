<?php
    
    if (isset($_FILES['excel']['name'])){
        echo "wrong";
        require "dbh.inc.php";
        include "xlsx.php";
        if($conn){
            $excel = SimpleXLSX::parse(($_FILES['excel']['tmp_name']));
            echo "<pre>"; print_r($excel->rows());     
        }
    }
?>

<section class="section" id="uploadExcel">
    <div class="container">
    <form action="#" method= "POST">
    <div class="container" id = "chooseFile">
        <h3 style="padding: 5px;">Upload Result</h3>
        <input type="file" name ="excel">

    </div>
    <div class="container" id="submitButton">
    <input type="submit" name="submit">
  </div>
    </div>
    </form>
    </section>
