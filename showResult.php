<!DOCTYPE html>
<html>
<head>    
    <link rel="stylesheet" href="style.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Excel upload</title>
  </head>
  <body>
  <div class="container" id="Table">
  <h3>Harassment</h3>
  <table class="table" id="user_data">
    <thead>
    <tr><th>id</th><th>Admisson No</th><th>Email</th><th>Branch</th><th>Description</th><th>Status</th></tr>
    </thead>
    </table>
    <script type="text/javascript" language="javascript" >
 $(document).ready(function(){

var dataTable = $('#user_data').DataTable({
 "processing" : true,
 "serverSide" : true,
 "order" : [],
 "ajax" : {
  url:"fetchHaras.php",
  type:"POST"
 }
});

$('#user_data').on('draw.dt', function(){
 $('#user_data').Tabledit({
  url:"actionHaras.php",
  dataType:"json",
  columns:{
   identifier : [0, 'id'],
   editable:[[1, 'admissionNo'], [2, 'email'],[3,'branch'], [4,'description'],  [5, 'status', '{"pending":"pending","completed":"completed","Not Completed":"Not completed"}']]
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
});
 
}); 
</script>
</div>
  </body>
</html>