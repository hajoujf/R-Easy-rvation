<link href='../CSS/MainD.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
  .top-sales.box {
    position: relative;
}

.average-rating {
    font-size: 14px;
    color: #888;
    position: absolute;
    bottom: 10px;
    right: 10px;
}
</style>
<div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Orders</div>
            <div class="number">
				<?php require_once('../dbCon.php');
        $sql = "SELECT * FROM tborder WHERE RestID IN (SELECT RestID FROM tbowner WHERE Username = '$_SESSION[User]')";
        $result = $con->query($sql);
				$rowcount = mysqli_num_rows( $result );	
				echo "$rowcount";
				?>
			</div>
            <div class="indicator">
              <span class="text">Amount of Orders</span>
            </div>
          </div>
          <i class='bx bx-cart-alt b'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Reviews</div>
            <div class="number">
				<?php require_once('../dbCon.php');
          $sql = "SELECT * FROM tbratings WHERE RestID IN (SELECT RestID FROM tbowner WHERE Username = '$_SESSION[User]')";
     			$result = $con->query($sql);
				$rowcount = mysqli_num_rows( $result );	
				echo "$rowcount";
				?></div>
            <div class="indicator">
              <span class="text">Amount of Reviews</span>
            </div>
          </div>
          <i class='fa fa-star b two' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Tables</div>
            <div class="number">
              <?php require_once('../dbCon.php');
              $sql = "SELECT * FROM tbtable WHERE RestID IN (SELECT RestID FROM tbowner WHERE Username = '$_SESSION[User]')";
     			    $result = $con->query($sql);
				      $rowcount = mysqli_num_rows($result );	
				      echo "$rowcount";
              ?>
              </div>
            <div class="indicator">
              <span class="text">tables in Your Restaurant</span>
            </div>
          </div>
          <i class='fa fa-cutlery b three' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Reports</div>
            <div class="number">
              <?php require_once('../dbCon.php');
              $sql = "SELECT * FROM tbreport WHERE RestID IN (SELECT RestID FROM tbowner WHERE Username = '$_SESSION[User]')";
     			    $result = $con->query($sql);
				      $rowcount = mysqli_num_rows( $result );	
				      echo "$rowcount";?>
              </div>
            <div class="indicator">
              <span class="text">Amount of Reports</span>
            </div>
          </div>
          <i class='fa fa-flag b four' ></i>
        </div>
      </div>

      <div class="sales-boxes">
      <div class="recent-sales box" style="max-height:400px">
    <div class="title">Earnings by Month</div>
    <?php
    require_once('../dbCon.php');

    // Process year selection
    $selectedYear = isset($_GET['year']) ? $_GET['year'] : date('Y');

    $sql = "SELECT MONTH(Date) AS Month, SUM(qty * Price) AS Earnings
    FROM tborder
    INNER JOIN tbordermeals ON tborder.OrderID = tbordermeals.OrderID
    INNER JOIN tbmenu ON tbordermeals.MealID = tbmenu.ID
    WHERE tborder.RestID IN (SELECT RestID FROM tbowner WHERE Username = '$_SESSION[User]')
    AND YEAR(Date) = $selectedYear
    GROUP BY MONTH(Date)
    ORDER BY MONTH(Date)";
    $result = $con->query($sql);

    $earnings = array_fill(1, 12, 0); // Initialize earnings array for all months with zero
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $month = $row['Month'];
            $earnings[$month] = $row['Earnings'];
        }
    }

    $months = array(
        1 => "January",
        2 => "February",
        3 => "March",
        4 => "April",
        5 => "May",
        6 => "June",
        7 => "July",
        8 => "August",
        9 => "September",
        10 => "October",
        11 => "November",
        12 => "December"
    );
    ?>
    <form method="get">
        <label for="year">Select Year:</label>
        <select name="year" id="year" onchange="this.form.submit()">
            <?php
            $currentYear = date('Y');
            for ($i = $currentYear; $i >= $currentYear - 5; $i--) {
                echo "<option value='$i' " . ($selectedYear == $i ? 'selected' : '') . ">$i</option>";
            }
            ?>
        </select>
    </form>
    <canvas id="earningsChart" style="max-height:310px" ></canvas>
    <script>
    var months = <?php echo json_encode(array_values($months)); ?>;
    var earnings = <?php echo json_encode(array_values($earnings)); ?>;
    var ctx = document.getElementById('earningsChart').getContext('2d');
    var earningsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Earnings',
                data: earnings,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
    </div>
        <div class="top-sales box">
          <div class="title">Your Restaurant's Ratings</div>
          <ul class="top-sales-details">
          <?php
    			require_once('../dbCon.php');
          $sql = "SELECT * FROM tbratings WHERE RestID IN (SELECT RestID FROM tbowner WHERE Username = '$_SESSION[User]')";
          $result = $con->query($sql);
          $totalRating = 0;
				  $cnt=0;
        		if($result->num_rows > 0 ){
            		while($cnt!=20 && $row = $result->fetch_assoc()){
                echo "<li><span class='product'>Annonymous</span><span class='price'>";
                $rate = $row["Stars"];
                    while ($rate > 0) {
                        echo "<i class='fa fa-star'></i>";
                        $rate--;
                        $totalRating += $row["Stars"];
                        $cnt++;
                    }
                echo "</span></li>";	
						    $cnt++;
            		}
        		}     
            if ($cnt > 0) {
              $averageRating = $totalRating / $cnt;
              echo "<div class='average-rating'>Average Rating: " . number_format($averageRating, 1) . " <i class='fa fa-star'></i></div>";
          } else {
              echo "<div class='average-rating'>Average Rating: N/A</div>";
          }
            
    			?>
          </ul>
        </div>
      </div>


