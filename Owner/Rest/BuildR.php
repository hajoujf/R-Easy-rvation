<html>
    <!--Start building the resturant by typing the width and height of the restaurant
    And then start Adding -->
    <body>
        <form action="" method="post">
        <label>Enter Width of your restaurant</label>
        <br>
        <input type="text" placeholder="Width" id="width" name="width"/>
        <br>
        <label>Enter Height of your restaurant</label>
        <br>
        <input type="text" placeholder="Height" id="height" name="height"/>
        <br>
        <input type="submit" placeholder="Start" id="start" name="start"/>
        <br>
        <button type="reset" placeholder="Reset" >Reset </button>
    </form>
    </body>
</html>
<?php 

if(isset($_POST['start'])){
    $w=$_POST['width'];
    $h=$_POST['height'];
    if($w<0 || $h<0){
        echo "<SCRIPT> 
        alert('Invalid Values')
        window.location.replace('BuildR.php');
    </SCRIPT>";
    }
    else{
        $w*=100;
        $h*=100;
        $_SESSION['width']=$w;
        $_SESSION['height']=$h;
        echo "<SCRIPT> 
        alert('Let`s Start!!')
        window.location.replace('Rest/AddTables.php?width=$w&height=$h');
    </SCRIPT>";
    }

}






?>