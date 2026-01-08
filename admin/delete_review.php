<?php
session_start();
include("../connection/connect.php");
error_reporting(0);

if (!isset($_SESSION['adm_id'])) {
    // Redirect to login page if the user is not logged in
    header("Location: index.php");
    exit();
}

// Check if rp_id is set in the URL parameters
if(isset($_GET['rp_id'])) {
    // Sanitize input
    $rp_id = mysqli_real_escape_string($db, $_GET['rp_id']);
    
    // Execute delete query
    $query = mysqli_query($db, "DELETE FROM report WHERE rp_id = '$rp_id'");
    
    if($query) {
        // Redirect to review.php after successful deletion
        header("Location: reviews.php");
        exit();
    } else {
        // Error occurred, display an error message
        echo "Error: Unable to delete review. Please try again later.";
        exit();
    }
} else {
    // rp_id is not set in the URL parameters, redirect or display an error message
    echo "Error: rp_id is not set.";
    exit();
}
?>
