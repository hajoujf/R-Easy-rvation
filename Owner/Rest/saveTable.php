<?php  include 'dbCon.php';

$myArr=$_GET['data'];
$width=$_GET['width'];
$height=$_GET['height'];



for($i=2;$i<strlen($myArr)-2;$i+=2){
 
    if(($myArr[$i])>='0' && ($myArr[$i])<='9' &&($myArr[$i+2])>='0' && ($myArr[$i+2])<='9' ){
    $y=$i+2;
     $sql="INSERT INTO tbtable (`RestID`, `CenterX`, `width`, `length`, `CenterY`)
     VALUES (1,$myArr[$i],$width,$height,$myArr[$y])";
     $result=mysqli_query($con,$sql);
     if($result){
       echo "added succefully";
      }
     else{
       echo "Error";
      }


    }
    echo "<SCRIPT> //not showing me this
    alert('More Tables')
    window.location.replace('AddTables.php?width=$width&height=$height');
</SCRIPT>";

}


?>