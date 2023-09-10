<?php 
require_once('dbCon.php');
$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$subject = $_POST['subject'];

$sql = "INSERT INTO tbcontacts VALUES('$firstName','$lastName','$subject')";
if($result = mysqli_query($con, $sql)){
    echo "<script>alert('Sent Successfully');</script>";
    echo "<Script>window.location.href='contact.php';</SCRIPT>";
}


mysqli_close($con);
?>