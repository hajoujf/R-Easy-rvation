<link rel=stylesheet href="../CSS/MainD.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<div style="text-align: center;padding-top:20px">
    <h1>Restaurants</h1>
    <p>All Unapproved Restaurants</p>
</div>
<div style="overflow-y:scroll; height:420px;padding-left:60px">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Res_Name</th>
      <th scope="col">Address</th>
      <th scope="col">City</th>
      <th scope="col">Cuisine</th>
	  <th scope="col">Owner</th>
	  <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>
  <?php
    require_once('../dbCon.php');
    $sql = "SELECT * FROM `tbrestaurant` Where `Status`='pending' ";
    $result = $con->query($sql);
    if($result->num_rows > 0 ){
	while($row = $result->fetch_assoc()){
        echo "<tr class='table-hover'>";
        echo "<td>" . $row['RestName'] . "</td>";
     	echo "<td>" . $row['Address'] . "</td>";
        echo "<td>" . $row['City'] . "</td>";
        echo "<td>" . $row['Cuisine'] . "</td>";
        echo "<td>" . $row['Owner'] . "</td>";
		echo "<td style='width:30px'>";
		echo "<div class='btn-group'>";
		echo "<a class='btn btn-success' href='./URScripts/Approve.php?id=" .$row['RestID'] ."'> Approve </a>";
		echo "<a class='btn btn-danger' href='./URScripts/delete.php?id=" .$row['RestID'] ."'> Delete</a>";
		echo "</div>";
		echo "</td>";
        echo "</div>";
        echo "</tr>";
								
        }
    }              
	?>
  </tbody>
</table>
</div>