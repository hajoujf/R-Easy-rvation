<?php include 'dbCon.php';
$prop=[];
session_start();
$sql = "SELECT * FROM tbrestaurant WHERE RestID = '$_SESSION[id]'";
$result = $con->query($sql);
$width=0;
$length=0;
$row=mysqli_fetch_assoc($result);
if($row){
    $width=$row['width'];
    $height=$row['height'];  
}
array_push($prop,$width);
array_push($prop,$height);
echo json_encode($prop);
?>