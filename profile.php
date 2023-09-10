<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<?php
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


include "navbar.php";
require_once('./dbCon.php');
$user =  $_SESSION['User'];
if(isUser($user)){
    $sql = "SELECT * FROM tbuser WHERE Username = '$user'";
$result = $con->query($sql);
if($result->num_rows != 1){
    // redirect to show page
    die('id is not in db');
}
$data = $result->fetch_assoc();
}
else if(isOwner($user)){
    $sql = "SELECT * FROM tbowner WHERE Username = '$user'";
    $result = $con->query($sql);
    if($result->num_rows != 1){
        // redirect to show page
        die('id is not in db');
    }
    $data = $result->fetch_assoc();
    
}
else if(isAdmin($user)){
    $sql = "SELECT * FROM tbadmin WHERE Username = '$user'";
    $result = $con->query($sql);
    if($result->num_rows != 1){
        // redirect to show page
        die('id is not in db');
    }
    $data = $result->fetch_assoc();
    
}
?>
<style>
    img:hover{
        height:170px;
        width:170px;
        transition:0.5s;
    }
    img{
        transition:0.5s;
    }
</style>
<div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
    <div class="card p-4">
        <div class=" image d-flex flex-column justify-content-center align-items-center"> 
            <button class="btn" > <img src="./CSS/pfp.jpg" height="150" width="150" />
        </button> 
        <span class="name mt-3"><font class='font-weight-bold text-primary'>Username: </font><?php echo $data['Username']?></span> 
        <span class="idd"><font class='font-weight-bold text-primary'> Email: </font><?php echo $data['Email']?></span> 
        <div class="d-flex flex-row justify-content-center align-items-center gap-2">
            <span class="idd1"><font class='font-weight-bold text-primary'>Phone Number: </font><?php echo $data['PhoneNumber']?></span> <span></span> 
        </div>
        <div class=" d-flex mt-2"> 
            <a href="ProfileScripts/Editprofile.php"><button class="btn btn-dark">Edit Profile</button></a>
        </div> 
</div>
</div>