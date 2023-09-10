<?php
    require_once('../../dbCon.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM `tbrestaurant` WHERE RestID = $id";

        if($con->query($sql) === TRUE){
            header('location:../AdminSide.php#UR');
        }else{
            echo "something went wrong";
        }
        
    }else{
        // redirect to show with error
        die('id not provided');
    }

?>
