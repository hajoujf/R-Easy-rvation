<html>
<link rel=stylesheet href="../CSS/ClientReg.css">
    <body>
        <form action=""  method='post' style="margin-top:30px">
            <div class="container">
            <h1>Register</h1>
            <p>Please fill in this form to create an account.</p>
              <input type="text" placeholder="Username" name="uname" id="uname" required >

             <!-- <input type="text" placeholder="Last Name" name="lname" id="lname" required>
                <br>-->
              <input type="text" placeholder="Email" name="email" id="email" required >
             
              <input type="text" placeholder="Phone Number" name="pnum" id="pnum" required >

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

if (isset($_POST['reg'])){
    $user=$_POST['uname'];
    $psw=$_POST['psw'];
    $email=$_POST['email'];
    $phone=$_POST['pnum'];
    header("Location: AddR.php?user=$user&psw=$psw&email=$email&phone=$phone");
   
}
    
    mysqli_close($con);
?>
</body>
</html>

<!-- <html>
<link rel=stylesheet href="CSS/OwnerReg.css">
    <body>
        <form action="" method="post">
            <div class="container">
            <div class="cntr">
                <h1>Register</h1>
                <p>Please fill in this form to create an account.</p>
            </div>
            <div class="column">
              <label><b>Username<br></b></label>
              <input type="text" placeholder="First Name" name="fname" id="fname">

              <label><b></b></label>
              <input type="text" placeholder="Last Name" name="lname" id="lname">
                <br>
              <label><b></b></label>
              <input type="text" placeholder="Email" name="email" id="email" >
             
              <label><b></b></label>
              <input type="text" placeholder="Phone Number" name="pnum" id="pnum">
              <br>
              <br>
              <label><b>Password <br></b></label>
              <input type="password" placeholder="Password" name="psw" id="psw">
              <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" >
              <br>
              </div>
              <div class="column">
              <label><b>Restaurant</b></label>
              <br>
              <input type="text" placeholder="Restaurant's Name" name="nrest" id="nrest">
              <input type="text" placeholder="Restaurant's Address" name="addrest" id="addrest">
              <br>
              <input type="text" placeholder="Restaurant's Phone" name="phoneres" id="phoneres">
              <input type="text" placeholder="Restaurant's City" name="City" id="City">
              <br>
              <input type="text" placeholder="Restaurant's Cuisine" name="Cuisine" id="Cuisine">
              <br><br>
              <label><b>Working Hours</b></label>
              <input style="margin-left:30px" type="Time" placeholder="Opening Time" name="OpenTime" id="OpenTime">
              <label><b></b></label>
              <input type="Time" placeholder="Closing Time" name="CloseTime" id="CloseTime">
              </div>
             <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
             <div class="buttons"> 
             <button type="submit" class="registerbtn">Register</button>
             <button type="reset" class="resetbtn">Reset</button>
             </div>
            </div>

            <div class="container signin">
              <p>Already have an account? <a href="logboth.php">Sign in</a>.</p>
            </div>
          </form>

<?php  
// require_once('dbCon.php');

// if (isset($_POST['reg'])){
//     $user=$_POST['uname'];
//     $psw=$_POST['psw'];
//     $email=$_POST['email'];
//     $phone=$_POST['pnum'];

//     $RName=$_POST['nrest'];
//     $OpenTime=$_POST['OpenTime'];
//     $CloseTime=$_POST['CloseTime'];
//     $phone=$_POST['phoneres'];
//     $Cuisine=$_POST['Cuisine'];
//     $City=$_POST['City'];
//     $addrest=$_POST['addrest'];
//     header('Location: logboth.php');
// }
//     mysqli_close($con);
?>



    </body>
</html> -->