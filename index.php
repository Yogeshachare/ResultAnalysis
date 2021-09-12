<!doctype html>
<html lang="en">
  <head>
  <link rel="stylesheet" href="style.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Excel upload</title>
  </head>
  <body>
  <section class="section" id="uploadExcel">
    <div class="container">
  <form action="#" method="POST" enctype="multipart/form-data" id="formContainer">
  <div class="container" id="chooseFile">
        <h3 style="padding: 5px;">Upload Result</h3>
        <input class="form-control" type="file" id="formFile" name="excel">

    </div>
	<div class="container" id="submitButton">
    <input type="submit" class="btn btn-primary mb-3" name="submit">
    </div>
    </form>
    </section>
    <?php
if(isset($_FILES['excel']['name'])){
	$con=mysqli_connect("localhost","root","","result");
	include "xlsx.php";
	if($con){
		$excel=SimpleXLSX::parse($_FILES['excel']['tmp_name']);	
        for ($sheet=0; $sheet < sizeof($excel->sheetNames()) ; $sheet++) { 
        $rowcol=$excel->dimension($sheet);
        $i=0;
        if($rowcol[0]!=1 &&$rowcol[1]!=1){
		foreach ($excel->rows($sheet) as $key => $row) {
			$q="";
			foreach ($row as $key => $cell) {
				if($i==0){
					$q.=$cell. " varchar(50),";
				}else{
					$q.="'".$cell. "',";
				}
			}
			if($i==0){
        $name = $excel->sheetName($sheet);
				mysqli_query($con,"DROP table  if exists $name;");
				$query="CREATE table ".$excel->sheetName($sheet)." (".rtrim($q,",").");";
			}else{
				$query="INSERT INTO ".$excel->sheetName($sheet)." values (".rtrim($q,",").");";
			}
      if(mysqli_query($con,$query))
			{
				header("Location: ./showResult.php?fileAdd=success");
			}
			$i++;
		}
	}
		}
	}
}

?>

  </body>
</html>