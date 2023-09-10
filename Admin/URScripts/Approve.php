<?php
    require_once('../../dbCon.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "UPDATE `tbrestaurant` SET `Status`='Approved' WHERE RestID = $id";
        header('location:../AdminSide.php#UR');
        if($con->query($sql) === FALSE){
            echo "something went wrong";
        }
        
    }else{
        // redirect to show with error
        die('id not provided');
    }

?>
