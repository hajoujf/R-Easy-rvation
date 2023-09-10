<?php
    require_once('../../dbCon.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM `tborder` WHERE OrderID = $id";

        if($con->query($sql) === TRUE){
            header('Location: ../ownerside.php#Orders');
        }else{
            echo "something went wrong";
        }
        
    }else{
        // redirect to show with error
        die('id not provided');
    }

?>
