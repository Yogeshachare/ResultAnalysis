<!DOCTYPE html>
<html>
<head>    
    <link rel="stylesheet" href="style.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>
    <title>Excel upload</title>
  </head>
  <body>

  <?php
// Database configuration
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "result";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


// Query to get columns from table
$query = $db->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'result' AND TABLE_NAME = 'sheet1'");

while($row = $query->fetch_assoc()){
    $result[] = $row;
}

// Array of all column names
$columnArr = array_column($result, 'COLUMN_NAME');
echo "$columnArr[0]";
?>

  <div class="container" id="Table">
  <h3>Result</h3>
  <table class="table" id="user_data">
    <thead>
    <tr><th><?php echo "$columnArr[0]"; ?></th><th><?php echo "$columnArr[1]"; ?></th><th><?php echo "$columnArr[2]"; ?></th><th><?php echo "$columnArr[3]"; ?></th>
    <th><?php echo "$columnArr[4]"; ?></th><th><?php echo "$columnArr[5]"; ?></th><th><?php echo "$columnArr[6]"; ?></th><th><?php echo "$columnArr[7]"; ?></th>
    <th><?php echo "$columnArr[8]"; ?></th><th><?php echo "$columnArr[9]"; ?></th><th><?php echo "$columnArr[10]"; ?></th></tr>
    </thead>
    </table>
    <script type="text/javascript" language="javascript" >
 $(document).ready(function(){

var dataTable = $('#user_data').DataTable({
 "processing" : true,
 "serverSide" : true,
 "order" : [],
 "ajax" : {
  url:"fetchResult.php",
  type:"POST"
 }
});

$('#user_data').on('draw.dt', function(){
 $('#user_data').Tabledit({
  url:"actionResult.php",
  dataType:"json",
  columns:{
   identifier : [0, 'id'],
   editable:[[1, <?php echo "$columnArr[0]"; ?>], [2, <?php echo "$columnArr[1]"; ?>],[3,<?php echo "$columnArr[2]"; ?>], [4,<?php echo "$columnArr[3]"; ?>],  
   [5, <?php echo "$columnArr[4]"; ?>], [6, <?php echo "$columnArr[5]"; ?>], [7, <?php echo "$columnArr[6]"; ?>], [8, <?php echo "$columnArr[7]"; ?>], [9, <?php echo "$columnArr[8]"; ?>],
   [10, <?php echo "$columnArr[9]"; ?>], [6, <?php echo "$columnArr[10]"; ?>]]
  },
  restoreButton:false,
  onSuccess:function(data, textStatus, jqXHR)
  {
   if(data.action == 'delete')
   {
    $('#' + data.id).remove();
    $('#user_data').DataTable().ajax.reload();
   }
  }
 });
});
 
}); 
</script>
</div>
  </body>
</html>