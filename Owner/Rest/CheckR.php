<?php 

if(isset($_POST['start'])){
    $w=$_POST['width'];
    $h=$_POST['height'];
    if($w<0 || $h<0){
        echo "<SCRIPT> 
        alert('Invalid Values')
        window.location.replace('BuildR.html');
    </SCRIPT>";
    }
    else{
        echo "<SCRIPT> 
        alert('Let`s Start!!')
        window.location.replace('AddTables.php');
    </SCRIPT>";
    }

}






?>