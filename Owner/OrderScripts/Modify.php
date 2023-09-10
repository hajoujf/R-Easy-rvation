<?php
    require_once('../../dbCon.php');
    if(isset($_GET['id']) && isset($_POST['editForm'])){
        $id = $_GET['id'];
        $name = $_POST['pname'];
        $Date = $_POST['Date'];
        $PS = $_POST['PartySize'];
        $time = $_POST['Time'];

        $sql = "UPDATE `tborder` SET 
                `Name`= '$name',
                `Date`= '$Date',
                `PartySize`= '$PS',
                `Time` = '$time',
                WHERE OrderID = $id";

        if($con->query($sql) === TRUE){
            header('Location: ../ownerside.php#Orders');
        }else{
            echo "something went wrong";
        }
    }else{
        echo "invalid";
    }
?>