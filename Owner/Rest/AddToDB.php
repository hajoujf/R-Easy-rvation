<?php include 'dbCon.php';
$data = json_decode(file_get_contents("php://input"), true);
$array = $data;
session_start();
print_r($array);
/*$array = $_POST['data'];
//$array = json_decode($_POST['data']);*/
$len = count($array);
$width = $array[$len  -3];
$length = $array[$len - 2];
$rest = $array[$len-1];
$sql = "SELECT * FROM tbrestaurant WHERE RestID = '$_SESSION[id]'";
$result = $con->query($sql);
$row = mysqli_fetch_assoc($result);
$RestID = $row['RestID'];
//add function to check if not exists and the add it, if wxist dont add it(with same width and height)
for ($i = 0; $i < $len - 3; $i++) {
    $table = $array[$i];
    $x = $table[0];
    $y = $table[1];
    $sql = "INSERT INTO tbtable (CenterX,CenterY,width,length,RestID) VALUES($x,$y,$width,$length,'$RestID')";
    $result = mysqli_query($con, $sql);
}
//seperate them just finish
//header("Location: AddTables.php?width=".$width."&height=".$length);
//exit();
?>