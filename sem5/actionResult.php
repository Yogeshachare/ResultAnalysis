<?php
include('database_connection.php');

if($_POST['action'] == 'edit')
{
 $TotalPercentage = (($_POST['MEP'] + $_POST['IP'] + $_POST['ADMT'] + $_POST['ECOM'] + $_POST['CNS']) / 500) * 100;

 $data = array(
  ':Admission_No'  => $_POST['Admission_No'],
  ':Student_Name'  => $_POST['Student_Name'],
  ':Roll_No'   => $_POST['Roll_No'],
  ':Department'   => $_POST['Department'],
  ':MEP'   => $_POST['MEP'],
  ':IP'   => $_POST['IP'],
  ':ADMT'   => $_POST['ADMT'],
  ':ECOM'   => $_POST['ECOM'],
  ':CNS'   => $_POST['CNS'],
  ':Total'   => ($_POST['MEP'] + $_POST['IP'] + $_POST['ADMT'] + $_POST['ECOM'] + $_POST['CNS']),
  ':Percentage'   => $TotalPercentage,
  ':Id'    => $_POST['Id']
 );

 $query = "
 UPDATE sem_v 
 SET Admission_No = :Admission_No, 
 Student_Name = :Student_Name, 
 Roll_No = :Roll_No,
 Department = :Department,
 MEP = :MEP, 
 IP = :IP, 
 ADMT = :ADMT,
 ECOM = :ECOM, 
 CNS = :CNS, 
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
 DELETE FROM sem_v 
 WHERE Id = '".$_POST["Id"]."'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 echo json_encode($_POST);
}
?>