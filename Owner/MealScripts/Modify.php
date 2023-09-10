<?php
    require_once('../../dbCon.php');
    if(isset($_GET['id']) && isset($_POST['editForm'])){
        $id = $_GET['id'];
        $name = $_POST['pname'];
        $Desc = $_POST['Desc'];
        $Price = $_POST['Price'];
        $Cate = $_POST['Category'];

        $sql = "UPDATE `tbmenu` SET 
                `Name`= '$name',
                `Description`= '$Desc',
                `Price`= '$Price',
                `Category` = '$Cate'
                WHERE ID = $id";

        if($con->query($sql) === TRUE){
            header('Location: ../ownerside.php#Menu');
        }else{
            echo "something went wrong";
        }
    }else{
        echo "invalid";
    }
?>