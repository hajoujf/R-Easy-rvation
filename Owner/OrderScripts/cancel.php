<?php
session_start();
require_once('../../dbCon.php');
// Check if the order ID is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $orderId = $_GET['id'];

    // Fetch the order details
    $sql = "SELECT * FROM tborder WHERE OrderID = '$orderId'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $restaurantId = $row['RestID'];
        $date = $row['Date'];
        $time = $row['Time'];
        $partySize = $row['PartySize'];
        $phone = $row['Phone'];

        // Delete the order from tborder
        $deleteSql = "DELETE FROM tborder WHERE OrderID = '$orderId'";
        $deleteResult = mysqli_query($con, $deleteSql);
        $deleteSql2 = "DELETE FROM tbordermeals WHERE OrderID = '$orderId'";
        $deleteResult2 = mysqli_query($con, $deleteSql2);

        if ($deleteResult && $deleteResult2) {
            // Fetch restaurant owner's email
            $ownerEmailSql = "SELECT Email FROM tbowner WHERE RestID = '$restaurantId'";
            $ownerEmailResult = mysqli_query($con, $ownerEmailSql);
            $sql_tbuser = "SELECT Email FROM tbuser WHERE Username = '$_SESSION[User]'";
            $result_tbuser = mysqli_query($con, $sql_tbuser);

            if (($ownerEmailResult && mysqli_num_rows($ownerEmailResult) == 1) && ($result_tbuser && mysqli_num_rows($result_tbuser) == 1)) {
                $ownerEmailRow = mysqli_fetch_assoc($ownerEmailResult);
                $costumerEmailRow = mysqli_fetch_assoc($result_tbuser);
                $CEmail = $costumerEmailRow['Email'];
                $restaurantOwnerEmail = $ownerEmailRow['Email'];
                // Send email to the Customer
                $subject = "Order Cancellation";
                $message = "Order ID: $orderId\n";
                $message .= "Date: $date\n";
                $message .= "Time: $time\n";
                $message .= "Party Size: $partySize\n";
                $message .= "Phone: $phone\n";
                $message .= "Customer: $_SESSION[User]\n";
                $message .= "Order has been cancelled.";

                $header = 'From:' .$restaurantOwnerEmail.'';

                mail($CEmail , $subject, $message, $header);
            }

            // Redirect to the order history page with a success message
            echo "<script>alert('Order $orderId has been cancelled successfully!');</script>";
            echo "<script>window.location.href = '../ownerside.php#Orders';</script>";
            exit();
        } else {
            // Redirect to the order history page with an error message
            echo "<script>alert('Error occurred while cancelling the order.');</script>";
            echo "<script>window.location.href = '../ownerside.php#Orders';</script>";
            exit();
        }
    } else {
        // Redirect to the order history page with an error message
        echo "<script>alert('Invalid order ID or order does not belong to the current user.');</script>";
        echo "<script>window.location.href = '../ownerside.php#Orders';</script>";
        exit();
    }
} else {
    // Redirect to the order history page with an error message
    echo "<script>alert('Invalid order ID.');</script>";
    echo "<script>window.location.href = '../ownerside.php#Orders';</script>";
    exit();
}
?>
