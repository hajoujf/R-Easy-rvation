<link rel="stylesheet" href="../CSS/AddR.css">
<script src="https://kit.fontawesome.com/1537167eaa.js" crossorigin="anonymous"></script>
<body>
    <div class="card" style="height:670px;margin-top: 15px">
        <p>
        <div
            style="background-image: url(../images/r.jpg);background-size:contain;background-repeat: no-repeat; border-radius:3px;margin-left:20px;padding-left:5px;z-index:-1;float:left;width:430px;margin-top: 20px; height: 93.5%">
        </div>
        
        <div class="row" style="padding-left: 10px;">
            <form action="" method='post' enctype="multipart/form-data">
            <label for="Image">  Restaurants Image</label>
            <input type="file" name="img" id="img" required>
            <br><br>
                <label for="RestName"> <i class='fas fa-city'></i> Restaurants Name</label>
                <input type="text" id="RestName" name="RestName" placeholder="Kennington Lane Cafe" required>
                <label for="RestName"> <i class='fas fa-city'></i> Cuisine</label>
                <input type="text" id="Cuisine" name="Cuisine" placeholder="Italian/Chinese" required>
                <center><label for="Hours"><i class='far fa-calendar'></i> Working hours</label></center>
                <center><input type="time"
                        style="width:100px;padding-left 5px;background-color:transparent;border:0px;border-bottom:1px solid black;"
                        name='open' required>
                    <input type="time"
                        style="width:100px; padding-left:5px;background-color:transparent;border:0px;border-bottom:1px solid black;"
                        name='close' required>
                </center><br>
                <label for="adr"> <i class='fas fa-road'></i> Address</label>
                <input type="text" id="address" name="address" placeholder="542 W. 15th Street" required><br>
                <label for="city"><i class='far fa-map'></i> City</label>
                <input type="text" id="city" name="city" placeholder="New York" require><br>
                <center><label for="width&height"> <i class="fa-light fa-arrow-up-small-big"></i> Width & height (in meters)</label>
                <input type="text"
                        style="margin-bottom:3px;width:100px;padding-left 5px;background-color:transparent;border:0px;border:1px solid black;"
                        name='width' placeholder="3" required>
                    <input type="text"
                        style="margin-bottom:3px;width:100px; padding-left:5px;background-color:transparent;border:0px;border:1px solid black;"
                        name='height' placeholder="5" required></center>
                <input type="submit" value="Add Resturaunt" class="btn" name='submit' id='submit'>
            </form>
        </div>
        </p>
    </div>

    <body>

    <?php 
    function notFoundOwner($name)
    {
        /*checks if username of owner already exists in database */
        $sql = "SELECT * FROM tbowner WHERE Username = '$name'";
        $res = mysqli_query($GLOBALS['con'], $sql);
        if (mysqli_num_rows($res) == 0)
            return true;
        return false;
    }
include '../dbCon.php';
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['RestName']);
    $open = mysqli_real_escape_string($con, $_POST['open']);
    $close = mysqli_real_escape_string($con, $_POST['close']);
    $adr = mysqli_real_escape_string($con, $_POST['address']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $Cuisine = mysqli_real_escape_string($con, $_POST['Cuisine']);
    $width = mysqli_real_escape_string($con, $_POST['width']);
    $height = mysqli_real_escape_string($con, $_POST['height']);
    $user=$_GET['user'];
    $psw=$_GET['psw'];
    $pswrp=$_GET['psw'];
    $email=$_GET['email'];
    $phone=$_GET['phone'];


    // Upload image to server
    $file = $_FILES['img'];
    $filename = $file['name'];
    $tmpname = $file['tmp_name'];
    $filetype = $file['type'];
    $filesize = $file['size'];
    $target_dir = "../uploads/"; // Change this to the folder where you want to store the images
    $target_dir_forDB = "uploads/";
    $target_file = $target_dir . basename($filename);
    $target_file_forDB = $target_dir_forDB . basename($filename);
    move_uploaded_file($tmpname, $target_file);
    
    // Insert data into database
    if (notFoundOwner($user) && ($psw == $pswrp)) {
    $sql="INSERT INTO tbrestaurant (RestName, OpenTime, CloseTime, Cuisine, Address, City, imgURL, Status, Owner,width,height)
          VALUES ('$name', TIME('$open'), TIME('$close'), '$Cuisine', '$adr', '$city', '$target_file_forDB', 'pending', '$user','$width','$height')";
    $res = mysqli_query($con, $sql);

    $sqlR = "SELECT * FROM tbrestaurant WHERE RestName='$name'";
    $resultR = $con->query($sqlR);
    $data = $resultR->fetch_assoc();
    
    $sql2="INSERT INTO  tbowner (Username,Password,Email,PhoneNumber,RepeatPassword,RestID) VALUES ('$user', '$psw','$email','$phone','$psw','$data[RestID]')";
    $res2 = mysqli_query($con, $sql2);
    
    if ($res && $res2) {
       echo "<SCRIPT> 
                alert('Restaurant created successfully Wait for Confirmation');
                window.location.replace('../logboth.php');
              </SCRIPT>";
    
    } else {
        echo "<SCRIPT> 
                alert('Error creating restaurant');
                window.location.replace('AddR.php');
              </SCRIPT>";
        }
    }
}

mysqli_close($con);
?>
