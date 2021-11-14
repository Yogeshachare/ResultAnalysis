<!DOCTYPE html>
<html>
    <head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<style>  
  table {  
    font-family: arial, sans-serif;  
    border-collapse: collapse;  
    width: 50%;
    margin: 0px auto;
  }
  #content{
    text-align: center;
  }  
  td, th, button {  
    border: 1px solid #dddddd;  
    text-align: left;  
    padding: 8px;  
  }  
  button {  
    border: 1px solid black;   
  } 
  tr:nth-child(even) {  
    background-color: #dddddd;  
  }  
</style>
    </head>
    <body>
        <div id="content">
            <h1>Result</h1>
            <?php
include "columnArray.php"
?>



 <label for="table1">Sem 01</label>
<table border="1px" id="table1">
    <tr>
    <?php
      for($x = 0; $x < count($columnArr); $x++){
    ?>  
    <th><?php echo "$columnArr[$x]"; ?></th>
  <?php 
      }
  ?>
  </tr>
<?php
include "dbh.inc.php";
if (isset($_POST['result-submit'])){
    $admissionNo = $_POST['admission'];
    $name = $_POST['name'];
    $records = $conn->query("SELECT * FROM sem_i WHERE `Admission_No` = '$admissionNo'");
}    
while($data = mysqli_fetch_array($records))
{
?>
<tbody>
<tr>
    <td><?php echo $data['Id']; ?></td>
    <td><?php echo $data['Admission_No']; ?></td>
    <td><?php echo $data['Student_Name']; ?></td>
    <td><?php echo $data['Roll_No']; ?></td>
    <td><?php echo $data['Department']; ?></td>
    <td><?php echo $data['Maths']; ?></td>
    <td><?php echo $data['Mechanics']; ?></td>
    <td><?php echo $data['BEE']; ?></td>
    <td><?php echo $data['Physics']; ?></td>
    <td><?php echo $data['Chemistry']; ?></td>
    <td><?php echo $data['Total']; ?></td>
    <td><?php echo $data['Percentage']; ?></td>
</tr>
</tbody>
<?php
}
?>  
</table>
</div>
    
<div id="editor"></div>
<button id="cmd">generate PDF</button>
<script>
    var doc = new jsPDF();
var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
    }
};

$('#cmd').click(function () {
    doc.fromHTML($('#content').html(), 15, 15, {
        'height':500,
        'width': 800,
            'elementHandlers': specialElementHandlers
    });
    doc.save('sample-file.pdf');
});
</script>
    </body>
</html>