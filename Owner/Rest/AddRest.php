<?php include 'dbCon.php';
/*$data = file_get_contents('php://input');
$array = json_decode($data, true);
print_r($array);*/
$array = $_POST['myData'];
// do something with the array
$len=count($array);
$width=$array[$len-3];
$length=$array[$len-2];
$rest=$array[$len-1];
for ($i = 0; $i < $len-3; $i++) {
    $table=$array[$i];
    $sql="INSERT INTO tbtable VALUES($table[0],$table[1],$width,$length,1)";
    $result=mysqli_query($con,$sql);
    if($result){
        echo "yes";
    }
}
//window.location.replace('clientreg.php');
//change location to homepage
echo "<SCRIPT> 
        alert('All Added And done');
    </SCRIPT>";




?>