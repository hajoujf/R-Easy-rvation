<?php
require_once('../dbCon.php');
include "navbar.php";
$user = $_SESSION['User'];

function isUser($name){
    /*Check if this account for user */
    $sql="SELECT * FROM tbuser WHERE Username='$name'";
    $res=mysqli_query($GLOBALS['con'],$sql);
    if(mysqli_num_rows($res)!=0 )
     return true;
    return false;
}
function isOwner($name){
    /*Check if this account for owner */
    $sql="SELECT * FROM tbowner WHERE Username='$name'";
    $res=mysqli_query($GLOBALS['con'],$sql);
    if(mysqli_num_rows($res)!=0)
        return true;
    return false;
}
function isAdmin($name){
    /*Check if this account for owner */
    $sql="SELECT * FROM tbadmin WHERE Username='$name'";
    $res=mysqli_query($GLOBALS['con'],$sql);
    if(mysqli_num_rows($res)!=0)
        return true;
    return false;
}
if(isUser($user)){
    $sql = "SELECT * FROM tbuser where Username='$user'";
    $result = $con->query($sql);
    $data = $result->fetch_assoc();
    
}
if(isAdmin($user)){
    $sql = "SELECT * FROM tbadmin where Username='$user'";
    $result = $con->query($sql);
    $data = $result->fetch_assoc();
}
if(isOwner($user)){
    $sql = "SELECT * FROM tbowner where Username='$user'";
    $result = $con->query($sql);
    $data = $result->fetch_assoc();
    
}
?>
<html>
 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<body>
<div class="jumbotron">
    <h1 class="text-center">
        Your Details
    </h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 col-sm-12">
            <form action="ModifyDetails.php" method="POST">
                <h3>Edit</h3>
                <div class="form-group">
                    <label for="name">UserName</label>
                    <input type="text" class="form-control" name="Name" value="<?= $data['Username'] ?>">
                </div>
                <div class="form-group">
                    <label for="price">Email</label>
                    <input type="text" class="form-control" name="Email" value="<?= $data['Email'] ?>">
                </div>
                <div class="form-group">
                    <label for="price">Phone</label>
                    <input type="text" class="form-control" name="Phone" value="<?= $data['PhoneNumber'] ?>">
                </div>
                <input type="submit" name="editDetails" value="submit" class="btn btn-dark btn-block">
            </form>
        </div>
    </div>
</div>
</body>
</html>