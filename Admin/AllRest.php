<link rel=stylesheet href="../CSS/MainD.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<div style="text-align: center;padding-top:20px">
    <h1>Restaurants</h1>
    <p>All Unapproved & Approved Restaurants</p>
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
      <th scope="col">Ratings</th>
	    <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
    require_once('../dbCon.php');
    $sql = "SELECT *, AVG(tbratings.Stars) AS avg_rating FROM `tbrestaurant` LEFT JOIN tbratings ON tbrestaurant.RestID = tbratings.RestID GROUP BY tbrestaurant.RestID ORDER BY avg_rating DESC";
    $result = $con->query($sql);
    if($result->num_rows > 0 ){
	while($row = $result->fetch_assoc()){
      echo "<tr class='table-hover'>";
      echo "<td>" . $row['RestName'] . "</td>";
     	echo "<td>" . $row['Address'] . "</td>";
      echo "<td>" . $row['City'] . "</td>";
      echo "<td>" . $row['Cuisine'] . "</td>";
      echo "<td>" . $row['Owner'] . "</td>";
      echo "<td>" . round($row['avg_rating'], 2) . "</td>";
		  echo "<td>";
		  echo "<a class='btn btn-danger' href='./ARScripts/delete.php?id=" .$row['RestID'] ."'> Delete</a>";
		  echo "</td>";
      echo "</div>";
      echo "</tr>";					
      }
    } 
	?>
  </tbody>
</table>

</div>
