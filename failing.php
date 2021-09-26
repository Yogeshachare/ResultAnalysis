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
<title>Top Three</title>
  </head>
  <body>

  <?php 
  include "columnArray.php";
  ?>


  <div class="container" id="Table">
  <h3>Result</h3>
  <table class="table" id="user_data">
    <thead>
    <tr>
    <?php
      for($x = 0; $x < count($columnArr); $x++){
    ?>  
    <th><?php echo "$columnArr[$x]"; ?></th>
  <?php 
      }
  ?>
  </tr>
    </thead>
    </table>
    <script type="text/javascript" language="javascript" >
$(document).ready(function(){
var dataTable = $('#user_data').DataTable({
 "processing" : true,
 "serverSide" : true,
 "order" : [],
 "ajax" : {
  url:"getFailing.php",
  type:"POST",
 },
});
$('#user_data').on('draw.dt', function(){
 $('#user_data').Tabledit({
  url:"actionResult.php",
  dataType:"json",
  columns:{
   identifier : [0, 'Id'],
   editable:[<?php
      for($x = 1; $x < count($columnArr); $x++){
    ?>
    [<?php echo $x  ?>, "<?php echo $columnArr[$x]?>"] <?php if ($x == count($columnArr) - 1){
      echo "";
    }
    else{
      echo ",";
    } ?>
    
    
    <?php } ?>]
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
})
}); 
</script>
</div>
<div class = container>
<?php  $noOfFailing = $result2 -> num_rows;
$Total = $result3 -> num_rows;
$z = (($Total - $noOfFailing) / $Total) * 100;
?>
<a class="btn btn-primary" href="topThree.php">Top 3</a>
<h4 style="text-align:right;">Passing Students :- <?php echo round($z);?>%</h4>
</div>
<?php  $noOfPassing = $result2 -> num_rows ?>
  </body>
</html>