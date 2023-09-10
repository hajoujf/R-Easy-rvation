<html>
    <!--Start adding tables width height chair breath -->
    <?php 
    $sql = "SELECT * FROM tbrestaurant WHERE RestID= '$_SESSION[id]'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    $width=$row['width']*100;
    $height=$row['height']*100;
    // if(!isset($_SESSION)){
    
    //     session_start();
    // }
    // if(!isset($_SESSION['width'])){
    //     $_SESSION['width']=$_GET['width']+100;
    //     $width=$_SESSION['width'];
    // }
    // else{
    //     $width=$_GET['width']+100;
    // }
    // if(!isset($_SESSION['height'])){
    //     $_SESSION['height']=$_GET['height']+100;
    //     $height=$_SESSION['height'];
    // }
    // else{
    //     $height=$_GET['height']+100;
    // }
    
    ?>
    <style>
        label{
            margin-top:10px;
        }
    </style>
    <body>
        <div  style="display:flex;justify-content:center">
        <form action="Rest/checkT.php" method="post">
        <label>Restaurant Width</label>
        <br>
        <input type="text" id="widthR" name="widthR" 
        value="<?php echo $width;?>" readonly/>
        <br>
        <label>Restaurant Height</label>
        <br>
        <input type="text" id="heightR" name="heightR"
        value="<?php echo $height;?>" readonly/>
        <br>
        <label>Enter Width of your table</label>
        <br>
        <input type="text" placeholder="Width" id="widthT" name="widthT"/>
        <br>
        <label>Enter Height of your table</label>
        <br>
        <input type="text" placeholder="Height" id="heightT" name="heightT"/>
        <br>
        <label>Enter Chair breath/Party Size</label>
        <br>
        <input type="text" placeholder="Chair Breath" id="chairb" name="chairb"/>
        <br><br>
        <div style="margin-left:20px">
        <input  class="btn btn-dark" type="submit" placeholder="Start" id="add" name="add"/>&nbsp
        <button  class="btn btn-dark" type="reset" placeholder="Reset">Reset </button>
    </div>
    </form>
    </div>
    </body>
</html>