<head>

</head>
<div style="display:flex;justify-content:center;align-items:center">
<?php include '../dbCon.php'; 
$restID = "SELECT * FROM tbowner WHERE Username = '$_SESSION[User]'";
$r=mysqli_query($con,$restID);
$D=mysqli_fetch_assoc($r);
echo "
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<br/>

<table border='1'>
<tr> <th>Appetizer <a href='MealScripts/addMeal.php?Category=Appetizer&RId=$D[RestID]'> <i class='fa fa-plus' aria-hidden='true'></i></a></th>

<tr/>
";

$sql= "SELECT * FROM tbmenu WHERE Category='Appetizer' AND RestID IN (SELECT RestID FROM tbowner WHERE Username = '$_SESSION[User]')";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_assoc($result)){
   
    echo "<tr>
    <td>$row[Name] </td>
    <td style='min-width:550px'>$row[Description]</td>
    <td style='min-width:50px;'><center> $row[Price]$</center> </td>
    <td style='padding:0 3px;'> <a class='btn btn-dark' href='./MealScripts/Edit.php?id=" .$row['ID'] ."'> Update </a>
    <a class='btn btn-danger' href='./MealScripts/delete.php?id=" .$row['ID'] ."'> Delete</a> </td>
    </tr>";
}

echo "  
<tr> <th>Main Course <a href='MealScripts/addMeal.php?Category=MainCourse&RId=$D[RestID]'> <i class='fa fa-plus' aria-hidden='true'></i></a></th>
<tr/>
";

$sql= "SELECT * FROM tbmenu WHERE Category='MainCourse' AND RestID IN (SELECT RestID FROM tbowner WHERE Username = '$_SESSION[User]')";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_assoc($result)){
   
    echo "<tr>
    <td>$row[Name] </td>
    <td style='min-width:550px'>$row[Description]</td>
    <td style='min-width:50px;'><center> $row[Price]$</center> </td>
    <td style='padding:0 3px;'> <a class='btn btn-dark' href='./MealScripts/Edit.php?id=" .$row['ID'] ."'> Update </a>
    <a class='btn btn-danger' href='./MealScripts/delete.php?id=" .$row['ID'] ."'> Delete</a> </td>
    </tr>";
}

echo "
<tr> <th> Desserts  <a href='MealScripts/addMeal.php?Category=Desserts&RId=$D[RestID]'> <i class='fa fa-plus' aria-hidden='true'></i></a></th>
<tr/>
";

$sql= "SELECT * FROM tbmenu WHERE Category='Desserts' AND RestID IN (SELECT RestID FROM tbowner WHERE Username = '$_SESSION[User]')";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_assoc($result)){
   
    echo "<tr>
    <td>$row[Name] </td>
    <td style='min-width:550px'>$row[Description]</td>
    <td style='min-width:50px;'><center> $row[Price]$</center> </td>
    <td style='padding:0 3px;'> <a class='btn btn-dark' href='./MealScripts/Edit.php?id=" .$row['ID'] ."'> Update </a>
    <a class='btn btn-danger' href='./MealScripts/delete.php?id=" .$row['ID'] ."'> Delete</a> </td>
    </tr>";
}

echo "</table>"

?>
</div>

