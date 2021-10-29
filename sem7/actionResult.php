<?php
include('database_connection.php');

if($_POST['action'] == 'edit')
{
 $TotalPercentage = (($_POST['SEPM'] + $_POST['DMBI'] + $_POST['CCS'] + $_POST['WN'] + $_POST['DF']) / 500) * 100;

 $data = array(
  ':Admission_No'  => $_POST['Admission_No'],
  ':Student_Name'  => $_POST['Student_Name'],
  ':Roll_No'   => $_POST['Roll_No'],
  ':Department'   => $_POST['Department'],
  ':SEPM'   => $_POST['SEPM'],
  ':DMBI'   => $_POST['DMBI'],
  ':CCS'   => $_POST['CCS'],
  ':WN'   => $_POST['WN'],
  ':DF'   => $_POST['DF'],
  ':Total'   => ($_POST['SEPM'] + $_POST['DMBI'] + $_POST['CCS'] + $_POST['WN'] + $_POST['DF']),
  ':Percentage'   => $TotalPercentage,
  ':Id'    => $_POST['Id']
 );

 $query = "
 UPDATE sem_vi 
 SET Admission_No = :Admission_No, 
 Student_Name = :Student_Name, 
 Roll_No = :Roll_No,
 Department = :Department,
 SEPM = :SEPM, 
 DMBI = :DMBI, 
 CCS = :CCS,
 WN = :WN, 
 DF = :DF, 
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
 DELETE FROM sem_vi 
 WHERE Id = '".$_POST["Id"]."'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 echo json_encode($_POST);
}
?>