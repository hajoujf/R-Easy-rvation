<?php include '../../dbCon.php';
function notFoundMeal($RestID, $MealName)
{
    //functino that gets the restID and name of a meal
    //Returns true if it isnt found in db else false
    $sql = "SELECT * FROM tbmenu WHERE RestID='$RestID' AND Name='$MealName'";
    $result = mysqli_query($GLOBALS['con'], $sql);
    $row=mysqli_fetch_assoc($result);
    if ($row!=null)
        return false;
    return true;

}
function addMealtoDB($Name, $Des, $price, $Category, $RestID)
{
   
    //function that enters the data into tbmenu
    if (notFoundMeal($RestID, $Name)==false)
        echo "<SCRIPT> 
    alert('Meal Already Exists')
</SCRIPT>";
    else {
        $sql = "INSERT INTO `tbmenu`(`Name`, `Description`, `Price`, `Category`, `RestID`) VALUES 
('$Name','$Des','$price','$Category','$RestID')";
        $result = mysqli_query($GLOBALS['con'], $sql);
        if ($result) {
            echo "<SCRIPT>
        alert('Added succefully');
        window.location.href = '../ownerside.php#Menu';
    </SCRIPT>";

        } else {
            echo "<SCRIPT>
    alert('Something went wrong, try again')
</SCRIPT>";

        }
    }

}
?>

<html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<body>
<div class="jumbotron">
        <h1 class="text-center">
            Enter Meal Details
        </h1>
    </div>
<div style="display:flex;justify-content:center;">
<form  method='post' action='' style="padding:30px 50px;width:550px">
    <center>
</center>
  <div class="form-group">
    <label >Meal Name</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
  </div>
  <div class="form-group">
    <label>Description</label>
    <input type="text" class="form-control" name="desc" id="desc" placeholder="Enter description">
  </div>
  <div>
    <label>Price</label>
    <input type="number" class="form-control" name="price" id="price" placeholder="Enter Price">
  </div>
  <br/>
  <center>
  <a href="../ownerside.php#Menu" class="btn btn-info"> Back </a>
  <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
</center>
</form>
</body>
</html>

<?php 
if(isset($_POST['submit'])){
    $RestID=$_GET['RId'];
    $name=$_POST['name'];
    $desc=$_POST['desc'];
    $price=$_POST['price'];
    $category=$_GET['Category'];
    addMealtoDB($name,$desc,$price,$category,$RestID);

}



?>
</div>