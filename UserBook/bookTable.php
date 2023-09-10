
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
 <style>
    td{
      padding:3px 20px;
    }
    th{
      padding:3px 10px;
    }
    .box {
      display: none;
      width: 50px;
      border: 1px solid black;
    }
  </style>
  <script>
    function handleCheckbox(id, check) {
      var checkbox = document.getElementById(check);
      if (checkbox.checked) {
        var box = document.getElementById(id);
        box.style.display = "block";
      } else {
        var box = document.getElementById(id);
        box.style.display = "none";
      }
    }
  </script>
<body>
    <?php
    include "../dbCon.php";
    include "navbar.php";
    $user = $_SESSION['User'];
    $sql = "SELECT * FROM tbuser where Username='$user'";
    $result = $con->query($sql);
    $data = $result->fetch_assoc();
    ?>
    <center><h1 style="padding-top:30px">Order now to save time!</h1>
<small><b><i>Order Online so you avoid delays</i></b></small></center><br><br><br><br>
<div style="display:flex;justify-content:center;align-items:center;height:50%">
    <br /> <br />
    <form method='post' action=''>
    <table border='1'>
      <tr>
        <th>Appetizer</th>
      </tr>
      <?php
    $sql = "SELECT * FROM tbmenu WHERE Category='Appetizer' AND RestID='$_GET[id]'";
    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>
        <td>
          <input type='checkbox' value='$row[ID]' name='checkbox[]' id='$row[ID]' onchange='handleCheckbox(\"$row[ID]qty\", \"$row[ID]\")' />
          $row[Name]  
          <input type='number' value='1' min='1' name='quantity[$row[ID]]' id='$row[ID]qty' class='box'/>  
        </td>
        <td style='min-width:550px'>$row[Description]</td>
        <td>$row[Price]$</td>
      </tr>";
    }
    ?>

      <tr >
        <th>Main Course</th>
      </tr>

      <?php
      $sql = "SELECT * FROM tbmenu WHERE Category='MainCourse' AND RestID='$_GET[id]'";
      $result = mysqli_query($con, $sql);

      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
        <td>
          <input type='checkbox' value='$row[ID]' name='checkbox[]' id='$row[ID]' onchange='handleCheckbox(\"$row[ID]qty\", \"$row[ID]\")' />
          $row[Name]  
          <input type='number' value='1' min='1' name='quantity[$row[ID]]' id='$row[ID]qty' class='box'/>  
        </td>
        <td style='min-width:550px'>$row[Description]</td>
        <td>$row[Price]$</td>
      </tr>";
      }
      ?>

      <tr>
        <th>Desserts</th>
      </tr>

      <?php
      $sql = "SELECT * FROM tbmenu WHERE Category='Desserts' AND RestID='$_GET[id]'";
      $result = mysqli_query($con, $sql);

      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
        <td>
          <input type='checkbox' value='$row[ID]' name='checkbox[]' id='$row[ID]' onchange='handleCheckbox(\"$row[ID]qty\", \"$row[ID]\")' />
          $row[Name]  
          <input type='number' value='1' min='1' name='quantity[$row[ID]]' id='$row[ID]qty' class='box'/>  
        </td>
        <td style='min-width:550px'>$row[Description]</td>
        <td>$row[Price]$</td>
      </tr>";
  }
  ?>
</table><br>
<center>
        <div class="form-group">
            <label>Phone for order</label>
            <input type="text" class="form-control" id="phone" name='phone' placeholder="Phone" value="<?= $data['PhoneNumber'] ?>"><br>
            <label>Extra Notes<b>(Optional and only if you're choosing Meals now!)</b></label>
            <input type="text" class="form-control" id="notes" name='notes' placeholder="Notes">

            <div class="form-group">
</div>
        <div style="margin-bottom:10px"><br><center>press the <font style="color:green"><b>BookTable</b></font> button if you <font class="text-danger"><b>didn't</b></font> choose any meal, and the <font class="text-info"><b>Book</b></font> button if you chose a meal!</center></div>
        <button type="submit" class="btn btn-outline-success" id='book' name='book'>Book Table</button>&nbsp<button class="btn btn-info" name="add" id="add">Book<i class="fas fa-hamburger"></i></button>
        </form>
        
</div>
</body>

<?php
$randomNumber = null;
$randomNumber = abs(mt_rand()); // Generate a random number

// Check if the random number exists in the tborder table
$query = "SELECT OrderID FROM tborder WHERE OrderID = $randomNumber";
$resultR = mysqli_query($con, $query);

// If the random number exists, generate another random number
while (mysqli_num_rows($resultR) > 0) {
    $randomNumber = abs(mt_rand()); // Generate another random number
    $query = "SELECT OrderID FROM tborder WHERE OrderID = $randomNumber";
    $resultR = mysqli_query($con, $query);
}

function findEmail($user)
{
    /*function that returns the email of the user ==> maybe we can change it to session */
    $sql = "SELECT Email FROM tbuser WHERE Username='$user'";
    $result = mysqli_query($GLOBALS['con'], $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['Email'];
    }
}
function sendMail($hour, $date, $to_email)
{
    //Include also the name if the restaurant(save it in a session)
    $header = 'From: fromemail@gmail.com' . "\r\n" .
        'MIME-Version: 1.0' . "\r\n" .
        'Content-type: text/html; charset=utf-8';
    // $header = 'MIME-Version: 1.0' . "\r\n";
    // $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // $header .= "From:brazialaa@gmail.com";
    $subject = "Order Confirmation";
    $body = '<html><body>';
    $body .= '<h1>Order Details</h1>';
    $body .= '<h2>Date: ';
    $body .= "$date  Hour: $hour";
    $body .= '</h2>';
    $body .= '<h3> We are wating for you!!</h3><br/>';
    $body .= '<img src="https://www.liveabout.com/thmb/l9yK5fbahqhtJiI0xprxCIuhJ7U=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/reserved-sign-on-restaurant-table-534761709-d4ef78d8a57743429658561abb9f615e.jpg"
    width="300"/>';
    $body .= '</body></html>';
    mail($to_email, $subject, $body, $header);
}
function isFirst($hour, $date, $RestID, $tableID)
{
    /*function that checks there is another row with tha same date hour and rest
    if not it will insert it to the queue if yes it will reject the order */
    $sql = "SELECT * FROM tborderqueue WHERE Date='$date' AND Time='$hour:00:00' AND RestID='$RestID' AND tableID='$tableID'";
    $result = mysqli_query($GLOBALS['con'], $sql);
    if (mysqli_num_rows($result) == 0) {
        $sql = "INSERT INTO tborderqueue (`Date`, `Time`, `RestID`,`tableID`) VALUES('$date','$hour:00:00','$RestID','$tableID')";
        $result = mysqli_query($GLOBALS['con'], $sql);
        return true;
    }
    return false;
}
if (isset($_POST['book'])) {
    $hour = $_GET['hour'];
    $date = $_GET['date'];
    $partysize = $_GET['PartySize'];
    $phone = $_POST['phone'];
    $table = $_GET['table'];
    $id = $_GET['id'];
 
    //user should be session in addition to the restaurantID
    if (isFirst($hour, $date, $id, $table)) {
        $sql = "INSERT INTO `tborder`(`OrderID`,`Phone`, `Date`, `Time`, `RestID`, `PartySize`, `Username`, `TableID`)
        VALUES ('$randomNumber','$phone','$date','$hour:00:00','$id','$partysize','$_SESSION[User]','$table')";
        $result = mysqli_query($con, $sql);
        $email = findEmail("$_SESSION[User]");
        if ($result) {
            sendMail($hour, $date, $email);
            echo "<div class='alert alert-success' role='alert'>
            <strong>Table Booked!</strong> Details in your email $email.</div> ";
            echo "<script>
            setTimeout(function() {
              window.location.href = '../OrdersClientHistory.php';
            }, 2000);
            </script>";
          } else {
            echo "<div class='alert alert-danger' role='alert'>
            <strong>Oh snap!</strong> Change a few things up and try submitting again.
            </div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>
        <strong>Table Already Booked!</strong> Check Other Dates.
        </div> ";
        echo "<script>
              setTimeout(function() {
                window.location.href = '../restaurant.php?id=$id';
              }, 2000);
        </script>";
    }
}
if (isset($_POST['add'])) {
    $hour = $_GET['hour'];
    $date = $_GET['date'];
    $partysize = $_GET['PartySize'];
    $phone = $_POST['phone'];
    $table = $_GET['table'];
    $id = $_GET['id'];
    $extraNotes = mysqli_real_escape_string($con, $_POST['notes']);
    $meals = [];
        
    //user should be session in addition to the restaurantID
    if (isFirst($hour, $date, $id, $table)) {
        $sql = "INSERT INTO `tborder`(`OrderID`,`Phone`, `Date`, `Time`, `RestID`, `PartySize`, `Username`, `TableID`)
        VALUES ('$randomNumber','$phone','$date','$hour:00:00','$id','$partysize','$_SESSION[User]','$table')";
        $result = mysqli_query($con, $sql);
        $email = findEmail("$_SESSION[User]");
        if ($result) {
        // Change RestID to session/url parameters
        $sqlM = "SELECT * FROM tbmenu WHERE RestID='$id'";
        $resultM = mysqli_query($con, $sqlM);
        
        foreach ($_POST['checkbox'] as $mealID) {
            $quantity = $_POST['quantity'][$mealID];
            
            if ($quantity > 0) {
                $meals[$mealID] = $quantity;
            }
        }
       
        //get orderID from url pass it after confirmung the order
        foreach($meals as $ID => $qty) {
            $sqlM1="INSERT INTO tbordermeals (`qty`, `MealID`, `RestID`, `OrderID`) VALUES ('$qty','$ID','$id','$randomNumber')";
       $resultM1 = mysqli_query($con,$sqlM1);
          }
            sendMail($hour, $date, $email);
            echo "<div class='alert alert-success' role='alert'>
            <strong>Table Booked!</strong> Details in your email $email.
            </div> ";
            echo "<script>
            setTimeout(function() {
              window.location.href = '../OrdersClientHistory.php';
            }, 2000);
            </script>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>
            <strong>Oh snap!</strong> Change a few things up and try submitting again.
            </div>";
        }
        if (!empty($extraNotes)) {
          $sqlNote = "UPDATE tborder SET Note='$extraNotes' WHERE OrderID='$randomNumber'";
          $resultNote = mysqli_query($con, $sqlNote);
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>
        <strong>Table Already Booked!</strong> Check Other Dates.
        </div> ";
        echo "<script>
        setTimeout(function() {
          window.location.href = '../restaurant.php?id=$id';
        }, 2000); 
        </script>";
    }
    
}
?>