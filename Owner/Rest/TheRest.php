<html>
    <?php
    $sql = "SELECT * FROM tbrestaurant WHERE RestID = '$_SESSION[id]'";
    $result = $con->query($sql);
    $row = mysqli_fetch_assoc($result);
if ($row) {
    $width = $row['width'];
    $height = $row['height'];
} else {
    // Default width and height when values are not retrieved
    $width = 0;
    $height = 0;
}
?>
<script src="Rest/Vis.js"></script>
<body onload="init()">
<center>
<canvas id='canvas'> </canvas>
<div style="display:none;">
  <img id="source" src="data:image/jpeg;base64,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" width="300" height="227" />
</div>
<div ><br><center>The <font style="color:green">Green</font> Squares Are the Available Tables in your restaurant!</center></div>

</center>



</form>
</body>
</html>