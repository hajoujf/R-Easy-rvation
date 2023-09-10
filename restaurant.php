<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<style>
.rate {
    float: left;
    height: 46px;
    margin-top:-5px;
}
.rate:not(:checked) > input {
    display: none;
}
.rate:not(:checked) > label {
    float:right;
    width:23px;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    /*#ccc*/
    color:#CC7722;
}
.rate:not(:checked) > label:before {
    content: '★ ';
    font-size:25px;
}
.rate > input:checked ~ label {
    color: #7e003b;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #7e003b;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #7e003b;
}

</style>
<?php include 'navbar.php';
if(!isset($_GET['id'])){
    die('id not provided');
}
require_once('./dbCon.php');
$id =  $_GET['id'];
$sql = "SELECT * FROM `tbrestaurant` where RestID = $id";
$result = $con->query($sql);
if($result->num_rows != 1){
    // redirect to show page
    die('id is not in db');
}
$data = $result->fetch_assoc();
$address = $data['Address'].' '.$data['City'];
echo "<script>var address = '$address';</script>";
?>
<style>
  .button{
    color:white;
  }
  .button:hover{
    background-color:rgba(0, 0, 0, 0.5);
    color:black;
  }
</style>
<body style="overflow-x:hidden;overflow-y:scroll;"><br>

<div style="width:100%;display:flex;justify-content:center;">
<section id="content" class="container" >
    <!-- Begin .page-heading -->
    <?php
    echo "<div class='page-heading' style='background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url($data[imgURL]);width:1160px;height:300px;background-size:cover; display: flex;align-items: center;justify-content:center;'>";
    ?>
        <div class="media clearfix">
          <center>
            <div class="media-body va-m" style="color:white">
            <h2 class="media-heading"><?php echo $data['RestName'];?>
              <small> - <?php echo $data['Cuisine'];?> </small>
            </h2>
            <small style="margin-top:-40px"><?php echo "$data[Address],";?> <?php echo $data['City'];?> </small>
            <small><br> <span class="panel-title">Restaurant Popularity - </span><?php
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
              showAverageRating($id);
              ?>
                </small><br>
                <small><?php echo "<a class='text-danger' href='report.php?id=$id&rname=$data[RestName]'><i class='fa fa-flag b four' ></i> </a>- Press to report</small>";?><br>
            <?php 
            if(isset($_SESSION['User'])){
				if($_SESSION['User']==null){
                    echo "<a class='btn button' style='color:white;border:1px solid white;width:500px;margin-top:10px' onclick='myFunction()'>Book Table</a>";
                 }
                else
                    echo "<a class='btn button' style='color:white;border:1px solid white;width:500px;margin-top:10px' href='UserBook/navbarPick.php?id=$id'>Book Table</a>";
            }
                else
                    echo "<a class='btn button' style='color:white;border:1px solid white;width:500px;margin-top:10px' onclick='myFunction()'>Book Table</a>"; 
                ?>
                <script>
                    function myFunction() {
                        alert("Login to Book a table!");
                    }
                </script>

        </div>
          </center>
        </div>
    </div>
    <div class="row " id="Details">
        <div class="col-md-4" style="padding-top:20px">
          <div class="panel">
            <div class="panel-heading">
              <span class="panel-icon">
              </span>
            </div>
            <div class="panel-body pn">
            <!-- <div id="googleMap" style="width:100%;height:400px;"></div> -->
            <div id="map-container" style="width:100%;height:400px;"></div>
            <!-- <script>
            function myMap() {
              var mapProp= {center:new google.maps.LatLng(51.508742,-0.120850),zoom:5,};
              var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
              }
            </script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzDDsptowMgDCnrOm1zbiZV4TgLbzKakA&callback=myMap"></script> -->

            <script>
function myMap() {
  var geocoder = new google.maps.Geocoder();
  var mapProp = {
    zoom: 13,
  };
  var map = new google.maps.Map(document.getElementById("map-container"), mapProp);

  // Geocode the address and create a marker
  geocoder.geocode({ address: address }, function (results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      var location = results[0].geometry.location;
      map.setCenter(location);
      var marker = new google.maps.Marker({
        map: map,
        position: location,
        title: address, 
      });
    } else {
      console.log("Geocode was not successful for the following reason: " + status);
    }
  });
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzDDsptowMgDCnrOm1zbiZV4TgLbzKakA&callback=myMap"></script>
            </div>
          </div>
        </div>
        
        <div class="col-md-8">
            <div class="tab-block">   
                <!-- <div class="w3-bar w3-black">
                    <button class="button" onclick="openTab('About')">About</button>
                    <button class="button" onclick="openTab('BookTable')">Book A Table</button>
                    <button class="button" onclick="openTab('Reviews')">Reviews</button>
                </div>
                <div id="About" class="Details">
                    <h2>London</h2>
                    <p>London is the capital city of England.</p>
                </div>  
                <div id="BookTable" class="Details" style="display:none">
                    <h2>Paris</h2>
                    <p>Paris is the capital of France.</p> 
                </div>
                -->
                <div id="Reviews" style="margin-left:-93px"> 
                <?php
                    $sql = "SELECT * FROM `tbratings` where RestID = $id";
                    $result = $con->query($sql);
                    if(isset($_SESSION['User'])){
                        echo "<div style='width:955px;padding-top:20px;'>";
                            echo "<div class='row d-flex justify-content-center'>";
                                echo "<div class='col-md-12 col-lg-10' >";
                                    echo "<div class='card text-dark'>";
                                        echo "<div class='card-body p-4'>";
                                            echo "<h4 class='mb-0' style='color:#7e003b'>Rate This Restaurant!</h4><br>";
                                            echo "<div class='d-flex flex-start' style='margin-bottom:10px;margin-top:15px; ' >";
                                            echo "<img class='rounded-circle shadow-1-strong me-3' style='margin-top:-5px;'  src='./CSS/pfp.jpg' alt='avatar' width='60' height='60' />";
                                            echo "<div style='margin-left:15px;'>";
                                                echo "<form action='' method='POST'>";
                                                echo "<h6 class='fw-bold mb-1 font-weight-bold' style='color:black;padding-top:3px' name='uname' id='uname'>". $_SESSION['User'] ."</h6>";
                                                ?>
                                                <div class="rate">  
                                                <input type="radio" id="star5" name="rate" value="5" />
                                                <label for="star5" ></label>
                                                <input type="radio" id="star4" name="rate" value="4" />
                                                <label for="star4"></label>
                                                <input type="radio" id="star3" name="rate" value="3" />
                                                <label for="star3"></label>
                                                <input type="radio" id="star2" name="rate" value="2" />
                                                <label for="star2"></label>
                                                <input type="radio" id="star1" name="rate" value="1" />
                                                <label for="star1"></label></div><?php
                                                echo "</p><textarea class='form-control' id='comment' name='comment' rows='4' placeholder='Comment' style='background: #fff;margin-top:10px;margin-bottom:10px;width:650px'></textarea>";
                                                echo "<input type='submit' name='submit' value='submit' class='btn btn-dark' style='float:right'>";
                                                echo "</form>";
                                            echo "</div>";
                                        echo "</div>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";    
                    echo "</div>";    
                }
                echo "<div style='padding-top:20px; width:955px;margin-bottom:50px;'>";
                    echo "<div class='row d-flex justify-content-center'>";
                        echo "<div class='col-md-12 col-lg-10' >";
                            echo "<div class='card text-dark' >";
                                echo "<div class='card-body p-4'>";
                                    echo "<h4 class='mb-0' style='color:#7e003b'>Recent comments</h4>";
                                    echo "<p class='fw-light mb-4 pb-2' >Latest Comments section by users</p>";
                                    if($result->num_rows > 0 ){
                                        while($row = $result->fetch_assoc()){
                                        echo "<div class='card p-3 mt-2'>";
                                        echo "<div class='d-flex justify-content-between align-items-center'>";
                                        echo "<div class='user d-flex flex-row align-items-center'>";
                                        echo "<img src='./CSS/pfp.jpg' width='30' class='user-img rounded-circle mr-2'>";
                                        echo "<span><small class='font-weight-bold text-primary'>Anonymous</small> <small class='font-weight-bold'>".$row['Comment']." </small></span>";
                                        echo "</div>";
                                        echo "</div>";
                                        echo "<div class='action d-flex justify-content-between mt-2 align-items-center'>";
                                        echo "<div class='reply px-4'>";
                                        echo "<span class='dots'></span>";
                                        echo "<small style='padding-left:10px'>Rating: ";
                                        $rate=$row['Stars'];
                                        while($rate>0){
                                            echo "<i class='fa fa-star'></i>";
                                            $rate--;
                                        }
                                        echo "</small></div>";
                                        echo "<div class='icons align-items-center'>";
                                        echo "<i class='fa fa-check-circle-o check-icon text-primary'></i></div></div></div>";

                                        //     echo "<div class='d-flex flex-start' style='margin-bottom:10px;margin-top:15px; ' >";
                                        //     echo "<img class='rounded-circle shadow-1-strong me-3' style='margin-top:-5px;'  src='./CSS/pfp.jpg' alt='avatar' width='60' height='60' />";
                                        //     echo "<div style='margin-left:15px;'>";
                                        //         echo "<h6 class='fw-bold mb-1' style='padding-top:3px'> Anonymous </h6>";
                                        //         echo "<div class='d-flex align-items-center mb-3'>";
                                        //             echo "<p style='font-size:20px'>". $row['Comment'] .". </p>";
                                        //         echo "</div>";
                                        //     echo "</div>";
                                        // echo "</div>";
                                        // echo "<hr class='my-0'/>";         
                                        }
                                    
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";    
                    echo "</div>";
                    }
                else{echo "<h1 style='color:red'>NO REVIEWS AVAILABLE</h1>";}
                if(isset($_POST['submit'])){
                    $stars=$_POST['rate'];
                    $desc=$_POST['comment'];
                //RestID Comment Stars RateID
                //INSERT INTO `tbratings`(`RestID`, `Comment`, `Stars`, `RateID`) 
                    
                   
                    $sql="INSERT INTO tbratings (`RestID`, `Comment`, `Stars`)  VALUES($id,'$desc',$stars)";
                    $result=mysqli_query($con,$sql);
                    if($result){
                        echo "<SCRIPT> 
                        window.location.replace('restaurant.php?id=$id');
                    </SCRIPT>";
                    }
                    else{
                        echo "<SCRIPT> 
                        alert('Error Adding Review');
                        </SCRIPT>";                
                    }}?>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</section>
</div>
</body>