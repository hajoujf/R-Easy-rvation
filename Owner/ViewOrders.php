<link rel=stylesheet href="../CSS/MainD.css">
<?php
    require_once('../dbCon.php');
   $user = $_SESSION['User'];
    $sql = "SELECT * FROM tborder WHERE Username='$user' ORDER BY Date DESC, Time Desc"; // Sorting by Date and Time in descending order
    $result = $con->query($sql);
    $today = date("Y-m-d");
    $currentDateTime = new DateTime();
    $currentDateTime->modify('+1 hour');
    function isCancelable($orderDateTime) {
    // Function to check if the order is cancellable (1 hour before the order time)
    $cancelTime = clone $orderDateTime;
    $cancelTime->sub(new DateInterval('PT1H')); // Subtract 1 hour from the order time
    $currentTime = new DateTime();
    $currentTime->modify('+1 hour');
    return $currentTime <= $cancelTime;
  }
?>

<div style="color: #081D45;text-align: center;padding-top:20px">
    <h1>Orders</h1>
    <p>View Orders since day One</p>
</div>
<div style="overflow-y:scroll; height:420px;padding-left:40px">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Order_Id</th>
      <th scope="col">Phone #</th>
      <th scope="col">Date</th>
      <th scope="col">Party_Size</th>
	    <th scope="col">Status</th>
      <th scope="col">Meals</th>
      <th scope="col">Notes</th>
	    <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
    require_once('../dbCon.php');
    $sql = "SELECT * FROM tborder WHERE RestID IN (SELECT RestID FROM tbowner WHERE Username = '$_SESSION[User]')  ORDER BY Date DESC, Time Desc";
    $result = $con->query($sql);
    if($result->num_rows > 0 ){
	while($row = $result->fetch_assoc()){
      $rowDate = $row['Date'];
      $orderDateTime = new DateTime($rowDate . ' ' . $row['Time']);
      $dateColorClass = ($rowDate > $today || ($rowDate == $today && $orderDateTime >= $currentDateTime)) ? 'table-success' : 'table-gray';
      echo "<tr class='table-hover " . $dateColorClass . "'>";
      echo "<td>" . $row['OrderID'] . "</td>";
     	echo "<td>" . $row['Phone'] . "</td>";
        echo "<td>" . $row['Date'] . "</td>";
        echo "<td>" . $row['PartySize'] . "</td>";
        echo "<td>" . $row['Time'] . "</td>";
        echo "<td>";
                $result3 = mysqli_query($con, "SELECT * FROM tbordermeals");
                $hasMeals = false;

                while ($ress = mysqli_fetch_array($result3)) {
                    if ($ress['OrderID'] == $row['OrderID']) {
                        // Query to retrieve the name from tbmenu based on the ID
                        $menuQuery = "SELECT Name FROM tbmenu WHERE ID = " . $ress['MealID'];
                        $menuResult = mysqli_query($con, $menuQuery);

                        if ($menuResult && mysqli_num_rows($menuResult) > 0) {
                            $menuRow = mysqli_fetch_assoc($menuResult);
                            $menuName = $menuRow['Name'];
                            echo "x$ress[qty] " . $menuName . "<br>";
                            $hasMeals = true;
                        }
                    }
                }
                if (!$hasMeals) {
                    echo "<font style='color:red'>Didn't order any meals!</font>";
                }
                echo "</td>";
                echo "<td>";
                if (!empty($row['Note'])) {
                  echo $row['Note'];
                } 
                else {
                  echo "<font style='color:red'>NO NOTES</font>";
                }
      echo "</td>";

		echo "<td style='width:30px'>";
		echo "<div class='btn-group'>";
		if ($rowDate > $today || ($rowDate == $today && $orderDateTime >= $currentDateTime))  {
      if (isCancelable($orderDateTime)) {
          echo "<a class='btn btn-dark' href='./OrderScripts/Edit.php?id=" .$row['OrderID'] ."'> Update </a>";
          echo "<a href='OrderScripts/cancel.php?id=" . $row['OrderID'] . "' class='btn btn-danger'>Cancel</a>";
      } else {
          echo "<a class='btn btn-dark' href='./OrderScripts/Edit.php?id=" .$row['OrderID'] ."'> Update </a>";
          echo "<button class='btn btn-danger' disabled>Cancel</button>";
      }
  } else {
    echo "<button class='btn btn-dark' style='cursor:normal' disabled>No Action!</button>";
    }
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