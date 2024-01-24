<?php 
include('dbconnection.php');
function getMaxId(){

  global $con;
  $query = "select max(id) from my_tbl";
  $run = mysqli_query($con, $query);
  $row = mysqli_fetch_array($run);
  return $row[0];
}
if(isset($_POST['id'])){
  $id = $_POST['id'];

  $query = "select * from my_tbl where  id > '$id' order by id limit 2";

  $run = mysqli_query($con, $query);
  $output = '';

  while ($row = mysqli_fetch_array($run)) {
    $output .= "<tr>
    <td>".$row[0]."</td>
    <td>".$row[1]."</td>
    <td>".$row[2]."</td>
    <td>".$row[3]."</td>
</tr>";
$id = $row[0];
  }

  if($id < getMaxId()){
    $output .= "<tr id='remove_row'>
    <td colspan='4' align='center'>
      <input type='button' value='Load More' id='load_more' data-id='$id'>
    </td>
  </tr>";
  }

}
sleep(2);
echo $output;

?>