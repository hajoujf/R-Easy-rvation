<?php include 'dbCon.php';
if(!isset($_SESSION)){session_start();}

function isUser($name,$pass){
    /*Check if this account for user */
    $sql="SELECT * FROM tbuser WHERE Username='$name' AND Password='$pass'";
    $res=mysqli_query($GLOBALS['con'],$sql);
    if(mysqli_num_rows($res)!=0 )
     return true;
    return false;
}
function isOwner($name,$pass){
    /*Check if this account for owner */
    $sql="SELECT * FROM tbowner WHERE Username='$name' AND Password='$pass'";
    $res=mysqli_query($GLOBALS['con'],$sql);
    if(mysqli_num_rows($res)!=0)
        return true;
    return false;
}
function isAdmin($name,$pass){
    /*Check if this account for owner */
    $sql="SELECT * FROM tbadmin WHERE Username='$name' AND Password='$pass'";
    $res=mysqli_query($GLOBALS['con'],$sql);
    if(mysqli_num_rows($res)!=0)
        return true;
    return false;
}
if(isset($_POST['submit'])){
    $user = mysqli_real_escape_string($con, $_POST['uname']);
    $psw = mysqli_real_escape_string($con, $_POST['psw']);
    if(isUser($user,$psw)){
        $_SESSION['User']=$_POST['uname'];
        header('Location: homepage.php');
    }
    else if(isOwner($user,$psw)){
        $_SESSION['User']=$_POST['uname'];
        $sql = "SELECT * FROM tbowner WHERE username = '$_SESSION[User]'";
        $result = mysqli_query($GLOBALS['con'], $sql);
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $row['RestID'];
        header('Location: Owner/ownerside.php');
    }
    else if(isAdmin($user,$psw)){
        $_SESSION['User']=$_POST['uname'];
        header('Location: Admin/Adminside.php');
    }
    else{
        echo "<script>alert('Enter Valid info!!!');</script>";
        echo "<Script>
            window.location.href='logboth.php';
        </SCRIPT>";
    }
    // $_SESSION["User"]=$_POST['uname'];

}

?>