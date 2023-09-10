<html>
<link rel=stylesheet href="../CSS/ClientReg.css">
    <body>
        <form action=""  method='post' style="margin-top:30px">
            <div class="container">
            <h1>Register</h1>
            <p>Please fill in this form to create an account.</p>
              <input type="text" placeholder="Username" name="uname" id="uname" required>

             <!-- <input type="text" placeholder="Last Name" name="lname" id="lname" required>
                <br>-->
              <input type="text" placeholder="Email" name="email" id="email" required>
             
              <input type="text" placeholder="Phone Number" name="pnum" id="pnum" required>

              <br>
              
              <input type="password" placeholder="Password" name="psw" id="psw" required>
                
              <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
             <!-- <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>-->
             <div class="buttons"> 
             <button type="submit" class="registerbtn" name='reg'>Register</button>
             <button type="reset" class="resetbtn">Reset</button>
             </div>
            </div>
          
            <div class="container signin">
              <p>Already have an account? <a href="#">Sign in</a>.<a style="margin-left:153px" href="../homepage.php">Go Home</a></p>
            </div>
          </form>

<?php  
require_once('../dbCon.php');
function notFoundOwner($name)
{
    /*checks if username of owner already exists in database */
    $sql = "SELECT * FROM tbuser WHERE Username = '$name'";
    $res = mysqli_query($GLOBALS['con'], $sql);
    if (mysqli_num_rows($res) == 0)
        return true;
    return false;
}
if (isset($_POST['reg'])){
    $user=$_POST['uname'];
    $psw=$_POST['psw'];
    $email=$_POST['email'];
    $phone=$_POST['pnum'];
    $rpsw=$_POST['psw-repeat'];
    if (notFoundOwner($user) && ($psw == $rpsw)){
      $result = mysqli_query($con,"INSERT INTO  tbuser (Username,Password,Email,PhoneNumber,RepeatPassword)
      VALUES ('$user', '$psw','$email','$phone','$rpsw')");
  
      if($result){
          header('Location: ../logboth.php');
      }
     
    }
    
}
    
    mysqli_close($con);
?>
</body>
</html>