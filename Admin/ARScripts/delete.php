<?php
    require_once('../../dbCon.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM `tbrestaurant` WHERE RestID = $id";
        $sql2 = "DELETE FROM `tborder` WHERE RestID = $id";
        $sql3 = "DELETE FROM `tbordermeals` WHERE RestID = $id";
        $sql4 = "DELETE FROM `tborderqueue` WHERE RestID = $id";
        $sql5 = "DELETE FROM `tbreport` WHERE RestID = $id";
        $sql6 = "DELETE FROM `tbowner` WHERE RestID = $id";
        
        if($con->query($sql) === TRUE && $con->query($sql2) === TRUE && $con->query($sql3) === TRUE && $con->query($sql4) === TRUE && $con->query($sql5) === TRUE && $con->query($sql6) === TRUE){
            header('location:../AdminSide.php#AR');
        }else{
            echo "something went wrong";
        }
        
    }else{
        // redirect to show with error
        die('id not provided');
    }

?>
