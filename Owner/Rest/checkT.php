<?php
if(isset($_POST['add'])){
    $tbw=$_POST['widthT'];
    $tbh=$_POST['heightT'];
    $tbch=$_POST['chairb'];
    $rtw=$_POST['widthR'];
    $rth=$_POST['heightR'];
    if($tbw<0 || $tbh<0 || $tbch<0){
        echo "<SCRIPT> 
        alert('Invalid Values')
        window.location.replace('AddTables.php');
    </SCRIPT>";
    }
    else{
        echo "<SCRIPT> 
       
        window.location.replace('CanvaDraw.php?tw=$tbw&th=$tbh&cht=$tbch&rtw=$rtw&rth=$rth');
    </SCRIPT>";
    }

}




?>