<?php
include('database_connection.php');

if($_POST['action'] == 'edit')
{
 $TotalPercentage = (($_POST['COA'] + $_POST['CN'] + $_POST['OS'] + $_POST['AT'] + $_POST['Maths']) / 500) * 100;

 $data = array(
  ':Admission_No'  => $_POST['Admission_No'],
  ':Student_Name'  => $_POST['Student_Name'],
  ':Roll_No'   => $_POST['Roll_No'],
  ':Department'   => $_POST['Department'],
  ':COA'   => $_POST['COA'],
  ':CN'   => $_POST['CN'],
  ':OS'   => $_POST['OS'],
  ':AT'   => $_POST['AT'],
  ':Maths'   => $_POST['Maths'],
  ':Total'   => ($_POST['COA'] + $_POST['CN'] + $_POST['OS'] + $_POST['AT'] + $_POST['Maths']),
  ':Percentage'   => $TotalPercentage,
  ':Id'    => $_POST['Id']
 );

 $query = "
 UPDATE sem_iv 
 SET Admission_No = :Admission_No, 
 Student_Name = :Student_Name, 
 Roll_No = :Roll_No,
 Department = :Department,
 COA = :COA, 
 CN = :CN, 
 OS = :OS,
 AT = :AT, 
 Maths = :Maths, 
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
 DELETE FROM sem_iv 
 WHERE Id = '".$_POST["Id"]."'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 echo json_encode($_POST);
}
?>