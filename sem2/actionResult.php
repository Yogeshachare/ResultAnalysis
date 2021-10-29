<?php
include('database_connection.php');

if($_POST['action'] == 'edit')
{
 $TotalPercentage = (($_POST['Maths'] + $_POST['ED'] + $_POST['SPA'] + $_POST['Physics'] + $_POST['Chemistry']) / 500) * 100;

 $data = array(
  ':Admission_No'  => $_POST['Admission_No'],
  ':Student_Name'  => $_POST['Student_Name'],
  ':Roll_No'   => $_POST['Roll_No'],
  ':Department'   => $_POST['Department'],
  ':Maths'   => $_POST['Maths'],
  ':ED'   => $_POST['ED'],
  ':SPA'   => $_POST['SPA'],
  ':Physics'   => $_POST['Physics'],
  ':Chemistry'   => $_POST['Chemistry'],
  ':Total'   => ($_POST['Maths'] + $_POST['ED'] + $_POST['SPA'] + $_POST['Physics'] + $_POST['Chemistry']),
  ':Percentage'   => $TotalPercentage,
  ':Id'    => $_POST['Id']
 );

 $query = "
 UPDATE sem_ii 
 SET Admission_No = :Admission_No, 
 Student_Name = :Student_Name, 
 Roll_No = :Roll_No,
 Department = :Department,
 Maths = :Maths, 
 ED = :ED, 
 SPA = :SPA,
 Physics = :Physics, 
 Chemistry = :Chemistry, 
 Total = :Total, 
 Percentage = :Percentage 
 WHERE Id = :Id
 ";
 $statement = $connect->prepare($query);
 $statement->execute($data);
 echo json_encode($_POST);
}

if($_POST['action'] == 'delete')
{
 $query = "
 DELETE FROM sem_ii 
 WHERE Id = '".$_POST["Id"]."'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 echo json_encode($_POST);
}
?>