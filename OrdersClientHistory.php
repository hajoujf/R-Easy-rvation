<?php
include 'navbar.php';
require_once('dbCon.php');

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
<center><h1 style="padding-top:40px">Here are all Your past orders!</h1></center>
<div style="display:flex;justify-content:center;width:100%;padding-top:35px">
    <table class="table table-striped table-bordered" style="width:79%">
        <tr>
            <th>Order Number</th>
            <th>Phone #</th>
            <th>Date</th>
            <th>Time</th>
            <th>PartySize</th>
            <th>Restaurant Name</th>
            <th>Meals</th>
            <th>Notes</th>
            <th>Action</th>
        </tr>
        <?php
        $user = $_SESSION['User'];
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($result)) {
                // Compare the order date with the current date and set the appropriate class for coloring
                $rowDate = $row['Date'];
                $orderDateTime = new DateTime($rowDate . ' ' . $row['Time']);
                $dateColorClass = ($rowDate > $today || ($rowDate == $today && $orderDateTime >= $currentDateTime)) ? 'table-success' : 'table-gray';
                echo "<tr class='table-hover " . $dateColorClass . "'>";
                echo "<td>" . $row['OrderID'] . "</td>";
                echo "<td>" . $row['Phone'] . "</td>";
                echo "<td>" . $row['Date'] . "</td>";
                echo "<td>" . $row['Time'] . "</td>";
                echo "<td>" . $row['PartySize'] . "</td>";

                $result2 = mysqli_query($con, "SELECT * FROM tbrestaurant");
                while ($res = mysqli_fetch_array($result2)) {
                    if ($res['RestID'] == $row['RestID']) {
                        echo "<td>" . $res['RestName'] . "</td>";
                        break;
                    }
                }
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
                echo "<td>";
                if ($rowDate > $today || ($rowDate == $today && $orderDateTime >= $currentDateTime))  {
                    if (isCancelable($orderDateTime)) {
                        echo "<a href='OrderScripts/CancelOrder.php?id=" . $row['OrderID'] . "' class='btn btn-danger btn-sm'>Cancel</a>";
                    } else {
                        echo "<button class='btn btn-danger btn-sm' disabled>Cancel</button>";
                    }
                } else {
                    echo "<button class='btn btn-dark' style='cursor:default' disabled>No Action</button>";
                }
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8' style='text-align:center'>No past orders found.</td></tr>";
        }
        mysqli_close($con);
        ?>
    </table>
</div>
