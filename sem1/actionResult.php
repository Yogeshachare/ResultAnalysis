<?php
include('database_connection.php');

if($_POST['action'] == 'edit')
{
 $TotalPercentage = (($_POST['Maths'] + $_POST['Mechanics'] + $_POST['BEE'] + $_POST['Physics'] + $_POST['Chemistry']) / 500) * 100;

 $data = array(
  ':Admission_No'  => $_POST['Admission_No'],
  ':Student_Name'  => $_POST['Student_Name'],
  ':Roll_No'   => $_POST['Roll_No'],
  ':Department'   => $_POST['Department'],
  ':Maths'   => $_POST['Maths'],
  ':Mechanics'   => $_POST['Mechanics'],
  ':BEE'   => $_POST['BEE'],
  ':Physics'   => $_POST['Physics'],
  ':Chemistry'   => $_POST['Chemistry'],
  ':Total'   => ($_POST['Maths'] + $_POST['Mechanics'] + $_POST['BEE'] + $_POST['Physics'] + $_POST['Chemistry']),
  ':Percentage'   => $TotalPercentage,
  ':Id'    => $_POST['Id']
 );

 $query = "
 UPDATE sem_i 
 SET Admission_No = :Admission_No, 
 Student_Name = :Student_Name, 
 Roll_No = :Roll_No,
 Department = :Department,
 Maths = :Maths, 
 Mechanics = :Mechanics, 
 BEE = :BEE,
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
 DELETE FROM sem_i 
 WHERE Id = '".$_POST["Id"]."'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 echo json_encode($_POST);
}
?>