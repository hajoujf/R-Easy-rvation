<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<?php
    require_once('../dbCon.php');
    $sql = "SELECT * FROM `tbratings` WHERE RestID IN (SELECT RestID FROM tbowner WHERE Username = '$_SESSION[User]')";
    $result = $con->query($sql);
?>
<style>
    body{
        overflow-x: hidden;
    }
</style>
<div style="overflow-y:scroll;overflow-x:hidden; height:100%;padding-left:40px">
<?php 
echo "<div style='padding-top:20px; width:1300px;margin-bottom:50px;'>";
echo "<div class='row d-flex justify-content-center'>";
    echo "<div class='col-md-12 col-lg-10' >";
        echo "<div class='card text-dark' >";
            echo "<div class='card-body p-4'>";
                echo "<h4 class='mb-0' style='color:#081D45'>Recent comments</h4>";
                echo "<p class='fw-light mb-4 pb-2' >Latest Comments section by users</p>";
                if($result->num_rows > 0 ){
                    while($row = $result->fetch_assoc()){
                    echo "<div class='card p-3 mt-2'>";
                    echo "<div class='d-flex justify-content-between align-items-center'>";
                    echo "<div class='user d-flex flex-row align-items-center'>";
                    echo "<img src='../CSS/pfp.jpg' width='30' class='user-img rounded-circle mr-2'>";
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
 else{
     echo "<h1 style='color:red'>NO REVIEWS AVAILABLE</h1>";
 }
?>
</div>