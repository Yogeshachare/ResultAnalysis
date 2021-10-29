<?php
include('database_connection.php');

if($_POST['action'] == 'edit')
{
 $TotalPercentage = (($_POST['DSA'] + $_POST['DBMS'] + $_POST['PCE'] + $_POST['LD'] + $_POST['Maths']) / 500) * 100;

 $data = array(
  ':Admission_No'  => $_POST['Admission_No'],
  ':Student_Name'  => $_POST['Student_Name'],
  ':Roll_No'   => $_POST['Roll_No'],
  ':Department'   => $_POST['Department'],
  ':DSA'   => $_POST['DSA'],
  ':DBMS'   => $_POST['DBMS'],
  ':PCE'   => $_POST['PCE'],
  ':LD'   => $_POST['LD'],
  ':Maths'   => $_POST['Maths'],
  ':Total'   => ($_POST['DSA'] + $_POST['DBMS'] + $_POST['PCE'] + $_POST['LD'] + $_POST['Maths']),
  ':Percentage'   => $TotalPercentage,
  ':Id'    => $_POST['Id']
 );

 $query = "
 UPDATE sem_iii 
 SET Admission_No = :Admission_No, 
 Student_Name = :Student_Name, 
 Roll_No = :Roll_No,
 Department = :Department,
 DSA = :DSA, 
 DBMS = :DBMS, 
 PCE = :PCE,
 LD = :LD, 
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
 DELETE FROM sem_iii 
 WHERE Id = '".$_POST["Id"]."'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 echo json_encode($_POST);
}
?>