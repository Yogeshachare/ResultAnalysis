<!doctype html>
<html lang="en">
  <head>
  	<title>Sidebar 01</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">

  <?php
   include "columnArray.php";
   $noOfFailing = $result2 -> num_rows;
    $Total = $result3 -> num_rows;
    $passPercent = (($Total - $noOfFailing) / $Total) * 100;
    $failPercent = 100 - $passPercent;
?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Passing',     <?php echo $passPercent;?>],
          ['Failing',   <?php echo $failPercent;?>],
        ]);

        var options = {
          title: 'Total Passing'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Department', 'Passing'],
          ['IT',   <?php echo $resultIT;?>],
          ['CS',   <?php echo $resultCS;?>],
          ['EXTC', <?php echo $resultEXTC;?>],
          ['Electronic', <?php echo $resultElec;?>],
          ['Mechanical',  <?php echo $resultMech;?>]
        ]);

        var options = {
          title: 'Department Passing',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {packages: ['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {
      var data = google.visualization.arrayToDataTable([
        ['Top Five', 'Student Percentage',],
        ["<?php echo $stack[0]["Student_Name"] ;?>", <?php echo $stackPercent[0]["Percentage"];?>],
        ["<?php echo $stack[1]["Student_Name"] ;?>", <?php echo $stackPercent[1]["Percentage"];?>],
        ["<?php echo $stack[2]["Student_Name"] ;?>", <?php echo $stackPercent[2]["Percentage"];?>],
        ["<?php echo $stack[3]["Student_Name"] ;?>", <?php echo $stackPercent[3]["Percentage"];?>],
        ["<?php echo $stack[4]["Student_Name"] ;?>", <?php echo $stackPercent[4]["Percentage"];?>]
      ]);

      var options = {
        title: 'Top Five Student',
        chartArea: {width: '50%'},
        hAxis: {
          title: 'Percentage',
          minValue: 0,
          maxValue: 100
          
        },
        vAxis: {
          title: 'Students'
        }
      };

      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

      chart.draw(data, options);
    }
    </script>


  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="p-4 pt-5">
		  		<a href="#" class="img logo mb-5" style="background-image: url(images/pillaiLogo.png);"></a>
	        <ul class="list-unstyled components mb-5">
	          <li>
	              <a href="index.php">Semester One</a>
	          </li>
            <li>
	              <a href="#">Semester Two</a>
	          </li>
            <li>
	              <a href="#">Semester Three</a>
	          </li>
            <li>
	              <a href="#">Semester Four</a>
	          </li>
            <li>
	              <a href="#">Semester Five</a>
	          </li>
	      </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-2 p-md-2">
      <nav class="navbar navbar-expand-lg">
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php" id = "navLink">Home</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>


      <div class="container">
        <div class="row">
          <div class="col">
            <div class="card" id = "pieCard">
      <div id="piechart" style="width: 350px; height: 250px;"></div>
      </div>
      </div>
      <div class="col">
      <div class="card" id = "donut">
      <div id="donutchart" style="width: 370px; height: 250px;"></div>
      </div>
      </div>
      <div class="col">
      <div class="card" id = "chartCard">
      <div id="chart_div" style="width: 400px; height: 250px;"></div>
      </div>
      </div>
        </div>
      </div>

  <div class="container" id="Table12">
  <table class="table" id="user_data">
    <thead>
    <tr>
    <?php
      for($x = 0; $x < count($columnArr); $x++){
    ?>  
    <th><?php echo "$columnArr[$x]"; ?></th>
  <?php 
      }
  ?>
  </tr>
    </thead>
    </table>
    <script type="text/javascript" language="javascript" >
 $(document).ready(function(){

var dataTable = $('#user_data').DataTable({
 "processing" : true,
 "serverSide" : true,
 "order" : [],
 "ajax" : {
  url:"fetchResult.php",
  type:"POST"
 }
});
$('#user_data').on('draw.dt', function(){
 $('#user_data').Tabledit({
  url:"actionResult.php",
  dataType:"json",
  columns:{
   identifier : [0, 'Id'],
   editable:[<?php
      for($x = 1; $x < count($columnArr); $x++){
    ?>
    [<?php echo $x  ?>, "<?php echo $columnArr[$x]?>"] <?php if ($x == count($columnArr) - 1){
      echo "";
    }
    else{
      echo ",";
    } ?>
    
    
    <?php } ?>]
  },
  
  restoreButton:false,
  onSuccess:function(data, textStatus, jqXHR)
  {
   if(data.action == 'delete')
   {
    $('#' + data.id).remove();
    $('#user_data').DataTable().ajax.reload();
   }
  }
 });
})
}); 
</script>
</div>
      </div>
		</div>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>