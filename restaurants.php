<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body style="overflow-y:scrolll;overflow-x:hidden">
    <style>
  .button1 {
	transition: 0.3s;
	background-color: #966F33; 
	color: white; 
	border: 0px solid transparent;
	cursor: pointer;
	width: 100%;
  }
  .button1:hover {
	background-color: #755627;
	color: white;
  }
  </style>

<?php
include 'navbar.php';
require_once('dbCon.php');
$sql = "SELECT * FROM `tbrestaurant` Where `Status`='Approved' ";
$result = mysqli_query($con, $sql);
echo "<center><div style='padding-top:7.5px;padding-bottom:10px'><i><h2 style='padding-bottom:3px;width:100%;background-color: rgb(237, 236, 236);'> Browse Restaurants </h1></i>
Here are All the available Restaurants on R'easy'rvations!</div><br>";
echo "<div class='row' style='display:flex;justify-content:center;margin-bottom:3px;min-width:1300px;padding-bottom:10px;' >";
$cnt=0;
while ($row = mysqli_fetch_array($result)){
  echo "<div class='card' style='margin:0px 10px;min-width:240px;height:270px'>";
  echo "<img class='card-img-top' src='$row[imgURL]' alt='Card image cap' style='height:140px'>";
  echo "<div class='card-body' style='margin-top:-6px;'>";
  echo "<h6>".$row['RestName']." - <small >".$row['Cuisine']."</small></h6>";
  echo "<p class='card-text'><small><span class='panel-title'>Restaurant Popularity - </span>";
  showAverageRating($row['RestID']);
  echo "<br>Address: <font style='font-size:11px'><b>$row[Address]</b>, $row[City]</font></p>";
  echo "</small></div>";
  echo"<a href='restaurant.php?id=$row[RestID]'><button style='height:35px' class='button1'>Visit Page</button></a>";
  echo "</div>";
  $cnt+=1;
  if($cnt==5){
    echo "</div>";
    echo "<div class='row' style='display:flex;justify-content:center;margin-bottom:3px;min-width:1300px;padding-bottom:10px;' >";
    $cnt=0;
  }
}
if($cnt!=5) echo "</div>";

// echo '<div class="card-deck col d-flex justify-content-center" >';
// while ($row = mysqli_fetch_array($result)) {
    // echo "<div class='card' style='max-width:300px'>";
    // echo "<img class='card-img-top' src='...' alt='Card image cap' style='height:170px'>";
    // echo "<div class='card-body'>";
    // echo "<h5 class='card-title'>".$row['RestName']."</h5>";
    // echo "<p class='card-text'>Work Hours: $row[OpenTime]-$row[CloseTime]<br>
    // Address: $row[Address]
    // </p>";
    // echo "</div>";
    // echo"<div class='card-footer'><a href='restaurant.php?id=$row[RestID]'><button class='button1'>Visit Page</button></a></div>";
    // echo "</div>";

//   }
 echo "</center> <br> <br>";


 function showAverageRating($restID){
  /*Functon that gets restaurant id and then displays the average rating with stars */
  $sum=0;
  $count=0;
  $sql="SELECT * FROM tbratings WHERE RestID=$restID";
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
</body>