<?php
include('database_connection.php');

if($_POST['action'] == 'edit')
{
 $data = array(
  ':admissionNo'  => $_POST['admissionNo'],
  ':email'  => $_POST['email'],
  ':branch'   => $_POST['branch'],
  ':description'   => $_POST['description'],
  ':status'   => $_POST['status'],
  ':id'    => $_POST['id']
 );

 $query = "
 UPDATE harassment 
 SET admissionNo = :admissionNo, 
 email = :email, 
 branch = :branch,
 description = :description,
 status = :status 
 WHERE id = :id
 ";
 $statement = $connect->prepare($query);
 $statement->execute($data);
 echo json_encode($_POST);
}

if($_POST['action'] == 'delete')
{
 $query = "
 DELETE FROM harassment 
 WHERE id = '".$_POST["id"]."'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 echo json_encode($_POST);
}


?>