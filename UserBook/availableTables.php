<?php 
require_once('../dbCon.php');
session_start();
function widthHightTable($tableID){
    /*function that returns the length and width of specific table
    we dont need rest id beacues tbID is primary key */
    $sql="SELECT * FROM tbtable WHERE tableID=$tableID";
    $result=mysqli_query($GLOBALS['con'],$sql);
    if($result){
        $row=mysqli_fetch_assoc($result);
        return [$row['width'],$row['length'],$row['CenterX'],$row['CenterY']];
    }
   return ;
}
function NotfoundInOrder($tableID, $hour, $date)
{
    /*do we have this table in the orders with specific date and hour */
    $sql = "SELECT * FROM tborder WHERE TableID=$tableID";
    $result = mysqli_query($GLOBALS['con'], $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $time = date('H', strtotime($row['Time']));
        $dateOrder = $row['Date'];
        if ($time == $hour && $dateOrder == $date){
            return false;
        }   
    }
    return true;
}
function AllReserved($hour, $date,$RestID)
{
    /*check if specific table of restaurant is reserved or not for the given
     hour and date */
    $sql = "SELECT * FROM tbtable WHERE RestID=$RestID";
    $result = mysqli_query($GLOBALS['con'], $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
      if (NotfoundInOrder($row['tableID'], $hour, $date) == true) {
        $newRow = widthHightTable($row['tableID']);
        $data[] = [$row['tableID'],$newRow];
      }
    }
    return $data;
}
$hour = $_SESSION['hour'];
$date = $_SESSION['date'];
$id = $_SESSION['id'];
$data = AllReserved($hour,$date,$id);
echo json_encode($data);

?>
