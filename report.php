<?php include "navbar.php";
?>
    <center><h1 style="padding-top:30px">Report this Restaurant</h1>
<small><b><i>State a valid reason to help us make a secure and scam-free website</i></b></small></center><br><br><br>
<div style="display:flex;justify-content:center;width:100%">
    <form  method='post' action='' style="width:90%" >
  <div class="form-group row">
    <label for="Name" class="col-sm-2 col-form-label">Restaurant Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="Name" Value="<?php echo "$_GET[rname]"?>" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="reason" class="col-sm-2 col-form-label">State the reason</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="reason" name='reason' placeholder="example: Restaurant doesn't exist">
    </div>
  </div>
      <center><button class="btn btn-dark" name='submit'>Submit</button></center>
   </form>
</div>

<?php
include "dbcon.php";
if (isset($_POST['submit'])){
    $reason = $_POST['reason'];
    $sql = "INSERT INTO `tbreport`(`Comment`, `RestID`, `RestName`) VALUES ('$reason','$_GET[id]','$_GET[rname]')";
    $result = mysqli_query($con, $sql);
            if ($result) {
                echo "<SCRIPT>
            alert('Restaurant Has been reported!!');
            window.location.href = 'restaurant.php?id=$_GET[id]';
        </SCRIPT>";
            }    

}?>