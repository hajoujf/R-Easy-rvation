<link rel=stylesheet href="../CSS/MainD.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<div style="text-align: center;padding-top:20px">
    <h1>Reports</h1>
    <p>Look at all Reports that have been sumbitted!</p>
</div>
<div style="overflow-y:scroll; height:420px;padding-left:60px">
<center><table class="table" style="width:300px">
  <thead>
    <tr>
      <th>Res_Name</th>
      <th>Number of Reports</th>
    </tr>
  </thead>
  <tbody>
  <?php
    require_once('../dbCon.php');
    $sql = "SELECT * FROM `tbreport`";
    $result = $con->query($sql);
    if($result->num_rows > 0 ){
	while($row = $result->fetch_assoc()){
      echo "<tr class='table-hover'>";
      echo "<td>" . $row['RestName'] . "</td>";
      echo "<td>" . $row['Comment'] . "</td>";
      echo "</tr>";					
      }
    }              
	?>
  </tbody>
</table></center>
</div>