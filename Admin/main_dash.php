<link href='../CSS/MainD(Admin).css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Restaurants</div>
            <div class="number">
				<?php require_once('../dbCon.php');
    			$sql = "SELECT * FROM `tbrestaurant`";
    			$result = $con->query($sql);
				$rowcount = mysqli_num_rows( $result );	
				echo "$rowcount";
				?>
			</div>
            <div class="indicator">
              <span class="text">Amount of Restaurants</span>
            </div>
          </div>
          <i class='bx bx-check cart'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Reviews</div>
            <div class="number">
				<?php require_once('../dbCon.php');
    			$sql = "SELECT * FROM `tbreport`";
    			$result = $con->query($sql);
				$rowcount = mysqli_num_rows( $result );	
				echo "$rowcount";
				?></div>
            <div class="indicator">
              <span class="text">Amount of Reviews</span>
            </div>
          </div>
          <i class='bx bx-message cart two' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Unapporved Res.</div>
            <div class="number">
            <?php require_once('../dbCon.php');
    			  $sql = "SELECT * FROM `tbrestaurant` Where `Status` ='pinding'";
    			  $result = $con->query($sql);
				    $rowcount = mysqli_num_rows( $result );	
				    echo "$rowcount";
				?>
            </div>
            <div class="indicator">
              <span class="text">Restaurants in queue</span>
            </div>
          </div>
          <i class='bx bx-hourglass cart three' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Reports</div>
            <div class="number">
              <?php require_once('../dbCon.php');
              $sql = "SELECT * FROM tbreport";
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
        <div class="recent-sales box">
        <div class="title">Earnings by Month (You Take 20% of what the restaurants make)</div>
    <?php
    require_once('../dbCon.php');

    // Process year selection
    $selectedYear = isset($_GET['year']) ? $_GET['year'] : date('Y');

    $sql = "SELECT MONTH(Date) AS Month, SUM((qty * Price)*0.2) AS Earnings
    FROM tborder
    INNER JOIN tbordermeals ON tborder.OrderID = tbordermeals.OrderID
    INNER JOIN tbmenu ON tbordermeals.MealID = tbmenu.ID
    WHERE YEAR(Date) = $selectedYear
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
          <div class="title" style="padding-bottom:9px">Approved Restaurants</div>
          <ul class="top-sales-details">
          <?php
    			require_once('../dbCon.php');
    			$sql = "SELECT * FROM `tbrestaurant` Where `status`!='pending'";
          $result = $con->query($sql);
				  $cnt=0;
        		if($result->num_rows > 0 ){
            		while($cnt!=20 && $row = $result->fetch_assoc()){
                echo "<li><span class='product'>$row[RestName]</span><span class='price'>";
                showAverageRating($row["RestID"]);      
                echo "</span></li>";	
						    $cnt++;
            		}
        		}        
            function showAverageRating($restID){
              /*Functon that gets restaurant id and then displays the average rating with stars */
              $sum=0;
              $count=0;
              $sql = "SELECT * FROM tbratings WHERE RestID IN (SELECT RestID FROM tbowner)";
              $result=mysqli_query($GLOBALS['con'],$sql);
              while($row=mysqli_fetch_array($result)){
                  $count++;
                  $str=$row['Stars'];
                  $sum+=$str;
              }
              $avg=0;
              if($count!=0){
                  $avg=$sum/$count;
              }
              $real_avg=ceil($avg);
              $star=$real_avg;
              $st=0;
              while($star>0){
                echo "<i class='fa fa-star'></i>";
                $star--;
                $st++;
            }
          }
    			?>
          </ul>
        </div>
      </div>


