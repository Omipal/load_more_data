<?php
include('dbconnection.php');

$query = "select * from my_tbl order by id limit 2";

$run = mysqli_query($con, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<table border="1" id="data_table" align="center">
  <tr>
    <th>Id</th>
    <th>Name</th>
    <th>SurName</th>
    <th>Email</th>
  </tr>
  <?php 
    while ($row = mysqli_fetch_array($run)) 
    {
      echo "<tr>
          <td>".$row[0]."</td>
          <td>".$row[1]."</td>
          <td>".$row[2]."</td>
          <td>".$row[3]."</td>
      </tr>";
      $id = $row[0];
    }
  ?>
  
  <tr id="remove_row">
    <td colspan="4" align="center">
      <input type="button" value="Load More" id="load_more" data-id="<?php echo $id; ?>">
    </td>
  </tr>
</table>
<div id="loader" align="center">
  <img src="spinner.gif" alt="Spiner" width="64" height="64">
</div>

 <script src="jquery.js"></script> 
 <script>
$( document ).ready(function() {
$(document).on("click", "#load_more", function(event){
  const id = $("#load_more").attr("data-id");
  $.ajax({
      url:"load.php",
      type:"post",
      data:{id:id},
      beforeSend:function(){
        $("#loader").show();
      },
      success:function(response){
        $("#remove_row").remove();
        $("#data_table").append(response);
        $("#loader").hide();
      }

  });
});
});
 </script>
</body>
</html>