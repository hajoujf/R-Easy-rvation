<html>
    <script src="canvaV1.js"></script>
<body onload="init()">
<?php 
$width=0;
$height=0;
if(!isset($_SESSION)){

    session_start();
}
if(!isset($_SESSION['width'])){
    $_SESSION['width']=$_GET['rtw']+100;
    $width=$_SESSION['width'];
}
else{
    $width=$_GET['rtw']+100;
}
if(!isset($_SESSION['height'])){
    $_SESSION['height']=$_GET['rth']+100;
    $height=$_SESSION['height'];
}
else{
    $height=$_GET['rth']+100;
}


?>
<center><h1>Click on the black squares to add tables to the restaurant!</h1></center>
<div style="display:flex;justify-content:center;margin-left:130px">
<canvas id='canvas' onclick='boardClicked(event)' 
width="<?php $w= $width; echo $w?>" height="<?php $h=$height; echo $h;?>" > </canvas>
</div>
<div style="display:flex;justify-content:center;margin-left:90px">
<form action='' method='post'>
<button> <a href="../ownerside.php#Vis" style="text-decoration: none;color:black"> Back to Home </a></button>

<button id='bob' name='bob' onclick='sendData()'> Add The Tables</button>

    <?php if(!isset($_POST['bob'])){}
    else {
        echo "<SCRIPT>
    alert('Done')
        </SCRIPT>";
        echo "<Script> window.location.href='../ownerside.php#Vis'; </SCRIPT>";
    }
    ?>
</form>
<div style="display:flex;justify-content:center;margin-left:70px">
</body>
</html>