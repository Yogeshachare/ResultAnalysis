<?php
include('database_connection.php');

if($_POST['action'] == 'edit')
{
 $TotalPercentage = (($_POST['IOE'] + $_POST['BDA'] + $_POST['ERP'] + $_POST['IRS'] + $_POST['EM']) / 500) * 100;

 $data = array(
  ':Admission_No'  => $_POST['Admission_No'],
  ':Student_Name'  => $_POST['Student_Name'],
  ':Roll_No'   => $_POST['Roll_No'],
  ':Department'   => $_POST['Department'],
  ':IOE'   => $_POST['IOE'],
  ':BDA'   => $_POST['BDA'],
  ':ERP'   => $_POST['ERP'],
  ':IRS'   => $_POST['IRS'],
  ':EM'   => $_POST['EM'],
  ':Total'   => ($_POST['IOE'] + $_POST['BDA'] + $_POST['ERP'] + $_POST['IRS'] + $_POST['EM']),
  ':Percentage'   => $TotalPercentage,
  ':Id'    => $_POST['Id']
 );

 $query = "
 UPDATE sem_viii 
 SET Admission_No = :Admission_No, 
 Student_Name = :Student_Name, 
 Roll_No = :Roll_No,
 Department = :Department,
 IOE = :IOE, 
 BDA = :BDA, 
 ERP = :ERP,
 IRS = :IRS, 
 EM = :EM, 
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
 DELETE FROM sem_viii 
 WHERE Id = '".$_POST["Id"]."'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 echo json_encode($_POST);
}
?>